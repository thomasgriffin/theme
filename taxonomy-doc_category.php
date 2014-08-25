<?php 
/**     
 * Download Category Taxonomy page
*/

get_header(); ?>

<div class="primary content-area">

<?php /*
    <header class="page-header">
        
		<h1 class="page-title">
			<?php printf( __( '%s', 'affwp' ), single_term_title( '', false ) ); ?>
		</h1>

        <?php
            $category_description = category_description();
            if ( ! empty( $category_description ) ) 
            echo apply_filters( 'category_archive_meta', '<div class="intro-meta">' . $category_description . '</div>' );
        ?>
    </header>
*/ ?>

			<?php /*
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			*/ ?>


	</div><!-- #primary -->
   
<?php get_footer(); ?>