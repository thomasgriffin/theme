<?php get_header(); ?>

<?php affwp_page_header(); ?>

<?php if ( have_posts() ) : ?>
	<div class="columns-main-side columns">
		<div class="wrapper">
			<div class="primary col content-area">
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>
			
			<nav class="nav-links columns columns-2 clear">
				<span class="nav-previous col">
					<?php next_posts_link( __( '&larr; Older', 'affwp' ) ); ?>
				</span>

				<span class="nav-next col">
					<?php previous_posts_link( __( 'Newer &rarr;', 'affwp' ) ); ?>
				</span>
			</nav>

			</div>
		
		<?php get_sidebar(); ?>
		</div>
	</div>
<?php endif; ?>
<?php get_footer(); ?>