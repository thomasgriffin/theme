<?php
$cart_items    = edd_get_cart_contents();
$cart_quantity = edd_get_cart_quantity();
$display       = $cart_quantity > 0 ? '' : 'style="display:none;"';
?>

<?php if ( $cart_items ) : ?>
	<h2>Ready to purchase?</h2>
	<ul class="edd-cart">
		<?php foreach ( $cart_items as $key => $item ) : ?>
			<?php echo edd_get_cart_item_template( $key, $item, false ); ?>
		<?php endforeach; ?>

		<?php edd_get_template_part( 'widget', 'cart-checkout' ); ?>
	</ul>
<?php endif; ?>
