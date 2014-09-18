<?php
/**
 * Template Name: About
 */

get_header(); ?>

<?php affwp_page_header(); ?>

<div class="primary content-area">
	<div class="wrapper">
		<div class="profile">
			<a href="http://twitter.com/pippinsplugins" title="Follow Pippin on Twitter" target="_blank">
				<svg width="80px" height="80px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-twitter'; ?>"></use>
				</svg>
			</a>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/about.jpg" alt="Pippin Williamson" />
		</div>
			
		

		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'page' );

			endwhile;
		?>
	</div>

</div>

<?php
get_footer();
