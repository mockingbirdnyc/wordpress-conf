<?php 
/**
 * Register widget areas.
 *
 * @package WPlook
 * @subpackage Conference
 * @since Conference 1.0
 */


/*-----------------------------------------------------------
	Include Widgets
-----------------------------------------------------------*/
get_template_part( '/inc/widgets/widget', 'featurednews' );

// Initiate Speakers widget
if (ot_get_option('wpl_cpt_speakers') != 'off') {
	get_template_part( '/inc/widgets/widget', 'speakers' );
}

// Initiate Sponsors widget
if (ot_get_option('wpl_cpt_sponsors') != 'off') {
	get_template_part( '/inc/widgets/widget', 'sponsors' );
}

// Initiate Gallery widgets
if (ot_get_option('wpl_cpt_galleries') != 'off') {
	get_template_part( '/inc/widgets/widget', 'gallery' );
	get_template_part( '/inc/widgets/widget', 'gallery-home' );
}

// Initiate Staff widget
if (ot_get_option('wpl_cpt_staff') != 'off') {
	get_template_part( '/inc/widgets/widget', 'staff' );
}

// Initiate Testimonials widgets
if (ot_get_option('wpl_cpt_testimonials') != 'off') {
	get_template_part( '/inc/widgets/widget', 'testimonials' );
}

// Initiate Schedules widgets
if (ot_get_option('wpl_cpt_shedules') != 'off') {
	get_template_part( '/inc/widgets/widget', 'schedule' );
}


get_template_part( '/inc/widgets/widget', 'tickets' );

get_template_part( '/inc/widgets/widget', 'quote' );
get_template_part( '/inc/widgets/widget', 'address' );
get_template_part( '/inc/widgets/widget', 'posts' );
get_template_part( '/inc/widgets/widget', 'flickr' );
get_template_part( '/inc/widgets/widget', 'social' );
get_template_part( '/inc/widgets/widget', 'page' );
get_template_part( '/inc/widgets/widget', 'video' );
get_template_part( '/inc/widgets/widget', 'countdown' );

function wplook_widgets_init() {

	/*-----------------------------------------------------------
		Home page Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'First Home Page Widget area', 'conference-wpl' ),
		'id' => 'front-1',
		'description' => __('Widgets in this area will be shown only on the Home Page Template.','conference-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
	) );


	/*-----------------------------------------------------------
		Pages widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Page Widget area', 'conference-wpl' ),
		'id' => 'page-1',
		'description' => __('Widgets in this area will be shown on all Pages.','conference-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
	) );
	

	/*-----------------------------------------------------------
		Posts Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Press/Blog Widget area', 'conference-wpl' ),
		'id' => 'post-1',
		'description' => __('Widgets in this area will be shown on all Posts.','conference-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
	) );


	/*-----------------------------------------------------------
		Speakers Widget area
	-----------------------------------------------------------*/
	
	if (ot_get_option('wpl_cpt_speakers') != 'off') {
		
		register_sidebar( array(
			'name' => __( 'Speakers Widget area', 'conference-wpl' ),
			'id' => 'speaker-1',
			'description' => __('Widgets in this area will be shown on all Speakers.','conference-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>'
		) );
	}

	/*-----------------------------------------------------------
		Sponsors Widget area
	-----------------------------------------------------------*/
	
	if (ot_get_option('wpl_cpt_sponsors') != 'off') {
		
		register_sidebar( array(
			'name' => __( 'Sponsors Widget area', 'conference-wpl' ),
			'id' => 'sponsor-1',
			'description' => __('Widgets in this area will be shown on Sponsor page.','conference-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>'
		) );
	}	

	/*-----------------------------------------------------------
		Staff widget area
	-----------------------------------------------------------*/
	
	if (ot_get_option('wpl_cpt_staff') != 'off') {
		register_sidebar( array(
			'name' => __( 'Staff Widget area', 'conference-wpl' ),
			'id' => 'staff-1',
			'description' => __('Widgets in this area will be shown on all Staff.','conference-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>'
		) );
	}


	/*-----------------------------------------------------------
		Gallerry Widget area
	-----------------------------------------------------------*/
	
	if (ot_get_option('wpl_cpt_galleries') != 'off') {	
		register_sidebar( array(
			'name' => __( 'Gallery Widget area', 'conference-wpl' ),
			'id' => 'gallery-1',
			'description' => __('Widgets in this area will be shown on all Gallery pages.','conference-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>'
		) );
	}


	/*-----------------------------------------------------------
		Contact page Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Contact Page Widget area', 'conference-wpl' ),
		'id' => 'contact-1',
		'description' => __('Widgets in this area will be shown on Contact Pages.','conference-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
	) );
	

	/*-----------------------------------------------------------
		Footer Widget area
	-----------------------------------------------------------*/

	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'conference-wpl' ),
		'id' => 'f1-widgets',
		'description' => __( 'The first footer widget area', 'conference-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	) );

	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'conference-wpl' ),
		'id' => 'f2-widgets',
		'description' => __( 'The first footer widget area', 'conference-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	) );

	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'conference-wpl' ),
		'id' => 'f3-widgets',
		'description' => __( 'The first footer widget area', 'conference-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	) );
}
/** Register sidebars */
add_action( 'widgets_init', 'wplook_widgets_init' );
?>
