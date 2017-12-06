<?php
/**
 * Template Name: Home page
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0.0
 */
?>

<?php get_header(); ?>
<?php if (is_active_sidebar( 'front-1') ) { ?>
			
	<?php if ( is_active_sidebar( 'front-1' ) ) : ?>
		<?php ! dynamic_sidebar( 'front-1' ); ?>
	<?php endif; ?>

<?php }	?>
<?php get_footer(); ?>