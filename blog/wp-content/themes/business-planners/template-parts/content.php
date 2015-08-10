<?php
/**
 * @package businessplanners
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content col-md-12">
		<div class="col-md-3">
			<?php if(has_post_thumbnail(get_the_ID())) : ?>
				<?php echo get_the_post_thumbnail(get_the_ID(), 'home-thumbnail'); ?>
			<?php endif; ?>
		</div>
		<div class="col-md-8">

			<header class="entry-header">
				<?php if ( 'post' == get_post_type() ) : ?>	
				<div class="entry-meta">
					<?php business_planners_posted_on(); ?> <span>By: <?php echo get_the_author_meta('display_name'); ?></span>
				</div><!-- .entry-meta -->
				<?php endif; ?>

				<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			</header><!-- .entry-header -->
			<?php

				$str = wordwrap(strip_tags(get_the_content()), 257, "<br>"); #echo $str."<br><br>";
				$pos = strpos($str, "<br>");

				$readmore = '<a href="'.get_permalink(get_the_ID()).'">Read more</a>';
				if(strlen(strip_tags(get_the_content())) > 300 ){
					echo substr(strip_tags(get_the_content()), 0, $pos). ' ... ' .  $readmore;
				}else if(strlen(strip_tags(get_the_content())) < 300 ){
					echo get_the_content();
				}else if(strlen(strip_tags(get_the_content())) < 50 ){
					echo get_the_content();
				}
				else{
					echo get_the_content();
				}
				/* translators: %s: Name of current post */
				// the_content( sprintf(
				// 	__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'business-planners' ),
				// 	the_title( '<span class="screen-reader-text">"', '"</span>', false )
				// ) );
				#the_excerpt();
			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'business-planners' ),
					'after'  => '</div>',
				) );
			?>
			<footer class="entry-footer">
				<?php business_planners_entry_footer(); ?>
			</footer><!-- .entry-footer -->

		</div>
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->

