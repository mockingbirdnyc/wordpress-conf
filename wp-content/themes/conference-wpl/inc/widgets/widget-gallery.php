<?php
/*
 * Plugin Name: Recent galleries
 * Plugin URI: http://www.wplook.com
 * Description: Add Posts on pages
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_gallery_widget");'));
class wplook_gallery_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_gallery_widget',
			__( 'WPlook Gallery', 'conference-wpl' ),
			array( 'description' => __( 'A widget for displaying galleries', 'conference-wpl' ), )
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
			$title = __( 'Gallery', 'conference-wpl' );
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
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of galleries:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of galleries you want to display', 'conference-wpl'); ?></p>
			</p>

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
		?>
		
		<?php

			if ( $categories < '1' ) {
				$args = array(
					'post_type' => 'post_gallery',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
				);
			} else {
				$args = array(
					'post_type' => 'post_gallery',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_gallery_category',
							'field' => 'id',
							'terms' => $categories
						),
					),
				);
			}

			$gallery = null;
			$gallery = new WP_Query( $args );
		?>

			<?php if( $gallery->have_posts() ) : ?>
			
				<?php if ($title=="") $title = "Gallery"; ?>
					<?php echo $before_widget; ?>
					<?php if ( $title )
	
					echo $before_title . $title . $after_title; ?>
					<div class="gallery_slider">
							<div id="owl-gallery" class="owl-carousel owl-theme">
								<?php while( $gallery->have_posts() ) : $gallery->the_post(); ?>
									<!-- First Image -->
									<div class="item">
										<?php if ( has_post_thumbnail() ) {?> 
											<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('gallery-widget'); ?>
											</a>
										<?php } ?>
									</div>
								<?php endwhile; wp_reset_postdata(); ?>
							</div>

							<!-- Pagination -->
							<div class="customNavigation">
								<a class="btn prev-gallery"><i class="fa fa-angle-left"></i></a>
								<a class="btn next-gallery"><i class="fa fa-angle-right"></i></a>
							</div>
					</div>
				<?php echo $after_widget; ?>
				
			<?php endif; ?>
		<?php
	}
}
?>
