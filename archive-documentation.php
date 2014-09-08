<?php
/**
 * The template for displaying Add-ons
 */

get_header(); ?>

<?php affwp_page_header( 'Documentation', '<h2>Helpful docs on all my plugins</h2>' ); ?>


<section class="section columns columns-3 grid product-grid">
	<div class="wrapper">

    <?php
    	$taxonomy = 'doc_category';

	    $args = array(
	        'orderby'       => 'date', 
	        'order'         => 'DESC',
	        'hide_empty'    => false,
	        'parent'        => 0,
	    ); 

   		$terms = get_terms( $taxonomy, $args );
	  	
   		foreach( $terms as $term ) : ?>
   			<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>> 
   				<h2 class="entry-title">
   					<a href="<?php echo get_term_link( $term, $taxonomy ); ?>"><?php echo $term->name; ?></a>
   				</h2>
   				
   				<?php if ( $term->description ) : ?>
   				<p><?php echo $term->description; ?></p>
   				<?php endif; ?>

   				<a href="<?php echo get_term_link( $term, $taxonomy ); ?>">View documentation &rarr;</a>
   			</article>	
   		<?php endforeach; ?>

	</div>
</section>





<?php get_footer();
