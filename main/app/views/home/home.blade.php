@extends('app')

@section('content')
<div id="banner">
	<div class="container">
		<div id="inside-banner">
			<div id="bulleted" class="col-md-5 col-sm-12">
				<ul>
					<li>Need to raise capital for your business?</li>
					<li>Need a Business Plan to help you expand into new markets or launch new products?</li>
					<li>Need a highly professional business plan which will attract funding from investors or other financial institutions?</li>
					<li>Do you need a road map for your business in an engaging and professional way?</li>
					<li>Need to make your ideas become reality?</li>
				</ul>
			</div><!-- #bulleted -->
			<div id="banner-branding" class="col-md-7 col-sm-12">
				 <img src="{{url('assets/img/banner-logo.png')}}">
				<h2>Call us to find out more 0345 052 2742</h2>
			</div><!-- #banner-branding -->
		</div><!-- #inside-banner -->
	</div><!-- .container -->
</div><!-- #banner -->

<div name="forfeature" class="thefeature" id="info-home">
	<div class="container">

		<div class="line col-md-12 col-sm-12">

			<div class="cols col-md-6">
				<div class="imgs col-md-3">
					<img src="{{ url('assets/img/hand-shake.png') }}">
				</div><!-- .imgs -->
				<div class="txt col-md-9">
					<h2>Collaborate with your team</h2>
					<p>Included in every business plan, you will have leading edge software which enables you to collaborate with your team.
This enables you to easily create and manage your forecasts and budgets giving you that all important chance to grow your business in the best possible way. </p>
				</div><!-- .txt -->
			</div><!-- .cols -->

			<div class="cols col-md-6">
				<div class="imgs col-md-3">
					<img src="{{ url('assets/img/bar-charts.png') }}">
				</div><!-- .imgs -->
				<div class="txt col-md-9">
					<h2>Track your progress</h2>
					<p>With our state of the art software, you can monitor and compare your performance and forecasts with your colleagues using our easy-to-understand dashboard. Login to make those quick adjustments to your business to stay on track. </p>
				</div><!-- .txt -->
			</div><!-- .cols -->

		</div><!-- .line -->

		<div class="line col-md-12">

			<div class="cols col-md-6">
				<div class="imgs col-md-3">
					<img src="{{ url('assets/img/group.png') }}">
				</div><!-- .imgs -->
				<div class="txt col-md-9">
					<h2>Dedicated Professionals at your service</h2>
					<p>We will assign you your own dedicated professional Business planner.  All of our business planners are vetted, with a minimum requirement of a masters degree qualification and should you chose the financial package, we offer you one of our in-house financial accountants </p>
				</div><!-- .txt -->
			</div><!-- .cols -->

			<div class="cols col-md-6">
				<div class="imgs col-md-3">
					<img src="{{ url('assets/img/micman.png') }}">
				</div><!-- .imgs -->
				<div class="txt col-md-9">
					<h2>Pitch for funding</h2>
					<p>All of our business plans will give you the right platform to attract funding from investors or banks.  We know how to package it up in the correct strategic format to give you maximum impact and maximum chances.</p>
				</div><!-- .txt -->
			</div><!-- .cols -->

		</div><!-- .line -->

	</div><!-- .container -->
</div><!-- .row -->

<div class="theblog" id="business-plan">
	<div class="container">
		<h2>Why You Need a <strong>Business Plan</strong></h2>

		<p>A business plan allows you as a business owner to increase your chances of <strong>business success</strong>. A professionally written business plan will map out what your business intends to do, and is often used as a proposal document to help secure funding from investors and banks. When used internaly, any potential problems can be identified in advance as well as any uncessary costs, to help improve profitability.</p>

<p>We recommend <strong>every business</strong>, large or small, to invest time in creating a thorough business plan to help both internally and externally.</p>
	
	<div id="iMac" class="col-md-12 col-md-offset-2">
		<!-- <img src="{{ url('assets/img/iMac.png') }}"> -->
		<div id="logo-cover" class="col-md-12">
			<img src="{{url('assets/img/banner-logo.png')}}">
		</div>
	</div><!-- #iMac -->

	</div><!-- .body_container -->
