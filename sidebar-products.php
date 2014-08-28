<?php
/**
 * The Sidebar for single product pages
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">

	<?php echo pp_get_purchase_link( get_the_ID() ); ?>



	<div class="support box">
		<h2>100% Supported</h2>
		<p><?php echo the_title(); ?> is a well supported product.</p>
		
		<?php /*
		<svg width="32px" height="32px">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-support-2'; ?>"></use>
		</svg>
		*/ ?>
	
		<a href="<?php echo site_url( 'plugin-support' ); ?>" title="Get Support" class="button">
		
		Get Support Now
		</a>
	</div>

	<?php 
		$connected = new WP_Query( array(
		  'connected_type'  => 'docs_to_downloads',
		  'connected_items' => get_queried_object(),
		  'nopaging'        => true,
		) );
	?>

	<?php if ( $connected->have_posts() ) : ?>
	<div class="documentation box">
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
	</div>
	<?php endif; ?>


	<?php




// 	$json = 'http://api.wordpress.org/plugins/info/1.0/easy-digital-downloads.json';

// 	$safe_json = str_replace("\n", "\\n", $json);

	

// var_dump(json_decode($safe_json));

	?>

</div>
