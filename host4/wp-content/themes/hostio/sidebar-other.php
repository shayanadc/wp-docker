<?php
/**
 * The Sidebar containing the main widget area
 */
?>
<?php if ( is_active_sidebar( 'sidebar-other' ) ) : ?>
	<?php dynamic_sidebar( 'sidebar-other' ); ?>
<?php endif; ?>