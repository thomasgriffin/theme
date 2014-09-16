<?php
/**
 * The Sidebar for single product pages
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">

	<?php echo pp_purchase_link( get_the_ID() ); ?>

	<?php echo pp_product_info( 'right' ); ?>

	

	

	<?php
		// get top level terms and their links
		$doc_term_id = (int) get_post_meta( get_the_ID(), '_pp_product_doc_term_id', true );
		$taxonomy = 'doc_category';

		$args = array(
			'parent' => $doc_term_id,
			'hide_empty' => false
		);

		$terms = get_terms( $taxonomy, $args );

		$main_doc_link = get_term_link( $doc_term_id, $taxonomy );
		$main_doc_link = ! is_wp_error( $main_doc_link ) ? $main_doc_link : '';
	?>
	<aside class="docs box">
		<svg width="96px" height="96px">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-docs'; ?>"></use>
		</svg>

		<h2>Documentation</h2>
		

	
		<ul>
			<?php foreach( $terms as $term ) : 
				// The $term is an object, so we don't need to specify the $taxonomy.
				$term_link = get_term_link( $term );
				
				// If there was an error, continue to the next term.
				if ( is_wp_error( $term_link ) ) {
				    continue;
				}
			?>
				<li>
					<a href="<?php echo esc_url( $term_link ); ?>"><?php echo $term->name; ?></a>

				</li>
			<?php endforeach; ?>
			
		</ul>
		<a href="<?php echo $main_doc_link; ?>">View all &rarr;</a>
	</aside>



	<?php
		$support_url = get_post_meta( get_the_ID(), '_pp_product_support_url', true ) ? get_post_meta( get_the_ID(), '_pp_product_support_url', true ) : site_url( 'plugin-support' );
		$target     = get_post_meta( get_the_ID(), '_pp_product_support_url', true ) ? ' target="_blank"' : '';
	?>
	<div class="support box">
		<h2>Need Help?</h2>
		<p>For support related questions, please <a href="<?php echo esc_url( $support_url ); ?>" title="Support"<?php echo $target ;?>>open a support ticket</a>.</p>
		
		
		<svg width="128px" height="128px">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-support-3'; ?>"></use>
		</svg>
		
	
	</div>

</div>