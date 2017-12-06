<?php 
/**
 * The default template for displaying Single pages
 *
 * @package WPlook
 * @subpackage Conference
 * @since Conference 1.0
 */
 ?>

<?php get_header(); ?>
<?php 
	$pid = $post->ID;
	$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
?>
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
		<div class="columns small-12 <?php if ($page_width != 'off') { echo "medium-9 large-9"; } else { echo "medium-12 large-12"; }?>">
			<?php get_template_part('content', 'page' ); ?>
		</div>

		<!-- Right Sidebar -->
		<?php if ($page_width != 'off') { ?>
			<div id="secondary" class="columns small-12 medium-3 large-3 sidebar_widgets">
				<?php get_sidebar('page'); ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>