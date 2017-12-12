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

	<?php if ( is_single() ) : ?>

		<?php pp_post_thumbnail( 'large' ); ?>

		<?php do_action( 'pp_content_single_start' ); ?>

	<?php else : ?>

		<div class="entry-meta">
			<?php pp_entry_meta(); ?>
		</div>

		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>


	<?php endif; ?>

	<?php if ( is_single() ) : ?>
		<div class="entry-content">
			<?php
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );

			?>
		</div><!-- .entry-content -->

	<?php else : // blog listing or learning page ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-wrap clear">
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>

				<div class="entry-thumbnail">
					<?php pp_post_thumbnail( 'large' ); ?>
				</div>

			</div>
		<?php else : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>

		<?php pp_post_footer(); ?>

	<?php endif; ?>

</article>
