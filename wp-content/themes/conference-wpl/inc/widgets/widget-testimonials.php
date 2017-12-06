<?php
/*
 * Plugin Name: Testimonials
 * Plugin URI: http://www.wplook.com
 * Description: Display the lates testimonials
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_testimonials_widget");'));
class wplook_testimonials_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_testimonials_widget',
			__( 'WPlook Testimonials (Home Page)', 'conference-wpl' ),
			array( 'description' => __( 'A widget for displaying Testimonials.', 'conference-wpl' ), )
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
			$title = __( 'Testimonials', 'conference-wpl' );
		}

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '3', 'conference-wpl' );
		}

		if ( $instance ) {
			$display_type = esc_attr( $instance[ 'display_type' ] );
		}
		else {
			$display_type = __( 'random', 'conference-wpl' );
		}


		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of testimonials:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The number of testimonials you want to display.', 'conference-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"><?php _e('Order:', 'conference-wpl'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="rand" <?php selected( 'rand', $display_type ); ?>><?php _e('Random', 'conference-wpl'); ?></option>
					<option value="date" <?php selected( 'date', $display_type ); ?>><?php _e('Latest', 'conference-wpl'); ?></option>
				</select>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>testimonials</strong>', 'conference-wpl'); ?></p>
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
		$instance['display_type'] = sanitize_text_field($new_instance['display_type']);
		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$nr_posts = apply_filters( 'widget_nr_posts', $instance['nr_posts'] );
		$display_type = apply_filters( 'widget', $instance['display_type'] );

		

		?>
		

		<!-- Testimonials -->
		<div class="testimonials widget-content" id="testimonials">
			<div class="row">
				<div class="columns small-12 medium-12 large-12">
					<div class="center-content">

						<h2><?php echo $title; ?></h2>
						<div id="owl-testimonials" class="owl-carousel owl-theme">
							<?php $args = array( 'post_type' => 'post_testimonials','post_status' => 'publish', 'posts_per_page' => $nr_posts, 'orderby' => $display_type); ?>
							<?php $wp_query = null; ?>
							<?php $wp_query = new WP_Query( $args ); ?>
							<?php if ( $wp_query->have_posts() ) : ?>
								<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
									<?php 
										$event_date = get_post_meta(get_the_ID(), 'wpl_event_date', true); 
										$testimonial_email = get_post_meta($post->ID, 'wpl_testimonial_email', true );
										$testimonial_company = get_post_meta($post->ID, 'wpl_testimonial_company', true );
									?>
									
									<!-- Forth Testimonial -->
								<div class="item">
									<div class="testimonial_item">
										<div class="description">
											<?php the_content(); ?>
										</div>
										<div class="customers">
											<?php 
												if ($testimonial_email != '') {
													echo get_avatar( $testimonial_email, $size = '60');
												} elseif ( has_post_thumbnail() ) {
													the_post_thumbnail('avatar-small', array( 'class' => 'avatar' ));
												}
											?>
											<div class="customers_info">
												<div class="name"><?php the_title(); ?></div>
												
												<!-- Company name -->
												<?php if ($testimonial_company) { ?>
													<div class="location"><?php echo $testimonial_company ?></div>
												<?php } ?>
													
											</div>
										</div>
									</div>
								</div>

								<?php endwhile; wp_reset_postdata(); ?>
							
							<?php else : ?>

								<li class="single-post">
									<div class="entry-content">
										<?php _e('Sorry, no testimonials matched your criteria.', 'conference-wpl'); ?>
									</div>
									<div class="clear"></div>
								</li>

							<?php endif; ?>
						</div>
						<!-- Pagination -->
						<div class="customNavigation">
							<a class="btn prev"><i class="fa fa-angle-left"></i></a>
							<a class="btn next"><i class="fa fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php }
}
?>
