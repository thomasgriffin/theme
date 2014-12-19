<?php
/*
Template Name: Blog
*/

get_header(); 

?>

<?php affwp_page_header(); ?>

<?php

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
		'posts_per_page' => 10,
		'paged'          => $paged,
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
			
			<nav class="nav-links columns columns-2">
				<span class="nav-previous col">
					<?php next_posts_link( __( '&larr; Older', 'affwp' ) ); ?>
				</span>

				<span class="nav-next col">
					<?php previous_posts_link( __( 'Newer &rarr;', 'affwp' ) ); ?>
				</span>
			</nav>

			</div>
		
	<?php endif; $wp_query = $temp; //reset back to original query ?>

		<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>