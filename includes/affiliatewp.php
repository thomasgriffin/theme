<?php

/**
 * Custom affiliate area shortcode
 * Mods: removed login from below register
 */
function pp_shortcode_affiliate_area() {
	ob_start();

	if ( ! function_exists( 'affiliate_wp' ) ) {
		return;
	}

	if ( is_user_logged_in() && affwp_is_affiliate() ) {

		affiliate_wp()->templates->get_template_part( 'dashboard' );

	} elseif ( is_user_logged_in() && affiliate_wp()->settings->get( 'allow_affiliate_registration' ) ) {

		affiliate_wp()->templates->get_template_part( 'register' );

	} else {

		if ( affiliate_wp()->settings->get( 'allow_affiliate_registration' ) ) {

			affiliate_wp()->templates->get_template_part( 'register' );

		} else {
			affiliate_wp()->templates->get_template_part( 'no', 'access' );
		}
	}

	return ob_get_clean();
}

$affiliate_wp = affiliate_wp();

// remove old shortcode
remove_shortcode( 'affiliate_area', array( $affiliate_wp, 'affiliate_area' ) );

// add our custom shortcode
add_shortcode( 'affiliate_area', 'pp_shortcode_affiliate_area' );

/**
 * Adds terms of use directly into register form so we can open it in a modal window
 */
function pp_affiliate_terms_of_use() {
	$terms_of_use = get_page_by_title( 'Affiliate Terms and Conditions' );
	?>
	<div id="terms-of-use" class="popup entry-content mfp-with-anim mfp-hide">
		<h1>
			<?php echo $terms_of_use->post_title; ?>
		</h1>

		<?php echo stripslashes( wpautop( $terms_of_use->post_content, true ) ); ?>
	</div>
	<?php
}
add_action( 'affwp_register_fields_before_submit', 'pp_affiliate_terms_of_use' );