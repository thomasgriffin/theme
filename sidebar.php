<?php
/**
 * The Sidebar containing the main widget area
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">
	<?php 
	// RCP login form
	echo do_shortcode( '[login_form]' ); ?>
	
	<?php dynamic_sidebar( 'sidebar-1' ); ?>

	
</div>
