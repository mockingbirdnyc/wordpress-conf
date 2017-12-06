<?php
/*
 * Plugin Name: Daily Schedule
 * Plugin URI: http://www.wplook.com
 * Description: Add Posts on pages
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_schedule_widget");'));
class wplook_schedule_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_schedule_widget',
			__( 'WPlook Schedule (Home Page)', 'conference-wpl' ),
			array( 'description' => __( 'A widget for displaying Schedules on home page', 'conference-wpl' ), )
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
			$title = __( 'Schedule', 'conference-wpl' );
		}


		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '3', 'conference-wpl' );
		}

		if ( $instance ) {
			$nr_columns = esc_attr( $instance[ 'nr_columns' ] );
		}
		else {
			$nr_columns = __( '3', 'conference-wpl' );
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
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Schedules:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_columns'); ?>"> <?php _e('Number of Columns:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_columns'); ?>" name="<?php echo $this->get_field_name('nr_columns'); ?>" type="text" value="<?php echo $nr_columns; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The Number of Columns you want to display', 'conference-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('View all URL:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('View all URL', 'conference-wpl'); ?></p>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>schedule</strong>', 'conference-wpl'); ?></p>
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
		$instance['nr_columns'] = sanitize_text_field($new_instance['nr_columns']);
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
		$nr_columns = isset( $instance['nr_columns'] ) ? esc_attr( $instance['nr_columns'] ) : '';
		$read_more_link = isset( $instance['read_more_link'] ) ? esc_attr( $instance['read_more_link'] ) : '';
			
			$args = array(
					'ignore_sticky_posts'=> 1,
					'post_type' => 'post_shedules',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					
				);

			$schedule = null;
			$schedule = new WP_Query( $args );
		?>

			<?php if( $schedule->have_posts() ) : ?>
		<!-- Agenda -->
		<div class="schedule widget-content" id="schedule">
			<div class="row">
				<div class="columns small-12 medium-12 large-12">
					<div class="center-content">
						<h2><?php echo $title; ?></h2>
					</div>
						<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-<?php echo $nr_columns; ?>">
							<?php while( $schedule->have_posts() ) : $schedule->the_post(); ?>
								<?php
									$pid = $post->ID;
									$schedule_day = get_post_meta( $pid, 'wpl_schedule_day', true);
									$wpl_speech = get_post_meta($post->ID, 'wpl_speech', true);
								?>
								<li>
									<div class="schedule-body">
										<div class="event-header">
											<div class="day">
												<?php the_title(); ?>
											</div>

											<?php if ($schedule_day) { ?>
												<div class="title">
													<?php echo $schedule_day; ?>
												</div>
											<?php } ?>
										</div>
										<div class="content">
											<dl class="accordion" data-accordion>
												<?php if ( ! empty( $wpl_speech ) ) {
													foreach( $wpl_speech as $item ) { ?>
														<?php if (isset($item["wpl_session_widget"]) AND $item['wpl_session_widget'] !='off' ) { ?>
															<dt></dt>
															<dd class="accordion-navigation">
																<?php
																	// Add unique pane ID
																	$str = 'abcdefgh';
																	$pane_id = str_shuffle($str);
																?>
																<a href="#<?php echo $pane_id; ?>">
																<?php
																	if (isset($item["wpl_agenda_speaker"])) {
																		foreach( $item["wpl_agenda_speaker"] as $wpl_agenda_speaker ) {
																			echo get_the_post_thumbnail( $wpl_agenda_speaker,'avatar-small',array('class' => 'large-2 right',));
																		}
																	}
																 ?>
																	<?php if ( $item['wpl_speech_start_time'] != "") { ?>
																		<div class="event-time large-8"><i class="fa fa-clock-o"></i><?php echo $item['wpl_speech_start_time']; ?> <?php if ($item['wpl_speech_end_time'] != '') { echo "- "; echo $item['wpl_speech_end_time']; } ?></div>
																	<?php } ?>
																	<div class="event-title large-8"><?php echo $item['wpl_speech_tematichs']; ?></div>
																	<div class="clear"></div>
																</a>

																<?php if ( $item['wpl_speech_short_desc'] ) { ?>
																	<div id="<?php echo $pane_id; ?>" class="content">
																		<?php echo $item['wpl_speech_short_desc']; ?>
																	</div>

																<?php } ?>
															</dd>

														<?php }
													}
												} ?>
											</dl>
										</div>
									</div>
								</li>
							<?php endwhile; wp_reset_postdata(); ?>
						</ul>

						<?php if ($read_more_link) { ?>
							<!-- View all Button -->
							<div class="view-all-sessions">
								<a href="<?php echo $read_more_link ?>" title="<?php _e('View all', 'conference-wpl'); ?>" class="btn-default"><?php _e('View all', 'conference-wpl'); ?></a>
							</div>
						<?php } ?>

					</div>
				</div>
			</div>
		
			<?php endif; ?>
		<?php
	}
}
?>
