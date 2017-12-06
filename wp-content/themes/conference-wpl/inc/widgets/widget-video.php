<?php
/*
 * Plugin Name: Video widget
 * Plugin URI: http://www.wplook.com
 * Description: Display a YouTube/Vimeo video in the sidebar
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_video_widget");'));
class wplook_video_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_video_widget',
			__( 'WPlook Video', 'conference-wpl' ),
			array( 'description' => __( 'Display a YouTube/Vimeo video in the sidebar', 'conference-wpl' ), )
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
			$title = __( 'Video', 'conference-wpl' );
		}

		if ( $instance ) {
			$youtube_id = esc_attr( $instance[ 'youtube_id' ] );
		}
		else {
			$youtube_id = __( '', 'conference-wpl' );
		}

		if ( $instance ) {
			$vimeo_id = esc_attr( $instance[ 'vimeo_id' ] );
		}
		else {
			$vimeo_id = __( '', 'conference-wpl' );
		}

		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p><strong><?php _e('Enter one of the following:', 'conference-wpl'); ?></strong></p>

			<p>
				<label for="<?php echo $this->get_field_id('youtube_id'); ?>"> <?php _e('YouTube ID:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('youtube_id'); ?>" name="<?php echo $this->get_field_name('youtube_id'); ?>" type="text" value="<?php echo $youtube_id; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php printf( __( 'For example, %1$s in the URL %2$s.', 'conference-wpl' ), '<strong><code style="font-size: 10px; padding: 3px 1px 2px; margin: 0;">5B4juUR-dM8</code></strong>', '<code style="font-size: 10px; padding: 3px 1px 2px; margin: 0;">https://www.youtube.com/watch?v=5B4juUR-dM8</code>' ); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('vimeo_id'); ?>"> <?php _e('Vimeo ID:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('vimeo_id'); ?>" name="<?php echo $this->get_field_name('vimeo_id'); ?>" type="text" value="<?php echo $vimeo_id; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php printf( __( 'For example, %1$s in the URL %2$s.', 'conference-wpl' ), '<strong><code style="font-size: 10px; padding: 3px 1px 2px; margin: 0;">17147778</code></strong>', '<code style="font-size: 10px; padding: 3px 1px 2px; margin: 0;">https://vimeo.com/17147778</code>' ); ?></p>
			</p>

		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['youtube_id'] = sanitize_text_field($new_instance['youtube_id']);
		$instance['vimeo_id'] = sanitize_text_field($new_instance['vimeo_id']);
		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$youtube_id = esc_attr( $instance['youtube_id'] );
		$vimeo_id = esc_attr( $instance['vimeo_id'] );
	?>
		
		<!-- Video widget -->
		<?php echo $before_widget; ?>

			<?php echo $before_title . $title . $after_title; ?>
			
			<?php if( !empty( $youtube_id ) ) : ?>

				<div class="widget-video">

					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0" allowfullscreen></iframe>

				</div>

			<?php elseif ( !empty( $vimeo_id ) ) : ?>

				<div class="widget-video">

					<iframe src="https://player.vimeo.com/video/<?php echo $vimeo_id; ?>?color=D0D9E0&title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" allowfullscreen></iframe>

				</div>

			<?php else : ?>

				<p><?php _e( 'YouTube or Vimeo video ID not found. Have you entered it correctly in the widget settings?', 'conference-wpl' ); ?></p>

			<?php endif; ?>

		<?php echo $after_widget; ?>

<?php }
}
?>
