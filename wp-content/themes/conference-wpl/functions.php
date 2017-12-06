<?php
/**
 * Conference functions and definitions
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 645; /* pixels */

/*-----------------------------------------------------------------------------------*/
/*	Include Option Tree
/*-----------------------------------------------------------------------------------*/

	/*-----------------------------------------------------------
		Optional: set 'ot_show_pages' filter to false.
		This will hide the settings & documentation pages.
	-----------------------------------------------------------*/

	add_filter( 'ot_show_pages', '__return_true' );


	/*-----------------------------------------------------------
		Optional: set 'ot_show_new_layout' filter to false.
		This will hide the "New Layout" section on the Theme Options page.
	-----------------------------------------------------------*/

	add_filter( 'ot_show_new_layout', '__return_false' );


	/*-----------------------------------------------------------
		Required: set 'ot_theme_mode' filter to true.
	-----------------------------------------------------------*/

	add_filter( 'ot_theme_mode', '__return_true' );


	/*-----------------------------------------------------------
		Required: include OptionTree.
	-----------------------------------------------------------*/

	include_once( get_template_directory() . '/option-tree/ot-loader.php' );
	include_once( get_template_directory() . '/inc/theme-options.php' );
	include_once( get_template_directory() . '/inc/custom-post-type/meta-boxes.php' );


/*-----------------------------------------------------------------------------------*/
/*	Theme setup
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_setup' ) ) {

	function wplook_setup() {


		/*-----------------------------------------------------------
			Let WordPress manage the document title.
			we declare that this theme does not use a hard-coded <title> tag in the document head, and expect WordPress to provide it for us.
		-----------------------------------------------------------*/

		add_theme_support( 'title-tag' );

		/*-----------------------------------------------------------
			Make theme available for translation
		-----------------------------------------------------------*/

		load_theme_textdomain( 'conference-wpl', get_template_directory() . '/languages' );


		/*-----------------------------------------------------------
			Theme style for the visual editor
		-----------------------------------------------------------*/
		
		add_editor_style( 'css/editor-style.css' );

		/*-----------------------------------------------------------
			Add default posts and comments RSS feed links to head
		-----------------------------------------------------------*/
		
		add_theme_support( 'automatic-feed-links' );


		/*-----------------------------------------------------------
			Enable support for Post Thumbnails on posts and pages
		-----------------------------------------------------------*/
		
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'small-thumb', 270, 160, array( 'left', 'center' ) );
		add_image_size( 'blog-thumb', 1200, 700, array( 'left', 'center' ) );
		add_image_size( 'speaker-thumb', 220, 220, true );
		add_image_size( 'gallery-widget', 311, 207, true );
		add_image_size( 'avatar-small', 60, 60, true );
		
		/*-----------------------------------------------------------
			Register menu
		-----------------------------------------------------------*/
		
		function register_my_menus() {
			register_nav_menus(
				array(
					'primary' => __( 'Main Menu Homepage', 'conference-wpl' ),
					'secondary' => __( 'Main Menu', 'conference-wpl' ),
					'footernav' => __( 'Footer Menu', 'conference-wpl' ),
				) 
			);
		}

		add_action( 'init', 'register_my_menus' );
		wp_create_nav_menu( 'Main Menu Homepage', array( 'slug' => 'primary' ) );
		wp_create_nav_menu( 'Main Menu', array( 'slug' => 'secondary' ) );
		wp_create_nav_menu( 'Footer Menu', array( 'slug' => 'footernav' ) );
		
		/*-----------------------------------------------------------
			Enable support for Post Formats
		-----------------------------------------------------------*/
		
		//add_theme_support( 'post-formats', array( 'status' ) );


		/*-----------------------------------------------------------
			Add theme Support Custom Background
		-----------------------------------------------------------*/
		
		add_theme_support( 'custom-background' );


		/*-----------------------------------------------------------
			Add theme Support  Custom Header
		-----------------------------------------------------------*/
		
		add_theme_support( 'custom-header' );

	}
} // wplook_setup
add_action( 'after_setup_theme', 'wplook_setup' );


