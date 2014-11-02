<?php
/**
 * The template for displaying Search Results pages
 */

get_header(); ?>

<?php affwp_page_header(); ?>

<div class="primary slim content-area">
	<div class="wrapper">
	<?php if ( have_posts() ) : ?>

		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;
			// Previous/next post navigation.
			pp_paging_nav();

		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'content', 'none' );

		endif;
	?>
	</div>
</div>


<?php

get_footer();