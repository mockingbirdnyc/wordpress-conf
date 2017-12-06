<?php
/*
 * Plugin Name: Recent Tickets
 * Plugin URI: http://www.wplook.com
 * Description: Add Posts on pages
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_tickets_widget");'));
class wplook_tickets_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_tickets_widget',
			__( 'WPlook Tickets (Home Page)', 'conference-wpl' ),
			array( 'description' => __( 'A widget for displaying Tickets', 'conference-wpl' ), )
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
			$title = __( 'Tickets', 'conference-wpl' );
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
			$nr_columns = __( '3', 'conference-wpl' );
		}

		if ( $instance ) {
			$bg_image = esc_attr( $instance[ 'bg_image' ] );
		}
		else {
			$bg_image = __( '', 'conference-wpl' );
		}

		if ( $instance ) {
			$categories = esc_attr( $instance[ 'categories' ] );
		}
		else {
			$categories = __( 'All', 'conference-wpl' );
		}


		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Tickets:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The Number of Tickets you want to display', 'conference-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_columns'); ?>"> <?php _e('Number of Columns:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_columns'); ?>" name="<?php echo $this->get_field_name('nr_columns'); ?>" type="text" value="<?php echo $nr_columns; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The Number of Columns you want to display', 'conference-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('bg_image'); ?>"> <?php _e('Background Image:', 'conference-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('bg_image'); ?>" name="<?php echo $this->get_field_name('bg_image'); ?>" type="text" value="<?php echo $bg_image; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Add the Background Image URL', 'conference-wpl'); ?></p>
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
						'taxonomy'  => 'wpl_tickets_category' 
					) 
				); ?>
			</p>

			<br />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The ID of this widget is: <strong>pricing</strong>', 'conference-wpl'); ?></p>
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
		$instance['bg_image'] = sanitize_text_field($new_instance['bg_image']);
		$instance['categories'] = sanitize_text_field($new_instance['categories']);
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
		$bg_image = isset( $instance['bg_image'] ) ? esc_attr( $instance['bg_image'] ) : '';
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';

		$args = array(
			'ignore_sticky_posts'=> 1,
			'post_type' => 'post_tickets',
			'post_status' => 'publish',
			'posts_per_page' => $nr_posts,
		);

		if ( $categories > '1' ) {
			$category_args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'wpl_tickets_category',
						'field' => 'id',
						'terms' => $categories
					)
				)
			);
			$args = array_merge( $args, $category_args );
		}
		
		$tickets = null;
		$tickets = new WP_Query( $args );
		?>

			<?php if( $tickets->have_posts() ) : ?>
				<!-- Buy tickets -->
				<div class="buytickets widget-content" id="pricing">
					<div class="buytickets_bg" data-stellar-background-ratio="0.2" style="background-image: url('<?php echo $bg_image; ?>');"></div>
					<div class="row">
						<div class="columns small-12 medium-12 large-12">
							<div class="center-content">
								<h2><?php echo $title; ?></h2>
								<div class="">
									<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-<?php echo $nr_columns; ?>">

								
										<?php while( $tickets->have_posts() ) : $tickets->the_post(); ?>
											<?php
												$pid = $post->ID;
												$ticket_price = get_post_meta( $pid, 'wpl_ticket_price', true);
												$ribbon_text = get_post_meta( $pid, 'wpl_ribbon_text', true);
												$ribbon_color = get_post_meta( $pid, 'wpl_ribbon_color', true);
												$eventbride_url = get_post_meta( $pid, 'wpl_eventbride_url', true);
											?>
											<li>
												<!-- Early bird box -->
												<div class="buytickets_item">
													<!-- Ticket Title -->
													<div class="title">
														<?php the_title(); ?>
													</div>
													
													<!-- Ticket price -->
													<?php if ($ticket_price) { ?>
														<div class="price"><?php echo $ticket_price; ?> <?php echo ot_get_option('wpl_curency_code') ?></div>
													<?php } ?>

													<!-- Ticket Description -->
													<div class="description">
														<?php the_content(); ?>
													</div>

													<?php if ($eventbride_url) { ?>
														<div class="btn_buy_ticket">
															<a href="<?php echo $eventbride_url; ?>" target="_blank" class="btn-default" data-reveal-id="BuyTicket"><?php _e('Buy ticket', 'conference-wpl'); ?></a>
														</div>
													<?php } else { ?>

														<form class="buy" action="<?php echo get_template_directory_uri() ?>/inc/paypal/buy.php" method="post">
															<label>
																<input name="price" type="hidden" value="<?php echo $ticket_price; ?>">
															</label>
															<label>
																<input name="ticket" type="hidden" value="<?php echo get_the_ID(); ?>|#| <?php the_title(); ?>">
															</label>
															<label class="btn_buy_ticket">
																<input class="btn-default" value="<?php _e('Buy ticket', 'conference-wpl'); ?>" type="submit">
															</label>
															<label>
																<input type="hidden" name="submitted" value="true">
															</label>
														</form>

													<?php } ?>

													<div class="promo">
														<div class="<?php echo $ribbon_color ?>"><?php echo $ribbon_text; ?></div>
													</div> 
												</div>
											</li>

										<?php endwhile; wp_reset_postdata(); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php endif; ?>
		<?php
	}
}
?>
