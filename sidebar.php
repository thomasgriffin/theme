<?php
/**
 * The Sidebar containing the main widget area
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">
	
	<?php if ( is_page( 'account' ) && is_user_logged_in() ) : ?>
	<div class="box">
		<ul class="linked list">
			<li><a href="<?php echo wp_logout_url( site_url( 'account' ) ); ?>"><?php _e( 'Logout', 'pp' ); ?></a></li>
		</ul>
	</div>
	<?php endif; ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

	
</div>
