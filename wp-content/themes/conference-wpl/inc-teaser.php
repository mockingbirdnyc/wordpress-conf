<?php
/**
 * The default template for displaying Home page teaser
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>
<?php if ( (is_page_template('template-homepage.php')) || (is_home()) ){ ?>
	<!-- Teaser -->
	<div class="banner" id="home">
		<div class="banner_bg" data-stellar-background-ratio="1.1" <?php if ( ot_get_option('wpl_teaser_background') != ''){ ?> style="background-image: url('<?php echo ot_get_option('wpl_teaser_background'); ?>');"<?php } ?>></div>
		<div class="row">
			<div class="colums small-12 medium-12-large-12">
				<div class="center-content">
					<!-- Site title -->
					<div class="logo">
						<h1 id="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo('description'); ?>" rel="home"> <?php bloginfo('name'); ?> </a>
						</h1>

						<?php
							if ( ot_get_option('wpl_logo') != ''){ ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo('description'); ?>" rel="home">
									<img src="<?php echo ot_get_option('wpl_logo'); ?>">
								</a>	
							<?php } 
						?>
					</div>

					<!-- Site Description -->
					<div class="sub-logo">
						<h2 id="site-description"><?php bloginfo('description'); ?></h2>
					</div>

					<!-- Event Info -->
					<div class="event-info">
						<ul class="small-block-grid-1 medium-block-grid-2">
							
							<!-- Event Location -->
							<?php if ( ot_get_option('wpl_event_location') != "") { ?>
								<li><i class="fa fa-map-marker"></i><?php echo ot_get_option('wpl_event_location') ?></li>
							<?php } ?>

							<!-- Event Date -->
							<?php if ( ot_get_option('wpl_event_date') != "") { ?>
								<li><i class="fa fa-calendar"></i><?php echo ot_get_option('wpl_event_date') ?></li>
							<?php } ?>

							
							<!-- Number of speakers -->
							<?php if ( ot_get_option('wpl_number_speakers') == "on") { ?>
								<?php
									$count_speakers = wp_count_posts('post_speaker');
								?>
								<li><i class="fa fa-microphone"></i><?php echo $count_speakers->publish; ?> <?php _e('Speakers', 'conference-wpl'); ?></li>
							<?php } ?>
							
							<!-- Number of Tickets remaining -->
							<?php if ( ot_get_option('wpl_number_tickets') != "") { ?>
								<?php 
									$count_tickets = wp_count_posts('post_pledges');
									$remainingtickets = ot_get_option('wpl_number_tickets') - $count_tickets->publish;
								?>
								<li><i class="fa fa-ticket"></i><?php echo $remainingtickets; ?> <?php _e('Tickets', 'conference-wpl'); ?></li>
							<?php } ?>
					
						</ul>
					</div>
					
					<!-- Teaser Title -->
					<?php if ( ot_get_option('wpl_teaser_title') != "") { ?>
						<h1><?php echo ot_get_option('wpl_teaser_title') ?></h1>
					<?php } ?>

					<!-- Teaser Description -->
					<?php if ( ot_get_option('wpl_teaser_description') != "") { ?>
						<h2><?php echo ot_get_option('wpl_teaser_description') ?></h2>
					<?php } ?>

					<!-- Social Links -->
					<div class="row social-links">
						<div class="large-6 small-centered columns">
							<div class="event-social">
								<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-3">
									<?php $social_media_share = ot_get_option( 'social_media_share', array() ); ?>
									<?php if( $social_media_share ) : ?>
							
										<?php foreach( $social_media_share as $item ) : ?>
											<li>
												<a target="_blank" title="<?php echo $item['wpl_share_item_name']; ?>" href="<?php echo $item['wpl_share_item_url']; ?>">
													<i class="fa <?php echo $item['wpl_share_item_icon']; ?>"></i><?php echo $item['wpl_share_item_name']; ?>
												</a>
											</li>
										<?php endforeach; ?>
										
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
					<!-- # Social Links -->
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
<div class="mini_header">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php $header_image = get_post_meta( get_the_ID(), 'wpl_header_image', true); ?>
				<?php if ($header_image !='') { ?>
					<div class="mini_header_bg" data-stellar-background-ratio="1.5" style="background-image: url('<?php echo $header_image ?>');"></div>
				<?php } else {?>
					<div class="mini_header_bg"></div>
				<?php } ?>
			<?php endwhile; endif; ?>

	<div class="row">
		<div class="columns small-12 medium-12 large-12">
			
			<!-- Site title -->
			<div class="logo">
				<h1 id="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo('description'); ?>" rel="home"> <?php bloginfo('name'); ?> </a>
				</h1>

				<?php
					if ( ot_get_option('wpl_logo') != ''){ ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo('description'); ?>" rel="home">
							<img src="<?php echo ot_get_option('wpl_logo'); ?>">
						</a>	
					<?php } 
				?>
			</div>

			<!-- Site description -->
			<div class="sub-logo">
				<h2 id="site-description"><?php bloginfo('description'); ?></h2>
			</div>
		</div>
	</div>
</div>

<?php } ?>
