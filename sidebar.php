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
	<?php elseif( is_user_logged_in() ) : ?>	
		<div class="box">
			<ul class="linked list">
				<li<?php if ( is_page( 'account' ) ) { echo ' class="active"'; } ?>><a href="<?php echo site_url( 'account' ); ?>"><?php _e( 'Your Account', 'pp' ); ?></a></li>

				<?php if ( affwp_is_affiliate() ) : ?>
				<li<?php if ( is_page( $affiliate_area_id ) ) { echo ' class="active"'; } ?>><a href="<?php echo get_permalink( $affiliate_area_id ); ?>"><?php _e( 'Affiliate Dashboard', 'pp' ); ?></a></li>
				<?php endif; ?>

				<li><a href="<?php echo wp_logout_url( site_url( 'account' ) ); ?>"><?php _e( 'Logout', 'pp' ); ?></a></li>
			</ul>
		</div>	
	<?php endif; ?>
	



	<?php dynamic_sidebar( 'sidebar-1' ); ?>

</div>
