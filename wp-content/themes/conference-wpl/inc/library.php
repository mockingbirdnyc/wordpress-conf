<?php
/**
 * Custom Functions
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*  Get Custom attacement ID
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'custom_get_attachment_id' ) ) {
	
	function custom_get_attachment_id( $guid ) {
		global $wpdb;

		/* nothing to find return false */
		if ( ! $guid )
		return false;

		/* get the ID */
		$id = $wpdb->get_var( $wpdb->prepare(
		"
		SELECT  p.ID
		FROM    $wpdb->posts p
		WHERE   p.guid = %s
				AND p.post_type = %s
		",
		$guid,
		'attachment'
		) );

		/* the ID was not found, try getting it the expensive WordPress way */
		if ( $id == 0 )
		$id = url_to_postid( $guid );

		return $id;
	}

}


/*-----------------------------------------------------------------------------------*/
/*  Add a container for video
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_custom_oembed_filter' ) ) {

	add_filter( 'embed_oembed_html', 'wpl_custom_oembed_filter', 10, 4 ) ;

	function wpl_custom_oembed_filter($html, $url, $attr, $post_ID) {
		$return = '<div class="video-container">'.$html.'</div>';
	    return $return;
	}
}



/*-----------------------------------------------------------------------------------*/
/*  Change the Read more structure
/*-----------------------------------------------------------------------------------*/

add_filter( 'the_content_more_link', 'wpl_more_link' );
	function wpl_more_link() {
	return '<div class="view-full-page"><a class="btn-default" href="' . get_permalink() . '"> ' . __("Read More","conference-wpl") . ' </a></div>';
}


/*-----------------------------------------------------------
	Get taxonomies terms links
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_custom_taxonomies_terms_links' ) ) {

	function wplook_custom_taxonomies_terms_links() {
		global $post, $post_id;
		// get post by post id
		$post = get_post($post->ID);
		// get post type by post
		$post_type = $post->post_type;
		// get post type taxonomies
		$taxonomies = get_object_taxonomies($post_type);
		foreach ($taxonomies as $taxonomy) {
			// get the terms related to post
			$terms = get_the_terms( $post->ID, $taxonomy );
			if ( !empty( $terms ) ) {
				$out = array();
				foreach ( $terms as $term )
					$out[] = $term->name;
				$return = join( ', ', $out );
			} else {
				$return = '';
			}
			return $return;
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/*  Display share buttons on posts
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_share_buttons' ) ) {
	
	function wplook_get_share_buttons() { ?>
		<a title="<?php _e('Facebook', 'conference-wpl'); ?>" class="facebook" id="fbbutton" onclick="fbwindows('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>'); return false;"><?php _e('Facebook', 'conference-wpl'); ?></a> 
		<a title="<?php _e('Twitter', 'conference-wpl'); ?>" class="twitter" id="twbutton" onClick="twwindows('http://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>'); return false;"><?php _e('Twitter', 'conference-wpl'); ?></a>
		<a title="<?php _e('Pinterest', 'conference-wpl'); ?>" class="pinterest" id="pinbutton" onClick="pinwindows('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=');"><?php _e('Pinterest', 'conference-wpl'); ?></a>
	<?php }

}


/*-----------------------------------------------------------
	Custom Tag cloud Widget
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_tag_cloud_widget' ) ) {

	function wplook_tag_cloud_widget($args) {
		$args['largest'] = 14;
		$args['smallest'] = 14;
		$args['unit'] = 'px';
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'wplook_tag_cloud_widget' );

}


/*-----------------------------------------------------------
	Get Date
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_date' ) ) {

	function wplook_get_date() {
		the_time(get_option('date_format'));
	}

}


/*-----------------------------------------------------------
	Get Time
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_time' ) ) {

	function wplook_get_time() {
		the_time(get_option('time_format'));
	}

}


/*-----------------------------------------------------------
	Get Date and Time
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_date_time' ) ) {

	function wplook_get_date_time() {
		the_time(get_option('date_format')); 
		_e( ' at ', 'conference-wpl');
		the_time(get_option('time_format'));
	}

}


/*-----------------------------------------------------------------------------------*/
/*	Trim excerpt
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_short_excerpt' ) ) {

	function wplook_short_excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		}	
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}

}


/*-----------------------------------------------------------
	Display Navigation for post, pages, search
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_content_navigation' ) ) {

	function wplook_content_navigation( $nav_id ) {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo $nav_id; ?>">
				<?php if ( get_previous_posts_link() ) { ?>
					<div class="nav-previous"><?php previous_posts_link( __( '<span class="mobile-nav">Previous</span>', 'conference-wpl' ) ); ?></div>
				<?php } ?>
					
				<?php if ( get_next_posts_link() ) { ?>
					<div class="nav-next"><?php next_posts_link( __( '<span class="mobile-nav">Next</span>', 'conference-wpl' ) ); ?></div>
				<?php } ?>
					<div class="clear"></div>
			</nav><!-- #nav -->
		<?php endif;
	}

}


/*-----------------------------------------------------------
	Format money
-----------------------------------------------------------*/

