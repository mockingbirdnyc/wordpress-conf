<?php
/**
 * The default Custom post type for Staff
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>
<?php

if (!function_exists('wpl_staff_cpt')) {
	function wpl_staff_cpt(){
		
		$url_rewrite = ot_get_option('wpl_staff_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'staff'; }

		$url_rewrite_name = ot_get_option('wpl_staff_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = __( 'Staff', 'conference-wpl' ); }

		register_post_type('post_staff',
			array(
				'labels' => array(
					'name' => __( 'Staff', 'conference-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Candidate', 'conference-wpl' ),
					'add_new_item' => __( 'Add New Candidate', 'conference-wpl' ),
					'edit' => __( 'Edit', 'conference-wpl' ),
					'edit_item' => __( 'Edit Candidate', 'conference-wpl' ),
					'new_item' => __( 'New Candidate', 'conference-wpl' ),
					'view' => __( 'View', 'conference-wpl' ),
					'view_item' => __( 'View Candidate', 'conference-wpl' ),
					'search_items' => __( 'Search for Candidates', 'conference-wpl' ),
					'not_found' => __( 'No Candidates found', 'conference-wpl' ),
					'not_found_in_trash' => __( 'No Candidates found in Trash', 'conference-wpl' ),
					'parent' => __( 'Parent Candidate', 'conference-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Staff.', 'conference-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-nametag',
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
			)
		);
	}
	add_action('init', 'wpl_staff_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for Staff
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_staff_category')) {
	function wpl_staff_category() {

		$url_rewrite = ot_get_option('wpl_staff_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'staff-items'; }

		register_taxonomy('wpl_staff_category', 'post_staff', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => __( 'Staff Departaments', 'conference-wpl' ),
					  'singular_name' => __( 'Department', 'conference-wpl' ),
					  'search_items' =>  __( 'Search in Department', 'conference-wpl' ),
					  'popular_items' => __( 'Popular Departments', 'conference-wpl' ),
					  'all_items' => __( 'All Departments', 'conference-wpl' ),
					  'parent_item' => __( 'Parent Department', 'conference-wpl' ),
					  'parent_item_colon' => __( 'Parent Department:', 'conference-wpl' ),
					  'edit_item' => __( 'Edit Department', 'conference-wpl' ),
					  'update_item' => __( 'Update Department', 'conference-wpl' ),
					  'add_new_item' => __( 'Add New Department', 'conference-wpl' ),
					  'new_item_name' => __( 'New Department Name', 'conference-wpl' )
				),
				'show_ui' => true,
				'query_var' => true, 
				'rewrite' => array('slug' => $url_rewrite)
			) 
		);
	}
	add_action('init', 'wpl_staff_category');
}
