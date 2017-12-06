<?php
/**
 * The default Theme Options
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Initialize the options before anything else. 
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_init', 'wpl_theme_options', 1 );

/*-----------------------------------------------------------------------------------*/
/*	Build the custom settings & update OptionTree.
/*-----------------------------------------------------------------------------------*/
if (!function_exists('wpl_theme_options')) {
	
	function wpl_theme_options() {

		/*-----------------------------------------------------------
			Get a copy of the saved settings array.
		-----------------------------------------------------------*/

		$saved_settings = get_option( 'option_tree_settings', array() );
	  

		/*-----------------------------------------------------------
			Custom settings array that will eventually be  passes 
			to the OptionTree Settings API Class.
		-----------------------------------------------------------*/

		$custom_settings = array(
			'contextual_help' => array(

				'content'       => array( 
					array(
						'id'        => 'general_help',
						'title'     => __( 'General', 'conference-wpl' ),
						'content'   => __( '<p>Help content goes here!</p>', 'conference-wpl' )
					)
				),

				'sidebar'       => __( '<p>Sidebar content goes here!</p>', 'conference-wpl' ),
			),

			'sections'        => array(


				/*-----------------------------------------------------------
					General Settings
				-----------------------------------------------------------*/
				
				array(
					'title'       => __( 'General settings', 'conference-wpl' ),
					'id'          => 'general_settings'
				),


				/*-----------------------------------------------------------
					Teaser Settings
				-----------------------------------------------------------*/
				
				array(
					'title'       => __( 'Teaser Settings', 'conference-wpl' ),
					'id'          => 'teaser_settings'
				),


				/*-----------------------------------------------------------
					Blog settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Blog settings', 'conference-wpl' ),
					'id'          => 'blog_settings'
				),


				/*-----------------------------------------------------------
					Speaker settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Speakers settings', 'conference-wpl' ),
					'id'          => 'speakers_settings'
				),


				/*-----------------------------------------------------------
					Staff settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Staff settings', 'conference-wpl' ),
					'id'          => 'staff_settings'
				),


				/*-----------------------------------------------------------
					Sponsor settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Sponsors settings', 'conference-wpl' ),
					'id'          => 'sponsors_settings'
				),


				/*-----------------------------------------------------------
					Daily Agenda settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Daily Agenda settings', 'conference-wpl' ),
					'id'          => 'daily_agenda_settings'
				),


				/*-----------------------------------------------------------
					Gallery settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Gallery settings', 'conference-wpl' ),
					'id'          => 'gallery_settings'
				),


				/*-----------------------------------------------------------
					Testimonials settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Testimonials settings', 'conference-wpl' ),
					'id'          => 'testimonials_settings'
				),


				/*-----------------------------------------------------------
					Ticket settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Ticket settings', 'conference-wpl' ),
					'id'          => 'tickets_settings'
				),


				/*-----------------------------------------------------------
					PayPal settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Payment settings', 'conference-wpl' ),
					'id'          => 'paypal_settings'
				),

				/*-----------------------------------------------------------
					Google Maps settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Google Maps settings', 'conference-wpl' ),
					'id'          => 'google_maps_settings'
				)
				
			),

			'settings'        => array(

				/*-----------------------------------------------------------
					General Settings
				-----------------------------------------------------------*/
				
				array(
					'label'       => __( 'Logo Image', 'conference-wpl' ),
					'id'          => 'wpl_logo',
					'type'        => 'upload',
					'desc'        => __( 'Upload your own logo', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Custom Cascading Style Sheets', 'conference-wpl' ),
					'id'          => 'wpl_css',
					'type'        => 'css',
					'desc'        => __( 'Add custom CSS to your theme', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '10',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Contact Form Email', 'conference-wpl' ),
					'id'          => 'wpl_contact_form_email',
					'type'        => 'text',
					'desc'        => __( 'Add the default email address for contact form.', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Google Analytics Tracking Code', 'conference-wpl' ),
					'id'          => 'wpl_google_analytics_tracking_code',
					'type'        => 'textarea-simple',
					'desc'        => __( 'Insert the complete tracking script from analytics.google.com', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '8',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),
				
				array(
					'label'       => __( 'Breadcrumb', 'conference-wpl' ),
					'id'          => 'wpl_breadcrumbs',
					'type'        => 'on-off',
					'desc'        => __( 'Activate or deactivate the breadcrumb', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Display Sharing Buttons On Posts', 'conference-wpl' ),
					'id'          => 'wpl_post_sharing_buttons',
					'type'        => 'on-off',
					'desc'        => __( 'This option can be overwritten by individual posts.', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Footer Background Image', 'conference-wpl' ),
					'id'          => 'wpl_footer_bg',
					'type'        => 'upload',
					'desc'        => __( 'Upload a footer background image. Recommended dimensions: 1680px x 800px.', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Copyright', 'conference-wpl' ),
					'id'          => 'wpl_copyright',
					'type'        => 'text',
					'desc'        => __( 'Enter your Copyright notice displayed in the footer of the website', 'conference-wpl' ),
					'std'         => __( 'Copyright &copy; 2016. All Rights reserved', 'conference-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),


				/*-----------------------------------------------------------
					Teaser Settings
				-----------------------------------------------------------*/
				array(
					'label'       => __( 'Teaser background', 'conference-wpl' ),
					'id'          => 'wpl_teaser_background',
					'type'        => 'upload',
					'desc'        => __( 'Add teaser Background', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),
				
				array(
					'label'       => __( 'Background Color', 'conference-wpl' ),
					'id'          => 'wpl_teaser_color',
					'type'        => 'colorpicker',
					'desc'        => __( 'Add background Color', 'conference-wpl' ),
					'std'         => '#000000',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),

				array(
					'label'       => __( 'Background Opacity', 'conference-wpl' ),
					'id'          => 'wpl_teaser_opacity',
					'type'        => 'text',
					'desc'        => __( 'Add background Opacity. Ex: From 0 to 1, 0.5 means 50%.', 'conference-wpl' ),
					'std'         => '0.8',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),

				array(
					'label'       => __( 'Event Location', 'conference-wpl' ),
					'id'          => 'wpl_event_location',
					'type'        => 'text',
					'desc'        => __( 'Add the event location', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),

				array(
					'label'       => __( 'Event date', 'conference-wpl' ),
					'id'          => 'wpl_event_date',
					'type'        => 'text',
					'desc'        => __( 'Add the event date', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),

				array(
					'label'       => __( 'Number of speakers', 'conference-wpl' ),
					'id'          => 'wpl_number_speakers',
					'type'        => 'on-off',
					'desc'        => __( 'Display number of speakers', 'conference-wpl' ),
					'std'         => 'off',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),

				array(
					'label'       => __( 'Number of tickets', 'conference-wpl' ),
					'id'          => 'wpl_number_tickets',
					'type'        => 'text',
					'desc'        => __( 'Display number of tickets', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),

				array(
					'label'       => __( 'Teaser title', 'conference-wpl' ),
					'id'          => 'wpl_teaser_title',
					'type'        => 'text',
					'desc'        => __( 'Add Title', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),

				array(
					'label'       => __( 'Teaser title Color', 'conference-wpl' ),
					'id'          => 'wpl_teaser_title_color',
					'type'        => 'colorpicker',
					'desc'        => __( 'Add title color', 'conference-wpl' ),
					'std'         => '#fff',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),

				array(
					'label'       => __( 'Teaser Description', 'conference-wpl' ),
					'id'          => 'wpl_teaser_description',
					'type'        => 'textarea-simple',
					'desc'        => __( 'Add Description', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),

				array(
					'label'       => __( 'Teaser Description Color', 'conference-wpl' ),
					'id'          => 'wpl_teaser_description_color',
					'type'        => 'colorpicker',
					'desc'        => __( 'Add description color', 'conference-wpl' ),
					'std'         => '#bfbfbf',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),


				array(
					'label'       => __( 'Social Network', 'conference-wpl' ),
					'id'          => 'social_media_share',
					'type'        => 'list-item',
					'desc'        => __( 'Press the <strong>Add New</strong> button in order to add social media links', 'conference-wpl' ),
					'settings'    => array(
						array(
							'label'       => __( 'Service Name', 'conference-wpl' ),
							'id'          => 'wpl_share_item_name',
							'type'        => 'text',
							'desc'        => __( 'The name of the social network site, for example: "Facebook"', 'conference-wpl' ),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						),
						array(
							'label'       => __( 'URL', 'conference-wpl' ),
							'id'          => 'wpl_share_item_url',
							'type'        => 'text',
							'desc'        => __( 'Enter the URL of the social network site, for example: http://www.facebook.com/wplookthemes', 'conference-wpl' ),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						), 
						array(
							'label'       => __( 'Icon', 'conference-wpl' ),
							'id'          => 'wpl_share_item_icon',
							'type'        => 'text',
							'desc'        => __( '<strong>NOTICE</strong>: Choose one item from tne next list: <br />fa-facebook, <br />fa-github, <br />fa-twitter, <br />fa-pinterest, <br />fa-linkedin, <br />fa-google-plus, <br />fa-youtube, <br />fa-skype, <br />fa-vimeo', 'conference-wpl' ),
							'std'         => 'fa-',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						), 
					),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'teaser_settings'
				),


				/*-----------------------------------------------------------
					Blog settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Excerpt limit for list template', 'conference-wpl' ),
					'id'          => 'wpl_blog_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for blog excerpt', 'conference-wpl' ),
					'std'         => '35',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for Post Widget', 'conference-wpl' ),
					'id'          => 'wpl_blog_widget_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for Post Widget', 'conference-wpl' ),
					'std'         => '15',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),


				array(
					'label'       => __( 'Number of news per page', 'conference-wpl' ),
					'id'          => 'wpl_blog_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many cause do you want to display on blog template', 'conference-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				// Single post settimgs
				array(
					'label'       => __( 'Featured image on single post', 'conference-wpl' ),
					'id'          => 'wpl_featured_image_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the Featured image on single post', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Date on single post', 'conference-wpl' ),
					'id'          => 'wpl_date_single_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the date on single post', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Author on single post', 'conference-wpl' ),
					'id'          => 'wpl_author_single_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the author on single post', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Category on single post', 'conference-wpl' ),
					'id'          => 'wpl_category_single_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the category on single post', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				// Blog post settings
				array(
					'label'       => __( 'Date on blog post', 'conference-wpl' ),
					'id'          => 'wpl_date_blog_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the date on blog post', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Author on Blog post', 'conference-wpl' ),
					'id'          => 'wpl_author_blog_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the author on blog post', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Category on Blog post', 'conference-wpl' ),
					'id'          => 'wpl_category_blog_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the category on blog post', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),


				/*-----------------------------------------------------------
					Speakers settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Speaker', 'conference-wpl' ),
					'id'          => 'wpl_cpt_speakers',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Speaker', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'conference-wpl' ),
					'id'          => 'wpl_speaker_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'conference-wpl' ),
					'std'         => 'speaker',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),

				array(
					'label'       => __( 'URL Rewrite name', 'conference-wpl' ),
					'id'          => 'wpl_speaker_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'conference-wpl' ),
					'std'         => __( 'Speakers', 'conference-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'conference-wpl' ),
					'id'          => 'wpl_speakers_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'conference-wpl' ),
					'std'         => 'speaker-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),


				array(
					'label'       => __( 'Number of Speakers per page', 'conference-wpl' ),
					'id'          => 'wpl_speaker_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many Speakers do you want to display on speaker template', 'conference-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),

				array(
					'label'       => __( 'Speakers Page', 'conference-wpl' ),
					'id'          => 'wpl_speaker_page',
					'type'        => 'page-select',
					'desc'        => __( 'Select the page you use for displaying speakers to link to it in the breadcrumbs.', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'speakers_settings'
				),


				/*-----------------------------------------------------------
					Staff settings
				-----------------------------------------------------------*/
				
				array(
					'label'       => __( 'Custom Post Type Staff', 'conference-wpl' ),
					'id'          => 'wpl_cpt_staff',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Staff', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'conference-wpl' ),
					'id'          => 'wpl_staff_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'conference-wpl' ),
					'std'         => 'staff',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'URL Rewrite Name', 'conference-wpl' ),
					'id'          => 'wpl_staff_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'conference-wpl' ),
					'std'         => __( 'Staff', 'conference-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'conference-wpl' ),
					'id'          => 'wpl_staff_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'conference-wpl' ),
					'std'         => 'staff-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'Number of staff per page', 'conference-wpl' ),
					'id'          => 'wpl_staff_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many staff members do you want to display on staff template', 'conference-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'Staff Page', 'conference-wpl' ),
					'id'          => 'wpl_staff_page',
					'type'        => 'page-select',
					'desc'        => __( 'Select the page you use for displaying staff to link to it in the breadcrumbs.', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),


				/*-----------------------------------------------------------
					Sponsors settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Sponsors', 'conference-wpl' ),
					'id'          => 'wpl_cpt_sponsors',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Sponsors', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'Number of Sponsor to display', 'conference-wpl' ),
					'id'          => 'wpl_sponsors_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many sponsors do you want to display', 'conference-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'conference-wpl' ),
					'id'          => 'wpl_sponsors_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'conference-wpl' ),
					'std'         => 'sponsor',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'URL Rewrite name', 'conference-wpl' ),
					'id'          => 'wpl_sponsors_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'conference-wpl' ),
					'std'         => __( 'Sponsor', 'conference-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'conference-wpl' ),
					'id'          => 'wpl_sponsors_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'conference-wpl' ),
					'std'         => 'sponsor-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'Sponsors Page', 'conference-wpl' ),
					'id'          => 'wpl_sponsors_page',
					'type'        => 'page-select',
					'desc'        => __( 'Select the page you use for displaying sponsors to link to it in the breadcrumbs.', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),


				/*-----------------------------------------------------------
					Daily Agenda settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Daily Agenda', 'conference-wpl' ),
					'id'          => 'wpl_cpt_shedules',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Daily Agenda', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'daily_agenda_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'conference-wpl' ),
					'id'          => 'wpl_schedules_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'conference-wpl' ),
					'std'         => 'dagenda',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'daily_agenda_settings'
				),

				/*-----------------------------------------------------------
					Gallery settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Gallery', 'conference-wpl' ),
					'id'          => 'wpl_cpt_galleries',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Gallery', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'conference-wpl' ),
					'id'          => 'wpl_gallery_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'conference-wpl' ),
					'std'         => 'gallery',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'URL Rewrite Name', 'conference-wpl' ),
					'id'          => 'wpl_gallery_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'conference-wpl' ),
					'std'         => __( 'Galleries', 'conference-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'conference-wpl' ),
					'id'          => 'wpl_gallery_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'conference-wpl' ),
					'std'         => 'gallery-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'Number of galleries per page', 'conference-wpl' ),
					'id'          => 'wpl_galleries_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many galleries do you want to display on gallery template', 'conference-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'Galleries Page', 'conference-wpl' ),
					'id'          => 'wpl_galleries_page',
					'type'        => 'page-select',
					'desc'        => __( 'Select the page you use for displaying galleries to link to it in the breadcrumbs.', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),


				/*-----------------------------------------------------------
					Testimonials settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Testimonials', 'conference-wpl' ),
					'id'          => 'wpl_cpt_testimonials',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Testimonials', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'testimonials_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'conference-wpl' ),
					'id'          => 'wpl_testimonials_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'conference-wpl' ),
					'std'         => 'testimonials',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'testimonials_settings'
				),


				/*-----------------------------------------------------------
					Tickets settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Tickets', 'conference-wpl' ),
					'id'          => 'wpl_cpt_tickets',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Tickets', 'conference-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'tickets_settings'
				),


				/*-----------------------------------------------------------
					Payment settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'PayPal API Username', 'conference-wpl' ),
					'id'          => 'wpl_pp_api_username',
					'type'        => 'text',
					'desc'        => __( 'PayPal API Username', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				array(
					'label'       => __( 'PayPal API Password', 'conference-wpl' ),
					'id'          => 'wpl_pp_api_password',
					'type'        => 'text',
					'desc'        => __( 'PayPal API Password', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				array(
					'label'       => __( 'PayPal API Signature', 'conference-wpl' ),
					'id'          => 'wpl_pp_api_signature',
					'type'        => 'text',
					'desc'        => __( 'PayPal API Signature', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				array(
					'label'       => __( 'PayPal Page return', 'conference-wpl' ),
					'id'          => 'wpl_pp_return_page',
					'type'        => 'custom-post-type-select',
					'desc'        => __( 'Select the page where the user will return back after successful payment', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				array(
					'label'       => __( 'PayPal Page Cancel', 'conference-wpl' ),
					'id'          => 'wpl_pp_return_cancel',
					'type'        => 'custom-post-type-select',
					'desc'        => __( 'Select the page where the user will return back after canceled payment process', 'conference-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				array(
					'label'       => __( 'Currency Code', 'conference-wpl' ),
					'id'          => 'wpl_curency_code',
					'type'        => 'text',
					'desc'        => __( 'Add currency code, for ex: USD, EUR, CAD', 'conference-wpl' ),
					'std'         => 'USD',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'paypal_settings'
				),

				/*-----------------------------------------------------------
					Google Maps settings
				-----------------------------------------------------------*/

				array(
					'label'       => '',
					'id'          => 'wpl_maps_description',
					'type'        => 'textblock',
					'desc'        => sprintf( __( 'Enter your Google Maps API keys here. These are a free code which allows maps to be displayed on your site. To create keys, follow instructions in the <a href="%s">WPlook Themes documentation</a>.', 'conference-wpl' ), 'https://wplook.com/docs/google-maps-api/' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'google_maps_settings'
				),

				array(
					'label'       => __( 'Browser key', 'conference-wpl' ),
					'id'          => 'wpl_maps_api_browser_key',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'google_maps_settings'
				),

				array(
					'label'       => __( 'Server key', 'conference-wpl' ),
					'id'          => 'wpl_maps_api_server_key',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'google_maps_settings'
				),
			)
		);
		/* settings are not the same update the DB */
		if ( $saved_settings !== $custom_settings ) {
			update_option( 'option_tree_settings', $custom_settings ); 
		}
	}
}
