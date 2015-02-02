<?php
/**
 * The Template for displaying all single addons
 */
get_header(); ?>
	

<?php pp_page_header(); ?>



<section class="section clear columns-3 columns">

	<?php 
	/**
	 * Product information
	 */
	?>
	<div class="col left">
		<?php echo pp_product_info(); ?>
	</div>
	
	<div class="primary col">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'box', 'product' ) ); ?>>
					
				<?php pp_post_thumbnail( 'pp-large' ); ?>
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pp' ) ); ?>
					</div>
				</article>

			<?php endwhile; ?>

	</div>

	<?php get_sidebar( 'products' ); ?>
		
</section>


<?php 

// Find connected pages
$connected = new WP_Query( array(
  'connected_type'  => 'downloads_to_add-ons',
  'connected_items' => get_queried_object(),
  'nopaging'        => true,
) );

if ( $connected->have_posts() ) : ?>
<section class="section columns columns-3 grid product-grid">

		<header class="page-header">
			<h1>Related add-ons</h1>
		</header>
	
	<div class="wrapper">

	    <?php while ( $connected->have_posts() ) : $connected->the_post();
		    $coming_soon = pp_product_is_coming_soon( get_the_ID() ) ? 'coming-soon' : '';
	    ?>  
	        <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box', $coming_soon ) ); ?>> 
	        	<div class="flex-wrapper">

				<?php 
				$external_download_url = get_post_meta( get_the_ID(), '_affwp_addon_download_url', true );

				if ( ! pp_product_is_coming_soon( get_the_ID() ) || current_user_can( 'manage_options' ) ) : ?>

		    		<?php pp_post_thumbnail( 'pp-grid-thumbnail', true ); ?>
						<h2 class="entry-title">
							<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
					    		<?php the_title(); ?>
					    	</a>
				    	</h2>

			    <?php elseif ( pp_product_is_coming_soon( get_the_ID() ) ) : ?>
			    		  	
		    		<?php if ( ! has_post_thumbnail() ) : ?>
						<h2 class="entry-title">
							<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
					    		<?php the_title(); ?>
					    	</a>
				    	</h2>

				    <?php else : ?>
				    	<?php pp_post_thumbnail( 'pp-grid-thumbnail', true ); ?>
					<?php endif; ?>

				<?php endif; ?>	

		       	<?php the_excerpt(); ?>
		       	</div>
			 		<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="link">
	 		    		Learn More  &rarr;
	 		    	</a>
		</article>
	       
	    <?php endwhile; wp_reset_postdata(); ?>
	   	
	   	<div class="gap"></div>
		<div class="gap"></div>
	</div>

</section>
<?php endif; ?>

<?php
get_footer();