if ( ! function_exists( 'formatMoney' ) ) {
	// echo formatMoney(1050); # 1,050 
	// echo formatMoney(1321435.4, true); # 1,321,435.40 
	function formatMoney($number, $fractional=false) { 
		if ($fractional) { 
			$number = sprintf('%.2f', $number); 
		}
		while (true) {
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
			if ($replaced != $number) { 
				$number = $replaced; 
			} else {
				break; 
			}
		}
		return $number; 
	}

}

/*-----------------------------------------------------------
	Breadcrumbs
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_breadcrumbs' ) ) {

	function wplook_breadcrumbs() {
		$showOnHome 	= '0'; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter 	= ''; // delimiter between crumbs
		
		$showCurrent 	= '1'; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$before 		= '<li class="current">'; // tag before the current crumb
		$after 		= '</li>'; // tag after the current crumb
		
		$text['home'] = __('Home','conference-wpl'); // text for the 'Home' link
		$text['category'] = __('Archive for %s','conference-wpl'); // text for a category page
		$text['search'] = __('Search results for: %s','conference-wpl'); // text for a search results page
		$text['tag'] = __('Posts tagged %s','conference-wpl'); // text for a tag page
		$text['author'] = __('Posts by %s','conference-wpl'); // text for an author page
		$text['404'] = __('Error 404','conference-wpl'); // text for the 404 page
		
		global $post;
		$homeLink = home_url( '/' );

		echo '<li><a href="' . $homeLink . '">' . $text['home'] . '</a></li>' . $delimiter . ' ';

		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif( is_singular( 'post_speaker' ) ) {
			$page = ot_get_option( 'wpl_speaker_page' );

			if( !empty( $page ) ) {
				echo '<a href="' . esc_url( get_page_link( $page ) ) . '">' . __( 'Speaker', 'conference-wpl' ) . '</a> ' . $delimiter . ' ';
			} else {
				echo '<span>' . __( 'Speaker', 'conference-wpl' ) . '</span> ' . $delimiter . ' ';
			}

			if ($showCurrent == 1) echo $before . get_the_title() . $after;
		} elseif( is_singular( 'post_staff' ) ) {
			$page = ot_get_option( 'wpl_staff_page' );

			if( !empty( $page ) ) {
				echo '<a href="' . esc_url( get_page_link( $page ) ) . '">' . __( 'Staff', 'conference-wpl' ) . '</a> ' . $delimiter . ' ';
			} else {
				echo '<span>' . __( 'Staff', 'conference-wpl' ) . '</span> ' . $delimiter . ' ';
			}
			
			if ($showCurrent == 1) echo $before . get_the_title() . $after;
		} elseif( is_singular( 'post_sponsor' ) ) {
			$page = ot_get_option( 'wpl_sponsors_page' );

			if( !empty( $page ) ) {
				echo '<a href="' . esc_url( get_page_link( $page ) ) . '">' . __( 'Sponsor', 'conference-wpl' ) . '</a> ' . $delimiter . ' ';
			} else {
				echo '<span>' . __( 'Sponsor', 'conference-wpl' ) . '</span> ' . $delimiter . ' ';
			}
			
			if ($showCurrent == 1) echo $before . get_the_title() . $after;
		} elseif( is_singular( 'post_gallery' ) ) {
			$page = ot_get_option( 'wpl_galleries_page' );

			if( !empty( $page ) ) {
				echo '<a href="' . esc_url( get_page_link( $page ) ) . '">' . __( 'Gallery', 'conference-wpl' ) . '</a> ' . $delimiter . ' ';
			} else {
				echo '<span>' . __( 'Gallery', 'conference-wpl' ) . '</span> ' . $delimiter . ' ';
			}
			
			if ($showCurrent == 1) echo $before . get_the_title() . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				//$slug = $post_type->rewrite;
				//echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				echo '<span>' . $post_type->labels->singular_name .'</span>' ;
				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				if ($showCurrent == 0) $cats = preg_replace("/^(.+)\s$delimiter\s$/", "$1", $cats);
				echo $cats;
					if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			//$cat = get_the_category($parent->ID); $cat = $cat[0];
			//echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
			}
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo ' ' . $delimiter . ' '; echo __('Page', 'conference-wpl') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

	} // end breadcrumbs()
}


/*-----------------------------------------------------------------------------------*/
/*	Page Title for WordPress < 4.1
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
		?>
		<title><?php wp_title( '|', false, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}


/*-----------------------------------------------------------------------------------*/
/*	Doctitle
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_doctitle' ) ) {
	function wplook_doctitle() {

		if ( is_search() ) { 
		  $content = __('Search Results for:', 'conference-wpl'); 
		  $content .= ' ' . esc_html(stripslashes(get_search_query()));
		}

		elseif ( is_category() ) {
			$content = __('', 'conference-wpl');
			$content .= ' ' . single_cat_title("", false);
		}

		elseif ( is_day() ) {
			$content = __( 'Daily Archives:', 'conference-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date()));
		}
		
		elseif ( is_month() ) {
			$content = __( 'Monthly Archives:', 'conference-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date( 'F Y' )));
		}
		elseif ( is_year()  ) {
			$content = __( 'Yearly Archives:', 'conference-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date( 'Y' ) ));
		}

		elseif ( is_tag() ) { 
			$content = __('', 'conference-wpl');
			$content .= ' ' . single_tag_title( '', false );
		}
		
		elseif ( is_author() ) { 
			$content = __("Author's Posts", 'conference-wpl');

		}

		elseif ( is_404() ) { 
			$content = __('Page Not Found', 'conference-wpl');
		}

		
		else { 
			$content = '';
		}
		
		$elements = array("content" => $content);   

		// Filters should return an array
		$elements = apply_filters('wplook_doctitle', $elements);
		
		// But if they don't, it won't try to implode
			if(is_array($elements)) {
			  $doctitle = implode(' ', $elements);
			} else {
			  $doctitle = $elements;
			}

			if ( is_search() || is_day() || is_month() || is_year() || is_404() || is_author() ) {
				$doctitle = $doctitle;
			}

		echo $doctitle;

	} 
}


/*-----------------------------------------------------------
	Add custom Colors to the theme
-----------------------------------------------------------*/