</div><!-- #business-plan -->

<div id="business-planners-review">
	<div class="container">
		<h2>Why The <strong>Business Planners</strong></h2>
		<div id="container-box" class="col-md-12">

			<div class="boxes col-md-3 col-sm-6 col-xs-12">
				<h3>Recommended</h3>
				<img src="{{ url('assets/img/recommend-icon.png') }}">
				<p>We are proud to say that we are recommended by nearly every major investment platform</p>
			</div><!-- .boxes -->
			<div class="boxes col-md-3 col-sm-6 col-xs-12">
				<h3>Review</h3>
				<img src="{{ url('assets/img/calc-icon.png') }}">
				<p>All of your financials will be reviewed by our in-house accountant</p>
			</div><!-- .boxes -->
			<div class="boxes col-md-3 col-sm-6 col-xs-12">
				<h3>Bespoke</h3>
				<img src="{{ url('assets/img/bust-icon.png') }}">
				<p>All of our bespoke packages are tailored to you and your needs, to suit you perfectly</p>
			</div><!-- .boxes -->
			<div class="boxes col-md-3 col-sm-6 col-xs-12">
				<h3>12 month access</h3>
				<img src="{{ url('assets/img/12monthsaccess-icon.png') }}">
				<p>You and your accountant will have 12 month access to update/amend your plan</p>
			</div><!-- .boxes -->

		</div><!-- #container-box -->
	</div><!-- .container -->
</div><!-- #business-planners-review -->

<div id="business-plan-packages">
	<div class="container">
		<h2>Business Plan <strong>Packages</strong></h2>
		<p>Choose from one of our three business plan packages. Alternatively, why not consider our DIY business plan?</p>
		
		<table id="comparetable" class="blueshine">
           <tr>
            <td class=""></td>
                <th>DIY</th>
                <th>Value</th>
                <th>Standard</th>
                <th>Professional</th>
                <th>Premium</th>
            </tr>
            <tr>
	            <td class=""></td>             
	            <td class="highlight">£199</td>
	            <td class="highlight">£999</td>
	            <td class="highlight">£1,750</td>
	            <td class="highlight">£1,950</td>
	            <td class="highlight">£5,000</td>
            </tr>
            <tr>
            	<td class="tblval"></td>            
	            <td>Best suited to those on a budget</td>
	            <td>Ideal for understanding your goals</td>
	            <td>Businesses that have been established for over a year</td>
	            <td>Best for raising finances and venture capital</td>
	            <td>Best for raising finances and venture capital. Your business plan will be sent to 50 angel investors to help get the funding you need</td>
            </tr>
            <tr>
	            <td class="tblval">Online Business Planning Software</td>    
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
            </tr>
            <tr>
	            <td class="tblval">MBA Graduate review</td>    
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr>
            <tr>
	            <td class="tblval">Dedicated Business Account Manager</td>    
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr>
            <tr>
	            <td class="tblval">Professionally written Business plan written by Professional Business Planner</td>    
	            <td></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr>
            <tr>
	            <td class="tblval">Financial forecasting with qualified Financial Accountant</td>    
	            <td></td>
	            <td></td>
	            <td>Yes 1 year</td>
	            <td>Yes 3 years</td>
	            <td>Yes 3 years</td>
            </tr>
            <tr>
	            <td class="tblval">Investor meeting</td>    
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td>Your business plan will be read cover to cover by at least 10 angel investors, we will get feedback and negotiate on your behalf to get you that investor meeting</td>
            </tr>
<!--             <tr>
	            <td class="tblval">Access to Virtual FD:*
Personalised Dashboard
Full online access to your business plan
Collaborate with your team
</td>    
	            <td>1 month</td>
	            <td>1 month</td>
	            <td>3 month</td>
	            <td>3 month</td>
	            <td>1 year</td>
            </tr> -->
            <tr>
	            <td class="tblval">Full reporting, financial monitoring and control
