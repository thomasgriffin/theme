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

        $term_name        = $term->name;
        $download         = get_page_by_title( $term_name, '', 'download' );
        $external_doc_url = $download ? get_post_meta( $download->ID, '_pp_product_doc_url', true ) : '';

        if ( $external_doc_url ) {
          $doc_url = $external_doc_url;
          $target = 'target="_blank"';
        } else {
          $doc_url = get_term_link( $term, $taxonomy );
          $target = '';
        }

        ?>

   			<article class="col box"> 
   				<div class="flex-wrapper">

          <h2 class="entry-title">
   					<a href="<?php echo $doc_url; ?>"<?php echo $target; ?>><?php echo $term->name; ?></a>
   				</h2>
   				
   				<?php if ( $term->description ) : ?>
   				<p><?php echo $term->description; ?></p>
   				<?php endif; ?>


          </div>
   				<a href="<?php echo $doc_url; ?>"<?php echo $target; ?>>View documentation &rarr;</a>
   			</article>	
   		<?php endforeach; ?>
      <div class="gap"></div>
      <div class="gap"></div>
	</div>
</section>

<?php get_footer();