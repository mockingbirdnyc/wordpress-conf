<?php
/**
 * Template Name: Sponsors
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
		
		<!-- Sponsors -->
		<div class="partners">
			<div class="center-content">
				<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
					<?php $args = array( 'post_type' => 'post_sponsor','post_status' => 'publish', 'posts_per_page' => ot_get_option('wpl_sponsors_per_page'), 'paged'=> $paged); ?>
						<?php $wp_query = null; ?>
						<?php $wp_query = new WP_Query( $args ); ?>
						<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
								
								<?php 
									$pid = $post->ID;
									$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
									$sponsor_url = get_post_meta( $pid, 'wpl_sponsor_url', true);
									$logo_image = get_post_meta($post->ID, 'wpl_logo_image', true);

								?>
								<!-- sponsorss -->
								<li id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<img src="<?php echo $logo_image; ?>" width="200" height="85" alt="<?php the_title(); ?>">
									</a>
								</li>

						<?php endwhile; wp_reset_postdata(); ?>
						<?php else : ?>
							<p><?php _e('Sorry, no Sponsors matched your criteria.', 'conference-wpl'); ?></p>
						<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
