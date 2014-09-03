<?php
/*
Template Name: Blog
*/

get_header(); 

?>

<?php affwp_page_header(); ?>

<?php
	/**
	 * Displays the most recent post
	 */
	$args = array(
		'posts_per_page' => 10
	);

	$temp = $wp_query; // assign original query to temp variable for later use  
	$wp_query = null;
	$wp_query = new WP_Query( $args ); 

	if ( have_posts() ) : ?>
	<div class="columns-main-side columns">
		<div class="wrapper">
			<div class="col content-area">
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>
			</div>
		
	<?php endif; $wp_query = $temp; //reset back to original query ?>

		<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>