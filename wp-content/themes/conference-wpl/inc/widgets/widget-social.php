<?php
/*
 * Plugin Name: Social Widget
 * Plugin URI: http://www.wplook.com
 * Description: Social Widget
 * Author: Victor Tihai	
 * Version: 1.0.0
 * @since: Conference 1.0.0
 * Author URI: http://wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("WPlooksocial");'));
class WPlooksocial extends WP_Widget {

	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
			'WPlooksocial',
			__( 'WPlook Social', 'conference-wpl' ),
			array( 'description' => __( 'A widget for displaying Social Networking', 'conference-wpl' ), )
		);
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/
	
	public function form( $instance ) {
	// outputs the options form on admin

		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}

		else {
			$title = __( '', 'conference-wpl' );
		} 

		if ( $instance ) {
			$twitter = esc_attr( $instance[ 'twitter' ] );
		}
		else {
			$twitter = __( '', 'conference-wpl' );
		} 

		if ( $instance ) {
			$facebook = esc_attr( $instance[ 'facebook' ] );
		}
		else {
			$facebook = __( '', 'conference-wpl' );
		} 
		if ( $instance ) {
			$rss = esc_attr( $instance[ 'rss' ] );
		}
		else {
			$rss = __( '', 'conference-wpl' );
		} 
		if ( $instance ) {
			$googleplus = esc_attr( $instance[ 'googleplus' ] );
		}
		else {
			$googleplus = __( '', 'conference-wpl' );
		} 
		if ( $instance ) {
			$youtube = esc_attr( $instance[ 'youtube' ] );
		}
		else {
			$youtube = __( '', 'conference-wpl' );
		}
		
		if ( $instance ) {
			$vimeo = esc_attr( $instance[ 'vimeo' ] );
		}
		else {
			$vimeo = __( '', 'conference-wpl' );
		}
		if ( $instance ) {
			$soundcloud = esc_attr( $instance[ 'soundcloud' ] );
		}
		else {
			$soundcloud = __( '', 'conference-wpl' );
		} 
		if ( $instance ) {
			$lastfm = esc_attr( $instance[ 'lastfm' ] );
		}
		else {
			$lastfm = __( '', 'conference-wpl' );
		} 
		if ( $instance ) {
			$pinterest = esc_attr( $instance[ 'pinterest' ] );
		}
		else {
			$pinterest = __( '', 'conference-wpl' );
		}
		if ( $instance ) {
			$flickr = esc_attr( $instance[ 'flickr' ] );
		}
		else {
			$flickr = __( '', 'conference-wpl' );
		}
		if ( $instance ) {
			$linked = esc_attr( $instance[ 'linked' ] );
		}
		else {
			$linked = __( '', 'conference-wpl' );
		}

		if ( $instance ) {
			$instagram = esc_attr( $instance[ 'instagram' ] );
		}
		else {
			$instagram = __( '', 'conference-wpl' );
		}

		?>
		<!-- Title-->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
		<!-- Twitter-->
		<p>
			<label for="<?php echo $this->get_field_id('twitter'); ?>">
				<?php _e('Twitter:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Twitter profile.', 'conference-wpl'); ?>
			</p>
		</p>
		
		<!-- Facebook-->
		<p>
			<label for="<?php echo $this->get_field_id('facebook'); ?>">
				<?php _e('Facebook:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Facebook profile, page or group.', 'conference-wpl'); ?>
			</p>
		</p>
		
		<!-- RSS-->
		<p>
			<label for="<?php echo $this->get_field_id('rss'); ?>">
				<?php _e('RSS:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $rss; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the Url of your RSS. You may include your RSS from Feedburner.', 'conference-wpl'); ?>
			</p>
		</p>
		
		<!-- Google Plus-->
		<p>
			<label for="<?php echo $this->get_field_id('googleplus'); ?>">
				<?php _e('Google Plus:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" name="<?php echo $this->get_field_name('googleplus'); ?>" type="text" value="<?php echo $googleplus; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Google Plus profile', 'conference-wpl'); ?>
			</p>
		</p>
		
		<!-- You Tube-->
		<p>
			<label for="<?php echo $this->get_field_id('youtube'); ?>">
				<?php _e('You Tube:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo $youtube; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your YouTube profile.', 'conference-wpl'); ?>
			</p>
		</p>
		
		<!-- vimeo-->
		<p>
			<label for="<?php echo $this->get_field_id('vimeo'); ?>">
				<?php _e('Vimeo:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo $vimeo; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your vimeo profile.', 'conference-wpl'); ?>
			</p>
		</p>
		
		<!-- lastfm-->
		<p>
			<label for="<?php echo $this->get_field_id('lastfm'); ?>">
				<?php _e('Lastfm:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('lastfm'); ?>" name="<?php echo $this->get_field_name('lastfm'); ?>" type="text" value="<?php echo $lastfm; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your lastfm profile.', 'conference-wpl'); ?>
			</p>
		</p>

		<!-- soundcloud -->
		<p>
			<label for="<?php echo $this->get_field_id('soundcloud'); ?>">
				<?php _e('Soundcloud:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('soundcloud'); ?>" name="<?php echo $this->get_field_name('soundcloud'); ?>" type="text" value="<?php echo $soundcloud; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your soundcloud profile.', 'conference-wpl'); ?>
			</p>
		</p>
		
		<!--Pinterest-->
		<p>
			<label for="<?php echo $this->get_field_id('pinterest'); ?>">
				<?php _e('Pinterest:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo $pinterest; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Pinterest profile.', 'conference-wpl'); ?>
			</p>
		</p>

		<!--Flickr-->
		<p>
			<label for="<?php echo $this->get_field_id('flickr'); ?>">
				<?php _e('Flickr:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo $flickr; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Flickr profile.', 'conference-wpl'); ?>
			</p>
		</p>
		
		<!--Linkedin-->
		<p>
			<label for="<?php echo $this->get_field_id('linked'); ?>">
				<?php _e('Linkedin:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('linked'); ?>" name="<?php echo $this->get_field_name('linked'); ?>" type="text" value="<?php echo $linked; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Linkedin profile.', 'conference-wpl'); ?>
			</p>
		</p>

		<!--Instagram-->
		<p>
			<label for="<?php echo $this->get_field_id('instagram'); ?>">
				<?php _e('Instagram:', 'conference-wpl'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo $instagram; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;">
				<?php _e('Insert the full URL of your Instagram profile.', 'conference-wpl'); ?>
			</p>
		</p>

<?php 

	} 

function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['twitter'] = sanitize_text_field($new_instance['twitter']);
		$instance['facebook'] = $new_instance['facebook'];
		$instance['rss'] = $new_instance['rss'];
		$instance['googleplus'] = $new_instance['googleplus'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['vimeo'] = $new_instance['vimeo'];
		$instance['lastfm'] = $new_instance['lastfm'];
		$instance['soundcloud'] = $new_instance['soundcloud'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['linked'] = $new_instance['linked'];
		$instance['instagram'] = $new_instance['instagram'];

	return $instance;
	}

function widget($args, $instance) {
		// outputs the content of the widget
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$twitter = isset( $instance['twitter'] ) ? esc_attr( $instance['twitter'] ) : '';
		$facebook = isset( $instance['facebook'] ) ? esc_attr( $instance['facebook'] ) : '';
		$rss = isset( $instance['rss'] ) ? esc_attr( $instance['rss'] ) : '';
		$googleplus = isset( $instance['googleplus'] ) ? esc_attr( $instance['googleplus'] ) : '';
		$youtube = isset( $instance['youtube'] ) ? esc_attr( $instance['youtube'] ) : '';
		$vimeo = isset( $instance['vimeo'] ) ? esc_attr( $instance['vimeo'] ) : '';
		$lastfm = isset( $instance['lastfm'] ) ? esc_attr( $instance['lastfm'] ) : '';
		$soundcloud = isset( $instance['soundcloud'] ) ? esc_attr( $instance['soundcloud'] ) : '';
		$pinterest = isset( $instance['pinterest'] ) ? esc_attr( $instance['pinterest'] ) : '';
		$flickr = isset( $instance['flickr'] ) ? esc_attr( $instance['flickr'] ) : '';
		$linked = isset( $instance['linked'] ) ? esc_attr( $instance['linked'] ) : '';
		$instagram = isset( $instance['instagram'] ) ? esc_attr( $instance['instagram'] ) : '';
		?>
<?php if ($title=="") $title = "Social Widget"; ?>
<?php echo $before_widget; ?>
<?php if ( $title )
		echo $before_title . $title . $after_title; 
		echo "<div class='social-widget-body'><div class='social-widget-margin'>";
			// Twitter
			if ($twitter != "") {
				echo "<div class='social-item-twitter'>"."<a href='$twitter' target='_blank'><i class='fa fa-twitter'></i></a>"."</div>";
			}
			// Facebook
			if ($facebook != "") {
				echo "<div class='social-item-facebook'>"."<a href='$facebook' target='_blank'><i class='fa fa-facebook'></i></a>" ."</div>";
			}		
			// RSS
			if ($rss != "") {
				echo "<div class='social-item-rss'>"."<a href='$rss' target='_blank'><i class='fa fa-rss'></i></a>" ."</div>";
			}
			// Google Plus
			if ($googleplus != "") {
				echo "<div class='social-item-gplus'>"."<a href='$googleplus' target='_blank'><i class='fa fa-google-plus'></i></a>" ."</div>";
			}
			// You Tube
			if ($youtube != "") {
				echo "<div class='social-item-youtube'>"."<a href='$youtube' target='_blank'><i class='fa fa-youtube'></i></a>" ."</div>";
			}
			// vimeo
			if ($vimeo != "") {
				echo "<div class='social-item-vimeo'>"."<a href='$vimeo' target='_blank'><i class='fa fa-vimeo-square'></i></a>" ."</div>";
			}
			// lastfm
			if ($lastfm != "") {
				echo "<div class='social-item-lastfm'>"."<a href='$lastfm' target='_blank'><i class='fa fa-lastfm'></i></a>" ."</div>";
			}
			// soundcloud
			if ($soundcloud != "") {
				echo "<div class='social-item-soundcloud'>"."<a href='$soundcloud' target='_blank'><i class='fa fa-soundcloud'></i></a>" ."</div>";
			}
			// Pinterest
			if ($pinterest != "") {
				echo "<div class='social-item-pinterest'>"."<a href='$pinterest' target='_blank'><i class='fa fa-pinterest'></i></a>" ."</div>";
			}
			// Flickr
			if ($flickr != "") {
				echo "<div class='social-item-flickr'>"."<a href='$flickr' target='_blank'><i class='fa fa-flickr'></i></a>" ."</div>";
			}
			// Linkedin
			if ($linked != "") {
				echo "<div class='social-item-linkedin'>"."<a href='$linked' target='_blank'><i class='fa fa-linkedin'></i></a>" ."</div>";
			}
			// Instagram
			if ($instagram != "") {
				echo "<div class='social-item-instagram'>"."<a href='$instagram' target='_blank'><i class='fa fa-instagram'></i></a>" ."</div>";
			}
		echo "<div class='clear'></div></div></div>";
	 	echo $after_widget; ?>
<?php
	}
}
?>
