<?php
/*
 * Plugin Name: Gallery Home Page Widget
 * Plugin URI: http://www.wplook.com
 * Description: List galleries on the home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_gallery_home_widget");'));
class wplook_gallery_home_widget extends WP_Widget {

	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_gallery_home_widget',
			__( 'WPlook Gallery (Home page)', 'conference-wpl' ),
			array( 'description' => __( 'A widget for displaying latest galleries on the home page', 'conference-wpl' ), )
		);
	}

	
	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/
	
	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$title = __( 'Galleries', 'conference-wpl' );
		}

		if ( $instance ) {
			$categories = esc_attr( $instance[ 'categories' ] );
		}
		else {
			$categories = __( 'All', 'conference-wpl' );
		}

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '4', 'conference-wpl' );
		}

		if ( $instance ) {
			$read_more_link = esc_attr( $instance[ 'read_more_link' ] );
		}
		else {
			$read_more_link = __( '', 'conference-wpl' );
		}

		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('categories'); ?>">
					<?php _e('Category:', 'conference-wpl'); ?>
					<br />
				</label>
				
				<?php wp_dropdown_categories(
					array( 
						'name'	=> $this->get_field_name("categories"),
						'show_option_all'    => __('All', 'conference-wpl'),
						'show_count'	=> 1,
						'selected' => $categories,
						'taxonomy'  => 'wpl_gallery_category' 
					) 
				); ?>
				
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Posts:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of posts you want to display', 'conference-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all galleries:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
			</p>

			<br />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>gallery_home</strong>', 'conference-wpl'); ?></p>
			<br />

		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['categories'] = sanitize_text_field($new_instance['categories']);
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['read_more_link'] = sanitize_text_field($new_instance['read_more_link']);
		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		$read_more_link = isset( $instance['read_more_link'] ) ? esc_attr( $instance['read_more_link'] ) : '';

			if ( $categories < '1' ) {
				$args = array(
					'ignore_sticky_posts'=> 0,
					'post_type' => 'post_gallery',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
				);
			} else {
				$args = array(
					'ignore_sticky_posts'=> 0,
					'post_type' => 'post_gallery',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_gallery_category',
							'terms' => $categories
						)
					)
				);
			}

			$posts = null;
			$posts = new WP_Query( $args );
		?>

			<?php if( $posts->have_posts() ) : ?>
			
				<!-- Galleries -->
				<div class="speakers center-content widget_gallery_homepage widget-content" id="gallery_home">
					<div class="row">
						<div class="columns small-12 medium-12 large-12">
							<h2><?php echo $title; ?></h2>

							<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">

								<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

									<li id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
										<div class="avatar">
											<?php if ( has_post_thumbnail() ) {?> 
												<?php the_post_thumbnail('speaker-thumb'); ?>
											<?php } ?>

											<!-- Speaker media links -->
											<div class="social">
												
												<!-- Speacker profile -->
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
													<i class="fa fa-eye"></i>
												</a>

											</div>
										</div>

										<div class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
									</li>

								<?php endwhile; wp_reset_postdata(); ?>

							</ul>
						</div>
					</div>

					<?php if ( $read_more_link ) { ?>
						<div class="visit-our-blog center-content">
							<a href="<?php echo $read_more_link; ?>" class="btn-default" title="<?php _e('Visit our Blog', 'conference-wpl'); ?>"><?php _e('Visit our Blog', 'conference-wpl'); ?></a>
						</div>
					<?php } ?>

				</div>

			<?php endif; ?>
		<?php
	}
}
?>
