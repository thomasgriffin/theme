<?php
/**
 * The Sidebar for single documentation pages
 *
 * @since 1.0
 */
?>

<div class="primary-sidebar widget-area col right" role="complementary">
	<?php echo pp_single_doc_info(); ?>

<?php 
	// Find connected pages
	$connected = new WP_Query( array(
	  'connected_type'  => 'docs_to_downloads',
	  'connected_items' => get_queried_object(),
	  'nopaging'        => true,
	) );
?>

<?php if ( $connected->have_posts() ) : ?>
	<aside class="box">
	<p>
		<span>Related Products</span>
	
    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>  
     
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_title(); ?>
	</a>
       
    <?php endwhile; wp_reset_postdata(); ?>
   	</p>

</aside>
<?php endif; ?>

</div>