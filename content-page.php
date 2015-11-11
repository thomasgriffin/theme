<?php
/**
 * The template used for displaying page content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php pp_post_thumbnail(); ?>

	<div class="entry-content">
	<?php do_action( 'pp_entry_content_start' ); ?>

		<?php the_content(); ?>

	<?php do_action( 'pp_entry_content_end' ); ?>
	</div>

	<?php do_action( 'pp_entry_content_after' ); ?>
</article>
