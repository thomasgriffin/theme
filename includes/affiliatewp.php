<?php

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