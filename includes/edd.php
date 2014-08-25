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
	$redirect = site_url('products');
 
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
add_filter( 'edd_default_downloads_name', 'affwp_edd_default_downloads_name' );

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
 * Processes the license upgrade
 */
function affwp_process_license_upgrade() {

	// get type. business or developer
	$type = isset( $_GET['type'] ) ? $_GET['type'] : '';

	if ( ! is_user_logged_in() || ! ( 'business' == $type || 'developer' == $type ) ) {
		// Isn't logged in, so go back to pricing
		wp_redirect( home_url( '/pricing' ) ); exit;
	}

	$affwp_id = affwp_get_affiliatewp_id();

	switch ( $type ) {

		case 'developer':
			// user has developer license already
			if ( edd_has_user_purchased( get_current_user_id(), $affwp_id, 2 ) ) {
				wp_die( 'You already have a Developer\'s license', '', array( 'back_link' => true ) );
			} 
			elseif ( edd_has_user_purchased( get_current_user_id(), $affwp_id, 1 ) ) {
				// Has a business license
				$discount = 99;
			} 
			elseif ( edd_has_user_purchased( get_current_user_id(), $affwp_id ) ) {
				// Has a personal license
				$discount = 49;
			} 
			else {
				// Hasn't purchased, so go back to pricing
				wp_redirect( home_url( '/pricing' ) ); exit;
			}

			$price_id = 2;

			break;

		case 'business':
			// user has developer license already
			if ( edd_has_user_purchased( get_current_user_id(), $affwp_id, 1 ) ) {
				wp_die( 'You already have a Business license', '', array( 'back_link' => true ) );
			} 
			elseif ( edd_has_user_purchased( get_current_user_id(), $affwp_id, 0 ) ) {
				// Has a personal license
				$discount = 49;
			}
			else {
				// Hasn't purchased, so go back to pricing
				wp_redirect( home_url( '/pricing' ) ); exit;
			}

			$price_id = 1;

			break;

	} // end switch

	// Remove anything in the cart
	edd_empty_cart();

	// Add the correct license
	edd_add_to_cart( $affwp_id, array( 'price_id' => $price_id ) );

	EDD()->fees->add_fee( $discount * -1, 'License Upgrade Discount' );
	//EDD()->session->set( 'is_upgrade', '1' );

	wp_redirect( edd_get_checkout_uri() ); exit;

}
add_action( 'edd_upgrade_affwp_license', 'affwp_process_license_upgrade' );

/**
 * Process add-on Downloads
 *
 * Handles the file download process for add-ons.
 *
 * @access      private
 * @since       1.1
 * @return      void
 */
