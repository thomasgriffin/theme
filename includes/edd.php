<?php
/**
 * EDD Modifications
 */

/**
 * Change download labels
 */
function pp_edd_download_labels( $labels ) {

	$labels = array(
	   'singular' => __( 'Product', 'pp' ),
	   'plural'   => __( 'Products', 'pp')
	);

	return $labels;

}
add_filter( 'edd_default_downloads_name', 'pp_edd_download_labels' );

/**
 * Get Purchase Link
 *
 * Builds a Purchase link for a specified download based on arguments passed.
 * This function is used all over EDD to generate the Purchase or Add to Cart
 * buttons. If no arguments are passed, the function uses the defaults that have
 * been set by the plugin. The Purchase link is built for simple and variable
 * pricing and filters are available throughout the function to override
 * certain elements of the function.
 *
 * $download_id = null, $link_text = null, $style = null, $color = null, $class = null
 *
 * @since 1.0
 * @param array $args Arguments for display
 * @return string $purchase_form
 */
function pp_get_purchase_link( $args = array() ) {
	global $edd_options, $post;

	if ( ! isset( $edd_options['purchase_page'] ) || $edd_options['purchase_page'] == 0 ) {
		edd_set_error( 'set_checkout', sprintf( __( 'No checkout page has been configured. Visit <a href="%s">Settings</a> to set one.', 'edd' ), admin_url( 'edit.php?post_type=download&page=edd-settings' ) ) );
		edd_print_errors();
		return false;
	}

	$post_id = is_object( $post ) ? $post->ID : 0;

	$defaults = apply_filters( 'edd_purchase_link_defaults', array(
		'download_id' => $post_id,
		'price'       => (bool) true,
		'direct'      => edd_get_download_button_behavior( $post_id ) == 'direct' ? true : false,
		'text'        => ! empty( $edd_options[ 'add_to_cart_text' ] ) ? $edd_options[ 'add_to_cart_text' ] : __( 'Purchase', 'edd' ),
		'style'       => isset( $edd_options[ 'button_style' ] ) 	   ? $edd_options[ 'button_style' ]     : 'button',
		'color'       => isset( $edd_options[ 'checkout_color' ] ) 	   ? $edd_options[ 'checkout_color' ] 	: 'blue',
		'class'       => 'edd-submit'
	) );

	$args = wp_parse_args( $args, $defaults );

	if( 'publish' != get_post_field( 'post_status', $args['download_id'] ) && ! current_user_can( 'edit_product', $args['download_id'] ) ) {
		return false; // Product not published or user doesn't have permission to view drafts
	}

	// Override color if color == inherit
	$args['color'] = ( $args['color'] == 'inherit' ) ? '' : $args['color'];

	$variable_pricing = edd_has_variable_prices( $args['download_id'] );
	$data_variable    = $variable_pricing ? ' data-variable-price=yes' : 'data-variable-price=no';
	$type             = edd_single_price_option_mode( $args['download_id'] ) ? 'data-price-mode=multi' : 'data-price-mode=single';

	if ( $args['price'] && $args['price'] !== 'no' && ! $variable_pricing ) {
		$price = edd_get_download_price( $args['download_id'] );

		$button_text = ! empty( $args['text'] ) ? '&nbsp;&ndash;&nbsp;' . $args['text'] : '';

		if ( 0 == $price ) {
			$args['text'] = __( 'Free', 'edd' ) . $button_text;
		} else {
			$args['text'] = edd_currency_filter( edd_format_amount( $price ) ) . $button_text;
		}
	}

	if ( edd_item_in_cart( $args['download_id'] ) && ! $variable_pricing ) {
		$button_display   = 'style="display:none;"';
		$checkout_display = '';
	} else {
		$button_display   = '';
		$checkout_display = 'style="display:none;"';
	}

	global $edd_displayed_form_ids;
	// Collect any form IDs we've displayed already so we can avoid duplicate IDs
	if ( isset( $edd_displayed_form_ids[$args['download_id']] ) ) {
		$edd_displayed_form_ids[$args['download_id']]++;
	} else {
		$edd_displayed_form_ids[$args['download_id']] = 1;
	}

	$form_id = ! empty( $args['form_id'] ) ? $args['form_id'] : 'edd_purchase_' . $args['download_id'];

	// If we've already generated a form ID for this download ID, apped -#
	if ( $edd_displayed_form_ids[$args['download_id']] > 1 ) {
		$form_id .= '-' . $edd_displayed_form_ids[$args['download_id']];
	}

	$args = apply_filters( 'edd_purchase_link_args', $args );

	ob_start();
?>


	<form id="<?php echo $form_id; ?>" class="edd_download_purchase_form" method="post">

		<?php do_action( 'edd_purchase_link_top', $args['download_id'], $args ); ?>

		<div class="edd_purchase_submit_wrapper">
			<?php
			 if ( ! edd_is_ajax_disabled() ) {
				printf(
					'<a href="#" class="edd-add-to-cart %1$s" data-action="edd_add_to_cart" data-download-id="%3$s" %4$s %5$s %6$s><span class="edd-add-to-cart-label">%2$s</span> <span class="edd-loading">%7$s</span></a>',
					implode( ' ', array( $args['style'], $args['color'], trim( $args['class'] ) ) ),
					esc_attr( $args['text'] ),
					esc_attr( $args['download_id'] ),
					esc_attr( $data_variable ),
					esc_attr( $type ),
					$button_display,
					'<img class="edd-icon-spin" src="'. get_stylesheet_directory_uri() . "/svgs/spinner.svg" .' " />'
				//	'<img class="edd-icon-spin" src="'. get_stylesheet_directory_uri() . "/svgs/spinner.svg" .' " />'

				);
			}

			printf(
				'<input type="submit" class="edd-add-to-cart edd-no-js %1$s" name="edd_purchase_download" value="%2$s" data-action="edd_add_to_cart" data-download-id="%3$s" %4$s %5$s %6$s/>',
				implode( ' ', array( $args['style'], $args['color'], trim( $args['class'] ) ) ),
				esc_attr( $args['text'] ),
				esc_attr( $args['download_id'] ),
				esc_attr( $data_variable ),
				esc_attr( $type ),
				$button_display
			);



			printf(
				'<a href="%1$s" class="%2$s %3$s" %4$s>' . __( 'Checkout', 'edd' ) . '%5$s</a>',
				esc_url( edd_get_checkout_uri() ),
				esc_attr( 'edd_go_to_checkout' ),
				implode( ' ', array( $args['style'], $args['color'], trim( $args['class'] ) ) ),
				$checkout_display,
				pp_add_to_cart_success()
			);
			?>

			
			<?php if ( edd_display_tax_rate() && edd_prices_include_tax() ) {
				echo '<span class="edd_purchase_tax_rate">' . sprintf( __( 'Includes %1$s&#37; tax', 'edd' ), edd_get_tax_rate() * 100 ) . '</span>';
			} elseif ( edd_display_tax_rate() && ! edd_prices_include_tax() ) {
				echo '<span class="edd_purchase_tax_rate">' . sprintf( __( 'Excluding %1$s&#37; tax', 'edd' ), edd_get_tax_rate() * 100 ) . '</span>';
			} ?>
		</div><!--end .edd_purchase_submit_wrapper-->

		<input type="hidden" name="download_id" value="<?php echo esc_attr( $args['download_id'] ); ?>">
		<?php if( ! empty( $args['direct'] ) ) { ?>
			<input type="hidden" name="edd_action" class="edd_action_input" value="straight_to_gateway">
		<?php } else { ?>
			<input type="hidden" name="edd_action" class="edd_action_input" value="add_to_cart">
		<?php } ?>

		<?php do_action( 'edd_purchase_link_end', $args['download_id'], $args ); ?>

	</form><!--end #<?php echo esc_attr( $form_id ); ?>-->
<?php
	$purchase_form = ob_get_clean();


	return apply_filters( 'edd_purchase_download_form', $purchase_form, $args );
}

