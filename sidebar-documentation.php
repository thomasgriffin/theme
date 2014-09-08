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

	<?php 
		$heading = $connected->post_count > 1 ? __( 'Related Products', 'pp' ) : __( 'Related Product', 'pp' );
	?>
		<h3><?php echo $heading; ?></h3>
	 
		<ul>
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