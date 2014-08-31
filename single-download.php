<?php
/**
 * The Template for displaying all single addons
 */
get_header(); ?>
	

<?php affwp_page_header(); ?>

<section class="section columns-3 columns">

	<?php 
	/**
	 * Product information
	 */
	?>
	<div class="col left">
		<?php echo pp_product_info( 'left' ); ?>
		
		<?php affwp_post_thumbnail( 'affwp-product-thumbnail' ); ?>
	</div>
	
	<div class="primary col">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
				<?php //affwp_post_thumbnail(); ?>
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'affwp' ) ); ?>
					</div>
				</article>

			<?php endwhile; ?>

	</div>

	<?php get_sidebar( 'products' ); ?>
	
		
</section>

<?php 
	$has_gallery_images = get_post_meta( get_the_ID(), '_easy_image_gallery', true );
	if ( $has_gallery_images ) : ?>
<section class="easy-image-gallery">
	<h1>Take a closer look</h1>
	<h2>Click on each image for a larger view</h2>
	<?php 
		if ( function_exists( 'easy_image_gallery' ) ) {
			echo easy_image_gallery(); 
		}
	
		if ( function_exists( 'easy_image_gallery_count_images' ) && easy_image_gallery_count_images() > 4 ) { ?>
				<a href="#" id="show-gallery-images" class="button">Show more images</a>
		<?php }
	?>



</section>
<?php endif; ?>

<?php 

// Find connected pages
$connected = new WP_Query( array(
  'connected_type'  => 'downloads_to_add-ons',
  'connected_items' => get_queried_object(),
  'nopaging'        => true,
) );

?>



<?php if ( $connected->have_posts() ) : ?>
<section class="section columns columns-3 products">

	<div class="wrapper">
		<header class="entry-header">
			<h2 class="entry-title">Related add-ons</h2>
		</header>
	</div>

    <?php while ( $connected->have_posts() ) : $connected->the_post();
	    $coming_soon = pp_product_is_coming_soon( get_the_ID() ) ? 'coming-soon' : '';
    ?>  
        <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', $coming_soon ) ); ?>> 
        		    
			<?php 
			$external_download_url = get_post_meta( get_the_ID(), '_affwp_addon_download_url', true );

			if ( ! pp_product_is_coming_soon( get_the_ID() ) || current_user_can( 'manage_options' ) ) : ?>

	    		<h2>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			    		<?php the_title(); ?>
			    	</a>
		    	</h2>

		    	<?php affwp_post_thumbnail(); ?>

		    <?php elseif ( pp_product_is_coming_soon( get_the_ID() ) ) : ?>
		    		  	
	    		<h2><?php the_title(); ?></h2>
	    		<div class="post-thumbnail">
	    			<?php the_post_thumbnail(); ?>
	    		</div>

			<?php endif; ?>	

	       	<?php the_excerpt(); ?>
	</article>
       
    <?php endwhile; wp_reset_postdata(); ?>
   	
   	<div class="gap"></div>
	<div class="gap"></div>


</section>
<?php endif; ?>

<?php
get_footer();
