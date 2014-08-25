<?php
/**
 * Documentation
 */


/**
 * Add doc category column
 */
function affwpt_docs_columns( $columns ) {
	// unset WPSEO columns
	unset( $columns['wpseo-metadesc'] );
	unset( $columns['wpseo-focuskw'] );
	unset( $columns['wpseo-title'] );

	// add category
	$columns['doc_category'] = __( 'Categories', 'affwp' );

	return $columns;
}
add_filter( 'manage_edit-docs_columns', 'affwpt_docs_columns' );

/**
 * Render categories
 */
function affwpt_render_docs_columns( $column_name, $post_id ) {
	if ( get_post_type( $post_id ) == 'docs' ) {

		switch ( $column_name ) {
			case 'doc_category':
				echo get_the_term_list( $post_id, 'doc_category', '', ', ', '');
				break;
		}
	}
}
add_action( 'manage_posts_custom_column', 'affwpt_render_docs_columns', 10, 2 );


/**
 * Mixitup
 */
function affwp_mixitup() {
	if ( ! ( is_page_template( 'page-templates/docs.php' ) || is_tax( 'doc_category' ) || is_singular( 'docs' ) ) )
		return;
		
	?>
	<script>
		jQuery(document).ready(function() {

		
    	  var layout = 'grid', 							// Store the current layout as a variable
    	      $container = jQuery('#docs-container'), 			// Cache the MixItUp container
    	      $changeLayout = jQuery('.change-layout'); 	// Cache the changeLayout button
    	  
    	  // Instantiate MixItUp with some custom options:
    	  $container.mixItUp({
    	    animation: {
    	      animateChangeLayout: true, 				// Animate the positions of targets as the layout changes
    	      animateResizeTargets: true, 				// Animate the width/height of targets as the layout changes
    	   //   effects: 'fade rotateX(-40deg) translateZ(-100px)'
    	    },
    	    layout: {
    	      containerClass: 'grid' 					// Add the class 'grid' to the container on load
    	    },
    	    selectors: {
				target: '.col'
			}
    	  });
    	  
    	  // MixItUp does not provide a default "change layout" button, so we need to make our own and bind it with a click handler:
    	  
    	  $changeLayout.on('click', function() {
    	    

    	    // If the current layout is a grid, change to list:
    	    
    	    if ( layout == 'list' ) {
    	      layout = 'grid';
    	      
    	      console.log( layout );

    	      $changeLayout.html( '<span class="hide">List</span>' ).prepend('<i class="icon icon-list"></i>'); // Update the button text
    	      //jQuery( '#change-layout i' ).attr( 'class', 'icon-list' );
    	      
    	     

    	      $container.mixItUp( 'changeLayout', {
    	        containerClass: layout // change the container class to "list"
    	      });
    	      
    	    // Else if the current layout is a list, change to grid:  
    	    
    	    } else {

    	      layout = 'list';
    	      
    	      console.log( layout );

    	      $changeLayout.html( '<span class="hide">Grid</span>' ).prepend('<i class="icon icon-grid"></i>'); // Update the button text
    	      //jQuery( '#change-layout i' ).attr( 'class', 'icon-grid' );

    	      $container.mixItUp( 'changeLayout', {
    	        containerClass: layout // Change the container class to 'list'
    	      });

    	    }
    	  });
	    	
		});



	</script>
<?php //endif;
}
//add_action( 'wp_footer', 'affwp_mixitup', 100 );

/**
 * Filters
 * @return [type] [description]
 */
function affwp_docs_filters() {
	?>
	<div class="filters">
		<button class="change-layout">
			<i class="icon icon-list"></i>
			<span class="hide">List</span>
		</button>
	</div>
	<?php
}


/**
 * Show getting started at top of docs
 * @return [type] [description]
 */
