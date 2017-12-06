<?php
/**
 * Template Name: Daily Agenda
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0.0
 */
?>

<?php get_header(); ?>
<?php 
	$pid = $post->ID;
	$number_of_columns = get_post_meta( $pid, 'wpl_number_of_columns', true);
?>
<div class="page">
	<div class="title_blog_container">
		<div class="row">
			<!-- Breadcrumbs -->
			<?php if ( ot_get_option('wpl_breadcrumbs') != "off") { ?>

				<div class="columns small-12 medium-12 large-12">
					<ul class="breadcrumbs">
						<?php wplook_breadcrumbs(); ?>
					</ul>
				</div>
			<?php } ?>
			
			<div class="columns small-12 medium-12 large-12">
				<h1 class="title_blog"><?php echo get_the_title(); ?></h1>
			</div>
		</div>
		
	</div>
	<!-- Agenda -->
	<div class="row">
		<?php // Display the default content
			if ( $post->post_content != '' ) { ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="template-main-article">
						<div class="entry-content">
							<div class="content"><?php the_content(); ?></div>
						</div>
						<div class="clear"></div>
					</article>
				<?php endwhile;
			} // End displaying the default content
		?>
		<div class="schedule">
			<div class="columns small-12 medium-12 large-12">

				<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-<?php if ( $number_of_columns == '' ){ echo "3";}else { echo $number_of_columns; } ?>">
					<?php $args = array( 'post_type' => 'post_shedules','post_status' => 'publish', 'posts_per_page' => 100, 'paged'=> $paged); ?>
					<?php $wp_query = null; ?>
					<?php $wp_query = new WP_Query( $args ); ?>
					<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						
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
										} ?>
									</dl>
								</div>
							</div>
						</li>

					<?php endwhile; wp_reset_postdata(); ?>
					<?php else : ?>
						<p><?php _e('Sorry, no Agenda matched your criteria.', 'conference-wpl'); ?></p>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
