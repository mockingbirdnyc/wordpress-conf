<?php
/**
 * The default Custom post type for Galleries
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0.0
 */
?>
<?php

if (!function_exists('wpl_gallery_cpt')) {
	
	function wpl_gallery_cpt(){
		
		$url_rewrite = ot_get_option('wpl_gallery_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'gallery'; }

		$url_rewrite_name = ot_get_option('wpl_gallery_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = __( 'Gallery', 'conference-wpl' ); }

		register_post_type('post_gallery',
			array(
				'labels' => array(
					'name' => __( 'Galleries', 'conference-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Gallery', 'conference-wpl' ),
					'add_new_item' => __( 'Add New Gallery', 'conference-wpl' ),
					'edit' => __( 'Edit', 'conference-wpl' ),
					'edit_item' => __( 'Edit Gallery', 'conference-wpl' ),
					'new_item' => __( 'New Gallery', 'conference-wpl' ),
					'view' => __( 'View', 'conference-wpl' ),
					'view_item' => __( 'View Gallery', 'conference-wpl' ),
					'search_items' => __( 'Search Galleries', 'conference-wpl' ),
					'not_found' => __( 'No Galleries found', 'conference-wpl' ),
					'not_found_in_trash' => __( 'No Galleries found in Trash', 'conference-wpl' ),
					'parent' => __( 'Parent Gallery', 'conference-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Galleries.', 'conference-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-format-gallery',
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
			)
		);
	}
	add_action('init', 'wpl_gallery_cpt');
}


/*-----------------------------------------------------------------------------------*/
/*	Adding category for Galleries
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_gallery_category')) {
	
	function wpl_gallery_category() {

		$url_rewrite = ot_get_option('wpl_gallery_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'gallery-category'; }

		register_taxonomy('wpl_gallery_category', 'post_gallery', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => __( 'Gallery Categories', 'conference-wpl' ),
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
	add_action('init', 'wpl_gallery_category');
}	