* Virtual FD is our own award winning in-house business planning platform
</td>    
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
            </tr>
            <tr>
	            <td class="tblval"><b>Bonus Materials</b></td>    
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
            </tr>
<!--             <tr>
	            <td class="tblval">New Business Start up Guide</td>    
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr> -->
            <tr>
	            <td class="tblval">Importance of Trademarks Guide </td>    
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr>
            <tr>
	            <td class="tblval">Guide to Why a Business Valuation is important </td>    
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr>
            <tr>
	            <td class="tblval">The Secrets of how big companies remunerate themselves in a tax efficient manner (the things your accountant doesn’t know) </td>    
	            <td></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr>
            <tr>
	            <td class="tblval">How to reduce your IHT liability and what to do</td>    
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr>
            <tr>
	            <td class="tblval">A Guide to The importance of having a Company Will </td>    
	            <td></td>
	            <td></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr>
<!--             <tr>
	            <td class="tblval">How to make more profit – Mini Guide for Small Businesses</td>    
	            <td></td>
	            <td></td>
	            <td></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr> -->
            <tr>
	            <td class="tblval">How to pay less Tax, Avoid and Deal with Tax investigations – the complete guide for all small businesses</td>    
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td><img src="{{ url('assets/img/checked.png') }}"></td>
            </tr>
            <tr>
	            <td class="tblval"><b>Additional Services</b></td>    
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td></td>
            </tr>
            <tr>
	            <td class="tblval">Remuneration Report – find out how to pay less tax, the things your accountant doesn’t know</td>    
	            <td></td>
	            <td>60% discount</td>
	            <td>60% discount</td>
	            <td>70% discount</td>
	            <td>80% discount</td>
            </tr>
            <tr>
	            <td class="tblval">Business Valuation Services</td>    
	            <td></td>
	            <td>10% discount</td>
	            <td>10% discount</td>
	            <td>15% discount</td>
	            <td>20% discount</td>
            </tr>
           <!--  <tr>
	            <td class="tblval">Trademark Review, Search and application services</td>    
	            <td></td>
	            <td>10% discount</td>
	            <td>10% discount</td>
	            <td>15% discount</td>
	            <td>20% discount</td>
            </tr> -->
            <tr>
	            <td class="tblval">Full IHT Review & Report and IHT mitigation service</td>    
	            <td></td>
	            <td>10% discount</td>
	            <td>10% discount</td>
	            <td>15% discount</td>
	            <td>20% discount</td>
            </tr>
            <tr>
	            <td class="nostyle"></td>    
	            <td class="nostyle"><a href="{{ url('order/diy') }}"><img class="col-md-12 buynow-btn" src="{{ url('assets/img/buynow.png') }}"></a></td>
	            <td class="nostyle"><a href="{{ url('order/value') }}"><img class="col-md-12 buynow-btn" src="{{ url('assets/img/buynow.png') }}"></a></td>
	            <td class="nostyle"><a href="{{ url('order/standard') }}"><img class="col-md-12 buynow-btn" src="{{ url('assets/img/buynow.png') }}"></a></td>
	            <td class="nostyle"><a href="{{ url('order/professional') }}"><img class="col-md-12 buynow-btn" src="{{ url('assets/img/buynow.png') }}"></a></td>
	            <td class="nostyle"><a href="{{ url('order/premium') }}"><img class="col-md-12 buynow-btn" src="{{ url('assets/img/buynow.png') }}"></a></td>
            </tr>
            </table>
         

	</div><!-- .container -->
</div><!-- #business-plan-packages -->

