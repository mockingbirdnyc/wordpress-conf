<?php
/*
 * Plugin Name: Countdown
 * Plugin URI: http://www.wplook.com
 * Description: Add a countdown to a date to home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_countdown_widget");'));
class wplook_countdown_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_countdown_widget',
			__( 'WPlook Countdown (Home page)', 'conference-wpl' ),
			array( 'description' => __( 'A widget for displaying a countdown to a date on the Home Page', 'conference-wpl' ), )
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
			$title = __( 'Countdown', 'conference-wpl' );
		}

		if ( $instance ) {
			$date = esc_attr( $instance[ 'date' ] );
		}
		else {
			$date = __( '', 'conference-wpl' );
		}
		?>

			<script>
			jQuery(document).ready(function() {
				jQuery('#<?php echo $this->get_field_id('date'); ?>').datetimepicker({
					dateFormat: 'dd-mm-yy',
					showTime: false,
					
				});
			});
			</script>

			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('date'); ?>"> <?php _e('Date:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('date'); ?>" name="<?php echo $this->get_field_name('date'); ?>" type="datetime" value="<?php echo $date; ?>" />
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 20px 0px; padding: 0px;"> <?php _e('The date format is: <strong>DD-MM-YYYY HH:MM</strong>', 'conference-wpl'); ?></p>
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>countdown</strong>', 'conference-wpl'); ?></p>
			<br />
			
		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['date'] = sanitize_text_field($new_instance['date']);
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$date = isset( $instance['date'] ) ? esc_attr( $instance['date'] ) : '';
		?>
		
		<!-- Countdown -->
		<div class="countdown widget-content" id="countdown">
			<div class="row">
				<div class="columns small-12 medium-12 large-12">
					<div class="center-content">
						<?php if( !empty( $title ) ) : ?>
							<h2 class="animate-title"><?php echo $title; ?></h2>
						<?php endif; ?>

						<div id="clock" class="clock" data-countdownto="<?php echo date( 'm/d/Y H:i:s', strtotime( $date ) ); ?>" data-days="<?php _e( 'days', 'conference-wpl' ); ?>" data-hours="<?php _e( 'hours', 'conference-wpl' ); ?>" data-minutes="<?php _e( 'minutes', 'conference-wpl' ); ?>" data-seconds="<?php _e( 'seconds', 'conference-wpl' ); ?>"></div>
							
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}
?>
