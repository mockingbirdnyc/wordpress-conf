<?php 
/**
 * The default template for displaying 404 Error page
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
				<h1 class="title_blog"><?php _e('404 Error Page', 'conference-wpl'); ?></h1>
			</div>


		</div>
		
	</div>
	<div class="row">
		<div class="columns small-12 medium-12 large-12">
			<div class="error-page"> 
				<div class="error-title">404</div>
				<h4><?php _e('The page you were looking for could not be found.', 'conference-wpl'); ?></h4>
				
				<div class="go-home">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-default"><?php _e('Go Home', 'conference-wpl'); ?></a>
				</div>
			</div>
		</div>

		
	</div>
</div>
<?php get_footer(); ?>
