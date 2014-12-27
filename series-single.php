<?php
/**
 * The Template for displaying all single series
 */
get_header(); ?>
	
<?php pp_page_header(); ?>

<section class="section clear columns-3 columns">

	<div class="col left">
		<?php echo pp_single_post_type_info(); ?>
	</div>
	
	<div class="primary col content-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'box', 'post' ) ); ?>>
					
					<?php pp_post_thumbnail( 'pp-large' ); ?>
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pp' ) ); ?>
					</div>
				</article>

			<?php endwhile; ?>
	</div>

	<?php get_sidebar(); ?>
		
</section>

<?php
get_footer();