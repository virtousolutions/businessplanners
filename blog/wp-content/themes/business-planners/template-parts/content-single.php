<?php
/**
 * @package businessplanners
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php business_planners_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="pull-left" style="padding-right:3rem;"><?php if(has_post_thumbnail(get_the_ID())) : ?>
			<?php the_post_thumbnail('home-thumbnail'); ?>
		<?php endif; ?></div>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'business-planners' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php business_planners_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
