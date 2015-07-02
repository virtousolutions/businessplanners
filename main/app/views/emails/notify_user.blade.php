<table align="center" cellpadding="0" cellspacing="0"><tbody>
	<tr><td>
		<table cellpadding="0" cellspacing="0" style="width: 600px;"><tbody><tr><td sectionid="preheader" style="text-align: left; margin: 0; padding: 10px 0; border: none; white-space: normal; line-height: normal;">
			<div>
				<div style="height: 15px; line-height: 15px;">
					&nbsp;
				</div>
			</div>
			<div>
				<div>
					<div style="color: rgb(26,36,46); font-size: 11px; font-family: arial; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible; text-align: center;">
						<div contentid="preheader" style="color: rgb(26,36,46); font-size: 11px; font-family: arial; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible; text-align: center;">
							<div>
								Having trouble viewing this email? <a href="{{ $web_url }}" shape="rect" style="color: rgb(121,76,156);">Click here</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div>
				<div style="height: 15px; line-height: 15px;">
					&nbsp;
				</div>
			</div>
		</td></tr></tbody></table>
	</td></tr>
	<tr><td>
		<table bgcolor="#FFFFFF" cellpadding="20" cellspacing="0" style="width: 600px; background-color: rgb(255,255,255);"><tbody>
			<tr><td sectionid="body" style="background-color: rgb(255,255,255); text-align: left; margin: 0; padding: 20px; border: none; white-space: normal; line-height: normal;" valign="top">
				<div>
					<div contentid="logo">
						<div contentid="logo">
							<div style="text-align: center;">
								<img align="bottom" alt="The Business Planners logo" border="0" height="124" src="https://d1yoaun8syyxxt.cloudfront.net/qk243-6d30886e-ac62-421b-8756-a52965ec1494-v2" style="margin: 0; margin-right: 0px; margin-left: 0px; padding: 0; background: none; border: none; white-space: normal; line-height: normal;" title="The Business Planners logo" width="364">
							</div>
						</div>
					</div>
				</div>
				<div>
					<div style="height: 15px; line-height: 15px;">
						&nbsp;
					</div>
				</div>
				<div>
					<div style="height: 20px;">
						<div style="height: 10px; border-bottom: 1px solid rgb(204,204,204);">
							&nbsp;
						</div>
						<div style="height: 10px;">
							&nbsp;
						</div>
					</div>
				</div>
				<div>
					<div style="height: 15px; line-height: 15px;">
					&nbsp;
					</div>
				</div>
				<div>
					<div style="color: rgb(69,69,69); font-size: 12px; font-family: arial; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
						<div contentid="paragraph" style="color: rgb(69,69,69); font-size: 12px; font-family: arial; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
							<div style="overflow: visible;">
								<div style="overflow: visible; text-align: center;">
								Hi {{ sprintf('%s %s', $first_name, $last_name) }},
								</div>
								<div style="overflow: visible; text-align: center;">
                                &nbsp;
								</div>
                                @if ($package == 'diy')
                                    <div style="overflow: visible; text-align: center;">
                                    Thank you for your order with The Business Planners' {{ ucwords($package_nice) }} package. You're now one step closer to creating your own business plan.&nbsp;
                                    </div>
                                    <div style="overflow: visible; text-align: center;">
                                    &nbsp;
                                    </div>
                                    <div style="overflow: visible; text-align: center;">
                                    To get started, it would be great if you could fill in some information for us, so we can find out a bit more about you and your needs. Please click <a href="{{ $survey_url }}" shape="rect" style="color: rgb(121,76,156);">here</a> to fill in the information.&nbsp;

                                @else
                                    <div style="overflow: visible; text-align: center;">
                                    Thank you for your order with The Business Planners' {{ ucwords($package_nice) }} package. You're now one step closer to having a clear and concise business plan.&nbsp;
                                    </div>
                                    <div style="overflow: visible; text-align: center;">
                                    &nbsp;
                                    </div>
                                    <div style="overflow: visible; text-align: center;">
                                    To get started, we need to know as much about your business as possible. Please click <a href="{{ $survey_url }}" shape="rect" style="color: rgb(121,76,156);">here</a> and fill in as much information as you can. This will enable us to create a really in-depth plan for you. If there's anything that doesn't apply to your business, or you're unsure of, then just leave blank.&nbsp;
								</div>
                                @endif
								<div style="overflow: visible;">
								&nbsp;
								</div>
							</div>
						</div>
					</div>
				</div>
                @if ($package == 'diy')
				<div>
					<div style="color: rgb(69,69,69); font-size: 12px; font-family: arial; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
						<div contentid="paragraph" style="color: rgb(69,69,69); font-size: 12px; font-family: arial; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
							<div style="overflow: visible; text-align: center;">
							&nbsp;
							</div>
							<div style="overflow: visible; text-align: center;">
								You may now log in to your account by clicking <a href="{{ $login_url }}" shape="rect" style="color: rgb(121,76,156);">here</a> and using the following email and password:
							</div>
							<div style="overflow: visible; text-align: center;">
							&nbsp;
							</div>
							<div style="overflow: visible; text-align: center;">
								Email: {{ $email }}
							</div>
							<div style="overflow: visible; text-align: center;">
							&nbsp;
							</div>
							<div style="overflow: visible; text-align: center;">
								Password: {{ $temporary_password }}
							</div>
							<div style="overflow: visible; text-align: center;">
							&nbsp;
							</div>
							<div style="overflow: visible; text-align: center;">
								This is a temporary password, after logging in, you will be asked to change it.
							</div>
						</div>
					</div>
				</div>
                @endif
				<div>
					<div style="color: rgb(69,69,69); font-size: 12px; font-family: arial; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
						<div contentid="paragraph" style="color: rgb(69,69,69); font-size: 12px; font-family: arial; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
							<div style="overflow: visible;">
								<p style="font-size: 12px; font-family: arial; margin: 0; color: null; text-align: center;">
								&nbsp;
								</p>
								<p style="font-size: 12px; font-family: arial; margin: 0; color: null; text-align: center;">
								If you need any help at all, or have any questions or queries, then please feel free to get in contact with us at info@thebusinessplanners.co.uk and we'll be happy to help.&nbsp;
								</p>
								<p style="font-size: 12px; font-family: arial; margin: 0; color: null; text-align: center;">
								&nbsp;
								</p>
								<p style="font-size: 12px; font-family: arial; margin: 0; color: null; text-align: center;">
								We look forward to helping write your business plan!
								</p>
								<p style="font-size: 12px; font-family: arial; margin: 0; color: null; text-align: center;">
								&nbsp;
								</p>
							</div>
						</div>
					</div>
				</div>
				<div>
					<div style="color: rgb(69,69,69); font-size: 12px; font-family: arial; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
						<div contentid="paragraph" style="color: rgb(69,69,69); font-size: 12px; font-family: arial; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
							<div style="overflow: visible; text-align: center;">
								<em> - The Business Planners team</em>
							</div>
						</div>
					</div>
				</div>
			</td></tr>
			<tr><td sectionid="footer" style="background-color: rgb(255,255,255); text-align: left; margin: 0; padding: 20px; border: none; white-space: normal; line-height: normal;" valign="top">
				<div>
					<div style="height: 20px;">
						<div style="height: 10px; border-bottom: 1px solid rgb(204,204,204);">
						&nbsp;
						</div>
						<div style="height: 10px;">
						&nbsp;
						</div>
					</div>
				</div>
				<div>
					<div style="whitespace: nowrap; text-align: center;">
						<table style="margin-left: auto; margin-right: auto;"><tbody><tr><td>
							<div style="color: rgb(13,13,13); font-size: 10px; font-family: verdana; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
								Follow:
							</div>
							</td><td>
								<div>
									<a href="http://www.facebook.com/https://www.facebook.com/thebusinessplannersuk?fref=ts" style="color: rgb(92,58,119); font-size: 11px; font-family: arial;" target="_blank"><img border="0" src="https://qk243.infusionsoft.com/slices/social-media/facebook.png" style="margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal;"></a>
								</div>
							</td><td>
								<div>
									<a href="http://www.twitter.com/https://twitter.com/BizPlannersUK" style="color: rgb(92,58,119); font-size: 11px; font-family: arial;" target="_blank"><img border="0" src="https://qk243.infusionsoft.com/slices/social-media/twitter.png" style="margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal;"></a>
								</div>
							</td></tr></tbody>
						</table>
					</div>
				</div>
				<div>
					<div style="height: 20px;">
						<div style="height: 10px; border-bottom: 1px solid rgb(204,204,204);">
						&nbsp;
						</div>
						<div style="height: 10px;">
						&nbsp;
						</div>
					</div>
				</div>
				<div>
					<div style="color: rgb(13,13,13); font-size: 10px; font-family: verdana; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
						<div contentid="paragraph" style="color: rgb(13,13,13); font-size: 10px; font-family: verdana; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
							<div>
							If you no longer wish to receive our emails, click the link below: 
								<br clear="none">
								<a href="https://qk243.infusionsoft.com/app/linkClick/766/e3cd02124da5b864/102/ef93520caee09ba3" shape="rect" style="color: rgb(92,58,119); font-size: 11px; font-family: arial;">Unsubscribe</a>
							</div>
						</div>
					</div>
				</div>
				<div>
					<div style="color: rgb(13,13,13); font-size: 10px; font-family: verdana; margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible;">
						Gtwo Ltd. 24 Seale Street, St Helier Jersey JE2 3QG Jersey 01534 786761
					</div>
				</div>
			</td></tr>
		</tbody></table>
	</td></tr>
</tbody></table>