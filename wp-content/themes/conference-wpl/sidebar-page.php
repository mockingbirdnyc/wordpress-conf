<?php
/**
 * The default Sidebar for pages.
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>
<?php if ( is_active_sidebar( 'page-1' ) ) : ?>
	<?php if ( ! dynamic_sidebar( 'page-1' ) ) : ?>
	<?php endif; // end sidebar widget area ?>
<?php endif; ?>