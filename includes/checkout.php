<?php

/**
 * Link to terms page
 * @return [type] [description]
 */
function affwp_edd_terms_agreement() {
	global $edd_options;
 
	if ( isset( $edd_options['show_agree_to_terms'] ) ) : ?>
	
	<fieldset id="edd_terms_agreement">
		<input name="edd_agree_to_terms" class="required" type="checkbox" id="edd_agree_to_terms" value="1" />
		<label for="edd_agree_to_terms">
			I agree to the <?php echo '<a href="#refund-policy" class="open">refund policy</a>'; ?>
		</label>
		
	</fieldset>
	
	<?php endif;
}
remove_action( 'edd_purchase_form_before_submit', 'edd_terms_agreement' );
add_action( 'edd_purchase_form_before_submit', 'affwp_edd_terms_agreement' );

/**
 * Terms and conditions
 */
function pp_show_refund_policy() {

	if ( ! function_exists( 'edd_is_checkout' ) || ! edd_is_checkout() ) {
		return;
	}

	$terms = get_posts(
	    array(
	        'name'      => 'terms-and-conditions',
	        'post_type' => 'page',
	        'posts_per_page' => 1
	    )
	);
	

	if ( ! $terms ) {
		return;
	}
	?>


	<div id="refund-policy" class="popup entry-content" style="display: none;">
		<h1><?php echo $terms[0]->post_title; ?></h1>
		<?php echo stripslashes( wpautop( $terms[0]->post_content, true ) ); ?>
	</div>

	<?php
}
add_action( 'wp_footer', 'pp_show_refund_policy' );

