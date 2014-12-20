<?php

/**
 * The template for displaying post series
 */
get_header(); ?>

<?php affwp_page_header( 'Series' ); ?>

<section class="section columns columns-3 grid">
    <div class="wrapper">
        <?php
            if ( have_posts() ) :
                // Start the Loop.
                while ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>> 
                <div class="flex-wrapper">
                    <?php pp_post_thumbnail( 'pp-grid-thumbnail' ); ?>

                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    
                    <?php the_excerpt(); ?>
                </div>
                
                <a href="<?php the_permalink(); ?>">View Series&rarr;</a>
            </article>  
            <?php endwhile;

            endif;
        ?>
        <div class="gap"></div>
        <div class="gap"></div>
    </div>
</section>    

<?php
get_footer();
  