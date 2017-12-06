<?php
/**
 * Headerdata
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Include CSS
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'wpl_css_include' ) ) {

	function wpl_css_include () {

		/*-----------------------------------------------------------
			Load our main stylesheet
		-----------------------------------------------------------*/
		// Source: http://stackoverflow.com/a/11741586
		// IE <9 has a limit on CSS rules in a file, so we split the CSS
		// into two files using grunt-bless.
		// To still get the benefits of a single file elsewhere, we check
		// what browser is used and only load the fix on IE 6-9
		preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $browser_version);

		if( count($browser_version) < 2 ){
			preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $browser_version);
		}

		if ( count($browser_version) > 1 && $browser_version[1] >= 6 && $browser_version[1] <= 9 ){
			wp_enqueue_style( 'Conference-style-ie', get_template_directory_uri() . '/ie.css', array(), '2015-12-11', 'all' );
		} else {
			wp_enqueue_style( 'Conference-style', get_stylesheet_uri(), array(), '2015-12-11', 'all' );
		}

	}
	add_action( 'wp_enqueue_scripts', 'wpl_css_include' );
}

/*-----------------------------------------------------------------------------------*/
/*	Include Java Scripts
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_scripts_include' ) ) {
	
	function wpl_scripts_include() {
		
		/*-----------------------------------------------------------
			Include vendor scripts
		-----------------------------------------------------------*/
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'fastclick',  get_template_directory_uri() . '/assets/javascript/vendor/fastclick.js', array(), '', true );
		wp_enqueue_script( 'foundation',  get_template_directory_uri() . '/assets/javascript/vendor/foundation.min.js', array(), '', true );
		wp_enqueue_script( 'jquery.cookie',  get_template_directory_uri() . '/assets/javascript/vendor/jquery.cookie.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jquery.countdown',  get_template_directory_uri() . '/assets/javascript/vendor/jquery.countdown.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jquery.fitvids',  get_template_directory_uri() . '/assets/javascript/vendor/jquery.fitvids.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jquery.nav',  get_template_directory_uri() . '/assets/javascript/vendor/jquery.nav.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jquery.placeholder',  get_template_directory_uri() . '/assets/javascript/vendor/jquery.placeholder.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jquery.stellar',  get_template_directory_uri() . '/assets/javascript/vendor/jquery.stellar.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jquery.waypoints',  get_template_directory_uri() . '/assets/javascript/vendor/jquery.waypoints.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'modernizr',  get_template_directory_uri() . '/assets/javascript/vendor/modernizr.js', array(), '', true );
		wp_enqueue_script( 'owl.carousel',  get_template_directory_uri() . '/assets/javascript/vendor/owl.carousel.min.js', array( 'jquery' ), '', true );

		/*-----------------------------------------------------------
			This part loads a JavaScript file that enables old versions of Internet Explorer to recognize the new HTML5 element
		-----------------------------------------------------------*/
		
		global $is_IE;
		if ($is_IE) { 
			wp_enqueue_script( 'html5',  get_template_directory_uri() . '/assets/javascript/vendor/html5shiv.js', '', '', '' );
		}

		/*-----------------------------------------------------------
			Include google maps 
		-----------------------------------------------------------*/
		if ( is_page_template('template-homepage.php') ) {
			$maps_api_key = ot_get_option( 'wpl_maps_api_browser_key' );

			if( !empty( $maps_api_key ) ) {
				wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=' . $maps_api_key );
			} else {
				wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp' );
			}

			wp_enqueue_script( 'wplook-google-maps', get_template_directory_uri() . '/assets/javascript/vendor/google-maps.js', array( 'jquery', 'google-maps-api' ), false, true );
		}

		/*-----------------------------------------------------------
	    	Base custom scripts
	    -----------------------------------------------------------*/

		wp_enqueue_script( 'app', get_template_directory_uri() . '/assets/javascript/app.js', array( 'jquery' ), '', true );

	}
	add_action('wp_enqueue_scripts', 'wpl_scripts_include');
}


/*-----------------------------------------------------------------------------------*/
/*	Include admin CSS
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_css_include_admin' ) ) {

	function wpl_css_include_admin($hook) {
	
		if ( 'widgets.php' == $hook || 'customize.php' == $hook ) {

			/*-----------------------------------------------------------
				jQuery UI
			-----------------------------------------------------------*/
			
			wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/admin/jquery-ui.min.css' );

			/*-----------------------------------------------------------
				jQuery UI TimePicker
			-----------------------------------------------------------*/
			
			wp_enqueue_style( 'jquery-ui-timepicker-addon', get_template_directory_uri() . '/admin/jquery-ui-timepicker-addon.min.css', array( 'jquery-ui' ) );

		}

	}
	add_action( 'admin_enqueue_scripts', 'wpl_css_include_admin' );
}

/*-----------------------------------------------------------------------------------*/
/*	Include admin JavaScript
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_scripts_include_admin' ) ) {
	
	function wpl_scripts_include_admin() {

		/*-----------------------------------------------------------
			Include jQuery UI TimePicker
		-----------------------------------------------------------*/
		
		wp_enqueue_script( 'jquery-ui-timepicker-addon',  get_template_directory_uri() . '/admin/jquery-ui-timepicker-addon.min.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker' ), '', true );

	}
	add_action('admin_enqueue_scripts', 'wpl_scripts_include_admin');
}
