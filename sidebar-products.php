<?php
/**
 * The Sidebar for single product pages
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">


	<?php echo pp_get_purchase_link( get_the_ID() ); ?>

	<?php echo pp_product_info( 'right' ); ?>

	<?php
		$support_url = get_post_meta( get_the_ID(), '_pp_product_support_url', true ) ? get_post_meta( get_the_ID(), '_pp_product_support_url', true ) : site_url( 'plugin-support' );
		$target     = get_post_meta( get_the_ID(), '_pp_product_support_url', true ) ? ' target="_blank"' : '';
	// make dynamic
	?>
	<div class="support box highlight">
		<h2>Need Help?</h2>
		<p>For support related questions, please <a href="<?php echo esc_url( $support_url ); ?>" title="Support"<?php echo $target ;?>>open a support ticket</a>.</p>
		
		
		<svg width="128px" height="128px">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-support-3'; ?>"></use>
		</svg>
		
	
	</div>

	<?php 
		$connected = new WP_Query( array(
		  'connected_type'  => 'docs_to_downloads',
		  'connected_items' => get_queried_object(),
		  'nopaging'        => true,
		) );
	?>

	<?php if ( $connected->have_posts() ) : ?>
	<div class="docs box">

		<svg width="128px" height="128px">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-docs'; ?>"></use>
		</svg>

	<h2>Related Documentation</h2>
		<ul>
	    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>  
	        <li> 	
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		    		<?php the_title(); ?>
		    	</a>
			</li>
	    <?php endwhile; wp_reset_postdata(); ?>
	   </ul>	
	</div>
	<?php endif; ?>


	<?php




// 	$json = 'http://api.wordpress.org/plugins/info/1.0/easy-digital-downloads.json';

// 	$safe_json = str_replace("\n", "\\n", $json);

	

// var_dump(json_decode($safe_json));

	?>

</div>
