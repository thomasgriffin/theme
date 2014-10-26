<li class="edd-cart-item">


	<span>
		<span class="edd-cart-item-title">{item_title}</span>
		<span class="edd-cart-item-price">{item_amount}</span>
	</span>
	
	<a href="{remove_url}" data-cart-item="{cart_item_id}" data-download-id="{item_id}" data-action="edd_remove_from_cart" class="edd-remove-from-cart">
		<svg width="16" height="16">
			<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-remove'; ?>"></use>
		</svg>

	</a>

</li>
