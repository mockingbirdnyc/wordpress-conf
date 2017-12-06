<?php
/**
 * Template Name: Blog/News
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0.0
 */
?>

<?php get_header(); ?>
<div class="page">
	<div class="title_blog_container">
		<div class="row">
			<!-- Breadcrumbs -->
			<?php if ( ot_get_option('wpl_breadcrumbs') != "off") { ?>

				<div class="columns small-12 medium-12 large-12">
					<ul class="breadcrumbs">
						<?php wplook_breadcrumbs(); ?>
					</ul>
				</div>
			<?php } ?>
			
			<div class="columns small-12 medium-12 large-12">
				<h1 class="title_blog"><?php echo get_the_title(); ?></h1>
			</div>


		</div>
		
	</div>

	<div class="row">
		<?php // Display the default content
			if ( $post->post_content != '' ) { ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="template-main-article">
						<div class="entry-content">
							<div class="content"><?php the_content(); ?></div>
						</div>
						<div class="clear"></div>
					</article>
				<?php endwhile;
			} // End displaying the default content
		?>
		<div class="columns small-12 medium-9 large-9">
			<?php $args = array( 'post_type' => 'post','post_status' => 'publish', 'posts_per_page' => ot_get_option('wpl_blog_per_page'), 'paged'=> $paged); ?>
				<?php $wp_query = null; ?>
				<?php $wp_query = new WP_Query( $args ); ?>
				<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

			<?php wplook_content_navigation('postnav' ) ?>
		</div>

		<!-- Right Sidebar -->
		<div id="secondary" class="columns small-12 medium-3 large-3 sidebar_widgets">
			<?php get_sidebar(); ?>
		</div>
	</div>

</div>
<?php get_footer(); ?>