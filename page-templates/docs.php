<?php 
/**
 * Template Name: Documentation
 */

    get_header();

?>

<div class="primary content-area">
    <?php while ( have_posts() ) : the_post();
            // Include the page content template.
          //  get_template_part( 'content', 'page' );
        ?>

    <?php endwhile; ?>

    <?php do_action( 'affwp_documentation' ); ?>

 
</div>
   
<?php get_footer(); ?>