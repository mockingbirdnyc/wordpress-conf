<?php
/**
 * The default Meta Box Settings
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */

	


/*-----------------------------------------------------------------------------------*/
/*	Initialize the meta boxes. 
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_init', 'wpl_meta_boxes' );

function wpl_meta_boxes() {

	/*-----------------------------------------------------------
		Custom meta box for pages
	-----------------------------------------------------------*/
	
	$page_meta_box = array(
		'id'          => 'page_meta_box',
		'title'       => __( 'Page Options', 'conference-wpl' ),
		'desc'        => '',
		'pages'       => array( 'page' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'label'       => __( 'Header image', 'conference-wpl' ),
				'id'          => 'wpl_header_image',
				'type'        => 'upload',
				'desc'        => __( 'The image will be displayed in the header of the page. Recommended dimensions: 1680px x 800px.', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),
			array(
				'label'       => __( 'Right Sidebar', 'conference-wpl' ),
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => __( 'Display or hide the sidebar on this page', 'conference-wpl' ),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)
		)
	);
	ot_register_meta_box( $page_meta_box );


	/*-----------------------------------------------------------
  		Calendar Template
  	-----------------------------------------------------------*/
	
	$page_meta_box_test = array(
		'id'          => 'page_meta_box_test',
		'title'       => __( 'Columns size', 'conference-wpl' ),
		'desc'        => '',
		'pages'       => array( 'page' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'label'       => __( 'Columns', 'conference-wpl' ),
				'id'          => 'wpl_number_of_columns',
				'type'        => 'text',
				'desc'        => __( 'Add the number of Columns between 1-12. Default is 3', 'conference-wpl' ),
				'std'         => '3',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
		)
	);

	$post_id = (isset($_GET['post'])) ? $_GET['post'] : ((isset($_POST['post_ID'])) ? $_POST['post_ID'] : false);

	if ($post_id) : 
		$post_template = get_post_meta($post_id, '_wp_page_template', true);
	
	if ($post_template == 'template-dayly-agenda.php') 
		ot_register_meta_box($page_meta_box_test);
	endif;


	/*-----------------------------------------------------------
  		Custom meta box for posts
  	-----------------------------------------------------------*/

	$blog_meta_box = array(
		'id'          => 'blog_meta_box',
		'title'       => 'Post Options',
		'desc'        => '',
		'pages'       => array( 'post' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Header image', 'conference-wpl' ),
				'id'          => 'wpl_header_image',
				'type'        => 'upload',
				'desc'        => __( 'The image will be displayed in the header of the page. Recommended dimensions: 1680px x 800px.', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),
			array(
				'label'       => __( 'Display Share Buttons', 'conference-wpl' ),
				'id'          => 'wpl_share_buttons',
				'type'        => 'select',
				'desc'        => __( 'Select "Default" to follow the global setting found in Theme Options, or one of the other two options to override it for just this post.', 'conference-wpl' ),
				'choices'     => array(
					array(
						'label'       => __( 'Default', 'conference-wpl' ),
						'value'       => 'default'
					),
					array(
						'label'       => __( 'On', 'conference-wpl' ),
						'value'       => 'on'
					),
					array(
						'label'       => __( 'Off', 'conference-wpl' ),
						'value'       => 'off'
					),
				),
				'std'         => 'default',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
		)
	);
	ot_register_meta_box( $blog_meta_box );


	/*-----------------------------------------------------------
  		Speakers
  	-----------------------------------------------------------*/

	$speakers_meta_box = array(
		'id'          => 'speakers_meta_box',
		'title'       => __( 'Speaker Options', 'conference-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_speaker' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'label'       => __( 'Company Name', 'conference-wpl' ),
				'id'          => 'wpl_speaker_company',
				'type'        => 'text',
				'desc'        => __( 'Company name', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => __( 'Company URL', 'conference-wpl' ),
				'id'          => 'wpl_speaker_company_url',
				'type'        => 'text',
				'desc'        => __( 'Company url', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => __( 'Social Network links', 'conference-wpl' ),
				'id'          => 'candidate_share',
				'type'        => 'list-item',
				'desc'        => __( 'Press the <strong>Add New</strong> button in order to add social media links.', 'conference-wpl' ),
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
						'desc'        => __( '<strong>NOTICE</strong>: Choose one item from tne next list: <br />fa-facebook, <br />fa-github, <br />fa-twitter, <br />fa-pinterest, <br />fa-linkedin, <br />fa-google-plus, <br />fa-youtube, <br />fa-flickr', 'conference-wpl' ),
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
				'section'     => 'toolbar'
			),

			array(
				'label'       => __( 'Right Sidebar', 'conference-wpl' ),
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => __( 'Display or hide the sidebar on this page', 'conference-wpl' ),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)

		)
	);
	ot_register_meta_box( $speakers_meta_box );


	/*-----------------------------------------------------------
  		Gallery
  	-----------------------------------------------------------*/

	$gallery_meta_box = array(
		'id'          => 'gallery_meta_box',
		'title'       => __( 'Gallery Options', 'conference-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_gallery' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Header image', 'conference-wpl' ),
				'id'          => 'wpl_header_image',
				'type'        => 'upload',
				'desc'        => __( 'The image will be displayed in the header of the page. Recommended dimensions: 1680px x 800px.', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),
			array(
				'label'       => __( 'Gallery', 'conference-wpl' ),
				'id'          => 'wpl_cpt_gallery',
				'type'        => 'list-item',
				'desc'        => __( 'Press the <strong>Add New</strong> button in order to add images to gallery.', 'conference-wpl' ),
				'settings'    => array(
					array(
						'label'       => __( 'Gallery Image', 'conference-wpl' ),
						'id'          => 'wpl_cpt_image',
						'type'        => 'upload',
						'desc'        => __( 'The required dimensions:  (1200 x 800 px)', 'conference-wpl' ),
						'std'         => '',
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
				'section'     => 'social_media'
			),

			array(
				'label'       => __( 'Right Sidebar', 'conference-wpl' ),
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => __( 'Display or hide the sidebar on this page', 'conference-wpl' ),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			
		)
	);
	ot_register_meta_box( $gallery_meta_box );


	/*-----------------------------------------------------------
  		Payments
  	-----------------------------------------------------------*/

	$pledges_meta_box = array(
		'id'          => 'pledges_meta_box',
		'title'       => __( 'Cause Options', 'conference-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_pledges' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Choose the ticket', 'conference-wpl' ),
				'id'          => 'wpl_pledge_ticket',
				'type'        => 'custom-post-type-select',
				'desc'        => __( 'Choose the ticket', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => 'post_tickets',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Transaction ID/Token', 'conference-wpl' ),
				'id'          => 'wpl_pledge_transaction_id',
				'type'        => 'text',
				'desc'        => __( 'Add the transaction ID', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'First name', 'conference-wpl' ),
				'id'          => 'wpl_pledge_first_name',
				'type'        => 'text',
				'desc'        => __( 'Add the first name', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Last name', 'conference-wpl' ),
				'id'          => 'wpl_pledge_last_name',
				'type'        => 'text',
				'desc'        => __( 'Add the last name', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Country', 'conference-wpl' ),
				'id'          => 'wpl_pledge_country',
				'type'        => 'text',
				'desc'        => __( 'Add the Postal Code', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Email', 'conference-wpl' ),
				'id'          => 'wpl_pledge_email',
				'type'        => 'text',
				'desc'        => __( 'Add the Email address', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Payment Amount', 'conference-wpl' ),
				'id'          => 'wpl_pledge_payment_amount',
				'type'        => 'text',
				'desc'        => __( 'Add the Payment Amount', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Payment Source', 'conference-wpl' ),
				'id'          => 'wpl_pledge_payment_source',
				'type'        => 'select',
				'desc'        => __( 'Choose the pledge payment source', 'conference-wpl' ),
				'choices'     => array(
					array(
						'label'       => __( 'Manual', 'conference-wpl' ),
						'value'       => 'manual'
					),
					array(
						'label'       => __( 'PayPal', 'conference-wpl' ),
						'value'       => 'paypal'
					),
					array(
						'label'       => __( 'Check/Cash', 'conference-wpl' ),
						'value'       => 'check_cash'
					),
				),        
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => __( 'Payment Status', 'conference-wpl' ),
				'id'          => 'wpl_pledge_payment_status',
				'type'        => 'select',
				'desc'        => __( 'Choose the pledge payment status', 'conference-wpl' ),
				'choices'     => array(
					array(
						'label'       => __( 'Completed', 'conference-wpl' ),
						'value'       => 'Completed'
					),
					array(
						'label'       => __( 'Refunded', 'conference-wpl' ),
						'value'       => 'Refunded'
					),
					array(
						'label'       => __( 'Canceled', 'conference-wpl' ),
						'value'       => 'Canceled'
					),
				),        
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)
		)
	);
	ot_register_meta_box( $pledges_meta_box );
	

	/*-----------------------------------------------------------
  		Staff
  	-----------------------------------------------------------*/

	$staff_meta_box = array(
		'id'          => 'staff_meta_box',
		'title'       => __( 'Staff Options', 'conference-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_staff' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Header image', 'conference-wpl' ),
				'id'          => 'wpl_header_image',
				'type'        => 'upload',
				'desc'        => __( 'Optional! <br /> The image will be displayed in the header of the page. Recommended dimensions: 1680px x 800px.', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => __( 'Position', 'conference-wpl' ),
				'id'          => 'wpl_candidate_position',
				'type'        => 'text',
				'desc'        => __( 'Candidate position, (ex: CEO/Co-Founder)', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => __( 'Social Network links', 'conference-wpl' ),
				'id'          => 'candidate_share',
				'type'        => 'list-item',
				'desc'        => __( 'Press the <strong>Add New</strong> button in order to add social media links.', 'conference-wpl' ),
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
						'desc'        => __( '<strong>NOTICE</strong>: Choose one item from tne next list: <br />fa-facebook, <br />fa-github, <br />fa-twitter, <br />fa-pinterest, <br />fa-linkedin, <br />fa-google-plus, <br />fa-youtube, <br />fa-flickr', 'conference-wpl' ),
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
				'section'     => 'toolbar'
			),

			array(
				'label'       => __( 'Right Sidebar', 'conference-wpl' ),
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => __( 'Display or hide the sidebar on this page', 'conference-wpl' ),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)
		)
	);
	ot_register_meta_box( $staff_meta_box );
	

	/*-----------------------------------------------------------
  		Sponsors
  	-----------------------------------------------------------*/

	$sponsor_meta_box = array(
		'id'          => 'sponsor_meta_box',
		'title'       => __( 'Media Options', 'conference-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_sponsor' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Logo', 'conference-wpl' ),
				'id'          => 'wpl_logo_image',
				'type'        => 'upload',
				'desc'        => __( '*  <br /> The required dimensions:  (200x85px)', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => __( 'URL', 'conference-wpl' ),
				'id'          => 'wpl_sponsor_url',
				'type'        => 'text',
				'desc'        => __( 'Add a sponsor URL, ex: http://wplook.com', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => __( 'Right Sidebar', 'conference-wpl' ),
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => __( 'Display or hide the sidebar on this page', 'conference-wpl' ),
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)
			
		)
	);
	ot_register_meta_box( $sponsor_meta_box );

	/*-----------------------------------------------------------
  		Tickets
  	-----------------------------------------------------------*/

	$tickets_meta_box = array(
		'id'          => 'tickets_meta_box',
		'title'       => __( 'Tickets Options', 'conference-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_tickets' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Price', 'conference-wpl' ),
				'id'          => 'wpl_ticket_price',
				'type'        => 'text',
				'desc'        => __( 'Ticket price', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => __( 'Ribbon Text', 'conference-wpl' ),
				'id'          => 'wpl_ribbon_text',
				'type'        => 'text',
				'desc'        => __( 'Ribbon Text', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => __( 'Ribbon Color', 'conference-wpl' ),
				'id'          => 'wpl_ribbon_color',
				'type'        => 'select',
				'desc'        => __( 'Choose the Ribon Color', 'conference-wpl' ),
				'choices'     => array(
					array(
						'label'       => __( 'Default', 'conference-wpl' ),
						'value'       => 'Default'
					),
					array(
						'label'       => __( 'Green', 'conference-wpl' ),
						'value'       => 'green'
					),
					array(
						'label'       => __( 'Orange', 'conference-wpl' ),
						'value'       => 'orange'
					),
					array(
						'label'       => __( 'Purple', 'conference-wpl' ),
						'value'       => 'purple'
					),
				),        
				'std'         => 'Default',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => __( 'Eventbrite URL', 'conference-wpl' ),
				'id'          => 'wpl_eventbride_url',
				'type'        => 'text',
				'desc'        => __( 'Sell Tickets on Eventbrite.com', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

		)
	);
	ot_register_meta_box( $tickets_meta_box );


	/*-----------------------------------------------------------
  		Testimonials
  	-----------------------------------------------------------*/

	$testimonials_meta_box = array(
		'id'          => 'testimonials_meta_box',
		'title'       => __( 'Testimonial Options', 'conference-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_testimonials' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Company', 'conference-wpl' ),
				'id'          => 'wpl_testimonial_company',
				'type'        => 'text',
				'desc'        => __( 'Company', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => __( 'Email', 'conference-wpl' ),
				'id'          => 'wpl_testimonial_email',
				'type'        => 'text',
				'desc'        => __( 'Email', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

		)
	);
	ot_register_meta_box( $testimonials_meta_box );


	/*-----------------------------------------------------------
  		Schedule
  	-----------------------------------------------------------*/

	$schedule_meta_box = array(
		'id'          => 'schedule_meta_box',
		'title'       => __( 'Schedule Options', 'conference-wpl' ),
		'desc'        => '',
		'pages'       => array( 'post_shedules' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => __( 'Daily thematic', 'conference-wpl' ),
				'id'          => 'wpl_schedule_day',
				'type'        => 'text',
				'desc'        => __( 'Add a title for daily agenda', 'conference-wpl' ),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => __( 'Sessions', 'conference-wpl' ),
				'id'          => 'wpl_speech',
				'type'        => 'list-item',
				'desc'        => __( 'Press the <strong>Add New</strong> button in order to add a new sessions for this day.', 'conference-wpl' ),
				'settings'    => array(
					array(
						'label'       => __( 'Speaker', 'conference-wpl' ),
						'id'          => 'wpl_agenda_speaker',
						'type'        => 'custom-post-type-checkbox',
						'desc'        => __( 'Select the Speaker for this session', 'conference-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => 'post_speaker',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'Tematics', 'conference-wpl' ),
						'id'          => 'wpl_speech_tematichs',
						'type'        => 'text',
						'desc'        => __( 'Add the thematic', 'conference-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'Short Description', 'conference-wpl' ),
						'id'          => 'wpl_speech_short_desc',
						'type'        => 'textarea-simple',
						'desc'        => __( 'Add a shord description', 'conference-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'Start time', 'conference-wpl' ),
						'id'          => 'wpl_speech_start_time',
						'type'        => 'text',
						'desc'        => __( 'Session start time', 'conference-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'End time', 'conference-wpl' ),
						'id'          => 'wpl_speech_end_time',
						'type'        => 'text',
						'desc'        => __( 'Session end time', 'conference-wpl' ),
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					array(
						'label'       => __( 'Display the session in the widget', 'conference-wpl' ),
						'id'          => 'wpl_session_widget',
						'type'        => 'on-off',
						'desc'        => __( 'Display or hide the session in the WPlook Schedule widget.', 'conference-wpl' ),
						'std'         => 'on',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => ''
					),
				),
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => 'toolbar'
			),


		)
	);
	ot_register_meta_box( $schedule_meta_box );	

}