function affwp_docs_getting_started() { 
	global $post;

	if ( ! ( is_page_template( 'page-templates/docs.php' ) ) )
		return;
	?>
	
	    	<section class="section columns columns-4 docs">
	    		<div class="wrapper">
	    		<header class="page-header">
						<h1>Getting Started</h1>
					<h2>Everything you need to get up and running, fast</h2>

				</header>



				
				</div>

					<div id="docs-container">
				<?php
				/*
				 * Loop through Categories and Display Posts within
				 */
				$post_type = 'docs';
				 
				// Get all the taxonomies for this post type
				$taxonomies = get_object_taxonomies( array( 'post_type' => $post_type ) );

				foreach ( $taxonomies as $taxonomy ) : ?>
				    
				    <?php

					    $args = array(
					        'orderby'       => 'date', 
					        'order'         => 'DESC',
					        'hide_empty'    => false,
					        'parent'        => 0,
					        'slug'			=> 'getting-started'
					    ); 

				   		$terms = get_terms( $taxonomy, $args );
					    $count = 0;

					    foreach ( $terms as $term ) : $count++; ?>
					    	
					          
					    	<?php /*
					            <?php if ( $term->description ) : ?>
					            <p><?php echo $term->description; ?></p>
					            <?php endif; ?>
							*/ ?>
						
					          <?php 
					              $args = array(
					                  'post_type' => 'docs',
					                  'posts_per_page' => -1,
					                  'tax_query' => array(
					                      array(
					                          'taxonomy' => $taxonomy,
					                          'field' => 'slug',
					                          'terms' => 'getting-started'
					                      )
					                  )
					              );

					              $wp_query = new WP_Query( $args );
					          ?>

					            <?php if ( $wp_query->have_posts() ) : ?>
					               
					                
					                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?> 
					                	 <div class="col box" data-myorder=""> 
					                   
					                        <h2>
					                        	<a href="<?php the_permalink(); ?>">
					                        		<?php the_title(); ?>
					                        	</a>
					                        </h2>	
					                           	<?php 
											 		affwp_post_thumbnail();
											 		the_excerpt();
											 	?>
					                    </div>
					                <?php endwhile; wp_reset_query(); ?>
						               	<div class="gap"></div>
			        					<div class="gap"></div>
					               
					            <?php endif; ?>
					       
					    <?php endforeach; ?>
					<?php endforeach; ?>
					</div>
	    	</section>

	    	
<?php }
add_action( 'affwp_content_after', 'affwp_docs_getting_started', 1 );







/**
 * Documentation posts
 */
function affwp_docs_tax() {
	if ( ! is_tax( 'doc_category' )  )
		return;

	global $post;
	
	?>
	
	<!-- <section id="docs"> -->
	<section class="section columns columns-4 docs">	
	<div class="wrapper">
				
				<header class="page-header">
				
				<h1><?php printf( __( '%s', 'affwp' ), single_term_title( '', false ) ); ?></h1>
				 <?php
		            $category_description = category_description();

		            if ( ! empty( $category_description ) )  {
		            	echo '<h2>' . esc_attr( strip_tags( $category_description ) ) . '</h2>';

		           // echo apply_filters( 'category_archive_meta', '<div class="intro-meta">' . $category_description . '</div>' );
		            }
		        ?>
		</header>
				
		       
	</div>
		
		
		<?php //echo affwp_docs_filters(); ?>

		<div id="docs-container">
		  <?php
		  $count = 0;
			while ( have_posts() ) : the_post(); $count++; ?>

			 <div class="col box" data-myorder="<?php echo $count; ?>">

			 <h2 class="page-title">
			 	<a href="<?php the_permalink(); ?>">
		 			<?php the_title(); ?>
		 		</a>
			 </h2>

		 	<?php 
		 		affwp_post_thumbnail();
		 		the_excerpt();
		 	?>
		
			</div>

			<?php endwhile; ?>

			<?php if ( $count >= 2 ) : ?>
				<div class="gap"></div>
				<div class="gap"></div>
				<div class="gap"></div>
			<?php endif; ?>

		</div>
	</section>
	<?php
}
add_action( 'affwp_content_after', 'affwp_docs_tax' );

/**
 * Documentation posts
 */
