<?php
/*
 * Plugin Name: Quote
 * Plugin URI: http://www.wplook.com
 * Description: Add Causes on pages
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_quote_widget");'));
class wplook_quote_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_quote_widget',
			__( 'WPlook Quote', 'conference-wpl' ),
			array( 'description' => __( 'A widget for displaying Quotes', 'conference-wpl' ), )
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
			$title = __( '', 'conference-wpl' );
		}

		if ( $instance ) {
			$quote = esc_attr( $instance[ 'quote' ] );
		}
		else {
			$quote = __( '', 'conference-wpl' );
		}

		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('quote'); ?>">
					<?php _e('Quote:', 'conference-wpl'); ?>
				</label>
				<textarea cols="25" rows="10" class="widefat" id="<?php echo $this->get_field_id('quote'); ?>" name="<?php echo $this->get_field_name('quote'); ?>" type="text"><?php echo $quote; ?></textarea>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: quotewidget', 'conference-wpl'); ?></p>
			<br />

		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		
		if ( current_user_can('unfiltered_html') )
			$instance['quote'] =  $new_instance['quote'];
		else
			$instance['quote'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['quote']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		//$quote = apply_filters( 'widget', $instance['quote'] );
		$quote = apply_filters( 'widget_text', empty( $instance['quote'] ) ? '' : $instance['quote'], $instance );
		?>
		
			<aside class="widget WPlookAnounce widget-content" id="quotewidget">	
				<div class="announce-body mright mleft">
					<div class="row">
						<div class="columns small-12 medium-12 large-12">
							<div class="center-content">
								<h2><?php echo $title; ?></h2>
								<h3><?php echo $quote ?></h3>
							</div>

							
						</div>	
					</div>
					
				</div>
			</aside>
		
			
		<?php
	}
}
?>
