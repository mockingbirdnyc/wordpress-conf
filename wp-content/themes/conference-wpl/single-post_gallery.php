<?php
/**
 * The default template for displaying Single Galleries
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>

<?php get_header(); ?>
<?php 
	$pid = $post->ID;
	$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
	$wpl_cpt_gallery = get_post_meta( $pid, 'wpl_cpt_gallery', true);
?>
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
		
		<!-- Content Area -->
		<div class="columns small-12 <?php if ($page_width != 'off') { echo "medium-9 large-9"; } else { echo "medium-12 large-12"; }?>">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<article class="single">
						<div class="entry-content">
							<!-- The Content -->
							<?php the_content(); ?>
							
							<!-- Gallery -->
							<div class="single-page-gallery_slider">
								<div id="owl-gallery-single" class="owl-carousel owl-theme">
									<?php foreach( $wpl_cpt_gallery as $item ) { ?>
										<div class="item">

											<?php 
												$id = custom_get_attachment_id( $item['wpl_cpt_image'] );
												$src = wp_get_attachment_image_src( $id, 'gallery-image' );
												echo '<img src="'.$src[0].'"  />';
											?>
										
										</div>
									<?php } ?>
									
								</div>

								<!-- Pagination -->
								<div class="customNavigation-single">
									<a class="btn prev-gallery"><i class="fa fa-angle-left"></i></a>
									<a class="btn next-gallery"><i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</article>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<!-- Right Sidebar -->
		<?php if ($page_width != 'off') { ?>
			<div id="secondary" class="columns small-12 medium-3 large-3 sidebar_widgets">
				<?php get_sidebar('gallery'); ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>