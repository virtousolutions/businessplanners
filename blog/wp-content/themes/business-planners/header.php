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
		<!-- <div id="logo" class="col-md-3">
			<img src="<?=get_template_directory_uri()?>/images/Logo.png">
		</div>#logo -->
		<!-- <div id="top-menu" class="col-md-6">
			<div id="btn-resp"></div> -->
			<?php #wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'menu')); ?>

			<nav class="navbar navbar-default">
              <div class="container-fluid" style="padding: 0px;">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header col-md-2">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{ url('') }}">
                        <img src="<?=get_template_directory_uri()?>/images/Logo.png">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="col-md-8">
                    <div class="collapse navbar-collapse" id="main-menu-collapse">
                      <ul class="nav navbar-nav">
                        <li><a href="<?=getsiteurl()?>" id="forhome">Home</a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Packages <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="<?=getsiteurl('diy-business-plan-package')?>">DIY package</a></li>
                            <li><a href="<?=getsiteurl('value-business-plan-package')?>">Value package</a></li>
                            <li><a href="<?=getsiteurl('standard-business-plan-package')?>">Standard Package</a></li>
                            <li><a href="<?=getsiteurl('professional-business-plan-package')?>">Professional Package</a></li>
                            <li><a href="<?=getsiteurl('premium-business-plan-package')?>">Premium Package</a></li>
                          </ul>
                        </li>
                        <li><a href="<?=getsiteurl('#info-home')?>" id="forfeature">Features</a></li>
                        
                        <li><a href="<?=getsiteurl('#contactus')?>" id="forcontactus">Contact Us</a></li>
                       
                        <!-- <li><a href="{{ url('resources')?>" id="forfeature">Resources</a></li> -->
                        <li><a href="<?=getsiteurl('blog')?>" id="forfeature">blog</a></li>
                      </ul>
                    </div>
                </div>
                <div id="info-head" class="col-md-2">
                    0345 052 2742
                </div>
              </div><!-- /.container-fluid -->
            </nav>

		<!-- </div> --><!-- #top-menu -->
		<!-- <div id="info-head" class="col-md-3">0345 052 2742</div> -->
	</div><!-- .body_container -->
</div>
<div class="head-div"></div>
