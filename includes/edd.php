<?php
/**
 * EDD Modifications
 */

/**
 * Remove and deactivate all styling included with EDD. Theme uses unique styling
 *
 * @since 1.0
 */
remove_action( 'wp_enqueue_scripts', 'edd_register_styles' );


/**
 * Custom Purchase button
 *
 * @since 1.0
 */
function pp_get_purchase_link( $download_id ) { 

	$external_purchase_url = ( get_post_meta( $download_id, '_pp_product_download_url', true ) ) ? get_post_meta( $download_id, '_pp_product_download_url', true ) : '';

	// overrides any variable/ multi priced options
	if ( $external_purchase_url ) { ?>

	<div class="edd_download_purchase_form">
		<a href="<?php echo esc_url( $external_purchase_url ); ?>" class="button external" target="_blank">
			<span><?php _e( 'Purchase', 'pp' ); ?></span>
			<svg width="17px" height="16px">
				<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-external'; ?>"></use>
			</svg>
		</a>
	</div>

	<?php }

		// it's a free download ($0.00) so we don't want the button to say 'buy' or 'purchase'
		elseif( '0' == edd_get_download_price( get_the_ID() ) && !edd_has_variable_prices( get_the_ID() ) ) {
			echo edd_get_purchase_link( array( 'class' => 'large primary', 'price' => false, 'text' => __( 'Add to', 'pp' ) ) );
		}
		// variable priced downloads
		elseif( edd_has_variable_prices( get_the_ID() ) ) {
			echo edd_get_purchase_link( array( 'class' => 'large primary' ) );
		}
		// normal downloads, don't show price on button
		else {
			echo edd_get_purchase_link( array( 'class' => 'large primary', 'price' => false ) );
		}

	?>

	<?php }


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
						'<label for="%3$s"><input type="%2$s" %1$s name="edd_options[price_id][]" id="%3$s" class="%4$s" value="%5$s" %7$s/> <span class="label">%6$s</span></label>',
						checked( apply_filters( 'edd_price_option_checked', 0, $download_id, $key ), $key, false ),
						$type,
						esc_attr( 'edd_price_option_' . $download_id . '_' . $key ),
						esc_attr( 'edd_price_option_' . $download_id ),
						esc_attr( $key ),
						'<span class="edd_price_option_name" itemprop="description">' . esc_html( $price['name'] ) . '</span><span class="edd_price_option_sep">&nbsp;&ndash;&nbsp;</span><span class="edd_price_option_price" itemprop="price">' . edd_currency_filter( edd_format_amount( $price[ 'amount' ] ) ) . '</span>',
						checked( isset( $_GET['price_option'] ), $key, false )
					);
					do_action( 'edd_after_price_option', $key, $price, $download_id );
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

	$class    = ! edd_get_cart_contents() ? ' hidden' : '';
	$quantity = edd_get_cart_quantity() == 1 ? ' item' : ' items';

?>
	<a href="<?php echo esc_url( edd_get_checkout_uri() ); ?>" class="cart<?php echo $class; ?>" title="You have <?php echo edd_get_cart_quantity() . $quantity; ?> ready for purchase">
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
 * Change labels
 */
function affwp_edd_default_downloads_name( $defaults ) {

	$defaults = array(
	   'singular' => __( 'Add-on', 'affwp' ),
	   'plural' => __( 'Add-ons', 'affwp')
	);

	return $defaults;
}
//add_filter( 'edd_default_downloads_name', 'affwp_edd_default_downloads_name' );

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
function affwp_add_on_info( $position = '' ) {
	$version               = get_post_meta( get_the_ID(), '_edd_sl_version', true );
	$requires              = get_post_meta( get_the_ID(), '_affwp_addon_requires', true );
	$released              = get_the_date();
	$updated               = intval ( get_post_meta( get_the_ID(), '_affwp_addon_last_updated', true ) );
	$edd_version_required  = get_post_meta( get_the_ID(), '_affwp_addon_edd_version_required', true );
	$external_download_url = get_post_meta( get_the_ID(), '_affwp_addon_download_url', true );
	$developer             = get_post_meta( get_the_ID(), '_affwp_addon_developer', true );
	$developer_url         = get_post_meta( get_the_ID(), '_affwp_addon_developer_url', true );
?>
	<aside class="add-on-info<?php echo ' ' . $position; ?>">
		
		<?php if ( $version ) : ?>
			<p><span>Version</span> v<?php echo esc_attr( $version ); ?></p>
		<?php endif; ?>	

		<?php if ( $requires ) : ?>
			<p><span>Requires AffiliateWP</span> v<?php echo esc_attr( $requires ); ?></p>
		<?php endif; ?>

		<?php if ( $edd_version_required ) : ?>
			<p><span>Requires <a title="Easy Digital Downloads" target="_blank" href="http://easydigitaldownloads.com">Easy Digital Downloads</a></span> v<?php echo esc_attr( $edd_version_required ); ?></p>
		<?php endif; ?>

		<?php if ( $released ) : ?>
			<p><span>Released </span><?php echo esc_attr( $released ); ?></p>
		<?php endif; ?>

		<?php if ( $updated ) : ?>
		<p><span>Last Updated</span><?php echo date( 'F j, Y', $updated ); ?></p>
		<?php endif; ?>
		
		<?php if ( $developer ) : ?>

			<?php if ( $developer_url ) : ?>
				<p><span>Developer </span><a href="<?php echo esc_url( $developer_url ); ?>" title="<?php echo esc_attr( $developer ); ?>" target="_blank"><?php echo esc_attr( $developer ); ?></a></p>
			
			<?php else : ?>
				<p><span>Developer </span><?php echo esc_attr( $developer ); ?></p>
			<?php endif; ?>

		<?php endif; ?>



		<?php if ( $external_download_url ) : ?>
			<a title="Download Now" target="_blank" href="<?php echo esc_url( $external_download_url ); ?>" class="button">Download Now</a>
		<?php endif; ?>


		
		
		

	</aside>
	<?php
}