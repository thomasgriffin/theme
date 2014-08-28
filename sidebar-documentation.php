<?php
/**
 * The Sidebar for single documentation pages
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">

<?php 
	// Find connected pages
	$connected = new WP_Query( array(
	  'connected_type'  => 'docs_to_downloads',
	  'connected_items' => get_queried_object(),
	  'nopaging'        => true,
	) );
?>

<?php if ( $connected->have_posts() ) : ?>
<section class="docs">
    <?php while ( $connected->have_posts() ) : $connected->the_post();
	    $coming_soon = pp_product_is_coming_soon( get_the_ID() ) ? 'coming-soon' : '';
    ?>  
        <article id="post-<?php the_ID(); ?>" <?php post_class( array( $coming_soon ) ); ?>> 
        		    
		<h2>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    		<?php the_title(); ?>
    	</a>
    	</h2>

	</article>
       
    <?php endwhile; wp_reset_postdata(); ?>
   	
</section>
<?php endif; ?>


</div>


