<?php
/**
 * The template for displaying Add-ons
 */

get_header(); ?>


<?php if ( have_posts() ) : ?>

<?php affwp_page_header( 'Products' ); ?>


<section class="section columns columns-3 grid product-grid">
	<div class="wrapper">

	<?php while ( have_posts() ) : the_post(); 

	$coming_soon = pp_product_is_coming_soon( get_the_ID() ) ? 'coming-soon' : '';
	?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box', $coming_soon ) ); ?>> 
		    <div class="flex-wrapper">
			<?php if ( ! pp_product_is_coming_soon( get_the_ID() ) || current_user_can( 'manage_options' ) ) : ?>

	    		<?php pp_post_thumbnail( 'affwp-grid-thumbnail' ); ?>

    			<h2 class="entry-title">
    				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
    		    		<?php the_title(); ?>
    		    	</a>
    	    	</h2>
				
				<?php the_excerpt(); ?>

		 		<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="link">
 		    		Learn More  &rarr;
 		    	</a>

		    <?php elseif ( pp_product_is_coming_soon( get_the_ID() ) ) : ?>
		    	
		    	<div class="post-thumbnail">
		    		<?php if ( current_user_can( 'manage_options' ) ) : ?>
		    		<?php pp_post_thumbnail( 'affwp-grid-thumbnail' ); ?>
		    		<?php else : ?>
		    			<img alt="<?php the_title(); ?> - Coming Soon" src="<?php echo get_stylesheet_directory_uri() . '/images/product-coming-soon.png'; ?>">
		    		<?php endif; ?>	
		    		
		    	</div>
		   		
		   		<h2 class="entry-title">
		   			<?php the_title(); ?>
		       	</h2>
	    		
	    		<?php the_excerpt(); ?>
		 		Coming Soon
 		    	
			<?php endif; ?>	
			</div>
		</article>

	<?php endwhile; ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box', 'more-plugins' ) ); ?>> 
    			<div class="flex-wrapper">
	    			<h2 class="entry-title">
	    				<a href="https://profiles.wordpress.org/mordauk/">
	    		    		Want more plugins?
	    		    	</a>
	    	    	</h2>
						
			       <p>I also have over 50 freely available plugins on the WordPress repository.</p>

	 		    </div>
		 		<a href="https://profiles.wordpress.org/mordauk/" class="link">
 		    		View Plugins  &rarr;
 		    	</a>
			</article>

	<div class="gap"></div>
	<div class="gap"></div>

	</div>
</section>
<?php endif; ?>

<?php get_footer();