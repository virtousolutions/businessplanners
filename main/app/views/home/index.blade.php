
@section('content')
<!-- BANNER -->
<div id="banner">
<div class="wrapper">
  <div id="gadgets" class="clearfix">

      <div id="bannerblurb">
        <p><img id="bannerblurb-image" src="{{ asset('assets/img/logo.png') }}" /></p>
        <p class="spacer">Impress investors with a clear, concise and professional business plan created with The Business Planners.</p>
        <p class="spacer">You'll be guaranteed to get the investment you need with a business plan from The Business Planners</p>

        <p class="spacer"><a href="#packages" id="btn-started">Get started</a></p>
      </div>

  </div>
</div>
</div>


<!-- PLAN -->
<div id="about">
<div class="wrapper">
  <h1 class="heading spacer">Why you need a business plan</h1>
  <p class="spacer">A business plan allows you as a business owner to increase your chances of business success. A professionally written business lan will map out what your business intends to do, and is often used as a proposal document to help secure funding from investors and banks. When used internaly, any potential problems can be identified in advance as well as any uncessary costs, to help improve profitability. </p>

  <p>
    We recommend every business, large or small, to invest time in creating a thorough business plan to help both internally and externally.
  </p>
</div>
</div>


<!-- HELP -->
<div id="help">
<div class="wrapper">
<div class="arrow-down"></div>
  <h1 class="heading spacer">We're here to help</h1>
  <p class="spacer">At The Business Planners, we aim to create you a professionally written business plan that will help you to succeed. We'll find out everything we need to know about your business in order to create a professional, complete business plan. We're experts in writing business plans so we know what needs to be included, and we'll make sure we cover everything in order to create a business plan that will help you get the investment you need. </p>
  <p>With our business plan writing service, we'll create a bespoke business plan for you. Our expert business plan writers can write for any business, regardless of industry or size. Get ahead of your competition today with a professional business plan. </p>

</div>
</div>


<!-- PLANNERS -->
<div id="planners">

<div class="wrapper">
<div class="arrow-down blue"></div>
  <h1 class="heading spacer">Why The Business Planners</h1>
  <div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <img src="{{ asset('assets/img/recommended-icon.png') }}" />
      <h3>Recommended</h3>
      <p>We are proud to say that we are recommended by nearly every major investment platform</p>
    </div>
    <div class="col-md-3">
      <img src="{{ asset('assets/img/review-icon.png') }}" />
      <h3>Review</h3>
      <p>All of your financials will be reviewed by our in-house accountant</p>
    </div>
    <div class="col-md-3">
      <img src="{{ asset('assets/img/bespoke-icon.png') }}" />
      <h3>Bespoke</h3>
      <p>All of our bespoke packages are tailored to you and your needs, to suit you perfectly</p>
    </div>
    <div class="col-md-3">
      <img src="{{ asset('assets/img/12month-icon.png') }}" />
      <h3>12 month access</h3>
      <p>You and your accountant will have 12 month access to update/amend your plan</p>
    </div>
  </div>
</div>
</div>
</div>

<!-- PACKAGES -->
<div id="packages">

<div class="wrapper">
<div class="arrow-down"></div>
  <h1 class="heading spacer">Business Plan Packages</h1>
  <p>Choose from one of our three business plan packages. Alternatively, why not consider our DIY business plan?</p>
  <p>&nbsp;</p>
</div>
<div class="wrapper">
  <div id="price" class="clearfix row">
    <div class="col-xs-12 col-sm-4">
        @include('package.package', ['package' => $packages[1], 'show_button' => true])
    </div>
    <div class="col-xs-12 col-sm-4">
        @include('package.package', ['package' => $packages[2], 'show_button' => true])
    </div>
    <div class="col-xs-12 col-sm-4">
        @include('package.package', ['package' => $packages[3], 'show_button' => true])
    </div>
  </div>
</div>
</div>

<!-- DIY -->
<div id="diy">
<div class="wrapper">
<div class="arrow-down blue"></div>
  <h1 class="heading spacer">DIY Business Plan - &pound;199 </h1>
  <p>Wiht our DIY business plan, you can go and create your business plan yourself. (Please note that this service does not include a financial review). Make sure to also check out our three business plan packages</p>

  <div class="row">
    <div class="step-box col-md-4">
    <h1 class="step-boxes heading">Step 1</h1>
    <p>First, you pay for your business plan, at just &pound;199.</p>
    </div>
    <div class="col-md-1"><div class="arrow"></div></div>
    <div class="step-box col-md-4">
    <h1 class="step-boxes heading">Step 2</h1>
    <p>Next, fill out the Business Plan Wizard with your business information. </p>
    </div>
    <div class="col-md-1"><div class="arrow"></div></div>
    <div class="step-box col-md-4">
    <h1 class="step-boxes heading">Step 3</h1>
    <p>Your plan is nthen reviewed by an MBA graduate, to make improvements to content, spelling and grammar. </p>
    </div>
  </div>

  <p>&nbsp;</p>


   <a href="#" class="buy-btn">Buy now</a>

</div>
</div>

<!-- CONTACT US -->
<div id="contact">
<div class="wrapper">
<div class="arrow-down"></div>
  <h1 class="heading">Contact Us</h1>
  <p>Need help or have any questions? Then simply fill out our contact form below and we'll be in
touch shortly!</p>
<p>&nbsp;</p>
  {{ Form::open(array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'contactus')) }}
    <div class="form-group">
      <input id="name" name="name" type="text" placeholder="Full Name" class="form-control input-lg"/>
    </div>
    <div class="form-group">
      <input id="email" name="email" type="email" placeholder="Email" class="form-control input-lg"/>
    </div>
    <div class="form-group">
      <textarea id="message" name="message" class="form-control input-lg" rows="5" placeholder="Message"></textarea>
    </div>
    <!--div class="form-group clearfix">

        <div class="pull-left col-xs-6" style="padding-left: 0px;">
            <input id="captchaCode" name="captcha_code" type="text" class="form-control pull-left" />
        </div>
        <div class="pull-left col-xs-6">
            <img id="captchaImages" src="" width="85px" />
            <a href="#" id="refresh" type="button">Refresh</a>
        </div>
    </div--> 
    <div class="form-group">
    <button type="submit" class="pull-left" id="contactSubmit" >Submit</button>
    </div>  
    <p id="contact-results"></p>
  </form>
  

</div>
</div>
@stop