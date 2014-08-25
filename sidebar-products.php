<?php
/**
 * The Sidebar for single product pages
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">

	<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>

	<section class="support">

		<a href="<?php echo site_url( 'plugin-support' ); ?>" title="Get Support">
		<svg width="32px" height="32px" viewBox="0 0 32 32">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-support-2'; ?>"></use>
		</svg>
		Get Support
		</a>
	</section>

	<?php 
		$connected = new WP_Query( array(
		  'connected_type'  => 'docs_to_downloads',
		  'connected_items' => get_queried_object(),
		  'nopaging'        => true,
		) );
	?>

	<?php if ( $connected->have_posts() ) : ?>
	<section class="documentation">
	<h3>Related Documentation</h3>
		<ul>
	    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>  
	        <li> 	
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		    		<?php the_title(); ?>
		    	</a>
			</li>
	    <?php endwhile; wp_reset_postdata(); ?>
	   </ul>	
	</section>
	<?php endif; ?>


</div>
