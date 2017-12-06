<?php 
/**
 * The default template for displaying Post Archive
 *
 * @package WPlook
 * @subpackage Conference
 * @since Conference 1.0
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
				<h1 class="title_blog"><?php wplook_doctitle(); ?></h1>
			</div>

		</div>
		
	</div>
	<div class="row">
		<div class="columns small-12 medium-9 large-9">
			
			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>
					<div class="entry-meta">
						<?php if ( ot_get_option('wpl_date_blog_post') != "off" ) { ?>
							<span class="date"><?php wplook_get_date_time(); ?></span>
						<?php } ?>
						
						<!-- Category -->
						<?php if ( ot_get_option('wpl_category_blog_post') != "off" ) { ?>
							<span class="entry-category"><i class="icon-folder"></i> <?php the_category(', ') ?></span>
						<?php } ?>
						
						<!-- Author -->
						<?php if ( ot_get_option('wpl_author_blog_post') != "off" ) { ?>
							<span class="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"> <?php echo get_the_author(); ?></a></span>
						<?php } ?>
					</div>
					<h1 class="entry-title">
						<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h1>
					<?php if ( has_post_thumbnail() ) {?>
						<div class="entry-featured-image">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-thumb', array('class' => 'round')); ?></a>
						</div>
					<?php } ?>

					<div class="entry-content">
						<p><?php echo wplook_short_excerpt(ot_get_option('wpl_blog_excerpt_limit'));?></p>
						<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'conference-wpl' ) . '</span>', 'after' => '</div>' ) ); ?>
					</div>
					<div class="entry-more">
						<a href="<?php the_permalink(); ?>" class="btn-default btn-post-more"><?php _e('Read more', 'conference-wpl'); ?></a>
					</div>
				</article>

				<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'conference-wpl'); ?></p>
			<?php endif; ?>
			
			<?php wplook_content_navigation('postnav' ) ?>
			
		</div>

		<!-- Right Sidebar -->
		<div id="secondary" class="columns small-12 medium-3 large-3 sidebar_widgets">
			<?php get_sidebar('post'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
