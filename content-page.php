<?php
/**
 * The template used for displaying page content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Page thumbnail and title.
		affwp_post_thumbnail();
	//	affwp_the_title();
	?>

	<div class="entry-content">
		<?php
			the_content();
		?>
	</div>
</article>
