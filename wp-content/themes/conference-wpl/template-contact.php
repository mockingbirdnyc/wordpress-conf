<?php
/**
 * Template Name: Contact
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
				<h1 class="title_blog"><?php the_title(); ?></h1>
			</div>

		</div>
		
	</div>
	<div class="row">
		<div class="columns small-12 medium-9 large-9">
			<?php get_template_part('content', 'page' ); ?>
		</div>

		<!-- Right Sidebar -->
		<div id="secondary" class="columns small-12 medium-3 large-3 sidebar_widgets">
			<?php get_sidebar('contact'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
