<?php 
/**     
 * Downloads archive page.
 * This is used by default unless EDD_DISABLE_ARCHIVE is set to true
*/

    get_header();

?>
  

    <div class="entry-content">

    <h1 class="page-title">
     Documentation
    </h1>
  
<?php
/*
 * Loop through Categories and Display Posts within
 */
$post_type = 'docs';
 
// Get all the taxonomies for this post type
$taxonomies = get_object_taxonomies( array( 'post_type' => $post_type ) );
 
foreach( $taxonomies as $taxonomy ) :
 
    // Gets every "category" (term) in this taxonomy to get the respective posts
    $terms = get_terms( $taxonomy );
 
    foreach( $terms as $term ) : ?>
 
      <?php echo $term->name; ?>
 
        <?php
        $args = array(
                'post_type' => $post_type,
                'posts_per_page' => -1,  //show all posts
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $term->slug,
                    )
                )
 
            );
        $posts = new WP_Query($args);
 
        if( $posts->have_posts() ): while( $posts->have_posts() ) : $posts->the_post(); ?>
 
                    <?php if(has_post_thumbnail()) { ?>
                            <?php the_post_thumbnail(); ?>
                    <?php }
                    /* no post image so show a default img */
                    else { ?>
                           <img src="<?php bloginfo('template_url'); ?>/assets/img/default-img.png" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" width="110" height="110" />
                    <?php } ?>
 
                   <?php  echo get_the_title(); ?>
 
                        <?php the_excerpt(); ?>
                   
 
        <?php endwhile; endif; ?>
 
    <?php endforeach;
 
endforeach; ?>

  <?php if ( have_posts() ) : ?>

    <ul class="docs">   
    <?php while ( have_posts() ) : the_post(); ?>

        <li>
          <a title="<?php echo the_title_attribute( 'echo=0' ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>


        <?php endwhile; ?>
        </ul>
  <?php endif; // end have_posts() check ?>

    </div>



<?php get_footer(); ?>