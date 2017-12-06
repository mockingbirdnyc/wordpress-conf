<?php
/**
 * The default Custom post type for Sponsors
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>
<?php

if (!function_exists('wpl_sponsors_cpt')) {
	function wpl_sponsors_cpt(){

		$url_rewrite = ot_get_option('wpl_sponsors_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'sponsor'; }

		$url_rewrite_name = ot_get_option('wpl_sponsors_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = __( 'Sponsors', 'conference-wpl' ); }

		register_post_type('post_sponsor',
			array(
				'labels' => array(
					'name' => __( 'Sponsors', 'conference-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Sponsor', 'conference-wpl' ),
					'add_new_item' => __( 'Add New Sponsor', 'conference-wpl' ),
					'edit' => __( 'Edit', 'conference-wpl' ),
					'edit_item' => __( 'Edit Sponsor', 'conference-wpl' ),
					'new_item' => __( 'New Sponsor', 'conference-wpl' ),
					'view' => __( 'View', 'conference-wpl' ),
					'view_item' => __( 'View Sponsor', 'conference-wpl' ),
					'search_items' => __( 'Search Sponsors', 'conference-wpl' ),
					'not_found' => __( 'No Sponsors found', 'conference-wpl' ),
					'not_found_in_trash' => __( 'No Sponsors found in Trash', 'conference-wpl' ),
					'parent' => __( 'Parent Sponsor', 'conference-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Sponsors.', 'conference-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-businessman',
				'supports' => array('title','editor'),
			)
		);
	}
	add_action('init', 'wpl_sponsors_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for Sponsors
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_sponsors_category')) {
	function wpl_sponsors_category() {

		$url_rewrite = ot_get_option('wpl_sponsors_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'sponsor-category'; }

		register_taxonomy('wpl_sponsors_category', 'post_sponsor', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => __( 'Sponsor Categories', 'conference-wpl' ),
					  'singular_name' => __( 'Category', 'conference-wpl' ),
					  'search_items' =>  __( 'Search in Category', 'conference-wpl' ),
					  'popular_items' => __( 'Popular Categories', 'conference-wpl' ),
					  'all_items' => __( 'All Categories', 'conference-wpl' ),
					  'parent_item' => __( 'Parent Category', 'conference-wpl' ),
					  'parent_item_colon' => __( 'Parent Category:', 'conference-wpl' ),
					  'edit_item' => __( 'Edit Category', 'conference-wpl' ),
					  'update_item' => __( 'Update Category', 'conference-wpl' ),
					  'add_new_item' => __( 'Add New Category', 'conference-wpl' ),
					  'new_item_name' => __( 'New Category Name', 'conference-wpl' )
				),
				'show_ui' => true,
				'query_var' => true, 
				'rewrite' => array('slug' => $url_rewrite)
			)
		);
	}
	add_action('init', 'wpl_sponsors_category');
}
