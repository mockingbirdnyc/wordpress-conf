<?php
/**
 * The footer template
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>	

	<!-- Footer -->
	<div class="footer">
		<div class="footer_bg" data-stellar-background-ratio="0.5" <?php if ( ot_get_option('wpl_footer_bg') ) { ?> style="background-image: url(' <?php echo ot_get_option('wpl_footer_bg'); } ?>');"></div>
		<?php if (is_active_sidebar( 'f1-widgets' ) || is_active_sidebar( 'f2-widgets' ) || is_active_sidebar( 'f3-widgets' ) ) { ?>
			<div class="footer_widgets">
				<div class="row">
					<!-- First widget area -->
					<?php if ( is_active_sidebar( 'f1-widgets' ) ) : ?>
						<div class="columns small-12 medium-4 large-4">
							<?php dynamic_sidebar( 'f1-widgets' ); ?>
						</div>
					<?php endif; ?>

					<!-- Second Widget area -->
					<?php if ( is_active_sidebar( 'f2-widgets' ) ) : ?>
						<div class="columns small-12 medium-4 large-4">
							<?php dynamic_sidebar( 'f2-widgets' ); ?>
						</div>
					<?php endif; ?>

					<!-- Third Widget area -->
					<?php if ( is_active_sidebar( 'f3-widgets' ) ) : ?>
						<div class="columns small-12 medium-4 large-4">
							<?php dynamic_sidebar( 'f3-widgets' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php }	?>	

		<!-- Copyright -->
		<div class="footer_copyright">
			<div class="row">
				<!-- Copy -->
				<div class="columns small-12 medium-5 large-5">
					<p><?php if ( ot_get_option('wpl_copyright') ){ echo ot_get_option('wpl_copyright'); } ?> <?php _e('Designed by', 'conference-wpl'); ?> <a href="https://wplook.com/theme/conference-wordpress-theme/?utm_source=Footer-URL&utm_medium=link&utm_campaign=Conference" title="<?php _e('Conference WordPress Theme', 'conference-wpl'); ?>" target="_blank">WPlook</a></p>
				</div>

				<!-- Footer menu -->
				<div class="columns small-12 medium-7 large-7">
					<?php
						if ( has_nav_menu( 'footernav' ) ) { ?>
							<?php wp_nav_menu( array('depth' => '3', 'items_wrap' => '<ul class="inline-list right">%3$s</ul>', 'theme_location' => 'footernav', 'container'	 => '','depth' => -1, )); ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.wrapper -->

	<?php if ( ot_get_option('wpl_google_analytics_tracking_code') ) {
		// Google Analytics Tracking Code
		echo ot_get_option('wpl_google_analytics_tracking_code');
	} ?>
	<?php wp_footer(); ?>
</body>
</html>
