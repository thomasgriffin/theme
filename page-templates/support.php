<?php
/**
 * Template Name: Support
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<?php affwp_page_header(); ?>

<section class="section columns-3 columns">
	<div class="col left">
	</div>

	<div class="primary col content-area">
		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
		?>
	</div>

	<div class="col right bdr">
		<h2>Have you seen these?</h2>
		<ul>
			<li><a href="/support/documentation/">Documentation</a></li>
			<li><a href="/docs/section/getting-started/">Getting Started</a></li>
			<li><a href="/docs/section/integrations/">Integrations</a></li>
			<li><a href="/docs/section/faq/">FAQ</a></li>
		</ul>
	</div>
		
	</section>

<?php
get_footer();
