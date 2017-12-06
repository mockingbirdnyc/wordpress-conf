<?php 
/**
 * The main template file. 
 *
 * @package WPlook
 * @subpackage Conference
 * @since Conference 1.0
 */
 ?>
<?php get_header(); ?>
<!-- Content -->
<div class="page">
	<div class="title_blog_container">
		<div class="row">
			<div class="columns small-12 medium-12 large-12">
				<h1 class="title_blog"><?php _e('Latest posts', 'conference-wpl'); ?></h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="columns small-12 medium-9 large-9">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>
		</div>

		<!-- Right Sidebar -->
		<div id="secondary" class="columns small-12 medium-3 large-3 sidebar_widgets">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
