<?php
/*
 * Plugin Name: Speakers
 * Plugin URI: http://www.wplook.com
 * Description: Add speakers to home page
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_speakers_widget");'));
class wplook_speakers_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_speakers_widget',
			__( 'WPlook Speakers (Home page)', 'conference-wpl' ),
			array( 'description' => __( 'A widget for displaying Speakers on Home Page', 'conference-wpl' ), )
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
			$title = __( 'Speakers', 'conference-wpl' );
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
			$nr_columns = esc_attr( $instance[ 'nr_columns' ] );
		}
		else {
			$nr_columns = __( '4', 'conference-wpl' );
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
						'taxonomy'  => 'wpl_speakers_category' 
					) 
				); ?>
				
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Speakers:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of Speakers you want to display', 'conference-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_columns'); ?>"> <?php _e('Number of Columns:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_columns'); ?>" name="<?php echo $this->get_field_name('nr_columns'); ?>" type="text" value="<?php echo $nr_columns; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The Number of Columns you want to display', 'conference-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"><?php _e('Order by:', 'conference-wpl'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="random" <?php selected( 'random', $display_type ); ?>><?php _e('Random', 'conference-wpl'); ?></option>
					<option value="Latest" <?php selected( 'Latest', $display_type ); ?>><?php _e('Latest', 'conference-wpl'); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all Speakers:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('View all speakers URL', 'conference-wpl'); ?></p>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>speakers</strong>', 'conference-wpl'); ?></p>
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
		$instance['nr_columns'] = sanitize_text_field($new_instance['nr_columns']);
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
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		$nr_columns = isset( $instance['nr_columns'] ) ? esc_attr( $instance['nr_columns'] ) : '';
		$display_type = isset( $instance['display_type'] ) ? esc_attr( $instance['display_type'] ) : '';
		$read_more_link = isset( $instance['read_more_link'] ) ? esc_attr( $instance['read_more_link'] ) : '';
		?>
		
		<?php
			if ( $categories < '1' ) {
				if ( $display_type == 'random') {
					$args = array(
						'post_type' => 'post_speaker',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'orderby' => 'rand'
					);
				} else {
					$args = array(
						'post_type' => 'post_speaker',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts
					);
				}
			} else {
				if ( $display_type == 'random') {
					$args = array(
						'post_type' => 'post_speaker',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'wpl_speakers_category',
								'field' => 'id',
								'terms' => $categories
							)
						)
					);
				} else {
					$args = array(
						'post_type' => 'post_speaker',
						'post_status' => 'publish',
						'posts_per_page' => $nr_posts,
						'tax_query' => array(
							array(
								'taxonomy' => 'wpl_speakers_category',
								'field' => 'id',
								'terms' => $categories
							)
						)
					);
				}
			}

			$speaker = null;
			$speaker = new WP_Query( $args );
		?>
		
			<?php if( $speaker->have_posts() ) : ?>
				<!-- Speakers -->
				<div class="speakers widget-content" id="speakers">
					<div class="row">
						<div class="columns small-12 medium-12 large-12">
							<div class="center-content">
								<h2><?php echo $title; ?></h2>
									<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-<?php echo $nr_columns; ?>">
										<!-- First Speacker -->
									
										<?php while( $speaker->have_posts() ) : $speaker->the_post(); ?>
											<?php 
												$pid = $post->ID;
												$candidate_position = get_post_meta( $pid, 'wpl_candidate_position', true);
											?>
					
											<?php 
											$pid = $post->ID;
											$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
											$speaker_company = get_post_meta( $pid, 'wpl_speaker_company', true);
											$speaker_company_url = get_post_meta( $pid, 'wpl_speaker_company_url', true);
											$candidate_share_items = get_post_meta($post->ID, 'candidate_share', true);

										?>
											<!-- Speackers -->
											<li id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
												<div class="avatar">
													<?php if ( has_post_thumbnail() ) {?> 
														<?php the_post_thumbnail('speaker-thumb'); ?>
													<?php } ?>

													<!-- Speaker media links -->
													<div class="social">
														<!-- Speacker profile / blog url -->
														<a href="<?php the_permalink(); ?>">
															<i class="fa fa-user"></i>
														</a>
										
														<?php if ( ! empty( $candidate_share_items ) ) {
															foreach( $candidate_share_items as $item ) { ?>
																<a href="<?php echo $item['wpl_share_item_url']; ?>" target="_blank">
																	<i class="fa <?php echo $item['wpl_share_item_icon']; ?>"></i>
																</a>
															<?php }
														} ?>

													</div>
												</div>
												<div class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
												
												<!-- Speaker company -->
												<?php if ( $speaker_company !='' ) { ?>
													<div class="company"><a href="<?php echo $speaker_company_url; ?>" target="_blank"><?php echo $speaker_company; ?></a></div>
												<?php } ?>	
											</li>
										<?php endwhile; wp_reset_postdata(); ?>
									</ul>

									<?php if ($read_more_link) { ?>
										<!-- View all Speakers Button -->
										<div class="view-all-speakers">
											<a href="<?php echo $read_more_link ?>" title="<?php _e('View all Speakers', 'conference-wpl'); ?>" class="btn-default"><?php _e('View all Speakers', 'conference-wpl'); ?></a>
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
