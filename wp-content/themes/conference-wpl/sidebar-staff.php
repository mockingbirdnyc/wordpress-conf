<?php
/**
 * The default Sidebar for Staff.
 *
 * @package WordPress
 * @subpackage Conference
 * @since Conference 1.0
 */
?>

<?php if ( is_active_sidebar( 'staff-1' ) ) : ?>
	<?php if ( ! dynamic_sidebar( 'staff-1' ) ) : ?>
	<?php endif; // end sidebar widget area ?>
<?php endif; ?>