<?php
/**
 * The default Custom post type for Shedules
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>
<?php

if (!function_exists('wpl_schedules_cpt')) {
	function wpl_schedules_cpt(){
		
		$url_rewrite = ot_get_option('wpl_schedules_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'dagenda'; }

		register_post_type('post_shedules',
			array(
				'labels' => array(
					'name' => __( 'Daily Agenda', 'conference-wpl' ),
					'singular_name' => __( 'Daily Agenda', 'conference-wpl' ),
					'add_new' => __( 'Add New Daily Agenda', 'conference-wpl' ),
					'add_new_item' => __( 'Add New Daily Agenda', 'conference-wpl' ),
					'edit' => __( 'Edit', 'conference-wpl' ),
					'edit_item' => __( 'Edit Daily Agenda', 'conference-wpl' ),
					'new_item' => __( 'New Daily Agenda', 'conference-wpl' ),
					'view' => __( 'View', 'conference-wpl' ),
					'view_item' => __( 'View Daily Agenda', 'conference-wpl' ),
					'search_items' => __( 'Search Daily Agenda', 'conference-wpl' ),
					'not_found' => __( 'No Daily Agenda found', 'conference-wpl' ),
					'not_found_in_trash' => __( 'No Daily Agenda found in Trash', 'conference-wpl' ),
					'parent' => __( 'Parent Daily Agenda', 'conference-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Daily Agendas.', 'conference-wpl' ),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_icon' => 'dashicons-calendar-alt',
				'rewrite' => array('slug' => $url_rewrite),
				'supports' => array('title'),
			)
		);
	}
	add_action('init', 'wpl_schedules_cpt');
}
