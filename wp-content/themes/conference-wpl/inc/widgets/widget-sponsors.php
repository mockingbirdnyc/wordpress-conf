<?php
/*
 * Plugin Name: Sponsors
 * Plugin URI: http://www.wplook.com
 * Description: Add sponsors to home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_sponsors_widget");'));
class wplook_sponsors_widget extends WP_Widget {

	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_sponsors_widget',
			__( 'WPlook Sponsors (Home page)', 'conference-wpl' ),
			array( 'description' => __( 'A widget for displaying Sponsors on Home Page', 'conference-wpl' ), )
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
			$title = __( 'Sponsors', 'conference-wpl' );
		}

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '4', 'conference-wpl' );
		}

		if ( $instance ) {
			$category = esc_attr( $instance[ 'category' ] );
		}
		else {
			$category = '';
		}

		if ( $instance ) {
			$display_type = esc_attr( $instance[ 'display_type' ] );
		}
		else {
			$display_type = __( 'random', 'conference-wpl' );
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
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Sponsors:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of Sponsors you want to display', 'conference-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'conference-wpl'); ?> <br /> </label>
				<?php wp_dropdown_categories( array(
					'show_option_all' => __( 'All categories', 'conference-wpl' ),
					'taxonomy' => 'wpl_sponsors_category',
					'id' => $this->get_field_id('category'),
					'name' => $this->get_field_name('category'),
					'selected' => $category,
					'show_count' => 1,
				) ); ?>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"><?php _e('Order by:', 'conference-wpl'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="random" <?php selected( 'random', $display_type ); ?>><?php _e('Random', 'conference-wpl'); ?></option>
					<option value="Latest" <?php selected( 'Latest', $display_type ); ?>><?php _e('Latest', 'conference-wpl'); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all Sponsors:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('View all speakers URL', 'conference-wpl'); ?></p>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>sponsors</strong>', 'conference-wpl'); ?></p>
			<br />
			
		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['category'] = sanitize_text_field($new_instance['category']);
		$instance['display_type'] = sanitize_text_field($new_instance['display_type']);
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
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$display_type = isset( $instance['display_type'] ) ? esc_attr( $instance['display_type'] ) : '';
		$read_more_link = isset( $instance['read_more_link'] ) ? esc_attr( $instance['read_more_link'] ) : '';
		?>
		
		<?php
			$args = array(
				'post_type' => 'post_sponsor',
				'post_status' => 'publish',
				'posts_per_page' => $nr_posts,
			);

			// Order
			if ( $display_type == 'random') {
				$new_args = array(
					'orderby' => 'rand',
				);

				$args = array_merge( $args, $new_args );
			} else {
				$new_args = array(
					'orderby' => 'date',
					'order' => 'DESC',
				);

				$args = array_merge( $args, $new_args );
			}

			// Category
			if ( !empty( $category ) ) {
				$new_args = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_sponsors_category',
							'terms' => $category,
						),
					),
				);

				$args = array_merge( $args, $new_args );
			}

			$sponsors = null;
			$sponsors = new WP_Query( $args );
		?>
		
			<?php if( $sponsors->have_posts() ) : ?>
				<!-- Sponsors -->
				<div class="partners widget-content" id="sponsors">
					<div class="row">
						<div class="columns small-12 medium-12 large-12">
							<div class="center-content">
								<h2><?php echo $title; ?></h2>
									<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
										<!-- First Speacker -->
									
										<?php while( $sponsors->have_posts() ) : $sponsors->the_post(); ?>
											<?php 
												$pid = $post->ID;
												$candidate_position = get_post_meta( $pid, 'wpl_candidate_position', true);
											?>
					
											<?php 
												$pid = $post->ID;
												$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
												$speaker_company = get_post_meta( $pid, 'wpl_speaker_company', true);
												$sponsor_url = get_post_meta( $pid, 'wpl_sponsor_url', true);
												$logo_image = get_post_meta($post->ID, 'wpl_logo_image', true);
											?>
											<!-- Speackers -->
											<li id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
													<img src="<?php echo $logo_image; ?>" width="200" height="85" alt="<?php the_title(); ?>">
												</a>
											</li>

										<?php endwhile; wp_reset_postdata(); ?>
									</ul>

									<?php if ($read_more_link) { ?>
										<!-- View all Sponsors Button -->
										<div class="view-all-partners">
											<a href="<?php echo $read_more_link; ?>" title="<?php _e('View all Sponsors', 'conference-wpl'); ?>" class="btn-default"><?php _e('View all Sponsors', 'conference-wpl'); ?></a>
										</div>
									<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php
	}
}
?>
