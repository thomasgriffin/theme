<?php
/**
 * Template Name: Full Width
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<?php affwp_page_header(); ?>

<div class="primary content-area">
	<div class="wrapper">
		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );

			endwhile;
		?>
	</div>
</div>

<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
?>

<?php
get_footer();