add_action( 'customize_register', 'hg_customize_register' );
function hg_customize_register($wp_customize) {
	
	$colors = array();
	$colors[] = array( 'slug'=>'wpl_link_color', 'default' => '#f74819', 'label' => __( 'Link color', 'conference-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_hover_link_color', 'default' => '#f74819', 'label' => __( 'Hover link color', 'conference-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_accent_color', 'default' => '#f74819', 'label' => __( 'Accent color', 'conference-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_footer_color', 'default' => '#000000', 'label' => __( 'Footer Color', 'conference-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_parllax_color', 'default' => '#000000', 'label' => __( 'Parallax Color', 'conference-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );


	foreach($colors as $color) {

		add_option( $color['slug'], $color['default'] );

		// SETTINGS
		$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_hex_color' ));

		// CONTROLS
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Print Custom Color Styles
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_print_custom_color_style' ) ) {

	function wplook_print_custom_color_style() { ?>
		<?php
			$link_color = get_option('wpl_link_color');
			$hover_link_color = get_option('wpl_hover_link_color');
			$accent_color = get_option('wpl_accent_color');
			$footer_color = get_option('wpl_footer_color');
			$parllax_color = get_option('wpl_parllax_color');
			$header_color = ot_get_option('wpl_teaser_color');
			$header_opacity = ot_get_option('wpl_teaser_opacity');

		?>
		<style>
			a, a:visited, .schedule ul li .content .event-title { color: <?php echo $link_color; ?>;}

			a:focus, a:active, a:hover, 
			.main_menu ul.menu li:hover > a,
			.entry-meta span a:hover, 
			h1.entry-title a:hover, 
			.main_menu .menu .current_page_ancestor > a,
			.main_menu .menu .current-menu-item > a,
			.inline-list.right .current-menu-item > a{ color: <?php echo $hover_link_color; ?>; }
			
			.btn-default, .btn-default:focus, 
			.btn-default, .btn-default:active,
			.wpcf7-submit, .wpcf7-submit:focus, .wpcf7-submit:active,
			.main_menu ul.menu li.register a,
			.main_menu div.menu > ul li.register a,
			.WPlookAnounce,
			.tagcloud a { background: <?php echo $accent_color; ?>; }

			.banner .event-info ul li i.fa {color: <?php echo $accent_color; ?>; }

			.clock .time-unit { border-color: <?php echo $accent_color; ?>; }

			.btn-default:hover, .wpcf7-submit:hover,
			.main_menu ul.menu li.register a:hover,
			.main_menu div.menu > ul li.register a:hover { background: <?php echo $hover_link_color; ?>; }

			.footer { background: <?php echo $footer_color; ?>}
			.buytickets { background: <?php echo $parllax_color; ?>}
			.banner, .mini_header { background-color: <?php echo hex2rgba($header_color, $header_opacity); ?> }

			.banner h1 { color: <?php echo ot_get_option('wpl_teaser_title_color'); ?> }

			.banner h2 { color: <?php echo ot_get_option('wpl_teaser_description_color'); ?> }
			
		</style>
	<?php }
	
	if (get_option('wpl_link_color')) {
		add_action( 'wp_head', 'wplook_print_custom_color_style' );
	}
}

/*-----------------------------------------------------------------------------------*/
/*  Convert hexdec color string to rgb(a) string
/*-----------------------------------------------------------------------------------*/

function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	if(empty($color))
		 return $default; 

		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
				return $default;
		}

		//Convert hexadec to rgb
		$rgb =  array_map('hexdec', $hex);

		//Check if opacity is set(rgba or rgb)
		if($opacity){
			if(abs($opacity) > 1)
				$opacity = 1.0;
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		} else {
			$output = 'rgb('.implode(",",$rgb).')';
		}

		//Return rgb(a) color string
		return $output;
}


/*-----------------------------------------------------------------------------------*/
/*	Custom CSS
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_custom_css' ) ) {

	function wpl_custom_css() {
		$wpl_css = ot_get_option('wpl_css');
		echo "<style>";
		echo $wpl_css;
		echo "</style>";
	}
	add_action( 'wp_head', 'wpl_custom_css' );

}


/*-----------------------------------------------------------------------------------*/
/*	BE Dashbord Widget
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_dashboard_widgets' ) ) {

	function wplook_dashboard_widgets() {
		global $wp_meta_boxes;
		unset(
			$wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
		);
			wp_add_dashboard_widget( 'dashboard_custom_feed', '<a href="https://wplook.com?utm_source=Our-Themes&utm_medium=rss&utm_campaign=Conference">WPlook News</a>' , 'dashboard_custom_feed_output' );
	}
	add_action('wp_dashboard_setup', 'wplook_dashboard_widgets');
}


if ( ! function_exists( 'dashboard_custom_feed_output' ) ) {

	function dashboard_custom_feed_output() {
		echo '<div class="rss-widget rss-wplook">';
		wp_widget_rss_output(array(
			'url' => 'http://feeds.feedburner.com/wplook',
			'title' => '',
			'items' => 5,
			'show_summary' => 1,
			'show_author' => 0,
			'show_date' => 1
			));
		echo '</div>';
	}
}

if ( ! function_exists( 'wplook_bar_menu' ) ):

	function wplook_bar_menu() {
		global $wp_admin_bar;
		if ( !is_super_admin() || !is_admin_bar_showing() )
			return;
		$admin_dir = get_admin_url();

		$wp_admin_bar->add_menu( 
			array(
				'id' => 'custom_menu',
				'title' => __( 'WPlook Panel', 'conference-wpl' ),
				'href' => FALSE,
				'meta' => array('title' => 'WPlook Options Panel', 'class' => 'wplookpanel') 
			) 
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_to',
				'parent' => 'custom_menu',
				'title' => __( 'Theme Options', 'conference-wpl' ),
				'href' => $admin_dir .'themes.php?page=ot-theme-options',
				'meta' => array('title' => 'Theme Option') 
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_sp',
				'parent' => 'custom_menu',
				'title' => __( 'Support', 'conference-wpl' ),
				'href' => 'https://wplook.com/help/?utm_source=Support&utm_medium=link&utm_campaign=Conference',
				'meta' => array('title' => 'Support') 
			)
		);


		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_wt',
				'parent' => 'custom_menu',
				'title' => __( 'Our Themes', 'conference-wpl' ),
				'href' => 'https://wplook.com/wordpress/themes/?utm_source=Our-Themes&utm_medium=link&utm_campaign=Conference',
				'meta' => array('title' => 'Our Themes')
				)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_fb',
				'parent' => 'custom_menu',
				'title' => __( 'Become our fan on Facebook', 'conference-wpl' ),
				'href' => 'http://www.facebook.com/wplookthemes',
				'meta' => array('target' => 'blank', 'title' => 'Become our fan on Facebook') 
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_tw',
				'parent' => 'custom_menu',
				'title' => __( 'Follow us on Twitter', 'conference-wpl' ),
				'href' => 'http://twitter.com/#!/wplook',
				'meta' => array('target' => 'blank', 'title' => 'Follow us on Twitter')
			)
		);
	}
	add_action('admin_bar_menu', 'wplook_bar_menu', '1000');
endif;


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Payments
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_pledge_columns' ) ) {

	function add_new_pledge_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Tranzaction ID', 'conference-wpl' ),
			'wpl_pledge_ticket' => __( 'Ticket', 'conference-wpl' ),
			'wpl_pledge_first_name' => __( 'First Name', 'conference-wpl' ),
			'wpl_pledge_last_name' => __( 'Last Name', 'conference-wpl' ),
			'wpl_pledge_donation_amount' => __( 'Donation amount', 'conference-wpl' ),
			'wpl_pledge_payment_source' => __( 'Payment Source', 'conference-wpl' ),
			'wpl_pledge_payment_Status' => __( 'Payment Status', 'conference-wpl' ),
			'date' => __( 'Date', 'conference-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_pledges_columns", "add_new_pledge_columns");
	// Add to admin_init function

}

 if ( ! function_exists( 'wpl_pledge_columns' ) ) {

	function wpl_pledge_columns( $column, $post_id ) {
		
		switch ($column) {

			
			/*-----------------------------------------------------------
				Case: First Name
			-----------------------------------------------------------*/
			case 'wpl_pledge_ticket' :

			$wpl_pledge_ticket = get_post_meta( $post_id, 'wpl_pledge_ticket', true );

			if ( empty( $wpl_pledge_ticket ) )
				echo __( 'Unknown', 'conference-wpl' );

			else
				echo get_the_title( $wpl_pledge_ticket );
			break;


			/*-----------------------------------------------------------
				Case: First Name
			-----------------------------------------------------------*/
			case 'wpl_pledge_first_name' :

			$wpl_pledge_first_name = get_post_meta( $post_id, 'wpl_pledge_first_name', true );

			if ( empty( $wpl_pledge_first_name ) )
				echo __( 'Unknown', 'conference-wpl' );

			else
				printf( __( '%s', 'conference-wpl' ), $wpl_pledge_first_name );

			break;

			/*-----------------------------------------------------------
				Case: Last Name
			-----------------------------------------------------------*/
			case 'wpl_pledge_last_name' :

			$wpl_pledge_last_name = get_post_meta( $post_id, 'wpl_pledge_last_name', true );

			if ( empty( $wpl_pledge_last_name ) )
				echo __( 'Unknown', 'conference-wpl' );

			else
				printf( __( '%s', 'conference-wpl' ), $wpl_pledge_last_name );

			break;
			

			/*-----------------------------------------------------------
				Case: Donation amount
			-----------------------------------------------------------*/
			case 'wpl_pledge_donation_amount' :

			$wpl_pledge_donation_amount = get_post_meta( $post_id, 'wpl_pledge_donation_amount', true );

			if ( empty( $wpl_pledge_donation_amount ) )
				echo __( 'Unknown', 'conference-wpl' );

			else
				printf( __( '%s', 'conference-wpl' ), $wpl_pledge_donation_amount );

			break;


			/*-----------------------------------------------------------
				Case: Payment Source
			-----------------------------------------------------------*/
			case 'wpl_pledge_payment_source' :

			$wpl_pledge_payment_source = get_post_meta( $post_id, 'wpl_pledge_payment_source', true );

			if ( empty( $wpl_pledge_payment_source ) )
				echo __( 'Unknown', 'conference-wpl' );

			else
				printf( __( '%s', 'conference-wpl' ), $wpl_pledge_payment_source );

			break;


			/*-----------------------------------------------------------
				Case: Payment Status
			-----------------------------------------------------------*/
			case 'wpl_pledge_payment_Status' :

			$wpl_pledge_payment_Status = get_post_meta( $post_id, 'wpl_pledge_payment_Status', true );

			if ( empty( $wpl_pledge_payment_Status ) )
				echo __( 'Unknown', 'conference-wpl' );

			else
				printf( __( '%s', 'conference-wpl' ), $wpl_pledge_payment_Status );

			break;
				
		} // end switch
	}
	add_action('manage_post_pledges_posts_custom_column', 'wpl_pledge_columns', 10, 2);

}


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Staff
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_staff_columns' ) ) {

	function add_new_staff_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Name', 'conference-wpl' ),
			'wpl_candidate_position' => __( 'Position', 'conference-wpl' ),
			'date' => __( 'Date', 'conference-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_staff_columns", "add_new_staff_columns");

}
 

if ( ! function_exists( 'wpl_staff_columns' ) ) {

	function wpl_staff_columns( $column, $post_id ) {
		
		switch ($column) {
			

			/*-----------------------------------------------------------
				Staff: Position
			-----------------------------------------------------------*/
			case 'wpl_candidate_position' :

			$wpl_candidate_position = get_post_meta( $post_id, 'wpl_candidate_position', true );

			if ( empty( $wpl_candidate_position ) )
				echo __( 'Unknown', 'conference-wpl' );

			else
				printf( __( '%s', 'conference-wpl' ), $wpl_candidate_position );

			break;
		
		} // end switch
	}
	add_action('manage_post_staff_posts_custom_column', 'wpl_staff_columns', 10, 2);

}



/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Speakers
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_speaker_columns' ) ) {

	function add_new_speaker_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Title', 'conference-wpl' ),
			'wpl_speaker_company' => __( 'Company', 'conference-wpl' ),
			'date' => __( 'Date', 'conference-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_speaker_columns", "add_new_speaker_columns");

}


if ( ! function_exists( 'wpl_speaker_columns' ) ) {

	function wpl_speaker_columns( $column, $post_id ) {
		
		switch ($column) {
			
			/*-----------------------------------------------------------
				Speakers: Company
			-----------------------------------------------------------*/
			case 'wpl_speaker_company' :

			$wpl_speaker_company = get_post_meta( $post_id, 'wpl_speaker_company', true );

			if ( empty( $wpl_speaker_company ) )
				echo __( 'Unknown', 'conference-wpl' );

			else
				printf( __( '%s', 'conference-wpl' ), $wpl_speaker_company );

			break;
		
		} // end switch
	}
	add_action('manage_post_speaker_posts_custom_column', 'wpl_speaker_columns', 10, 2);

}
?>
