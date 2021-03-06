<?php
/**
 * The default template for displaying Single Staff page
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
			<!-- Staff -->
			<div class="speakers">
				<div class="center-content">
					<ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-1">
						<?php if ( have_posts() ) : ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php 
									$pid = $post->ID;
									$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
									$candidate_position = get_post_meta( $pid, 'wpl_candidate_position', true);
									$candidate_share_items = get_post_meta($post->ID, 'candidate_share', true);
									$wpl_cpt_video = get_post_meta( $pid, 'wpl_cpt_video', true);
								?>
								<!-- Speackers -->
								<li id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
									<div class="avatar">
										<?php if ( has_post_thumbnail() ) {?> 
											<?php the_post_thumbnail('speaker-thumb'); ?>
										<?php } ?>

										<!-- Speaker media links -->
										<div class="social">
											<?php if ( ! empty( $candidate_share_items ) ) {
												foreach( $candidate_share_items as $item ) { ?>
													<a href="<?php echo $item['wpl_share_item_url']; ?>" target="_blank">
														<i class="fa <?php echo $item['wpl_share_item_icon']; ?>"></i>
													</a>
												<?php }
											} ?>
										</div>
									</div>
									<div class="name"><?php the_title(); ?></div>
									
									<!-- Speaker company -->
									<?php if ( $candidate_position !='' ) { ?>
										<div class="company"><a><?php echo $candidate_position; ?></a></div>
									<?php } ?>	
								</li>

						<?php endwhile; wp_reset_postdata(); ?>
						<?php else : ?>
							<p><?php _e('Sorry, no Staff matched your criteria.', 'conference-wpl'); ?></p>
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
				<?php get_sidebar('staff'); ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>
