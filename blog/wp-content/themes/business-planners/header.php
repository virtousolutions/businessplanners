<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package businessplanners
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta name="description" content="Regular news and updates from the world of business with The Business Planners blog" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="head-bg">
	<div class="container">
		<div id="logo" class="col-md-3">
			<img src="<?=get_template_directory_uri()?>/images/Logo.png">
		</div><!-- #logo -->
		<div id="top-menu" class="col-md-6">
			<div id="btn-resp"></div>
			<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'menu')); ?>
		</div><!-- #top-menu -->
		<div id="info-head" class="col-md-3">0345 052 2742</div>
	</div><!-- .body_container -->
</div>
<div class="head-div"></div>
