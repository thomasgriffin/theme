<?php
/**
 * The Sidebar for single product pages
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">

	<?php  
	/* This custom link is broken. See https://3.basecamp.com/4226849/buckets/12205794/messages/2132700320
	if ( function_exists( 'pp_purchase_link' ) ) { echo pp_purchase_link( get_the_ID() ); }
	*/
	?>
	<?php echo edd_get_purchase_link(); ?>
	<?php 
		$terms = get_page_by_title( 'Terms and Conditions' );
	?>

	<?php if ( $terms ) : ?>
	<p><small>Plugins are subject to a yearly license for support and updates. <a href="#terms-conditions" class="popup-content" data-effect="mfp-move-from-bottom">View license terms</a>.</small></p>

	<div id="terms-conditions" class="popup entry-content mfp-with-anim mfp-hide">
		<h1>
			<?php echo $terms->post_title; ?>
		</h1>

		<?php echo stripslashes( wpautop( $terms->post_content, true ) ); ?>
	</div>
	<?php endif; ?>

	<?php if ( function_exists( 'pp_product_info' ) ) { echo pp_product_info( 'right' ); } ?>

	<?php 
	/**
	 * Show the shopping cart
	 */
	
	$cart_items    = edd_get_cart_contents();
	$cart_quantity = edd_get_cart_quantity();
	$display       = $cart_quantity > 0 ? '' : 'style="display:none;"';
	
	if ( $cart_items ) : ?>
		<aside>
		<h2>Ready to purchase?</h2>
		<ul class="edd-cart">
			<?php foreach ( $cart_items as $key => $item ) : ?>
				<?php echo edd_get_cart_item_template( $key, $item, false ); ?>
			<?php endforeach; ?>

			<?php edd_get_template_part( 'widget', 'cart-checkout' ); ?>
		</ul>
		</aside>
	<?php endif; ?>
	
	<?php
		$support_url = get_post_meta( get_the_ID(), '_pp_product_support_url', true ) ? get_post_meta( get_the_ID(), '_pp_product_support_url', true ) : site_url( 'plugin-support' );
		$target     = get_post_meta( get_the_ID(), '_pp_product_support_url', true ) ? ' target="_blank"' : '';
	?>
	<div class="support box">
		<h2>Need Help?</h2>
		<p>For support related questions, please <a href="<?php echo esc_url( $support_url ); ?>" title="Support"<?php echo $target; ?>>open a support ticket</a>.</p>
		
		
		<svg width="128px" height="128px">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-support-3'; ?>"></use>
		</svg>
		
	
	</div>


	<?php 
	/**
	 * Related Posts
	 */
		$connected = new WP_Query( array(
		  'connected_type'  => 'downloads_to_posts',
		  'connected_items' => get_queried_object(),
		  'nopaging'        => true,
		) );

	if ( $connected->have_posts() ) : ?>
		<aside class="box">

		<?php 
			$heading = $connected->post_count > 1 ? __( 'Related Posts', 'pp' ) : __( 'Related Post', 'pp' );
		?>
			<h2><?php echo $heading; ?></h2>
		 
			<ul class="linked list">
		    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>  
		    
		    <li>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_title(); ?>
				</a>
		    </li>   
		    <?php endwhile; wp_reset_postdata(); ?>
		    </ul>
	  

	</aside>
	<?php endif; ?>

	

</div>