function affwp_process_add_on_download() {

	if( ! isset( $_GET['add_on'] ) ) {
		return;
	}

	if( ! is_user_logged_in() ) {
		return;
	}

	$add_on   = absint( $_GET['add_on'] );

	if( 'download' != get_post_type( $add_on ) ) {
		return;
	}

	$affwp_id = affwp_get_affiliatewp_id();

	if( ! edd_has_user_purchased( get_current_user_id(), $affwp_id, 2 ) ) {
		wp_die( 'You need to have a Developer\'s license key to download this add-on' );
	}

	$user_info = array();
	$user_data 			= get_userdata( get_current_user_id() );
	$user_info['email'] = $user_data->user_email;
	$user_info['id'] 	= $user_data->ID;
	$user_info['name'] 	= $user_data->display_name;

	edd_record_download_in_log( $add_on, 0, $user_info, edd_get_ip(), 0, 0 );

	$download_files = edd_get_download_files( $add_on );
	$requested_file = $download_files[0]['file'];
	$file_extension = edd_get_file_extension( $requested_file );
	$ctype          = edd_get_file_ctype( $file_extension );

	if ( ! edd_is_func_disabled( 'set_time_limit' ) && !ini_get('safe_mode') ) {
		set_time_limit(0);
	}
	if ( function_exists( 'get_magic_quotes_runtime' ) && get_magic_quotes_runtime() ) {
		set_magic_quotes_runtime(0);
	}

	@session_write_close();
	if( function_exists( 'apache_setenv' ) ) @apache_setenv('no-gzip', 1);
	@ini_set( 'zlib.output_compression', 'Off' );

	nocache_headers();
	header("Robots: none");
	header("Content-Type: " . $ctype . "");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=\"" . basename( $requested_file ) . "\"");
	header("Content-Transfer-Encoding: binary");

	$method = edd_get_file_download_method();
	if( 'x_sendfile' == $method && ( ! function_exists( 'apache_get_modules' ) || ! in_array( 'mod_xsendfile', apache_get_modules() ) ) ) {
		// If X-Sendfile is selected but is not supported, fallback to Direct
		$method = 'direct';
	}

	switch( $method ) :

		case 'redirect' :

			// Redirect straight to the file
			header( "Location: " . $requested_file );
			break;

		case 'direct' :
		default:

			$direct       = false;
			$file_details = parse_url( $requested_file );
			$schemes      = array( 'http', 'https' ); // Direct URL schemes
			if ( ( ! isset( $file_details['scheme'] ) || ! in_array( $file_details['scheme'], $schemes ) ) && isset( $file_details['path'] ) && file_exists( $requested_file ) ) {

				/** This is an absolute path */
				$direct    = true;
				$file_path = $requested_file;

			} else if( defined( 'UPLOADS' ) && strpos( $requested_file, UPLOADS ) !== false ) {

				/** 
				 * This is a local file given by URL so we need to figure out the path
				 * UPLOADS is always relative to ABSPATH
				 * site_url() is the URL to where WordPress is installed
				 */
				$file_path  = str_replace( site_url(), '', $requested_file );
				$file_path  = realpath( ABSPATH . $file_path );
				$direct     = true;
				
			} else if( strpos( $requested_file, WP_CONTENT_URL ) !== false ) {

				/** This is a local file given by URL so we need to figure out the path */
				$file_path  = str_replace( WP_CONTENT_URL, WP_CONTENT_DIR, $requested_file );
				$file_path  = realpath( $file_path );
				$direct     = true;

			}

			// Now deliver the file based on the kind of software the server is running / has enabled
			if ( function_exists( 'apache_get_modules' ) && in_array( 'mod_xsendfile', apache_get_modules() ) ) {

				header("X-Sendfile: $file_path");

			} elseif ( stristr( getenv( 'SERVER_SOFTWARE' ), 'lighttpd' ) ) {

				header( "X-LIGHTTPD-send-file: $file_path" );

			} elseif ( stristr( getenv( 'SERVER_SOFTWARE' ), 'nginx' ) || stristr( getenv( 'SERVER_SOFTWARE' ), 'cherokee' ) ) {

				// We need a path relative to the domain
				$file_path = str_ireplace( $_SERVER[ 'DOCUMENT_ROOT' ], '', $file_path );
				header( "X-Accel-Redirect: /$file_path" );

			} else

			if( $direct ) {
				edd_deliver_download( $file_path );
			} else {
				// The file supplied does not have a discoverable absolute path
				header( "Location: " . $requested_file );
			}

			break;

	endswitch;

	edd_die();

	exit;
}
add_action( 'edd_add_on_download', 'affwp_process_add_on_download', 100 );

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


		<?php if ( has_term( 'developer-add-ons', 'download_category' ) ) : ?>

				<?php if ( is_user_logged_in() && edd_has_user_purchased( get_current_user_id(), array( affwp_get_affiliatewp_id() ), 2 ) ) : ?>

					<?php if ( edd_get_download_files( get_the_ID() ) ) : ?>
						<a title="Get this add-on" href="<?php echo affwp_get_add_on_download_url( get_the_ID() ); ?>" class="button">Download Now</a>
					<?php endif; ?>
				<?php
					// if the user is logged and has purchased a lower license, show a link to upgrade their license 
					elseif ( is_user_logged_in() && 
						edd_has_user_purchased( get_current_user_id(), array( affwp_get_affiliatewp_id() ), 0 )  ||
						edd_has_user_purchased( get_current_user_id(), array( affwp_get_affiliatewp_id() ), 1 ) )
				: ?>
					
					<a title="License Upgrade Required" href="<?php echo affwp_get_license_upgrade_url( 'developer' ); ?>" class="button">License Upgrade Required</a>
					<p>This add-on will become immediately available to you after you <a title="Upgrade Your License" href="<?php echo affwp_get_license_upgrade_url( 'developer' ); ?>">upgrade your license</a>.</p>
				<?php else : // user is logged in and has not purchased, or is logged out. Direct link to purchase dev license 
					$purchase_url = edd_get_checkout_uri() . '?edd_action=add_to_cart&amp;download_id=' . affwp_get_affiliatewp_id() .'&amp;edd_options[price_id]=2';
				?>
					
					<a title="Buy Developer License" class="button" href="<?php echo $purchase_url; ?>">Buy Developer License</a>
					<p>This add-on is only available to <a title="Developer License" href="<?php echo site_url( 'pricing' ); ?>">Developer License</a> holders</p>
				<?php endif; ?>

		<?php endif; ?>
		
		

	</aside>
	<?php
}