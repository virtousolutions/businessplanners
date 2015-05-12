<?php

class PlanController 
extends BaseController 
{
    protected $main_pages = null;
    protected $sub_pages = null;
    protected $current_main_page_id = null;
    protected $business_plan = null;

    protected $has_financial_statement = ['standard', 'professional', 'premium'];

    public function __construct()
    {
        parent::__construct();
        
        $user = Auth::getUser();
        $id = DB::table('business_plans')->where('user_id', $user->id)->pluck('id');

        if ($id) {
            $this->business_plan = BusinessPlan::find($id);
        }
    }

    protected function checkAccess()
    {
        $segment_1 = Request::segment(1);

        if ($segment_1 == 'create') {
            if ($this->business_plan) {
                return Redirect::to('plan/details/' . $this->business_plan->id);
            }
        }
        else if ($segment_1 == 'plan') {
            if (!$this->business_plan) {
                return Redirect::to('create');
            }
             
            $segment_2 = Request::segment(2);

            if ($segment_2 == 'financial-statements' && !in_array(Auth::getUser()->package, $this->has_financial_statement)) {
                return Redirect::to('plan/details/' . $this->business_plan->id);
            }
        }
    }

    public function index()
    {
        if ($this->business_plan) {
            return Redirect::to('plan/details/' . $this->business_plan->id);
        }
        else {
            return Redirect::to('create');
        }
    }

    public function profile()
    {
        $this->layout = View::make('layout.plan');
        
        Asset::container('header')->add("profile-css", "assets/css/plan/profile.css");

        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add("profile-js", "assets/javascript/plan/profile.js");

        $countries = DB::table('countries')->orderBy('country_name')->lists('country_name', 'id');
        $countries = ['' => 'Select'] + $countries;
        
        View::share('subheader_description', 'Edit Profile');

        $this->layout->content = View::make("plan.profile", [
            'user' => Auth::getUser(),
            'countries' => $countries
        ]);
    }

    public function profileSubmit()
    {
        $input = Input::all();
        
        Auth::getUser()->fill($input);
        Auth::getUser()->save();

        return Redirect::to('profile')->with('the-message', 'Successfully saved your changes');
    }

	public function create()
    {
        $this->layout = View::make('layout.plan');
        
        Asset::container('header')->add("create-css", "assets/css/plan/details.css");

        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add("create-js", "assets/javascript/plan/details.js");

        $currentYear = date('Y');
    	$currentMonth = date('M');
	    $service = new PlanEmployeeService();
    	$defaultMonthist = $service->twelveMonthsSetting($currentYear, $currentMonth);

        $this->layout->content = View::make("plan.create", [
            'dummy_bp_name' => '', 
            'months' => $defaultMonthist,
            'plan_year' => $currentYear,
            'bp_user_id' => Auth::getUser()->id,
            'bp_id' => 0,
            'plan_details_form_button_text' => 'Create New Plan'
        ]);

        return $this->checkAccess();
    }

    public function createSubmit()
    {
        $input = Input::get();

        $new_plan = BusinessPlan::create($input);

        // redirect to details
        return Redirect::to('plan/details/' . $new_plan->id);
    }

    public function details($id)
    {
        Asset::container('header')->add("create-css", "assets/css/plan/details.css");

        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add("create-js", "assets/javascript/plan/details.js");

        $currentYear = date('Y');
    	$currentMonth = date('M');
        $service = new PlanEmployeeService();
        $months = $service->twelveMonthsSetting($currentYear, $currentMonth);
        $business_plan = BusinessPlan::find($id);
        $date = strtotime($business_plan->bp_financial_start_date);
        $plan_year = date('Y', $date);
        $plan_month = date('F', $date);

        $this->displayPage(
            $business_plan, 
            [], 
            [
                'months' => $months, 
                'plan_name' => $business_plan->bp_name, 
                'plan_year' => $plan_year,
                'plan_month' => $plan_month,
                'bp_user_id' => 1,
                'bp_id' => $business_plan->id,
                'plan_details_form_button_text' => 'Save Details'
            ], 
            null,
            ['layout_page' => "plan.details"]
        );

        return $this->checkAccess();
    }

    public function submitDetails($id)
    {
        $input = Input::get();
        $plan = BusinessPlan::find($input['bp_id']);

        $plan->fill([
            'bp_name' => $input['plan_name'],
            'bp_financial_start_date' => date("M", strtotime($input['start_month'])) . " " . $input['start_year']
        ]);
        $plan->save();

        return Redirect::to('plan/details/' . $plan->id)->with('message', 'Successfully saved changes');
    }

    protected function getPageContents($bp)
    {
        $page_ids = array_keys($this->sub_pages[$this->current_main_page_id]);
        $page_contents = DB::table('bp_pages')->where('bp_id', $bp->id)->whereIn('pageid', $page_ids)->get();
        
        $values = [];
        $subs   = $this->sub_pages[$this->current_main_page_id];

        foreach ($page_contents as $page_content) {
            $values[str_replace('-', '_', $subs[$page_content->pageid]->pageurl)] = $page_content->page_content;
        }

        return $values;
    }

    protected function displayPage($business_plan, $images, $instructions, $section, $sub_page_sections_data = [])
    {
        Asset::container('footer')->add('tinymce-js', 'assets/plugins/tinymce/jscripts/tiny_mce/tiny_mce.js');
        Asset::container('footer')->add("plan-edit-js", "assets/javascript/plan/edit.js");

        $pages = DB::table('pages')
                    //->where('pageorder', '>', '0')
                    ->where('parentid', '>', '0')
                    ->orderBy('parentid', 'ASC')
                    ->orderBy('pageorder', 'ASC')
                    ->get();

        // parse the pages
        $selected_main    = Request::segment(2);
        $selected_main_id = null;
        $mainpages        = [];
        $subpages         = [];
        $fs_index         = 0;

        foreach ($pages as $page) {
            if (array_key_exists($page->parentid, $mainpages)) {
                // this is a subpage
                $subpages[$page->parentid][$page->pageid]  = $page;
            }
            else {
                $mainpages[$page->pageid] = $page;
                $subpages[$page->pageid]  = [];

                if ($selected_main == $page->pageurl) {
                    $selected_main_id = $page->pageid;        
                }

                if ($page->pageurl == 'financial-statements') {
                    $fs_index = $page->pageid;
                }
            }
        }

       if (!in_array(Auth::getUser()->package, $this->has_financial_statement)) {
            unset($mainpages[$fs_index]);
        }
        
        $this->main_pages = $mainpages;
        $this->sub_pages = $subpages;
        $this->current_main_page_id = $selected_main_id;

        $subpagesections = [];
        $sectionids = [];
        $values = [];
        $section_values = [];
        
        if (!in_array($selected_main, ['details', 'print'])) {
            $page_sections = DB::table('page_sections')->whereIn('s_pageid', array_keys($subpages[$selected_main_id]))->orderBy('section_order', 'ASC')->get();

            foreach ($page_sections as $row) {
                if (!isset($subpagesections[$row->s_pageid])) {
                    $subpagesections[$row->s_pageid] = [];
                }

                $subpagesections[$row->s_pageid][$row->section_id] = $row;
                $sectionids[] = $row->section_id;
            }

            if ($selected_main == 'executive-summary') {
                $es = $business_plan->executiveSummary();
                $values = $es ? $es->getAttributes() : [];
            }
            else {
                $values = $this->getPageContents($business_plan);
            }

            $section_values = empty($sectionids) ? [] : DB::table('bp_page_sections')
                                    ->where('bp_id', $business_plan->id)
                                    ->whereIn('section_id', $sectionids)
                                    ->lists('section_content', 'section_id');
        }
        
        View::share('plan_main_pages', $mainpages);
        View::share('plan_sub_pages', $subpages);
        View::share('plan_sub_page_sections', $subpagesections);
        View::share('plan_main_page', $selected_main);
        View::share('plan_main_page_id', $selected_main_id);
        View::share('plan_sub_page', Request::segment(3));
        View::share('business_plan', $business_plan);
        
        $this->layout = View::make('layout.plan');

        $this->layout->content = View::make(
            isset($sub_page_sections_data['layout_page']) ? 
                $sub_page_sections_data['layout_page'] : 
                'plan.edit-page', 
            [
                'sub_page_images' => $images,
                'values' => $values,
                'instructions' => $instructions,
                'section' => $section,
                'section_values' => $section_values,
                'sub_page_sections_data' => $sub_page_sections_data
            ]
        );

        return $this->checkAccess();
    }

    public function executiveSummary($section, $id)
    {
        $images = [
            'contract.png',
            'box.png',
            'chart_line.png',
            'cashier.png'
        ];

        $instructions = [
            'Introduce yourself and your company; this should be a summary of what write about in detail in the Company section of your plan. Recap the main points from that section, think about you reader, tell your story, and make them want to read more.',
            'Details about the products or services you offer and your competitors. Give a recap of the major points you write about in the Products and Services section, but keep it brief. Save the full detail for later.',
            'Details of your target clients/customers for your products/services and how you plan to get your message to them. Remember, this should be a summary of your main points from the Target Market section. Just focus on the most salient details here.',
            'Give a summary of your projected sales and expenses which is explained in detail in the Financial Plan section. Talk about the logic you used to arrive at your sales forecast. If you are starting a business, when do you expect to show a profit?'
        ];

        $business_plan = BusinessPlan::find($id);
        $this->displayPage($business_plan, $images, $instructions, $section);
    }

    public function company($section, $id)
    {
        $images = [
            'com_over.gif',
            'man_team.gif',
            'man_team.gif',
            'man_team.gif',
            'man_team.gif'
        ];

        $instructions = [
            'The Company Overview introduces your business - outlining the basic facts and details of your company <br/><br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How long have you been in business? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What is the main company address? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Are there any other locations? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;If this is a new business, will you be starting from a home office? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Who owns the company?<br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Who are members of your management team?<br/><br/>

You can use the other topics in this section to break down this information and give more details. If you do, then this topic should cover only the main points.',
            'List the members of the management team and their responsibilities within the company. Include a summary of their backgrounds and experience. Give as much detail as you can to show how you and your team will handle the needs of running the business.<br/><br/>

<u>If you are a start-up business will you yourself be covering multiple functions? </u><br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What areas of the business best suit your expertise?<br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;In what areas are you least qualified? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Do you plan to recruit someone to handle this area of the business? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;When do you plan to fill those gaps? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Will you be recruiting a full-time person or an outside contractor?<br/>',
            'Give a brief description of the office, shop or factory space your business occupies, its square footage and location. Detail any facilities that could be advantages to you company in serving your clients/customers, for example high street location, car parking space for clients and close to public transport.
<br/><br/>
If you will be working from a home office, is this a temporary location? Are you planning for a separate location in the near future? If so, detail the long-term plan for your office, its location and when you expect  this change to happen.',
            'Your mission statement is meant to be a simple, internal message for you and your employees: 
<br/><br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What is the core value and purpose of the company? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What is the vision, which will guide company decisions, now and in the future? <br/>
<br/>
Think of it as the rally cry for you and your employees; this is the reason why you do what you do, every day. All other goals should support this mission.',
            'This is where you tell the company story; outline where the company started and how it got to where it is now.
<br/><br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What year did it start? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Where was it first located? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What was the original product or service? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What has changed since then? 
<br/><br/>
Mention the good years, bad years, new services, new locations and new partners/directors. Highlight an important date or event which had an impact on the business.'
        ];

        $business_plan = BusinessPlan::find($id);
        $this->displayPage($business_plan, $images, $instructions, $section);
    }

    public function products($section, $id)
    {
        $images = [
            'Prodservi.gif',
            'comp.gif',
            'comp.gif',
            'cashier.png',
            'cashier.png',
            'cashier.png'
        ];

        $instructions = [
            'Products and services define what you sell to your customers. You may want to group similar
			 products/services together, rather than listing them individually. Describe the main features of each. 
			 What need does the product or service fill for your customers?',
            'All businesses are in competition for Clients and customers. Who competes with your company? <br/><br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Do they compete directly with you (for example, restaurants, hair dresser and dry cleaners)? <br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Are you a high street store competing with an online catalogue?<br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Manufacturing business competing in a specialised market?<br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Service Industry providing a professional service? <br/>
		<br/>
		The more you know about them, the better you are able compete with them. <br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;List your main competitors and what they do well? <br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What do you think your company does better and why?<br/>',
            'As your business grows are you thinking of developing or adding new products and services to the company. 
		If so, detail them here. This may only be a simple statement of intent as to what you would like to see 
		happen once the company reaches a stage in its growth. <br/><br/>
		
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Do you need to reach a certain level of sales first? <br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Are you still developing details of a service or the design of a new product?<br/>',
            'Do you source materials, buy parts or supplies before you manufacture the products you sell or the services you offer? <br/><br/>

			&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Do you buy materials or services from more than one company? <br/>
			&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Do you have an agreement to buy from only one supplier? <br/>
			&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Do they offer payment options which help you keep the costs down? <br/><br/>
			
			These purchase costs become part of the costs of your goods or services. It is important to understand these
			 costs and how they can impact on your selling price. It is important you regularly negotiate with your suppliers to
			  keep these costs are as low as possible.
			<br/><br/>
			Product fulfilment might include the costs to make, store, assemble or deliver the product to the customer. ',
            'Does your company rely on technology or a technical skill/service as an important element in how you 
			provide your product or service to your clients/customers? <br/><br/>

			&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Does your company have exclusive rights to use this technology? <br/>
			&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Do you have a process in place to protect against losing this technology? <br/>
			&nbsp; &#8226;&nbsp;&nbsp;&nbsp;If the technology became unavailable to your business, would you still be able to provide your product or service?',
            'Does your company have any copyrights, trademarks, patents or licensing in place which gives your company an 
			advantage over your competitors? <br/><br/>
			&nbsp; &#8226;&nbsp;&nbsp;&nbsp;If so will any of these expire in the near future? <br/> 
			&nbsp; &#8226;&nbsp;&nbsp;&nbsp;If a business was violating any of your protected rights or infringing a licensing agreement, 
			do you have a process in place to stop them?<br/>'
        ];

        $business_plan = BusinessPlan::find($id);
        $this->displayPage($business_plan, $images, $instructions, $section);
    }

    public function targetMarket($section, $id)
    {
        $images = [
            'com_over.gif',
            'man_team.gif',
            'man_team.gif',
            'man_team.gif',
            'man_team.gif',
            'man_team.gif'
        ];

        $instructions = [
            'If someone asks you who is your client/customer?<br/><br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How do you answer them? <br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How much do you know about the people you want to sell to? <br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Where can you find this information?<br/><br/>
		
		Start by asking yourself what need your product or service fills for your clients/customers. 
		Then think about how (or where) your customers find you, how they buy from you? <br/><br/>
		
		As you answer these questions, you will start to see a similar need - location, price point, quality level, 
		and prestige - or other common reason they choose to do business with you. <br/><br/>
		
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Do your products appeal to a certain age group? <br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Do you sell more to men, or more to women? Why? <br/><br/>
		
		Based on shared reasons or traits, you can divide them into groups and define your core target market.<br/><br/>
		
		You also want to show what\'s going on with this market (growth, trends), and how your business fits into the larger 
		industry that meets this market\'s needs.',
            'This is where you want to step back and look at your business through your customers\' eyes. <br/><br/>

&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What problem does your business solve for them? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What do you offer them that they can\'t get anywhere else? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Are your competitors failing them in some key way?<br/><br/>

			If you are marketing to more than one group of customers, do this exercise for each group. You may find the needs of 
			the groups are very different. You want your marketing message to match the solution your product gives to each customer group.',
            'Nothing in life stands still, as the saying goes \'The only constant is change.\' Having a business is a perfect way to see change in action. 
		Just when you think you have identified your core market, it changes. What you think your clients/customers want or need changes. 
		There\'s a shift in direction.
		<br /><br />
		Change happens for many different reasons. No matter the reason, it is important to be able to recognise when a change can or 
		will affect your business. You should look for, and be aware of, market trends. Think of trends as a way to get ahead of the 
		market and understand where it is going before it gets there.',
            'An important factor for any business is to understand its market and how it is developing.<br/><br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Has it changed, where is the market for your business going? <br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Is it moving in a different direction from where it has been? <br/>
		&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How can you use your strengths to take advantage of this growth?<br/><br/>
		
		Be able to confirm sustained market growth can enhance the implied value of your business. It is therefore important to find data which supports your market estimates. This is particularly important if you are presenting your business plan to secure for outside funding. Look to market research firms, trade associations, or credible journalists, and include their findings here. The Internet is a great place to research for this type of content.',
            'This is not just about your company but your industry. <br /><br />
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What type of industry is it? <br />
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;What common traits best describe the industry? <br />
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How do businesses in this industry make, buy, sell, and deliver their products or services? <br />
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How does this industry\'s customer make their buying decisions? For example, is reputation more important than price?<br />',
            'When considering your potential clients/customers you will inevitably focus on a select group within your target market.
		These are the ones you identify as those most likely to value your products and services at the prices you set. 
		<br/><br/>
		Write one paragraph describing this client/customer group and what they have in common. 
		Then write a second paragraph explaining why your main focus will on these customers, and not others.'
        ];

        $business_plan = BusinessPlan::find($id);
        $this->displayPage($business_plan, $images, $instructions, $section);
    }

    public function strategy($section, $id)
    {
        $images = [
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            ''
        ];

        $instructions = [
            'The small business owner will often neglect to establish an effective marketing strategy believing their product or service will sell itself. However it is one of the most important factors for any business to succeed. You can have the best product in the world, but if you can\'t find customers or importantly they can\'t find you, your business will fail.
Fortunately, marketing is mostly common sense. It\'s about answering basic questions about your business:<br/><br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Who has a need for your product/service?  <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Who are your competitors and how do you compare? <br/> 
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How much will you charge? <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How will you promote your products?<br/> 
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;Will you sell directly or through third parties? <br/>

<br/><br/>
<strong>Overview</strong><br/>
A marketing plan should broadly outline three things: <br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How you differentiate your business from your competitors;<br/> 
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How you will communicate that difference<br/>
&nbsp; &#8226;&nbsp;&nbsp;&nbsp;How you target your message to the right audience. <br/>
A marketing plan is about generating qualified leads. Your sales plan will address how you close the sales.',
            'The successful execution of your business plan is likely to depend on a handful of key events. </p>
<ul>
<li>	When will the new product you are developing start generating revenue? </li>
<li>	How quickly can you recruit the right marketing team to generate new leads?</li>
<li>	How long will it take to source and relocate to new offices?</li>
</ul>
<p>In this section, identify the \'milestone events\' that are strategically important for your business, and make your best guesstimate when you will achieve them. This is not a detailed task list of everything your business needs to do. Instead, include only those key events that represent important assumptions affecting the rest of your plan.</p> 
<br/>
<p>You should review and update your milestones regularly. When key events are completed early or slip to a later date, this is a good time to review and revise your plan to ensure that it is still achievable.</p>
<br/>
<strong>Establishing Milestones</strong>
<p>If your goal is to get your business started, then a milestone is the date to complete a task which brings you closer to your goal. Track the important tasks; don\'t try to create a detailed \'to-do\' list. </p>
<ul>
<li>	Set a date and a budget (if necessary) for each milestone. </li>
<li>	Explain what\'s involved,</li> 
<li>	Who is responsible</li>
<li>	When it should happen. </li>
</ul>
<p>This will help you keep track of your progress, and keep your goal in sight.',
            'Preparing a SWOT analysis is a relatively simple task. The acronym stands for \'Strengths, Weaknesses, Opportunities, and Threats.\' The idea behind this exercise is for you to focus on and describe your company\'s strategic position in these four areas. </p>
<ul>
<li>	What are the greatest strengths and weaknesses of your company? </li>
<li>	Where do you see your most promising opportunities? </li>
<li>	What competitive threats do you need to avoid or overcome to take advantage of those opportunities?</li>
</ul>
<p>',
            'The nature of business is to compete to gain and retain clients/customers who will choose your company\'s products and services.</p> 
<ul>
<li>	Who are you competing against? </li>
<li>	What do they do well? </li>
<li>	What do they do poorly? </li>
<li>	Is there a reason why clients/customers will choose to buy from you instead? </li>
<li>	Is your product or service simpler, faster, better for the customer? </li>
</ul>
<p>Please give details of what you believe to be your competitive edge and why clients/customers will choose your company over that of a competitor.',
            'In the Target Market section, you identified your client/customer group on which to concentrate your promotional activity. Given your knowledge of this group how do you propose to promote your company and product/services to them? </p>
<ul>
<li> Amongst other methods will you use newspaper/magazine ads, direct mail, radio ads, the internet, or point of sale? </li>
<li>	What is your unique selling proposition to encourage new customer to contact you? </li>
<li>	Will you offer regular clients/customers special offers/discounts? </li>
</ul>
<p>
What will the frequency of your advertising and promotional activity - Daily, Weekly or Monthly? What budget will you allocate to your advertising and promotional activity and how will you monitor the return? Find a way to track the results it gives you and record how many new leads it produces. Are you getting value for money, maybe you will need to look at your approach and try other media?',
            'It is very easy after all the effort of attracting a client/customer to lose them through a poor sales process. It is essential to ensure you have efficient systems and process in place to complete the sale, leaving your client/customer feeling happy and their custom valued</p>

<ul>
<li>	What are the steps in your sales process? </li>
<li>	Do you have information you give the customer at the time of the sale?</li> 
<li>	Do you explain in person or in writing the sales process? </li>
<li>	Do you follow up, in person or in writing, with update information about the progress, or the date of completion?</li>
</ul>
<p>Making the entire experience simple for your clients/customers will go a long way to building confidence in your company and retaining them as a client.',
            'The marketing plan creates the strategy to reach new customers. Your sales plan is the process to close the deals that your marketing plan opens. 
<br/><br/>
<p>
You want your sales plan to explain:</p>
<ul>
<li>	The steps you follow to close a sale.</li>
<li>	How you reward your sales team; do they receive a commission for each sale?</li>
<li>	How the company processes and tracks the order once it\'s received.</li>
<li> 	How you keep in contact with your customers throughout the sales process.</li> 
<li>	Where and how do you store customer information?</li>
<li>	What is the final step in your sales process?</li>

</ul>
<p>',
            'Strategic alliances with other businesses or major organisations can be of major benefit and will enhance your company profile and be of get value in your sales and marketing activity. </p>
<ul>
<li>	Maybe you have a licensing agreement to bring to market a technology that another company or group have developed. </li>
<li>	Maybe you have an opportunity to cooperate on marketing activities with a company who offers a complementary product or customer base. </li>
<li>	Maybe you have a relationship with a service organisation that provides training or support to your customers. </li>
<p>Give full details to ensure all readers of your business plan are aware of these valuable connections.',
            'When preparing your business plan an aspect that should be defined is your exit strategy. This is particularly important if you are looking for outside investment into your business. Investors before trusting you with their money, will want to know how they will get their money back - and will they make a healthy profit. 

Two exit strategies are common;</p>
<ul>
<li>One is acquisition, if your company does well, larger players in your industry may want to buy it rather than try to compete with it. </li>
<li>A second common exit strategy is going public, taking your company onto a public stock market so its shares of stock can legally be bought and sold.</li>
</ul>
<p>'
        ];
        
        $business_plan = BusinessPlan::find($id);
        $this->displayPage($business_plan, $images, $instructions, $section);
    }

    public function financialPlan($section, $id)
    {
        $business_plan = BusinessPlan::find($id);

        Asset::container('header')->add("financial-plan-css", "assets/css/plan/financial_plan.css");
        Asset::container('header')->add("widget-css", "assets/css/plan/widget_pages.css");
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add("financial-plan-js", "assets/javascript/plan/financial_plan.js");

        $images = [
            'Sale_forec.gif',
            'Pers_pan.gif',
            'Budget.gif',
            'chart_line.png',
            'bookmark.png'
        ];

        $instructions = [
            '<p>The financial future of your business begins with your projected sales. This is just your best guess at how much revenue your business will generate in the coming years. Think of your forecasted sales as the paycheck for your company. Just like at home, you can\'t really dial in your budget until you know roughly how much money you\'ll have to spend. That\'s what the forecast provides.</p>
            <p>The future is uncertain, of course. No one knows exactly how your business will do. The best anyone can do is an educated guess. Knowing all that you know about your particular business, though, your educated guess is actually worth a lot.</p>
            <p>The table builder will walk you through the details one step at a time. Be realistic here. Your business plan does not need to shoot for the sort of ambitious targets that you might share with your sales staff as motivational goals. The numbers in the sales
                forecast should be reasonable, maybe even a bit conservative, so that you can achieve them and stay on plan.</p>',
            null,
            null,
            'Managing cash flow is one of the most important aspects of business. In the planning phase, you can radically change your cash outlook by adjusting a few basic assumptions about when you pay and get paid. This section, which is a required part of full financials, walks you through those assumptions, which are also available in the plan settings.',
            '<p>Sometimes regular sales are not enough to fund growth, especially for startups. Will your business need additional funding to balance your budget, finance major purchases, or meet other objectives? This section makes it easy to determine your funding needs and to build loans, investments, credit lines, credit cards, or less-specific funding sources into your plan.</p>'
        ];

        $cash_flow_data = $business_plan->CashFlowProjections();
        $sales_calculator = new PlanSalesCalculatorService($business_plan);
        $personnel_calculator = new PlanPersonnelCalculatorService($business_plan);
        $budget_calculator = new PlanBudgetCalculatorService($business_plan, $personnel_calculator);
        $loans_calculator = new PlanLoansCalculatorService($business_plan);

        $options = Input::get();

        $sales_graph = new SalesGraphService($business_plan, $sales_calculator);
        $sales_graph_images = $sales_graph->getGraphs();

        $budget_graph = new BudgetGraphService($business_plan, $budget_calculator);
        $budget_graph_images = $budget_graph->getGraphs();

        $sub_page_sections_data = [
            'details' => [
                ['Sales Forecast Table', 'Gross Margin by Year', 'About Sales Forecast'],
                ['Personnel Plan', 'About Human Resources'],
                ['Budget Table', 'Expenses by the Year', 'About Budget'],
                ['Cash Flow Projections Table', 'Expenses by the Year', 'About Cash Flow Projections'],
                ['Loans and Investments Table', 'Expenses by the Year', 'About Loans and Investments']
            ],
            'includes' => [
                'plan.financial-plan.sales-forecast',
                'plan.financial-plan.human-resources',
                'plan.financial-plan.budget',
                'plan.financial-plan.cash-flow-projections',
                'plan.financial-plan.loans-and-investments',
            ],
            'data' => [
                ['calculator' => $sales_calculator, 'graphs' => $sales_graph_images],
                ['calculator' => $personnel_calculator],
                ['calculator' => $budget_calculator, 'graphs' => $budget_graph_images],
                $cash_flow_data,
                ['calculator' => $loans_calculator],
            ],
            'options' => $options
        ];

        $this->displayPage($business_plan, $images, $instructions, $section, $sub_page_sections_data);
    }

    public function financialStatements($section, $id)
    {
        Asset::container('header')->add("financial-plan-css", "assets/css/plan/financial_plan.css");
        Asset::container('header')->add("widget-css", "assets/css/plan/widget_pages.css");

        try {
            $business_plan = BusinessPlan::find($id);
            $cash_flow_data = $business_plan->CashFlowProjections();
            
            $sales_calculator = new PlanSalesCalculatorService($business_plan);
            $personnel_calculator = new PlanPersonnelCalculatorService($business_plan);
            $budget_calculator = new PlanBudgetCalculatorService($business_plan, $personnel_calculator);
            $loans_calculator = new PlanLoansCalculatorService($business_plan);
            $fs_calculator = new PlanFinancialStatementsCalculatorService($business_plan, $sales_calculator, $personnel_calculator, $budget_calculator, $loans_calculator);

            $sales_graph = new SalesGraphService($business_plan, $sales_calculator);
            $sales_graph_images = $sales_graph->getGraphs();

            $budget_graph = new BudgetGraphService($business_plan, $budget_calculator);
            $budget_graph_images = $budget_graph->getGraphs();

            $pl_graph = new ProfitAndLossGraphService($business_plan, $fs_calculator);
            $pl_graph_images = $pl_graph->getGraphs();
        }
        catch (Exception $e) {
            return $this->displayPage($business_plan, [], [], $section, ['layout_page' => "plan.financial-statements.cannot-access"]);
        }

        $images = [
            'pie_chart.png',
            'balance_icon.png',
            'coins_icon.png',
        ];

        $instructions = [
            '<p>The profit and loss statement (also known as the "income statement") is the most common of the standard financial reports that bankers and investors will expect to see in your business plan. It shows your revenues, your expenses, and the difference between the two - that is, your net profit or "bottom line." Is your company going to make more money that it spends?</p>
            <p>Note that the Profit and Loss Statement here is not directly editable. It is a read-only display of information from other sources. To change the P&L, go to the more detailed tables in the Financial Plan sections, and make your changes there. The P&L will update automatically.</p>',
            '<p>The balance sheet is one of the three standard financial statements. Unlike the profit and loss statement, which measures activities and their effect on profitability during a given period, the balance sheet is a snapshot of the company\'s financial position as of the last day of the period.</p>
            <p>How much cash is on hand? What additional value do you have available in major purchases ("assets"), outstanding payments due in from customers, and unsold inventory? How much do you owe for unpaid bills, loan and credit-line payments, and so on? Is the company producing long-term value for its owners or stockholders? Lenders and investors will review the balance sheet carefully to better understand the company\'s strengths and prospects.</p>
            <p>Note that the Balance Sheet shown here is not directly editable. It is a read-only display of information from other sources. To change the balance sheet, go to the more detailed tables in the Financial Plan sections, and make changes there. The balance sheet statement will update automatically.</p>',
            '<p>Cash flow is the most important aspect of your business - period. Profitability is important in the long term, but as many entrepreneurs have learned the hard way, it is quite possible to be profitable on paper up until the moment your business fails. There is a big difference between money due in soon and cash on hand today, especially when it comes time to place orders or pay bills.</p>
            <p>The cash flow statement - the third of the three most common financial statements - is a valuable tool for understanding and planning your cash flow. The cash flow statement is not a snapshot like the balance sheet. Instead, it measures the change in cash during a period. How much money did you start and end with? What changed in between to make it go up or down? This view of future cash is one of the most important things about business planning. It enables you to see whether your plans, if executed well, will produce and maintain a sustainable business.</p>
            <p>Note that the Cash Flow Statement shown here is not directly editable. It is a read-only display of information from other sources. To change the cash flow, go to the more detailed tables in the Financial Plan sections, and make changes there. The cash flow statement will update automatically.</p>'
        ];

        $sub_page_sections_data = [
            'details' => [
                ['Profit and Loss Statement', 'Net Profit (or Loss) by Year', 'Gross Margin by Year', 'About the Profit and Loss Statement'],
                ['Balance Sheet', 'About Balance Sheet'],
                ['Cash Flow Statement', 'About Cash Flow Statement'],
            ],
            'includes' => [
                'plan.financial-statements.profit-and-loss',
                'plan.financial-statements.balance-sheet',
                'plan.financial-statements.cash-flow'
            ],
            'data' => [
                [
                    'sales_calculator' => $sales_calculator, 
                    'personnel_calculator' => $personnel_calculator, 
                    'budget_calculator' => $budget_calculator,
                    'fs_calculator' => $fs_calculator,
                    'sales_graph' => $sales_graph_images,
                    'budget_graph' => $budget_graph_images,
                    'pl_graph' => $pl_graph_images
                ],
                ['calculator' => $fs_calculator],
                ['calculator' => $fs_calculator],
            ],
            'options' => []
        ];
        
        $this->displayPage($business_plan, $images, $instructions, $section, $sub_page_sections_data);
    }

    public function savePage()
    {
        $data = Input::get();
        $bp = BusinessPlan::find($data['business_plan_id']);
        
        if ($data['main_section'] == 'executive-summary') {
            $main_section_class = trim(str_replace(' ', '', ucwords(str_replace('-', ' ', $data['main_section']))));

            $obj = $bp->$main_section_class();

            if (!$obj) {
                $obj = new $main_section_class();
                $obj->business_plan_id = $bp->id;
            }

            $column = trim(str_replace('-', '_', $data['sub_section']));

            $obj->$column = $data['page_content'];

            $obj->save();
        }
        else {
            $id = DB::table('bp_pages')->where('bp_id', $data['business_plan_id'])->where('pageid', $data['page_id'])->pluck('id');

            if ($id) {
                DB::table('bp_pages')
                    ->where('id', $id)
                    ->update(['page_content' => $data['page_content']]);
            }
            else {
                $id = DB::table('bp_pages')->insertGetId([
                    'bp_id' => $data['business_plan_id'], 
                    'pageid' => $data['page_id'],
                    'page_content' => $data['page_content']
                ]);
            }
        }

        echo json_encode(['type' => 'success', 'text' => "Your changes was successfully saved."]);
        exit;
    }

    public function saveSection()
    {
        $data = Input::get();
        $bp = BusinessPlan::find($data['business_plan_id']);
        
       
        $id = DB::table('bp_page_sections')->where('bp_id', $data['business_plan_id'])->where('section_id', $data['section_id'])->pluck('id');

        if ($id) {
            DB::table('bp_page_sections')
                ->where('id', $id)
                ->update(['section_content' => $data['page_content']]);
        }
        else {
            $id = DB::table('bp_page_sections')->insertGetId([
                'bp_id' => $data['business_plan_id'], 
                'section_id' => $data['section_id'],
                'section_content' => $data['page_content']
            ]);
        }

        echo json_encode(['type' => 'success', 'text' => "Your changes was successfully saved."]);
        exit;
    }

    public function editFinancialPlanCashFlow($id)
    {
        $business_plan = BusinessPlan::find($id);
        View::share('business_plan', $business_plan);

        Asset::container('header')->add("financial-plan-css", "assets/css/plan/financial_plan.css");
        Asset::container('header')->add("create-css", "assets/css/plan/widget_pages.css");
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add("financial-plan-js", "assets/javascript/plan/financial_plan.js");
        Asset::container('footer')->add("financial-plan-cfp-js", "assets/javascript/plan/financial_plan/cash_flow_projections.js");

        $data = DB::table('cash_flow_projection')
                            ->select(
                                'percentage_sale as incoming_percentage', 
                                'days_collect_payments as incoming_collection', 
                                'percentage_purchase as outgoing_percentage', 
                                'days_make_payments as outgoing_collection'
                            )
                            ->where('cash_fp_bpid', $business_plan->id)
                            ->get();
        
        if ($data) {
            $data = $data[0];
        }

        $this->layout = View::make('layout.plan');
        $this->layout->content = View::make('plan.financial-plan.edits.cash-flow-projection', ['data' => $data, 'options' => Input::get()]);
    }

    public function saveFinancialPlanCashFlow()
    {
        $input = Input::get();

        $business_plan = BusinessPlan::find($input['business_plan_id']);
        $save_data = ['cash_fp_bpid' => $business_plan->id];

        if ($input['cash-flow-payment-type'] == 'outgoing') {
            $save_data['percentage_purchase'] = $input['outgoing_percentage'];
            $save_data['days_make_payments'] = $input['outgoing_collection'];
        }
        else {
            $save_data['percentage_sale'] = $input['incoming_percentage'];
            $save_data['days_collect_payments'] = $input['incoming_collection'];
        }

        $id = DB::table('cash_flow_projection')->where('cash_fp_bpid', $business_plan->id)->pluck('cash_fp_id');

        if ($id) {
            DB::table('cash_flow_projection')
                ->where('cash_fp_id', $id)
                ->update($save_data);
        }
        else {
            $id = DB::table('cash_flow_projection')->insertGetId($save_data);
        }

        echo json_encode(['type' => 'success', 'text' => "Your changes was successfully saved."]);
        exit;
    }

    public function editFinancialPlanBudget($id)
    {
        $business_plan = BusinessPlan::find($id);
        View::share('business_plan', $business_plan);

        Asset::container('header')->add("financial-plan-css", "assets/css/plan/financial_plan.css");
        Asset::container('header')->add("create-css", "assets/css/plan/widget_pages.css");
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add("financial-plan-js", "assets/javascript/plan/financial_plan.js");
        Asset::container('footer')->add("financial-plan-budget-js", "assets/javascript/plan/financial_plan/budget.js");

        $expenditure_list = BudgetExpenditure::getAll($business_plan->id);
        $purchases_list = BudgetPurchase::getAll($business_plan->id);
        
		$data = [
            'months' => $business_plan->getStartMonths(),
            'default_month_year' => $business_plan->bp_financial_start_date,
            'expenses' => $expenditure_list,
            'purchases' => $purchases_list
        ];

        $this->layout = View::make('layout.plan');
        $this->layout->content = View::make('plan.financial-plan.edits.budget', ['data' => $data, 'options' => Input::get()]);
    }

    public function saveFinancialPlanBudgetExpenditure()
    {
        $input = Input::get();

        $business_plan = BusinessPlan::find($input['business_plan_id']);
        $expenditure_id = $input['expenditure_id'];
        $save_data = [
            'expenditure_bp_id' => $business_plan->id,
            'expenditure_name' => $input['expenditure_name'],
            'expenditure_start_date' => $input['expenditure_month_year_date'],
            'expected_change' => $input['expenditure_expected_change'],
            'percentage_of_change' => $input['expenditure_percentage_of_change'],
            'pay_per_year' => $input['expenditure_how_you_pay'],
            'pay_amount' => $input['expenditure_how_much_is_it']
        ];

        if ($expenditure_id) {
            $obj = BudgetExpenditure::find($expenditure_id);
            $obj->update($save_data);
            $msg = "Successfully saved your changes";
        }
        else {
            $obj = BudgetExpenditure::create($save_data);
            $msg = "Successfully added a new expenditure";
        }

        return Redirect::to('plan/financial-plan-budget/' . $business_plan->id . '?selected_tab=expenses')->withMessage($msg);
    }

    public function saveFinancialPlanBudgetDeleteExpenditure($id)
    {
        $obj = BudgetExpenditure::find($id);
        $obj->delete();
        return Redirect::to('plan/financial-plan-budget/' . $obj->businessPlan()->id . '?selected_tab=expenses')->withMessage("Successfully deleted expenditure");
    }

    public function saveFinancialPlanBudgetPurchase()
    {
        $input = Input::get();

        $business_plan = BusinessPlan::find($input['business_plan_id']);
        $mp_id = $input['mp_id'];
        $save_data = [
            'mp_bpid' => $business_plan->id,
            'mp_name' => $input['mp_name'],
            'mp_price' => $input['mp_price'],
            'mp_date' => $input['mp_date'],
            'mp_depreciate' => $input['mp_depreciate']
        ];

        if ($mp_id) {
            $obj = BudgetPurchase::find($mp_id);
            $obj->update($save_data);
            $msg = "Successfully saved your changes";
        }
        else {
            $obj = BudgetPurchase::create($save_data);
            $msg = "Successfully added a new major purchase";
        }

        return Redirect::to('plan/financial-plan-budget/' . $business_plan->id . '?selected_tab=purchases')->withMessage($msg);
    }

    public function saveFinancialPlanBudgetDeletePurchase($id)
    {
        $obj = BudgetPurchase::find($id);
        $obj->delete();
        return Redirect::to('plan/financial-plan-budget/' . $obj->businessPlan()->id . '?selected_tab=purchases')->withMessage("Successfully deleted major purchase");
    }

    public function saveFinancialPlanBudgetTax()
    {
        $input = Input::get();

        $business_plan = BusinessPlan::find($input['business_plan_id']);
        $business_plan->bp_income_tax_in_percentage = $input['bp_income_tax_in_percentage'];
        $business_plan->save();
        $msg = "Successfully saved your changes";
        
        return Redirect::to('plan/financial-plan-budget/' . $business_plan->id . '?selected_tab=tax')->withMessage($msg);
    }

    public function editFinancialPlanHumanResources($id)
    {
        $business_plan = BusinessPlan::find($id);
        View::share('business_plan', $business_plan);

        Asset::container('header')->add("financial-plan-css", "assets/css/plan/financial_plan.css");
        Asset::container('header')->add("create-css", "assets/css/plan/widget_pages.css");
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add("financial-plan-js", "assets/javascript/plan/financial_plan.js");
        Asset::container('footer')->add("financial-plan-budget-js", "assets/javascript/plan/financial_plan/human_resources.js");

        $employee_list = Employee::getAll($business_plan->id);

        $data = [
            'months' => $business_plan->getStartMonths(),
            'default_month_year' => $business_plan->bp_financial_start_date,
            'employees' => $employee_list
        ];

        $this->layout = View::make('layout.plan');
        $this->layout->content = View::make('plan.financial-plan.edits.human-resources', ['data' => $data, 'options' => Input::get()]);
    }

    public function saveFinancialPlanHumanResourcesPersonnel()
    {
        $input = Input::get();

        $business_plan = BusinessPlan::find($input['business_plan_id']);
        $employee_id = $input['employee_id'];
        $save_data = [
            'employee_bp_id' => $business_plan->id,
            'employee_name' => $input['employee_name'],
            'employee_start_date' => $input['employee_start_date'],
            'employee_type' => $input['employee_type'],
            'employee_pay_per_year' => $input['employee_pay_per_year'],
            'employee_pay_amount' => $input['employee_pay_amount']
        ];

        if ($employee_id) {
            $obj = Employee::find($employee_id);
            $obj->update($save_data);
            $msg = "Successfully saved your changes";
        }
        else {
            $obj = Employee::create($save_data);
            $msg = "Successfully added a new employee";
        }

        return Redirect::to('plan/financial-plan-human-resources/' . $business_plan->id . '?selected_tab=personnel')->withMessage($msg);
    }

    public function saveFinancialPlanHumanResourcesExpenses()
    {
        $input = Input::get();

        $business_plan = BusinessPlan::find($input['business_plan_id']);
        $business_plan->bp_related_expenses_in_percentage = $input['bp_related_expenses_in_percentage'];
        $business_plan->save();
        $msg = "Successfully saved your changes";
        
        return Redirect::to('plan/financial-plan-human-resources/' . $business_plan->id . '?selected_tab=expenses')->withMessage($msg);
    }

    public function saveFinancialPlanHumanResourcesDeletePersonnel($id)
    {
        $obj = Employee::find($id);
        $obj->delete();
        return Redirect::to('plan/financial-plan-human-resources/' . $obj->businessPlan()->id . '?selected_tab=personnel')->withMessage("Successfully deleted employee");
    }

    public function editFinancialPlanSalesForecast($id)
    {
        $business_plan = BusinessPlan::find($id);
        View::share('business_plan', $business_plan);

        Asset::container('header')->add("financial-plan-css", "assets/css/plan/financial_plan.css");
        Asset::container('header')->add("create-css", "assets/css/plan/widget_pages.css");
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add("financial-plan-js", "assets/javascript/plan/financial_plan.js");
        Asset::container('footer')->add("financial-plan-budget-js", "assets/javascript/plan/financial_plan/sales_forecast.js");

        $sales = SalesForecast::getAll($business_plan->id);

        $data = [
            'months' => $business_plan->getStartMonths(),
            'default_month_year' => $business_plan->bp_financial_start_date,
            'start_year' => $business_plan->getStartYear(),
            'sales' => $sales
        ];

        $this->layout = View::make('layout.plan');
        $this->layout->content = View::make('plan.financial-plan.edits.sales-forecast', $data);
    }

    public function saveFinancialPlanSalesForecast()
    {
        $input = Input::get();

        $business_plan = BusinessPlan::find($input['business_plan_id']);
        $sf_id = $input['sf_id'];
        $input['sales_forecast_bp_id'] = $input['business_plan_id'];

        unset($input['sf_id']);

        if ($sf_id) {
            $obj = SalesForecast::find($sf_id);
            $obj->update($input);
            $msg = "Successfully saved your changes";
        }
        else {
            $obj = SalesForecast::create($input);
            $msg = "Successfully added a sales forecast";
        }

        return Redirect::to('plan/financial-plan-sales-forecast/' . $business_plan->id)->withMessage($msg);
    }

    public function deleteFinancialPlanSalesForecast($id)
    {
        $obj = SalesForecast::find($id);
        $obj->delete();
        return Redirect::to('plan/financial-plan-sales-forecast/' . $obj->businessPlan()->id)->withMessage("Successfully deleted a sales forecast");
    }

    public function editFinancialPlanLoans($id)
    {
        $business_plan = BusinessPlan::find($id);
        View::share('business_plan', $business_plan);

        Asset::container('header')->add("financial-plan-css", "assets/css/plan/financial_plan.css");
        Asset::container('header')->add("create-css", "assets/css/plan/widget_pages.css");
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add("financial-plan-js", "assets/javascript/plan/financial_plan.js");
        Asset::container('footer')->add("financial-plan-loans-js", "assets/javascript/plan/financial_plan/loans_and_investments.js");

        $fundings = Fund::getAll($business_plan->id);
        
        $data = [
            'months' => $business_plan->getStartMonths(),
            'default_month_year' => $business_plan->bp_financial_start_date,
            'start_year' => $business_plan->getStartYear(),
            'fundings' => $fundings
        ];

        $this->layout = View::make('layout.plan');
        $this->layout->content = View::make('plan.financial-plan.edits.loans-and-investments', $data);
    }

    public function saveFinancialPlanLoans()
    {
        $input = Input::get();

        $business_plan = BusinessPlan::find($input['business_plan_id']);
        $li_id = $input['li_id'];
        $input['loan_invest_bp_id'] = $input['business_plan_id'];
        
        unset($input['li_id']);

        if ($li_id) {
            $obj = Fund::find($li_id);
            $obj->update($input);
            $msg = "Successfully saved your changes";
        }
        else {
            $obj = Fund::create($input);
            $msg = "Successfully added a loan projection";
        }

        return Redirect::to('plan/financial-plan-loans-and-investments/' . $business_plan->id)->withMessage($msg);
    }

    public function deleteFinancialPlanLoans($id)
    {
        $obj = Fund::find($id);
        $obj->delete();
        return Redirect::to('plan/financial-plan-loans-and-investments/' . $obj->businessPlan()->id)->withMessage("Successfully deleted a loan projection");
    }

    public function printDoc($id)
    {
        $business_plan = BusinessPlan::find($id);
        $user = Auth::getUser();

        $data_pages = DB::table('pages')
            ->where('parentid', '>', '0')
            ->orderBy('parentid', 'ASC')
            ->orderBy('pageorder', 'ASC')
            ->get();

        $data_page_sections = DB::table('page_sections')->orderBy('s_pageid', 'ASC')->orderBy('section_order', 'ASC')->get();

        $page_contents = DB::table('bp_pages')->where('bp_id', $business_plan->id)->lists('page_content', 'pageid');
        $es_contents = $business_plan->executiveSummary();
        $es_contents = $es_contents ? $es_contents->getAttributes() : [];
        $section_contents = DB::table('bp_page_sections')
            ->where('bp_id', $business_plan->id)
            ->lists('section_content', 'section_id');
        
        $main_pages = [];
        $sub_pages  = [];
        $page_sections = [];
        $pdf_entries = [];

        foreach ($data_page_sections as $row) {
            if (!isset($page_sections[$row->s_pageid])) {
                $page_sections[$row->s_pageid] = [];
            }

            $page_sections[$row->s_pageid][$row->section_id] = $row;
        }

        $page_num = 0;
        
        foreach ($data_pages as $page) {
            if (array_key_exists($page->parentid, $main_pages)) {
                $has_content = false;
                // this is a subpage
                $sub_pages[$page->parentid][$page->pageid]  = $page;

                if ($main_pages[$page->parentid]->pageurl == 'executive-summary') {
                    $key = str_replace('-', '_', trim($page->pageurl));
                    $content = isset($es_contents[$key]) ? $es_contents[$key] : "";
                }
                else {
                    $content = isset($page_contents[$page->pageid]) ? $page_contents[$page->pageid] : '';
                }

                if (isset($page_sections[$page->pageid])) {
                    foreach ($page_sections[$page->pageid] as $section) {
                        if (isset($section_contents[$section->section_id]) && !empty($section_contents[$section->section_id])) {
                            $content .= "<p><b>" . $section->section_title . "</b></p>";
                            $content .= $section_contents[$section->section_id];
                        }
                    }
                }

                if (!empty($content)) {
                    if (!isset($pdf_entries[$page->parentid])) {
                        $page_num++;

                        $pdf_entries[$page->parentid] = [
                            'title' => $main_pages[$page->parentid]->pagetitle,
                            'page_num' => $page_num,
                            'sub_pages' => []
                        ];
                    }

                    if (count($pdf_entries[$page->parentid]['sub_pages']) == 5) {
                        $page_num++;
                    }

                    $pdf_entries[$page->parentid]['sub_pages'][$page->pageid] = [
                        'title' => $page->pagetitle,
                        'page_num' => $page_num,
                        'content' => $content
                    ];
                }
            }
            else {
                if (in_array($page->pageurl, ['financial-plan', 'financial-statements'])) {
                    // do not include financial plan and financial statements
                    continue;
                }

                $main_pages[$page->pageid] = $page;
                $sub_pages[$page->pageid]  = [];
            }
        }
        
        /*echo '<pre>';
        var_dump($pdf_entries);
        var_dump($es_contents);
        //var_dump($section_contents);
        echo '</pre>';
        die;*/
        
        try {
            $report = new PlanReport($business_plan, $user, $pdf_entries, (in_array(Auth::getUser()->package, $this->has_financial_statement)));
            $report->toPdf('D');
        }
        catch (Exception $e) {
            return $this->displayPage($business_plan, [], [], $section, ['layout_page' => "plan.cannot-print"]);
        }
    }
}