function affwp_docs() {
	if ( ! ( is_page_template( 'page-templates/docs.php' ) ) )
		return;

	?>
	 
	<section class="section columns columns-4 docs">

		<?php //echo affwp_docs_filters(); ?>

		<div class="wrapper">
			
		<header class="page-header">
				<h1>Everything Else</h1>
				<h2>Other things that will be helpful to know</h2>
		</header>

		</div>

		<div id="docs-container">

	    		
	    		
	<?php
	/*
	 * Loop through Categories and Display Posts within
	 */
	$post_type = 'docs';
	 
	// Get all the taxonomies for this post type
	$taxonomies = get_object_taxonomies( array( 'post_type' => $post_type ) );

	foreach ( $taxonomies as $taxonomy ) : ?>
	    
	    <?php

	    	$term = get_term_by( 'slug', 'getting-started', 'doc_category' ); 
	    	$term_id = $term->term_id;
	    	

		    $args = array(
		        'orderby'       => 'date', 
		        'order'         => 'DESC',
		        'hide_empty'    => false,
		        'parent'        => 0,
		        'exclude'		=> array( $term_id )
		    ); 

	   	$terms = get_terms( $taxonomy, $args );
		    $count = 0;

		    foreach( $terms as $term ) : $count++; ?>

		        <div class="col box <?php echo $term->slug; ?>" data-myorder="<?php echo $count; ?>">

		            <h2>
		                <a href="<?php echo get_term_link( $term, $term->slug ); ?>"><?php echo $term->name; ?></a>
		            </h2>

		            <?php if ( $term->description ) : ?>
		            <p><?php echo $term->description; ?></p>
		            <?php endif; ?>

		          <?php 
		              $args = array(
		                  'post_type' => 'docs',
		                  'posts_per_page' => 3,
		                  'tax_query' => array(
		                      array(
		                          'taxonomy' => $taxonomy,
		                          'field' => 'slug',
		                          'terms' => $term->slug
		                      )
		                  )
		              );

		              $wp_query = new WP_Query( $args );
		          ?>

		            <?php if ( $wp_query->have_posts() ) : ?>
		                <p class="recent">Recent articles:</p>
		                <ul>
		                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>  
		                    <li>
		                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		                    </li>
		                <?php endwhile; wp_reset_query(); ?>
		                </ul>
		            <?php endif; ?>

		           

		        </div>
		       
		        
		    <?php endforeach; ?>
		 		<div class="gap"></div>
		        <div class="gap"></div>
		<?php endforeach; ?>
		</div>
	</section>
	<?php
}
add_action( 'affwp_content_after', 'affwp_docs' );

/**
 * Documentation posts
 */
function affwp_docs_singular() {
	if ( ! is_singular( 'docs' ) )
		return;

	global $post;
	
  	$taxonomy = 'doc_category';
  	$terms = get_the_terms( get_the_ID(), $taxonomy );

  	if ( ! $terms )
  		return;
  	
  	$terms = wp_list_pluck( $terms, 'term_id' );
  	$terms = array_values( $terms );

      $args = array(
          'post_type' => 'docs',
          'posts_per_page' => -1,
          'post__not_in' => array( get_the_ID() ), // hide the currently viewed post
          'tax_query' => array(
              array(
                  'taxonomy' => 'doc_category',
                  'field' => 'id',
                  'terms' => $terms
              )
          )
      );

    	$wp_query = new WP_Query( $args );

    	// return if there are no related docs
    	if ( ! $wp_query->found_posts )
    		return;
    ?>	


	<section class="section columns columns-4 docs">
     
		<div class="wrapper">
			<header class="page-header">
					<h1>Related docs</h1>
				<h2>These are rather helpful also</h2>
			</header>
		</div>


		<div id="docs-container">
	      
	       <?php if ( $wp_query->have_posts() ) : ?>
	               
	                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>  
	                     <div class="col box" data-myorder="">
	                     	
	                        <h2>
	                        	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	                    	</h2>

						   <?php 
					   	 		affwp_post_thumbnail();
					   	 		the_excerpt();
					   	 	?>
	                 </div>
	                <?php endwhile; wp_reset_query(); ?>
	             
	            <?php endif; ?>

		 		<div class="gap"></div>
		        <div class="gap"></div>
		</div>

	</section>
	<?php
}
add_action( 'affwp_content_after', 'affwp_docs_singular', 1 );