/**
 * Shown when an item is successfully added to the cart
 */
function pp_add_to_cart_success() { 

	ob_start();
?>
	
	<?php if ( ! edd_is_ajax_disabled() ) : ?>
		
		<span class="edd-cart-added-alert" style="display: none;">
			<?php 
				printf( '<svg width="32px" height="32px"><use xlink:href="'. get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-check'. '"></use></svg>' );
			?>
		</span>
		
	<?php endif; ?>

<?php return ob_get_clean();
}



/**
 * Remove and deactivate all styling included with EDD. Theme uses unique styling
 *
 * @since 1.0
 */
remove_action( 'wp_enqueue_scripts', 'edd_register_styles' );

/**
 * Shows a purchase link in the header at mobile sizes which links to the pricing form
 *
 * @since 1.0
 */
function pp_mobile_purchase_link() {

	if ( ! is_singular( 'download' ) ) {
		return;
	}

	$external_download_url = get_post_meta( get_the_ID(), '_pp_product_download_url', true ) ? get_post_meta( get_the_ID(), '_pp_product_download_url', true ) : '';

	$text = '0' == edd_get_download_price( get_the_ID() ) ? __( 'Free Download', 'pp' ) : __( 'Purchase', 'pp' );
	
	if ( $external_download_url ) :	?>

	
		<a href="<?php echo esc_url( $external_download_url ); ?>" class="button external large purchase" target="_blank">
			<span><?php echo $text; ?></span>
			<svg width="17px" height="16px">
				<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-external'; ?>"></use>
			</svg>
		</a>
	

	<?php else : ?>

	<a href="#<?php echo 'edd_purchase_' . get_the_ID(); ?>" class="button large purchase"><?php echo $text; ?></a>
<?php endif;
}
add_action( 'affwp_page_header_end', 'pp_mobile_purchase_link' );

/**
 * Custom Purchase button
 *
 * @since 1.0
 */
function pp_purchase_link( $download_id ) { 

	$external_download_url = get_post_meta( $download_id, '_pp_product_download_url', true ) ? get_post_meta( $download_id, '_pp_product_download_url', true ) : '';
	
	// overrides any variable/ multi priced options
	if ( $external_download_url ) { 
		// if a download has an external download URL, and is free
		$text = '0' == edd_get_download_price( $download_id ) ? __( 'Free Download', 'pp' ) : __( 'Purchase', 'pp' );
	?>

	<?php
		echo pp_edd_external_variable_pricing( $download_id );
	?>

	<div class="edd_download_purchase_form">
		<a href="<?php echo esc_url( $external_download_url ); ?>" class="button external large wide" target="_blank">
			<span><?php echo $text; ?></span>
			<svg width="17px" height="16px">
				<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-external'; ?>"></use>
			</svg>
		</a>
	</div>

	<?php }

	// normal downloads, don't show price on button
	else {
		echo pp_get_purchase_link( array( 'class' => 'large', 'price' => false ) );
	}

}

/**
 * External variable pricing options
 */
function pp_edd_external_variable_pricing( $download_id = 0 ) {
	global $edd_options;

	$variable_pricing = edd_has_variable_prices( $download_id );

	if ( ! $variable_pricing )
		return;

	$prices = apply_filters( 'edd_purchase_variable_prices', edd_get_variable_prices( $download_id ), $download_id );

	?>
	<div class="edd_price_options">
		<ul>
			<?php
			if ( $prices ) :
				foreach ( $prices as $key => $price ) :
					echo '<li id="edd_price_option_' . $download_id . '_' . sanitize_key( $price['name'] ) . '" itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
					printf(
						'<span class="label %1$s">%2$s</span>',
						esc_attr( 'edd_price_option_' . $download_id . '_' . $key ), // label
						
						apply_filters( 'pp_vpd', $price )
						
					);
					
					echo '</li>';
				endforeach;
			endif;
			
			?>
		</ul>
	</div>
<?php
}
remove_action( 'edd_after_price_option', 'edd_vpd_output_description', 10, 3 );

/**
 * Outputs the description
 * @since 1.0.2
 */
function pp_vpd_output_description( $price ) {
//	var_dump( $price );

//	'<span class="edd_price_option_name" itemprop="description">' . esc_html( $price['name'] ) . '</span><span class="edd_price_option_price" itemprop="price">' . edd_currency_filter( edd_format_amount( $price[ 'amount' ] ) ) . '</span>'
	ob_start();
	?>
	<span class="edd_price_option_name" itemprop="description">
	<?php 
		echo esc_html( $price['name'] ) . '<span>' . esc_html( $price['description'] ) . '</span>';
	?>
	</span>


	<span class="edd_price_option_price" itemprop="price">
		<?php echo edd_currency_filter( edd_format_amount( $price[ 'amount' ] ) ); ?>
	</span>


	<?php
	return ob_get_clean();
}

add_filter( 'pp_vpd', 'pp_vpd_output_description', 10, 1 );

// add_action( 'edd_after_price_option', 'pp_vpd_output_description', 10, 3 );


/**
 * Custom variable pricing options
 */
function pp_edd_purchase_variable_pricing( $download_id = 0 ) {
	global $edd_options;

	$variable_pricing = edd_has_variable_prices( $download_id );

	if ( ! $variable_pricing )
		return;

	$prices = apply_filters( 'edd_purchase_variable_prices', edd_get_variable_prices( $download_id ), $download_id );

	$type   = edd_single_price_option_mode( $download_id ) ? 'checkbox' : 'radio';

	do_action( 'edd_before_price_options', $download_id ); ?>
	<div class="edd_price_options">
		<ul>
			<?php
			if ( $prices ) :
				foreach ( $prices as $key => $price ) :
					echo '<li id="edd_price_option_' . $download_id . '_' . sanitize_key( $price['name'] ) . '" itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
					printf(
						'<label for="%3$s"><input type="%2$s" %1$s name="edd_options[price_id][]" id="%3$s" class="%4$s" value="%5$s" %7$s/> <span class="price-label">%6$s</span></label>',
						checked( apply_filters( 'edd_price_option_checked', 0, $download_id, $key ), $key, false ),
						$type,
						esc_attr( 'edd_price_option_' . $download_id . '_' . $key ),
						esc_attr( 'edd_price_option_' . $download_id ),
						esc_attr( $key ),
						'<span class="edd_price_option_name" itemprop="description">' . esc_html( $price['name'] ) . '</span><span class="edd_price_option_sep">&nbsp;&ndash;&nbsp;</span><span class="edd_price_option_price" itemprop="price">' . edd_currency_filter( edd_format_amount( $price[ 'amount' ] ) ) . '</span>',
						checked( isset( $_GET['price_option'] ), $key, false ),
						do_action( 'edd_after_price_option', $key, $price, $download_id )
					);
					
					echo '</li>';
				endforeach;
			endif;
			do_action( 'edd_after_price_options_list', $download_id, $prices, $type );
			?>
		</ul>
	</div><!--end .edd_price_options-->
<?php
	do_action( 'edd_after_price_options', $download_id );
}
remove_action( 'edd_purchase_link_top', 'edd_purchase_variable_pricing', 10 );
add_action( 'edd_purchase_link_top', 'pp_edd_purchase_variable_pricing', 10 );



/**
 * Show the amount of downloads in the cart with an icon
 *
 * @since 1.0
 */
function pp_show_cart_quantity_icon() {
	global $edd_options;

	$class    = ! ( function_exists('edd_get_cart_contents') && edd_get_cart_contents() ) ? ' hidden' : '';
	$quantity = ( function_exists('edd_get_cart_quantity') && edd_get_cart_quantity() == 1 ) ? ' item' : ' items';

?>
	<a href="<?php echo esc_url( edd_get_checkout_uri() ); ?>" class="menu-icon cart<?php echo $class; ?>" title="You have <?php echo edd_get_cart_quantity() . $quantity; ?> ready for purchase">
		<div class="bag">
			<span class="edd-cart-quantity"><?php echo edd_get_cart_quantity(); ?></span>
			<img class="checkout" src="<?php echo get_stylesheet_directory_uri() . '/images/arrow-right.svg'; ?> " />
		</div>
	</a>
<?php }



/**
 * Easy Digital Downloads - update the cart quantity with "Item" or "Items" when the ajax call is fired
 */
function pp_edd_quantity_updated_js() {
	?>
<script>
	jQuery(document).ready(function($) {
		$('body').on('edd_quantity_updated', function( response ) {
 
            $('#masthead .cart').each(function() {
            	var quantity = parseInt($(this).text(), 10);
 
            	if ( quantity == 1 ) {
            		text = 'You have ' + quantity + ' item ready for purchase';
            	} else {
            		text = 'You have ' + quantity + ' items ready for purchase';
            	}

            	$(this).attr('title', text);
            });
		});
	});
</script>
<?php }
add_action( 'wp_footer', 'pp_edd_quantity_updated_js' );


/**
 * Renders the credit card info form.
 * Based on the edd_get_cc_form() function
 * 
 */
function pp_get_cc_form() {
	ob_start(); ?>

	<?php do_action( 'edd_before_cc_fields' ); ?>

	<fieldset id="edd_cc_fields" class="edd-do-validate">
		<span>
			<legend><?php _e( 'Credit Card Info', 'edd' ); ?></legend>
		</span>
		<?php if( is_ssl() ) : ?>
			<div id="edd_secure_site_wrapper">
				<svg width="48px" height="64px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-padlock'; ?>"></use>
				</svg>
				<span><?php _e( 'This is a secure SSL encrypted payment.', 'edd' ); ?></span>
			</div>
		<?php endif; ?>
		<p id="edd-card-number-wrap">
			<label for="card_number" class="edd-label">
				<?php _e( 'Card Number', 'edd' ); ?>
				<span class="edd-required-indicator">*</span>
				<span class="card-type"></span>
			</label>
			<span class="edd-description"><?php _e( 'The (typically) 16 digits on the front of your credit card.', 'edd' ); ?></span>
			<input type="text" autocomplete="off" name="card_number" id="card_number" class="card-number edd-input required" placeholder="<?php _e( 'Card number', 'edd' ); ?>" />
		</p>
		<p id="edd-card-cvc-wrap">
			<label for="card_cvc" class="edd-label">
				<?php _e( 'CVC', 'edd' ); ?>
				<span class="edd-required-indicator">*</span>
			</label>
			<span class="edd-description"><?php _e( 'The 3 digit (back) or 4 digit (front) value on your card.', 'edd' ); ?></span>
			<input type="text" size="4" autocomplete="off" name="card_cvc" id="card_cvc" class="card-cvc edd-input required" placeholder="<?php _e( 'Security code', 'edd' ); ?>" />
		</p>
		<p id="edd-card-name-wrap">
			<label for="card_name" class="edd-label">
				<?php _e( 'Name on the Card', 'edd' ); ?>
				<span class="edd-required-indicator">*</span>
			</label>
			<span class="edd-description"><?php _e( 'The name printed on the front of your credit card.', 'edd' ); ?></span>
			<input type="text" autocomplete="off" name="card_name" id="card_name" class="card-name edd-input required" placeholder="<?php _e( 'Card name', 'edd' ); ?>" />
		</p>
		<?php do_action( 'edd_before_cc_expiration' ); ?>
		<p class="card-expiration">
			<label for="card_exp_month" class="edd-label">
				<?php _e( 'Expiration (MM/YY)', 'edd' ); ?>
				<span class="edd-required-indicator">*</span>
			</label>
			<span class="edd-description"><?php _e( 'The date your credit card expires, typically on the front of the card.', 'edd' ); ?></span>
			<select id="card_exp_month" name="card_exp_month" class="card-expiry-month edd-select edd-select-small required">
				<?php for( $i = 1; $i <= 12; $i++ ) { echo '<option value="' . $i . '">' . sprintf ('%02d', $i ) . '</option>'; } ?>
			</select>
			<span class="exp-divider"> / </span>
			<select id="card_exp_year" name="card_exp_year" class="card-expiry-year edd-select edd-select-small required">
				<?php for( $i = date('Y'); $i <= date('Y') + 10; $i++ ) { echo '<option value="' . $i . '">' . substr( $i, 2 ) . '</option>'; } ?>
			</select>
		</p>
		<?php do_action( 'edd_after_cc_expiration' ); ?>

	</fieldset>
	<?php
	do_action( 'edd_after_cc_fields' );

	echo ob_get_clean();
}
remove_action( 'edd_cc_form', 'edd_get_cc_form' );
add_action( 'edd_cc_form', 'pp_get_cc_form' );






















/**
 * Redirect to pricing page when cart at checkout is empty.
 * @return void
 */
function affwp_empty_cart_redirect() {
	$cart     = function_exists( 'edd_get_cart_contents' ) ? edd_get_cart_contents() : false;
	$redirect = site_url( 'products' );
 
	if ( function_exists( 'edd_is_checkout' ) && edd_is_checkout() && ! $cart ) {
		wp_redirect( $redirect, 301 ); 
		exit;
	}
}
add_action( 'template_redirect', 'affwp_empty_cart_redirect' );

/**
 * Get's the customer's first name from purchase session
 * @return [type] [description]
 */
function affwp_edd_purchase_get_first_name() {
	// get purchase session
	$purchase_session = edd_get_purchase_session();

	// get the key
	$purchase_key = $purchase_session['purchase_key'];

	// get the payment ID from the purchase key
	$payment_id = edd_get_purchase_id_by_key( $purchase_key );

	$user_info = edd_get_payment_meta_user_info( $payment_id );
	$first_name = $user_info['first_name'];

	if ( $first_name )
		return $first_name;

	return null;
}

/**
 * Thank the customer for purchasing
 */
function affwp_edd_thank_customer() {
	if ( function_exists( 'edd_is_success_page' ) && ! edd_is_success_page() )
		return;

	$message = '<h2>Your purchase was successful</h2>';
	
	if ( $message )
		return $message;

	return null;
}



/**
 * Add-on info box
 *
 * @since  1.1.9
 */
function pp_product_info( $position = '' ) {
	$post                = get_post ( get_the_ID() );
	$is_edd              = 'Easy Digital Downloads' == $post->post_title ? true : false;
	$updated             = intval ( get_post_meta( get_the_ID(), '_pp_product_last_updated', true ) );
	$pp_show_plugin_info = function_exists( 'pp_show_plugin_info' ) ? pp_show_plugin_info() : '';
	$slug                = 'easy-digital-downloads';
	$rating              = $pp_show_plugin_info ? $pp_show_plugin_info->get_info( $slug, 'rating' ) / 20 : '';
	$num_ratings         = $pp_show_plugin_info ? $pp_show_plugin_info->get_info( $slug, 'num_ratings' ) : '';
	$downloads           = $pp_show_plugin_info ? number_format( $pp_show_plugin_info->get_info( $slug, 'downloaded' ) ) : '';
	$released            = $is_edd && $pp_show_plugin_info ? $pp_show_plugin_info->get_info( $slug, 'added' ) : get_the_date();
	$version             = $is_edd && $pp_show_plugin_info ? $pp_show_plugin_info->get_info( $slug, 'version' ) : get_post_meta( get_the_ID(), '_edd_sl_version', true );

	$changelog = stripslashes( wpautop( get_post_meta( get_the_ID(), '_edd_sl_changelog', true ), true ) );
					
?>
	<aside class="box product-info<?php if ( $position ) { echo ' ' . $position; } ?>">	

		<?php if ( $version ) : ?>
			<p><span>Version</span> v<?php echo esc_attr( $version ); ?>
				<?php if ( $changelog ) : ?>
					<br /><a href="#changelog" class="popup-content" data-effect="mfp-move-from-bottom">View changelog</a>

					<div id="changelog" class="popup entry-content mfp-with-anim mfp-hide">
				    	<h1>Changelog</h1>
				    	<?php echo $changelog; ?>
				    </div>

				<?php endif; ?>
			</p>
		<?php endif; ?>	
		

		<?php
			// external doc url
			$external_doc_url = get_post_meta( get_the_ID(), '_pp_product_doc_url', true );
			
			$doc_term_id      = get_post_meta( get_the_ID(), '_pp_product_doc_term_id', true );
			$doc_url          = get_term_link( (int) $doc_term_id, 'doc_category' );

			if ( ! is_wp_error( $doc_url ) ) {
				$documentation_url = esc_url( $doc_url );
				$external = '';
		    } elseif ( $external_doc_url ) {
				$documentation_url = esc_url( $external_doc_url );
				$external = ' target="blank"';
			} else {
				$documentation_url = '';
				$external = '';
			}

			if ( $documentation_url ) : 
		?>
		<p>
			<span>Documentation</span>
			<a href="<?php echo $documentation_url; ?>" <?php echo $external; ?>>View Documentation</a>
		</p>
		<?php endif; ?>

		<?php if ( $released ) : ?>
			<p><span>Released </span><?php echo esc_attr( $released ); ?></p>
		<?php endif; ?>

		<?php 
		/**
		 * EDD Specific
		 */
		if ( $is_edd && $pp_show_plugin_info ) : ?>
		<p><span>Downloads </span><?php echo $downloads; ?></p>

		<p><span>Rating </span><?php echo $rating; ?> / 5 from <?php echo $num_ratings; ?> reviews</p>
		<?php endif; ?>

		<?php if ( $updated ) : ?>
		<p><span>Last Updated</span><?php echo date( 'F j, Y', $updated ); ?></p>
		<?php endif; ?>

		
			
		
		

	</aside>
	<?php
}



/**
 * Shows the final purchase total at the bottom of the checkout page
 *
 * @since 1.5
 * @return void
 */
function pp_edd_checkout_final_total() {
?>
<p id="edd_final_total_wrap">
	<?php _e( 'Purchase Total:', 'edd' ); ?>
	<span class="edd_cart_amount" data-subtotal="<?php echo edd_get_cart_subtotal(); ?>" data-total="<?php echo edd_get_cart_subtotal(); ?>">
		<?php edd_cart_total(); ?>
	</span>
</p>
<?php
}
remove_action( 'edd_purchase_form_before_submit', 'edd_checkout_final_total', 999 );
add_action( 'edd_purchase_form_before_submit', 'pp_edd_checkout_final_total', 999 );
/**
 * Software licensing
 * @return [type] [description]
 */
function pp_edd_sl_renewal_form2() {

	if( ! edd_sl_renewals_allowed() )
		return;

	$renewal     = EDD()->session->get( 'edd_is_renewal' );
	$renewal_key = EDD()->session->get( 'edd_renewal_key' );
	$preset_key  = ! empty( $_GET['key'] ) ? urldecode( $_GET['key'] ) : '';

	ob_start(); ?>
	

	<form method="post" id="edd_sl_renewal_form">
		<fieldset id="edd_sl_renewal_fields">
			<?php if( empty( $renewal ) || empty( $renewal_key ) ) : ?>

			<p id="edd_sl_show_renewal_form_wrap">
				<a href="#" id="edd_sl_show_renewal_form">
					<svg width="32" height="32">
					   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-renew'; ?>"></use>
					</svg>
					<?php _e( 'Renewing a License Key?', 'edd_sl' ); ?>
				</a>
			</p>

			<p id="edd-license-key-container-wrap" style="display:none;">
				<span class="edd-description"><?php _e( 'Enter the license key you wish to renew. Leave blank to purchase a new one.', 'edd_sl' ); ?></span>
					

			<span class="input-wrap">
				<input class="edd-input required" type="text" name="edd_license_key" placeholder="<?php _e( 'Enter your license key', 'edd_sl' ); ?>" id="edd-license-key" value="<?php echo $preset_key; ?>"/>
				<input type="submit" class="edd-submit button edd-renew-license" value="<?php _e( 'Renew', 'edd_sl' ); ?>" />
			</span>

				<input type="hidden" name="edd_action" value="apply_license_renewal"/>

			</p>

			<?php else : ?>
			<div id="edd-license-key-container-wrap">
				<p id="edd-license-key-wrap">
					<label class="edd-label" for="edd-license-key"><?php _e( 'License Key Being Renewed', 'edd_sl' ); ?></label>
					<span class="edd-renewing-key"><?php echo $renewal_key; ?></span>
				</p>
				<p id="edd-license-key-submit">
					<input type="hidden" name="edd_action" value="cancel_license_renewal"/>
					<input type="submit" class="edd-submit button" value="<?php _e( 'Cancel License Renewal', 'edd_sl' ); ?>"/>
				</p>
			</div>
			<?php endif; ?>
		</fieldset>
	</form>
	<?php
	echo ob_get_clean();
}
//remove_action( 'edd_before_purchase_form', 'edd_sl_renewal_form', -1 );
//add_action( 'edd_before_purchase_form', 'pp_edd_sl_renewal_form2', -1 );

//add_action( 'edd_before_purchase_form', 'pp_edd_sl_renewal_form', -1 );
function pp_edd_sl_renewal_form() {

	if( ! edd_sl_renewals_allowed() )
		return;

	$renewal      = EDD()->session->get( 'edd_is_renewal' );
	$renewal_keys = EDD()->session->get( 'edd_renewal_keys' );
	$preset_key   = ! empty( $_GET['key'] ) ? urldecode( $_GET['key'] ) : '';
	$error        = ! empty( $_GET['edd-sl-error'] ) ? absint( $_GET['edd-sl-error'] ) : '';
	$color        = edd_get_option( 'checkout_color', 'blue' );
	$color        = ( $color == 'inherit' ) ? '' : $color;
	$style        = edd_get_option( 'button_style', 'button' );
	ob_start(); ?>
	<form method="post" id="edd_sl_renewal_form">
		<fieldset id="edd_sl_renewal_fields">
			<p id="edd_sl_show_renewal_form_wrap">
				<?php _e( 'Renewing a license key? <a href="#" id="edd_sl_show_renewal_form">Click to renew an existing license</a>', 'edd_sl' ); ?>
			</p>
			<p id="edd-license-key-container-wrap" class="edd-cart-adjustment" style="display:none;">
				<span class="edd-description"><?php _e( 'Enter the license key you wish to renew. Leave blank to purchase a new one.', 'edd_sl' ); ?></span>
				<input class="edd-input required" type="text" name="edd_license_key" autocomplete="off" placeholder="<?php _e( 'Enter your license key', 'edd_sl' ); ?>" id="edd-license-key" value="<?php echo $preset_key; ?>"/>
				<a href="#" id="edd-cancel-license-renewal"><?php _e( 'Cancel', 'edd_sl' ); ?></a>
				<input type="hidden" name="edd_action" value="apply_license_renewal"/>
				<input type="submit" class="edd-submit button <?php echo $color . ' ' . $style; ?>" value="<?php _e( 'Apply License Renewal', 'edd_sl' ); ?>"/>
			</p>

			<?php if( ! empty( $renewal ) && ! empty( $renewal_keys ) ) : ?>
				<p id="edd-license-key-container-wrap" class="edd-cart-adjustment">
					<label class="edd-label" for="edd-license-key">
						<?php _e( 'License keys being renewed:', 'edd_sl' ); ?>
					</label>
					<?php foreach( $renewal_keys as $key ) :

					$license_id = edd_software_licensing()->get_license_by_key( $key );
					$download_id = get_post_meta( $license_id, '_edd_sl_download_id', true );
					?>
						<span class="edd-renewing-key-title"><?php echo get_the_title( $download_id ); ?></span>
						<span class="edd-renewing-key-sep">&nbsp;&ndash;&nbsp;</span>
						<span class="edd-renewing-key"><?php echo $key; ?></span><br/>
					<?php endforeach; ?>
					<span class="edd-description"><?php _e( 'You may renew multiple license keys at once.', 'edd_sl' ); ?></span>
				</p>
			<?php endif; ?>
		</fieldset>
		<?php if( ! empty( $error ) ) :
			switch( $error ) :

				case 1 :
					$message = __( 'That license key appears to be invalid.', 'edd_sl' );
					break;

			endswitch;
			?>
			<div class="edd_errors">
				<p class="edd_error"><?php echo $message; ?></p>
			</div>
		<?php endif; ?>
	</form>
	<?php if( ! empty( $renewal ) && ! empty( $renewal_keys ) ) : ?>
	<form method="post" id="edd_sl_cancel_renewal_form">
		<p>
			<input type="hidden" name="edd_action" value="cancel_license_renewal"/>
			<input type="submit" class="edd-submit button" value="<?php _e( 'Cancel License Renewal', 'edd_sl' ); ?>"/>
		</p>
	</form>
	<?php
	endif;
	echo ob_get_clean();
}





/**
 * EDD discount field
*/
function pp_edd_discount_field() {

	if( isset( $_GET['payment-mode'] ) && edd_is_ajax_disabled() ) {
		return; // Only show before a payment method has been selected if ajax is disabled
	}

	if ( edd_has_active_discounts() && edd_get_cart_total() ) :

		$color = edd_get_option( 'checkout_color', 'blue' );
		$color = ( $color == 'inherit' ) ? '' : $color;
		$style = edd_get_option( 'button_style', 'button' );
?>
		<fieldset id="edd_discount_code">
			
			<p id="edd-show-discount">
				<a href="#" class="edd-discount-link">
					<svg width="32" height="32">
					   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-discount'; ?>"></use>
					</svg>
					<?php echo _x( 'Have a discount code?', 'Entering a discount code', 'edd' ); ?>
				</a>
			</p>

			<p id="edd-discount-code-wrap">
				<label class="edd-label" for="edd-discount">
					<img src="<?php echo EDD_PLUGIN_URL; ?>assets/images/loading.gif" id="edd-discount-loader" style="display:none;"/>
				</label>
				<span class="edd-description"><?php _e( 'Enter a coupon code if you have one.', 'edd' ); ?></span>

				<span class="input-wrap">
					<input class="edd-input" type="text" id="edd-discount" name="edd-discount" placeholder="<?php _e( 'Enter discount', 'edd' ); ?>"/>
					<input type="submit" class="edd-apply-discount edd-submit button <?php echo $color . ' ' . $style; ?>" value="<?php echo _x( 'Apply', 'Apply discount at checkout', 'edd' ); ?>"/>
				</span>

				
				
				<span id="edd-discount-error-wrap" class="edd_errors" style="display:none;"></span>
			</p>

		</fieldset>
<?php
	endif;
}
remove_action( 'edd_checkout_form_top', 'edd_discount_field', -1 );
add_action( 'edd_checkout_form_top', 'pp_edd_discount_field', -1 );

/**
 * Discount remove icon
 */
function pp_edd_get_cart_discounts_html( $html, $discounts, $rate, $remove_url ) {
	if ( ! $discounts ) {
		$discounts = edd_get_cart_discounts();
	}

	if ( ! $discounts ) {
		return;
	}

	 $html = '';

	 foreach ( $discounts as $discount ) {
	 	$discount_id  = edd_get_discount_id_by_code( $discount );
	 	$rate         = edd_format_discount_rate( edd_get_discount_type( $discount_id ), edd_get_discount_amount( $discount_id ) );

		$remove_url   = add_query_arg(
			array(
				'edd_action'    => 'remove_cart_discount',
				'discount_id'   => $discount_id,
				'discount_code' => $discount
			),
			edd_get_checkout_uri()
		);

		$svg = '<svg width="16" height="16" viewBox="0 0 16 16"><use xlink:href="'. get_stylesheet_directory_uri() . "/images/svg-defs.svg#icon-remove" . '"></use></svg>';

		$html .= "<span class=\"edd_discount\">\n";
			$html .= "<span class=\"edd_discount_rate\">$discount&nbsp;&ndash;&nbsp;$rate</span>\n";
			$html .= "<a href=\"$remove_url\" data-code=\"$discount\" class=\"edd_discount_remove\">$svg</a>\n";
		$html .= "</span>\n";
	 }

	return $html;
}
add_filter( 'edd_get_cart_discounts_html', 'pp_edd_get_cart_discounts_html', 10, 4 );

/**
 * Load jQuery chosen on the checkout and contact page
 */
function pp_edd_load_scripts( $hook ) {
	
	if ( ! ( function_exists('edd_is_checkout') && edd_is_checkout() || is_page( 'contact' ) ) ) {
		return;
	}

	$js_dir  = EDD_PLUGIN_URL . 'assets/js/';
	$css_dir = EDD_PLUGIN_URL . 'assets/css/';

	// Use minified libraries if SCRIPT_DEBUG is turned off
	$suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'jquery-chosen', $css_dir . 'chosen' . $suffix . '.css', array(), EDD_VERSION );
	wp_enqueue_script( 'jquery-chosen', $js_dir . 'chosen.jquery' . $suffix . '.js', array( 'jquery' ), EDD_VERSION );
	
}
add_action( 'wp_enqueue_scripts', 'pp_edd_load_scripts', 100 );
