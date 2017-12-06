<?php
/**
 * The default Custom post type Payments
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>
<?php

if (!function_exists('wpl_pledges_cpt')) {
	function wpl_pledges_cpt(){
		
		$url_rewrite = ot_get_option('wpl_pledges_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'pledges'; }

		register_post_type('post_pledges',
			array(
				'labels' => array(
					'name' => __( 'Payments', 'conference-wpl' ),
					'singular_name' => __( 'Payment', 'conference-wpl' ),
					'add_new' => __( 'Add New Payment', 'conference-wpl' ),
					'add_new_item' => __( 'Add New Payment', 'conference-wpl' ),
					'edit' => __( 'Edit', 'conference-wpl' ),
					'edit_item' => __( 'Edit Payment', 'conference-wpl' ),
					'new_item' => __( 'New Payment', 'conference-wpl' ),
					'view' => __( 'View', 'conference-wpl' ),
					'view_item' => __( 'View Payments', 'conference-wpl' ),
					'search_items' => __( 'Search Payments', 'conference-wpl' ),
					'not_found' => __( 'No Payments found', 'conference-wpl' ),
					'not_found_in_trash' => __( 'No Payments found in Trash', 'conference-wpl' ),
					'parent' => __( 'Parent Payment', 'conference-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Payments.', 'conference-wpl' ),
				'public' => false,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_icon' => 'dashicons-money',
				'rewrite' => array('slug' => $url_rewrite),
				'supports' => array('title', 'thumbnail'),
			)
		);
	}
	add_action('init', 'wpl_pledges_cpt');
}	
