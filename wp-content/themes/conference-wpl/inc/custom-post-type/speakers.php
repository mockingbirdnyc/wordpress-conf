<?php
/**
 * The default Custom post type for Speakers
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>
<?php 
if (!function_exists('wpl_speaker_cpt')) {
	function wpl_speaker_cpt(){
		
		$url_rewrite = ot_get_option('wpl_speaker_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'speaker'; }

		$url_rewrite_name = ot_get_option('wpl_speaker_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = __( 'Speaker', 'conference-wpl' ); }

		register_post_type('post_speaker',
			array(
				'labels' => array(
					'name' => __( 'Speakers', 'conference-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Speaker', 'conference-wpl' ),
					'add_new_item' => __( 'Add New Speaker', 'conference-wpl' ),
					'edit' => __( 'Edit', 'conference-wpl' ),
					'edit_item' => __( 'Edit Speaker', 'conference-wpl' ),
					'new_item' => __( 'New Speaker', 'conference-wpl' ),
					'view' => __( 'View', 'conference-wpl' ),
					'view_item' => __( 'View Speakers', 'conference-wpl' ),
					'search_items' => __( 'Search Speakers', 'conference-wpl' ),
					'not_found' => __( 'No Speakers found', 'conference-wpl' ),
					'not_found_in_trash' => __( 'No Speakers found in Trash', 'conference-wpl' ),
					'parent' => __( 'Parent Speaker', 'conference-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Speakers.', 'conference-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_icon' => 'dashicons-id-alt',
				'rewrite' => array('slug' => $url_rewrite),
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
			)
		);
	}
	add_action('init', 'wpl_speaker_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for speakers
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_speakers_category')) {
	function wpl_speakers_category() {

		$url_rewrite = ot_get_option('wpl_speakers_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'speakers-category'; }

		register_taxonomy('wpl_speakers_category', 'post_speaker', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => __( 'Speakers Categories', 'conference-wpl' ),
					  'singular_name' => __( 'Department', 'conference-wpl' ),
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
	add_action('init', 'wpl_speakers_category');
}
