<?php 
/**     
 * Download Category Taxonomy page
*/

get_header(); ?>

<?php affwp_page_header( single_term_title( '', false ) ); ?>

<?php
	/**
	 * The main parent term page
	 */
	$taxonomy = get_queried_object()->taxonomy;
	$term_children = get_term_children( get_queried_object_id(), $taxonomy );

	if ( $term_children ) :
?>

	<section class="section columns columns-3 grid">
		<div class="wrapper">
		<?php foreach ( $term_children as $term ) :
			$term = get_term_by( 'id', $term, $taxonomy );
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>> 
				<a href="<?php echo get_term_link( $term, $taxonomy ); ?>">
					<h2 class="entry-title"><?php echo $term->name; ?></h2>
				</a>
				
				<?php if ( $term->description ) : ?>
					<p><?php echo $term->description; ?></p>
				<?php endif; ?>

		          <?php

					$args = array(
						'post_type'      => 'documentation',
						'posts_per_page' => 3,
						'tax_query'      => array(
							array(
								'taxonomy' => $taxonomy,
								'field'    => 'id',
								'terms'    => $term->term_id
							)
						)
					);

					$wp_query = new WP_Query( $args );
		          	
		          	if ( $wp_query->have_posts() ) : ?>

		          	<ul>
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?> 
		   				<li>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>
					<?php endwhile; ?>
					</ul>
					
					<a href="<?php echo get_term_link( $term, $taxonomy ); ?>">View all &rarr;</a>
					<?php wp_reset_query(); endif; ?>

			</article>
		<?php endforeach; ?>
		</div>
	</section>

<?php else : ?>

	<?php 
	/**
	 * The sub term page
	 */
	if ( have_posts() ) : ?>
	<section class="section columns columns-3 grid">
	     <div class="wrapper">

	     <?php while ( have_posts() ) : the_post(); ?>
	          <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>>
	             
				<h2 class="entry-title">
					<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>

	            <?php the_excerpt(); ?>

				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="link">Learn More  &rarr;</a>

                <?php /*
                                <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="link">
                                   View <?php the_title(); ?> &rarr;
                              </a>
                */ ?>

	               
	          </article>

	     <?php endwhile; ?>
	     <div class="gap"></div>
	     <div class="gap"></div>
	    

	     </div>
	</section>
	<?php endif; ?>

<?php endif; ?>

<?php
get_footer();
