<?php
/**
 * The Sidebar containing the main widget area
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">
	
	<?php 
		$affiliate_area_id = affiliate_wp()->settings->get( 'affiliates_page' );
	?>

	<?php if ( is_page( $affiliate_area_id ) && ! is_user_logged_in() ) : ?>

		<div class="box">
		<?php echo affiliate_wp()->login->login_form(); ?>
		</div>

	<?php elseif( is_page( $affiliate_area_id ) && is_user_logged_in() ) : ?>
		<div class="box">
			<ul class="linked list">
				<li><a href="<?php echo wp_logout_url( get_permalink( $affiliate_area_id ) ); ?>"><?php _e( 'Logout', 'pp' ); ?></a></li>
			</ul>
		</div>
	<?php endif; ?>

	<?php if ( is_page( 'account' ) && is_user_logged_in() ) : ?>
	<div class="box">
		<ul class="linked list">
			<li><a href="<?php echo wp_logout_url( site_url( 'account' ) ); ?>"><?php _e( 'Logout', 'pp' ); ?></a></li>
		</ul>
	</div>
	<?php endif; ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

</div>
