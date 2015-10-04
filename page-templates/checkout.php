<?php
/**
 * Template Name: Checkout
 */

get_header(); ?>

<?php pp_page_header(); ?>

<div class="primary content-area">
	<div class="wrapper">

	<?php if ( function_exists( 'pp_came_from_rcp' ) && pp_came_from_rcp() ) : ?>
	<div class="notice">
		<p>You've just arrived from the Restrict Content Pro website, complete your purchase below.</p>
	</div>
	<?php endif; ?>

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
get_footer();
