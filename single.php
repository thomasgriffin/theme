<?php
/**
 * The Template for displaying all single posts
 */

get_header(); ?>

<?php affwp_page_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<section class="section columns-3 columns">

	<div class="col left">
		<?php echo pp_blog_post_info(); ?>
	</div>

	<div class="primary col content-area">
		
		<?php get_template_part( 'content', get_post_format() ); ?>

		<?php if ( comments_open() || get_comments_number() ) {
			comments_template();
		} ?>
	
	</div>

	<?php get_sidebar( 'blog' ); ?>
		
</section>

<?php endwhile; ?>

<?php do_action( 'affwp_single_content_after' ); ?>

<?php
get_footer();