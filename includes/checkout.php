<?php

/**
 * Link to terms page
 * @return [type] [description]
 */
function pp_edd_terms_agreement() {
	global $edd_options;
 
	if ( isset( $edd_options['show_agree_to_terms'] ) ) : ?>
	
		    
	<fieldset id="edd_terms_agreement">
		<input name="edd_agree_to_terms" class="required" type="checkbox" id="edd_agree_to_terms" value="1" />
		<label for="edd_agree_to_terms">
			I agree to the <?php echo '<a href="#refund-policy" class="popup-content" data-effect="mfp-move-from-bottom">refund policy</a>'; ?>
		</label>
	</fieldset>

	<?php // seems to only work when placed here ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {

		// inline
		$('.popup-content').magnificPopup({
			type: 'inline',
			fixedContentPos: true,
			fixedBgPos: true,
			overflowY: 'scroll',
			closeBtnInside: true,
			preloader: false,
			callbacks: {
				beforeOpen: function() {
				this.st.mainClass = this.st.el.attr('data-effect');
				}
			},
			midClick: true,
			removalDelay: 300
        });

		});
	</script>

	<?php endif;
}
remove_action( 'edd_purchase_form_before_submit', 'edd_terms_agreement' );
add_action( 'edd_purchase_form_before_submit', 'pp_edd_terms_agreement' );



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

	
	<div id="refund-policy" class="popup entry-content mfp-with-anim mfp-hide">
		<h1><?php echo $terms[0]->post_title; ?></h1>
		<?php echo stripslashes( wpautop( $terms[0]->post_content, true ) ); ?>
	</div>

	<?php
}
add_action( 'wp_footer', 'pp_show_refund_policy' );


/**
 * Skin the select menus after the ajax call for the payment method has run
 * Can't think of a better way to do this
 */
function pp_edd_checkout_js() {
	if ( ! ( function_exists( 'edd_is_checkout' ) && edd_is_checkout() || is_page( 'contact' ) ) ) {
		return;
	}

	?>
	<script>
		jQuery(document).ready(function($) {
			 $(".edd-select").chosen({disable_search_threshold: 15});
		});
			
		jQuery( document ).ajaxComplete(function( event,request, settings ) {
			jQuery(".edd-select").chosen({disable_search_threshold: 15});
		});
	</script>
	<?php
}
//add_action( 'wp_footer', 'pp_edd_checkout_js' );