<?php
/**
 * Template Name: Learn
 */

get_header(); 

$tutorials_total = pp_get_category_post_count( 'tutorials' );
?>


<?php pp_page_header( 'Learn Plugin Development', '<h2>' . $tutorials_total . ' tutorials and <a href="' . get_post_type_archive_link( 'series' ) . '">' . pp_get_series_count() . ' series</a>, ready when you are.</h2>' ); ?>

<?php

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

  $args = array(
    'posts_per_page' => 10,
    'paged'          => $paged,
    'category_name'  => 'tutorials'
  );

  $temp = $wp_query; // assign original query to temp variable for later use  
  $wp_query = null;
  $wp_query = new WP_Query( $args ); 

  if ( have_posts() ) : ?>
  <div class="columns-main-side columns">
    <div class="wrapper">
      <div class="primary col content-area">
      <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

        <?php get_template_part( 'content', get_post_format() ); ?>

      <?php endwhile; ?>
      
      <nav class="nav-links columns columns-2 clear">
        <span class="nav-previous col">
          <?php next_posts_link( __( '&larr; Older', 'pp' ) ); ?>
        </span>

        <span class="nav-next col">
          <?php previous_posts_link( __( 'Newer &rarr;', 'pp' ) ); ?>
        </span>
      </nav>

      </div>
    
  <?php endif; $wp_query = $temp; //reset back to original query ?>

    <?php get_sidebar(); ?>
    </div>
  </div>


<?php
get_footer();
  
