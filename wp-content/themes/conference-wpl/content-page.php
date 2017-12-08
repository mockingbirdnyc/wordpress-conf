<?php
/**
 * The default template for displaying content for pages
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'conference-wpl' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div>
		</article>
		
	<?php endwhile; 
endif; ?>
