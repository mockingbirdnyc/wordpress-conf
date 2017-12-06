<?php
/**
 * Template Name: Sponsors By Category
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0.7
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
		
		
		<?php
		$category_args = array(
			'taxonomy' => 'wpl_sponsors_category',
			'orderby' => 'id'
		);
		$cats = get_categories( $category_args );

		foreach ($cats as $cat) {
			$cat_id= $cat->term_id;
			echo "<div class='clear'></div>";
			echo "<h2>".$cat->name."</h2><br />";
			$args = array(
				'orderby' => 'ID',
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'wpl_sponsors_category',
						'field' => 'id',
						'terms' => $cat_id
					)
				)
			); ?>

			<?php $wp_query = null; ?>
			<?php $wp_query = new WP_Query( $args ); ?>
						

				<div class="partners">
					<div class="center-content">
						<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
						
								<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
							
									<?php 
										$pid = $post->ID;
										$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
										$sponsor_url = get_post_meta( $pid, 'wpl_sponsor_url', true);
										$logo_image = get_post_meta($post->ID, 'wpl_logo_image', true);

									?>

									<!-- Sponsors -->
									<li id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<img src="<?php echo $logo_image; ?>" width="200" height="85" alt="<?php the_title(); ?>">
										</a>
									</li>

								<?php endwhile; endif; // done our wordpress loop. Will start again for each category ?>
						</ul>
					</div>
				</div>

				<?php wp_reset_query(); ?>
				
		<?php } // End Foreach statement ?>

	</div>
</div>
<?php get_footer(); ?>
