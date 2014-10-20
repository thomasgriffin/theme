<?php
/**
 * Template Name: Learn
 */
get_header(); ?>

<?php affwp_page_header( 'Learn Plugin Development', '<h2>Learning By Doing</h2>' ); ?>

<?php
/**
 * Series
 */
    $args = array(
      'post_type' => 'series',
      'posts_per_page' => -1,
    );

    $series = new WP_Query( $args );
?>
<?php if ( $series->have_posts() ) : ?> 
<section class="section columns columns-3 grid">
    <div class="wrapper">
        <h2>Series</h2> 
    </div>
    <div class="wrapper">
        <?php while ( $series->have_posts() ) : $series->the_post(); ?>  
              <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>> 
            	
            	<?php pp_post_thumbnail( 'affwp-grid-thumbnail' ); ?>
                <h2 class="entry-title">
                    <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            	

            <?php the_excerpt(); ?>

            <a href="<?php the_permalink(); ?>">View Series &rarr;</a>
        </article> 

        <?php endwhile; wp_reset_query(); ?>
        <div class="gap"></div>
        <div class="gap"></div>
    </div>
</section>    
<?php endif; ?>


<?php
/**
 * Members - subscriber only (paid)
 */
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 3,
      'category_name' => 'subscriber-only'
    );

    $series = new WP_Query( $args );
?>
<?php if ( $series->have_posts() ) : ?>
<?php //echo pp_get_category_post_count( 'subscriber-only' ); 
?> 
<section class="section columns columns-3 grid">
    <div class="wrapper">
        <h2>Members - Paid Subscribers</h2> 
    </div>
    <div class="wrapper">
        <?php while ( $series->have_posts() ) : $series->the_post(); ?>  
              <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>> 
               <?php pp_post_thumbnail( 'affwp-grid-thumbnail' ); ?>
                               <h2 class="entry-title">
                                   <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                                       <?php the_title(); ?>
                                   </a>
                               </h2>

            <?php the_excerpt(); ?>

            <a href="<?php the_permalink(); ?>">View Series &rarr;</a>
        </article> 

        <?php endwhile; wp_reset_query(); ?>
        <div class="gap"></div>
        <div class="gap"></div>
    </div>
</section>    
<?php endif; ?>


<?php
/**
 * Members - subscriber only (paid)
 */
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 3,
      'category_name' => 'free-members'
    );

    $series = new WP_Query( $args );
?>
<?php if ( $series->have_posts() ) : ?>
<?php //echo pp_get_category_post_count( 'free-members' ); 
?> 
<section class="section columns columns-3 grid">
    <div class="wrapper">
        <h2>Members - Free Subscribers</h2> 
    </div>
    <div class="wrapper">
        <?php while ( $series->have_posts() ) : $series->the_post(); ?>  
              <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'col', 'box' ) ); ?>> 
               <?php pp_post_thumbnail( 'affwp-grid-thumbnail' ); ?>
                               <h2 class="entry-title">
                                   <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                                       <?php the_title(); ?>
                                   </a>
                               </h2>

            <?php the_excerpt(); ?>

            <a href="<?php the_permalink(); ?>">View Series &rarr;</a>
        </article> 

        <?php endwhile; wp_reset_query(); ?>
        <div class="gap"></div>
        <div class="gap"></div>
    </div>
</section>    
<?php endif; ?>

<?php /* only show this to logged out users  */ ?>
<div class="action">
    <a class="button huge" href="<?php echo site_url('join-the-site/register'); ?>">Join the site</a>
</div>

<?php
get_footer();
  