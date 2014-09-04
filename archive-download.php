<?php
/**
 * The template for displaying Add-ons
 */

get_header(); ?>


<?php if ( have_posts() ) : ?>

		<header class="page-header">
		<h1 class="page-title">Products</h1>
		<h2>A really awesome sub heading goes here</h2>

	</header>


<section class="section columns columns-3 grid products-grid">
	<div class="wrapper">

	<?php while ( have_posts() ) : the_post(); 

	$coming_soon = pp_product_is_coming_soon( get_the_ID() ) ? 'coming-soon' : '';
	?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box', $coming_soon ) ); ?>> 
		    
			<?php if ( ! pp_product_is_coming_soon( get_the_ID() ) || current_user_can( 'manage_options' ) ) : ?>

				<?php if ( ! has_post_thumbnail() ) : ?>
					<h2 class="entry-title">
						<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
				    		<?php the_title(); ?>
				    	</a>
			    	</h2>

			    <?php else : ?>
			    	<?php 
			    		affwp_post_thumbnail( 'affwp-product-thumbnail' ); 
			    	?>

				<?php endif; ?>
				
		    <?php elseif ( pp_product_is_coming_soon( get_the_ID() ) ) : ?>
		    	
		    	<?php /*	  	
	    		<h2><?php the_title(); ?></h2>
	    		*/ ?>
	    	
	    		<div class="post-thumbnail">
	    			<?php if ( current_user_can( 'manage_options' ) ) : ?>
	    				<?php affwp_post_thumbnail(); ?>
	    			<?php else : ?>
	    				<img alt="<?php the_title(); ?> - Coming Soon" src="<?php echo get_stylesheet_directory_uri() . '/images/add-ons-coming-soon.png'; ?>">
	    			<?php endif; ?>	
	    			
	    		</div>

			<?php endif; ?>	

	       	<?php 
		 		the_excerpt();
		 	?>

		 		<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="link">
		 		    		Learn More  &rarr;
		 		    	</a>

		 	<?php /*
		 			 	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="link">
		 		    		View <?php the_title(); ?> &rarr;
		 		    	</a>
		 	*/ ?>

		 	
		</article>

	<?php endwhile; ?>
	<div class="gap"></div>
	<div class="gap"></div>
	<?php endif; ?>

	</div>
</section>



<?php get_footer();
