<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<?php affwp_page_header(); ?>

<?php
// Start the Loop.
	while ( have_posts() ) : the_post();
?>

<section class="section columns-3 columns">

	<div class="col left box">
		<?php //echo get_avatar( get_the_author_meta('email'), '80' ); ?>
		
		<p>
		
		<?php /*
		<span>Written by <?php the_author(); ?></span>
		 */ ?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<?php printf( '<time datetime="%1$s">%2$s</time>',
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			); ?>
		<?php endif; ?>
		</p>

		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && affwp_categorized_blog() ) : ?>
			<p><span>Categories</span>
			<?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'affwp' ) ); ?>
			</p>
		<?php endif; ?>

		<?php the_tags( '<p><span>Tags</span> ', ', ', '</p>' ); ?>
		<p>
			<span>Comments</span>
			
			<?php comments_popup_link( __( 'Leave a comment', 'affwp' ), __( '1', 'affwp' ), __( '%', 'affwp' ) ); ?>
			
		</p>

	</div>


	<div class="primary col content-area">
			<?php
				

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

			// Previous/next post navigation.
		//	affwp_single_post_nav();
			?>

				<?php if ( comments_open() || get_comments_number() ) {
					comments_template();
				} ?>
	
	</div>

	<?php get_sidebar(); ?>
		
</section>

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		// if ( comments_open() || get_comments_number() ) {
		// 	comments_template();
		// }
	endwhile;
?>

<?php do_action( 'affwp_single_content_after' ); ?>



<?php
get_footer();