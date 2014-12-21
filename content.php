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

	<?php //do_action( 'pp_content_single_start' ); ?>


		

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
		
		<?php if ( is_category( 'tutorials' ) ) : ?>

			<footer>
				<a href="<?php the_permalink(); ?>">Learn now &rarr;</a>

				
				<div class="tutorial-meta">
				<?php if ( ! has_category( 'subscriber-only' ) ) : ?>
					<a href="#" class="tutorial everyone" title="These tutorials are available for everyone">For Everyone</a>
				<?php endif; ?>	

				<?php if ( has_category( 'subscriber-only' ) ) : ?>
					<a href="<?php echo get_category_link( get_cat_ID( 'subscriber-only' ) ); ?>" class="tutorial members" title="These tutorials are available for members only">For Members</a>
				<?php endif; ?>	

				<?php if ( has_category( 'beginner' ) ) : ?>
					<a href="<?php echo get_category_link( get_cat_ID( 'beginner' ) ); ?>" class="tutorial beginner" title="This tutorial requires a beginner skill level">Beginner</a>
				<?php endif; ?>	

				<?php if ( has_category( 'intermediate' ) ) : ?>
					<a href="<?php echo get_category_link( get_cat_ID( 'intermediate' ) ); ?>" class="tutorial intermediate" title="This tutorial requires an intermediate skill level">Intermediate</a>
				<?php endif; ?>	

				<?php if ( has_category( 'advanced' ) ) : ?>
					<a href="<?php echo get_category_link( get_cat_ID( 'advanced' ) ); ?>" class="tutorial advanced" title="This tutorial requires an advanced skill level">Advanced</a>
				<?php endif; ?>

				<?php if ( get_post_meta( get_the_ID(), 'series_id', true ) ) : ?>
					<a href="<?php echo get_post_type_archive_link( 'series' ); ?>" class="tutorial series" title="This tutorial is part of a series">Part Of Series</a>
				<?php endif; ?>

				


				</div>

			</footer>
		<?php else : ?>
			<footer>
			<a href="<?php the_permalink(); ?>">Read now &rarr;</a>
			</footer>
		<?php endif; ?>
			
	<?php endif; ?>




<?php
	// Upsell non-members to premium content
if ( has_category( 'member-restricted' ) && is_singular() && ! rcp_is_active() ) : ?>
		<a href="<?php echo site_url('join-the-site'); ?>" class="upsell">
		<div class="box columns columns-2">
			
				<div class="col">
					<?php if ( has_category( 'subscriber-only' ) ) : ?>
						<p>Join now to gain access to this tutorial and more.</p>
					<?php elseif ( has_category( 'free-members' ) ) : ?>
						<p>Join now to gain access to an ever-growing vault of information.</p>
					<?php endif; ?>
				</div>

				<div class="col align-right">
					<span class="button">Join Now</span>
				</div>
			
		</div>
		</a>
<?php endif; ?>

</article>


					

								
		