/*-----------------------------------------------------------------------------------*/
/*	Include Theme specific functionality
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_initiate_files' ) ) {

	function wpl_initiate_files() {

		// Plugin activation
		require_once( get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php' );
		require_once( get_template_directory() . '/inc/plugins/plugin-list.php' );

		// Initiate  widgets
		include_once( get_template_directory() . '/inc/widgets/widget-init.php' );

		// Include header data
		include_once( get_template_directory() . '/inc/headerdata.php' );

		// Include main functions
		include_once( get_template_directory() . '/inc/library.php' );

		// Include Google Maps
		include_once( get_template_directory() . '/inc/google-maps.php' );

		// Include Comments
		require_once (get_template_directory() . '/inc/' . 'comment.php');	

		// Initiate Custom post type Speakers
		if (ot_get_option('wpl_cpt_speakers') != 'off') {
			require_once get_template_directory() . '/inc/custom-post-type/speakers.php';
		}

		// Initiate Custom post type Staff
		if (ot_get_option('wpl_cpt_staff') != 'off') {
			require_once get_template_directory() . '/inc/custom-post-type/staff.php';
		}

		//Initiate Custom post type Sponsors
		if (ot_get_option('wpl_cpt_sponsors') != 'off') {
			require_once get_template_directory() . '/inc/custom-post-type/sponsors.php';
		}

		// Initiate Custom post type Schedule
		if (ot_get_option('wpl_cpt_shedules') != 'off') {
			require_once get_template_directory() . '/inc/custom-post-type/schedule.php';
		}

		// Initiate Custom post type Gallery
		if (ot_get_option('wpl_cpt_galleries') != 'off') {
			require_once get_template_directory() . '/inc/custom-post-type/gallery.php';
		}

		// Initiate Custom post type Testimonials
		if (ot_get_option('wpl_cpt_testimonials') != 'off') {
			require_once get_template_directory() . '/inc/custom-post-type/testimonials.php';
		}

		// Initiate Custom post type Tickets
		if (ot_get_option('wpl_cpt_tickets') != 'off') {
			require_once get_template_directory() . '/inc/custom-post-type/tickets.php';
		}

		// Initiate Custom post type Paymments
			require_once get_template_directory() . '/inc/custom-post-type/payments.php';

	}
	add_action( 'after_setup_theme', 'wpl_initiate_files' );
}


/*-----------------------------------------------------------------------------------*/
/*	Include the theme updater
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_load_updater' ) ) {

	function wplook_load_updater() {
		include_once ( get_template_directory() . '/inc/update.php' );
	}

	add_action( 'wp_loaded', 'wplook_load_updater' );

}


/*-----------------------------------------------------------------------------------*/
/*	Redirect After the theme is activated
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_redirect_after_theme_activation' ) ) {

	function wpl_redirect_after_theme_activation (){
		$redirectTo = admin_url().'themes.php?page=ot-theme-options';
		wp_redirect($redirectTo);
	}

	add_action("after_switch_theme", "wpl_redirect_after_theme_activation");

}


/*-----------------------------------------------------------------------------------*/
/*	Flush Rewrite after the theme is activated
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'my_rewrite_flush' ) ) {

	function my_rewrite_flush() {
		flush_rewrite_rules();
	}

	add_action( 'after_switch_theme', 'my_rewrite_flush' );

}


/*-----------------------------------------------------------------------------------*/
/*	Custom Background
/*-----------------------------------------------------------------------------------*/

$defaults = array(
	'default-color'          => 'ffffff',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );


/*-----------------------------------------------------------
	Custom Header
-----------------------------------------------------------*/

$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => '1920',
	'height'                 => '700',
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => 'ffffff',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'		=> 'wplook_header_style',
	'admin-head-callback'	=> 'wplook_admin_header_style',
	'admin-preview-callback'=> 'wplook_admin_header_image',
);
add_theme_support( 'custom-header', $defaults );


/*-----------------------------------------------------------*/
/*	Styles the header image and text displayed on the blog
/*-----------------------------------------------------------*/



if ( ! function_exists( 'wplook_header_style' ) ) {

	function wplook_header_style() {

		// If no custom options for text are set, let's bail
		// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
		if ( HEADER_TEXTCOLOR == get_header_textcolor() )
			return;
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			<?php // Has the text been hidden?
				if ( 'blank' == get_header_textcolor() ) { ?>
					#site-title{ position: absolute !important; clip: rect(1px 1px 1px 1px); /* IE6, IE7 */ clip: rect(1px, 1px, 1px, 1px); }
				<?php // If the user has set a custom color for the text use that
				} else { ?>
					#site-title a, #site-description { color: #<?php echo get_header_textcolor(); ?> !important; }
			<?php } ?>
		</style>
		<?php
	}
} // wplook_header_style

/*-----------------------------------------------------------*/
/*	Styles the header image displayed on the Appearance > Header admin panel.
/*	Referenced via add_custom_image_header() in wplook_setup().
/*-----------------------------------------------------------*/


if ( ! function_exists( 'wplook_admin_header_style' ) ) {
	
	function wplook_admin_header_style() { ?>
		<style type="text/css">
			
			#site-title a { font-size: 32px; line-height: 36px; text-decoration: none; }
			#site-description { font-size: 14px; line-height: 23px; padding: 0 0 3em; }

			<?php // If the user has set a custom color for the text use that
			if ( get_header_textcolor() != HEADER_TEXTCOLOR ) { ?>
				#site-title a, #site-description { color: #<?php echo get_header_textcolor(); ?>; }
			<?php } ?>
			#headimg img { max-width: 1000px; height: auto; width: 100%; }
		</style>
		<?php
	}

} // wplook_admin_header_style



/*-----------------------------------------------------------*/
/*	Custom header image markup displayed on the Appearance > Header admin panel.
/*	Referenced via add_custom_image_header() in wplook_setup().
/*-----------------------------------------------------------*/


if ( ! function_exists( 'wplook_admin_header_image' ) ) {
	
	function wplook_admin_header_image() { ?>
		<div id="headimg">
			<?php
			if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
				$style = ' style="display:none;"';
			else
				$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
			?>
			<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
			<?php endif; ?>
		</div>
	<?php 
	}

} // wplook_admin_header_image
