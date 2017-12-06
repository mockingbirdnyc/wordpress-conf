<?php
/**
 * The default template for displaying Single Sponsor
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>

<?php get_header(); ?>
<div class="single_post">
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
		<div class="columns small-12 medium-3 large-3">
			<!-- Sponsors -->
			<div class="partners">
				<div class="center-content">
					<ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-1">
						<?php if ( have_posts() ) : ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php 
									$pid = $post->ID;
									$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
									$sponsor_url = get_post_meta( $pid, 'wpl_sponsor_url', true);
									$logo_image = get_post_meta($post->ID, 'wpl_logo_image', true);
									$sponsor_url = get_post_meta($post->ID, 'wpl_sponsor_url', true);
								?>
								<!-- Logo -->
								<li id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
									<a href="<?php echo $sponsor_url; ?>" title="<?php the_title(); ?>" target="_blank">
										<img src="<?php echo $logo_image; ?>" width="200" height="85" alt="<?php the_title(); ?>">
									</a>
								</li>

						<?php endwhile; wp_reset_postdata(); ?>
						<?php else : ?>
							<p><?php _e('Sorry, no Speakers matched your criteria.', 'conference-wpl'); ?></p>
						<?php endif; ?>
					</ul>
				</div>
			</div>
			
		</div>

		<!-- Content area -->
		<div class="columns small-12 <?php if ($page_width != 'off') { echo "medium-6 large-6"; } else { echo "medium-9 large-9"; }?>">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="single">
						<div class="entry-content">
							<!-- The Content -->
							<?php the_content(); ?>
						</div>
						<div class="clear"></div>
					</article>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<!-- Right Sidebar -->
		<?php if ($page_width != 'off') { ?>
			<div id="secondary" class="columns small-12 medium-3 large-3 sidebar_widgets">
				<?php get_sidebar('sponsors'); ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>
