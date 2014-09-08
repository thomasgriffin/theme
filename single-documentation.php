<?php
/**
 * The Template for displaying all single posts
 */
get_header(); ?>



<?php affwp_page_header(); ?>

<section class="section columns-3 columns">
	<div class="col left">
		<?php echo pp_single_doc_info(); ?>
	</div>
	
	<div class="primary col">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'box', 'doc' ) ); ?>>
					
				<?php affwp_post_thumbnail(); ?>
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'affwp' ) ); ?>
					</div>
				</article>

			<?php endwhile; ?>

	</div>

	

<?php get_sidebar( 'documentation' ); ?>

</section>

<?php
get_footer();