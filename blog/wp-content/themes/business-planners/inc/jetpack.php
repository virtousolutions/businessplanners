<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package businessplanners
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function business_planners_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'business_planners_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function business_planners_jetpack_setup
add_action( 'after_setup_theme', 'business_planners_jetpack_setup' );

function business_planners_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function business_planners_infinite_scroll_render