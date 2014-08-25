<?php
/**
 * The Template for displaying all single posts
 */
get_header(); ?>



<?php affwp_page_header(); ?>

<section class="section columns-3 columns">
	<div class="col left">
		<p>
		<span>Published</span>
		<?php if ( 'docs' == get_post_type() ) : ?>
			<?php printf( '<time datetime="%1$s">%2$s</time>',
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			); ?>
		<?php endif; ?>
		</p>

		<?php if ( in_array( 'doc_category', get_object_taxonomies( get_post_type() ) ) && affwp_categorized_blog() ) : ?>
			<p><span>Categories</span>
			<?php echo get_the_term_list( get_the_ID(), 'doc_category', '', '<br/>' ); ?>
			</p>
		<?php endif; ?>
	</div>
	
	<div class="primary col">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
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