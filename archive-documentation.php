<?php
/**
 * The template for displaying Add-ons
 */

get_header(); ?>

<?php affwp_page_header( 'Documentation' ); ?>

<section class="section columns columns-3 grid">
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

       <?php
          if ( $term->slug == 'easy-digital-downloads' ) {
             $doc_url = 'https://easydigitaldownloads.com/documentation/';
             $external = true;
          } elseif( $term->slug == 'affiliatewp' ) {
            $doc_url = 'http://affiliatewp.com/support/documentation/';
             $external = true;
          } else {
            $doc_url = get_term_link( $term, $taxonomy );
          }

          $external = isset( $external ) &&  $external == true ? ' target="_blank"' : '';
        ?>

   			<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>> 
   				<div class="flex-wrapper">

          <h2 class="entry-title">
   					<a href="<?php echo $doc_url; ?>"<?php echo $external; ?>><?php echo $term->name; ?></a>
   				</h2>
   				
   				<?php if ( $term->description ) : ?>
   				<p><?php echo $term->description; ?></p>
   				<?php endif; ?>


          </div>
   				<a href="<?php echo $doc_url; ?>"<?php echo $external; ?>>View documentation &rarr;</a>
   			</article>	
   		<?php endforeach; ?>
      <div class="gap"></div>
      <div class="gap"></div>
	</div>
</section>

<?php get_footer();