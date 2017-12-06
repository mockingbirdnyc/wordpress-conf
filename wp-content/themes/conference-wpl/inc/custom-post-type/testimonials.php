<?php
/**
 * The default Custom post type for Testimonials
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>
<?php
if (!function_exists('wpl_testimonials_cpt')) {
	
	function wpl_testimonials_cpt(){
		
		$url_rewrite = ot_get_option('wpl_testimonials_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'testimonial'; }

		register_post_type('post_testimonials',
			array(
				'labels' => array(
					'name' => __( 'Testimonials', 'conference-wpl' ),
					'singular_name' => __( 'Testimonial', 'conference-wpl' ),
					'add_new' => __( 'Add New Testimonial', 'conference-wpl' ),
					'add_new_item' => __( 'Add New Testimonial', 'conference-wpl' ),
					'edit' => __( 'Edit', 'conference-wpl' ),
					'edit_item' => __( 'Edit Testimonial', 'conference-wpl' ),
					'new_item' => __( 'New Testimonial', 'conference-wpl' ),
					'view' => __( 'View', 'conference-wpl' ),
					'view_item' => __( 'View Testimonial', 'conference-wpl' ),
					'search_items' => __( 'Search Testimonials', 'conference-wpl' ),
					'not_found' => __( 'No Testimonials found', 'conference-wpl' ),
					'not_found_in_trash' => __( 'No Testimonials found in Trash', 'conference-wpl' ),
					'parent' => __( 'Parent Testimonial', 'conference-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Testimonials.', 'conference-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_icon' => 'dashicons-testimonial',
				'rewrite' => array('slug' => $url_rewrite),
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
			)
		); 
	}
	add_action('init', 'wpl_testimonials_cpt');
}	