<div id="testimonial">
	<div class="container">
		<h2>Testimonials</h2>
		<p>Over <strong>12,000 customers</strong></p>
		<p>It's a known fact that businesses who plan will grow approx <strong>35% faster</strong> than those who do not.<br>
	Let the Business Planners help you succeed today!</p>
		
		<div class="box-container">

			<div class="testi-box col-md-5 col-sm-10">
				<div class="img"><img src="{{ url('assets/img/bp-testimonial3.png') }}"></div><!-- .img -->
				<p>"The Business Planners have been so helpful. I was really unsure about how to go about creating a business plan, but I knew it was important to help increase the chance of my business being a success. Once I’d got in touch they were great from start to finish. I now have a really professional business plan that outlines everything, and has given me a greater insight into how to take my business forward." – Lilian Cole, Bradford</p>
			</div>

			<div class="testi-box col-md-5 col-sm-10">
				<div class="img"><img src="{{ url('assets/img/bp-testimonial1.png') }}"></div><!-- .img -->
				<p>“The Business Planners have been exceptionally helpful in getting me funding for my business. With their professional and thorough business plan I was able to take it to the bank and secure the loan I desperately needed for my business. They knew exactly what needed to go in it and the whole process was quick, simple and easy. I cannot recommend them enough,” – Daniel Gray, Cambridgeshire </p>
			</div>

		</div>

		<div class="testi-boxx col-md-5 col-sm-10 col-md-offset-4">
			<div class="img"><img src="{{ url('assets/img/bp-testimonial2.png') }}"></div><!-- .img -->
			<p>“I had already created a business plan, but on looking for investment I was unsuccessful. The potential investors told me that my business plan was not thorough enough and too vague. Unsure on how to proceed, I got in touch with The Business Planners. They got everything down that was needed, and managed to create a much more thorough and clear business plan. I took my plan back to the investors and managed to secure the investment. I can’t thank The Business Planners enough.” – Troy Stevenson, Clapham</p>
		</div>

	</div><!-- .container -->
</div><!-- #testimonial -->

<div class="thecontactus" id="contactus">
	<div class="container">
	<h2>Contact <strong>Us</strong></h2>

	<div id="contacttbl" class="col-md-offset-1">
	{{ Form::open(array('id' => 'contactusform', 'method' => 'get', 'class' => 'cmxform')) }}
		<div class="form-group">
			<label class="col-md-3" for="Name">Name</label>
			<input type="text" name="name" id="name" required aria-required="true" class="required-field col-md-8 form-control" data-bv-field="name">
		</div>
		<div class="form-group">
			<label class="col-md-3" for="contactnum">Contact Number</label>
			<input type="number" name="contactnum" required aria-required="true" id="contactnum" class="required-field col-md-8 form-control" placeholder="">
		</div>
		<div class="form-group">
			<label class="col-md-3" for="email">Your Email Address</label>
			<input type="email" id="email" name="email" required aria-required="true" class="required-field col-md-8 form-control" placeholder="">
		</div>
		<div class="form-group">
			<label class="col-md-3" for="headaboutus">Where did you hear about us from?</label>
			<input type="text" name="headaboutus" required aria-required="true" id="headaboutus" class="required-field col-md-8 form-control" placeholder="">
		</div>
		<div class="form-group">
			<label class="col-md-3" for="message">Message</label>
			<textarea id="message" name="message" required aria-required="true" class="required-field col-md-8 form-control"></textarea>
		</div>
		<div id="submit-btn-con" class="col-md-2 col-md-offset-3">
			<button type="button" id="contactussubmit-btn" class="btn btn-default">Submit</button>
		</div>
		{{ Form::close() }}
	</div><!-- #contacttbl -->
	</div><!-- .container -->
</div><!-- #contactus -->

@endsection


@section('js')
<script>
jQuery(function($){
	$.validator.setDefaults({
		submitHandler: function() {
			alert("submitted!");
		}
	});

	var HOME = {
		formValifator : function(){
			$("#contactusform").validate({
				rules : {
					name: "required",
					contactnum: "required",
					email: {
						required : true,
						email: true
					},
					headaboutus: {
						minlength: 5,
						required: true
					},
					message: {
						minlength: 15,
						required: true
					}
				},
				messages:{
					name :{
						required : "Please ener your name"
					},
					contactnum: {
						required: "Please enter your valid contact number"
					},
					email:{
						required : "Please enter your valid email address"
					},
					message: {
						required: "Message field must not be empty",
						minlength: "Enter atleast 15 character"
					}
				}
			});
		},
		executecode : function(){
			this.formValifator();
		}
	}
	HOME.executecode();
});
</script>
@endsection