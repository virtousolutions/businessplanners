<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package businessplanners
 */
?>

<footer>
		<div class="container">
			<div id="footer-menu" class="col-md-7">
				<ul>
					<li><a href="#">Contact</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Cookie Policy</a></li>
				</ul>
			</div><!-- #footer-menu -->
			
			<p class="col-md-9">Rates are variable dependant on circumstances and will be discussed in full once an assessment has been made.</p>
			<div id="social-icons" class="col-xs-12">
				<ul>
					<li><a href="#"><img src="<?=get_template_directory_uri()?>/images/footer-social-fb.png"></a></li>
					<li><a href="#"><img src="<?=get_template_directory_uri()?>/images/footer-social-twitter.png"></a></li>
					<li><a href="#"><img src="<?=get_template_directory_uri()?>/images/footer-social-linked.png"></a></li>
					<li><a href="#"><img src="<?=get_template_directory_uri()?>/images/footer-social-google.png"></a></li>
				</ul>
			</div><!-- #social-icons -->
			<p class="col-md-12">© 2015 Contractors Pro. All Rights Reserved. Company Number: 0871 789 0580. Address: Constractors Pro Offices in London in Tower 42.</p>
			
			
		</div><!-- .container -->
	</footer>

<?php wp_footer(); ?>

</body>
</html>
