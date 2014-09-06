<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'box' ) ); ?>>
	<!-- <header class="entry-header"> -->
		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>

		

		<?php endif; ?>

		<?php if ( is_single() ) : ?>

			<?php /*
		<h1 class="entry-title"><?php the_title(); ?></h1>
	*/ ?>
		<?php else : ?>

		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>

		<div class="entry-meta">
			<?php pp_entry_meta(); ?>
		</div>
		
		<?php endif; ?>

		

		<!-- <div class="entry-meta"> -->
			<?php /*
			<span class="comments">
				<?php comments_popup_link( __( '0', 'affwp' ), __( '1', 'affwp' ), __( '%', 'affwp' ) ); ?>
				<svg width="37px" height="32px">
					<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-comments'; ?>"></use>
				</svg>
			</span>
			*/ ?>
		
			
			<?php // edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
		<!-- </div> -->

	<!-- </header> -->

	<?php if ( is_search() || is_home() ) : // Only display Excerpts for Search ?>

	<div class="entry-summary">
		<div class="entry-thumbnail">
			<?php affwp_post_thumbnail( 'thumbnail' ); ?>
		</div>
		<?php the_excerpt(); ?>
	</div>
	
	<a href="<?php the_permalink(); ?>">Read now &rarr;</a>

	<?php else : ?>

	<div class="entry-content">
		<?php the_content( __( 'Read now <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div>

	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer>

</article>



						

								
		