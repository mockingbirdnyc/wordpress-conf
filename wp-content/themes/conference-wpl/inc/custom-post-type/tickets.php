<?php
/**
 * The default Custom post type for Tickets
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>
<?php

if (!function_exists('wpl_tickets_cpt')) {
	function wpl_tickets_cpt(){

		register_post_type('post_tickets',
			array(
				'labels' => array(
					'name' => __( 'Tickets', 'conference-wpl' ),
					'singular_name' => __( 'Ticket', 'conference-wpl' ),
					'add_new' => __( 'Add New Ticket', 'conference-wpl' ),
					'add_new_item' => __( 'Add New Ticket', 'conference-wpl' ),
					'edit' => __( 'Edit', 'conference-wpl' ),
					'edit_item' => __( 'Edit Ticket', 'conference-wpl' ),
					'new_item' => __( 'New Ticket', 'conference-wpl' ),
					'view' => __( 'View', 'conference-wpl' ),
					'view_item' => __( 'View Ticket', 'conference-wpl' ),
					'search_items' => __( 'Search Tickets', 'conference-wpl' ),
					'not_found' => __( 'No Tickets found', 'conference-wpl' ),
					'not_found_in_trash' => __( 'No Tickets found in Trash', 'conference-wpl' ),
					'parent' => __( 'Parent Ticket', 'conference-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Tickets.', 'conference-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_icon' => 'dashicons-tickets-alt',
				'rewrite' => array('slug' => 'tickets'),
				'supports' => array('title','editor'),
			)
		);
	}
	add_action('init', 'wpl_tickets_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for Tickets
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_tickets_category')) {
	function wpl_tickets_category() {

		register_taxonomy('wpl_tickets_category', 'post_tickets', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => __( 'Ticket Categories', 'conference-wpl' ),
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
				'rewrite' => array('slug' => 'tickets-category')
			)
		);
	}
	add_action('init', 'wpl_tickets_category');
}
