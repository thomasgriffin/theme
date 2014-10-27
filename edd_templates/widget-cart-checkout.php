<li class="cart_item edd_subtotal">
	
	<span>
		<?php echo __( 'Subtotal:', 'edd' ); ?>

		<span class="price">
		<?php echo edd_currency_filter( edd_format_amount( edd_get_cart_subtotal() ) ); ?>
		</span>
	</span>
	
	<a href="<?php echo edd_get_checkout_uri(); ?>" class="button"><?php _e( 'Checkout', 'edd' ); ?></a>
</li>