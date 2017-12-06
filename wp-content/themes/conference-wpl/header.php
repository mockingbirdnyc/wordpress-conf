<?php
/**
 * The header template file
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- Favicon -->
	<?php if ( ot_get_option('wpl_favicon') ) { ?>
		<link rel="shortcut icon" href="<?php echo ot_get_option('wpl_favicon'); ?>">
		<link rel="apple-touch-icon" href="<?php echo ot_get_option('wpl_favicon'); ?>" />
	<?php } ?>
	
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper">
		<div class="main_menu navbar-fixed">
			<div class="row">
				<div class="columns small-12 medium-12 large-12">
					<div class="mb">
						<div class="navmobile"><a href=""></a></div>
						<?php if ( is_page_template('template-homepage.php') ) {
							wp_nav_menu( array('depth' => '3', 'theme_location' => 'primary', 'container' => '')); 
						} else { 
							wp_nav_menu( array('depth' => '3', 'theme_location' => 'secondary', 'container' => ''));
						} ?>
					</div>
				</div>
			</div>
		</div>

		<?php get_template_part( 'inc', 'teaser' ); ?>
