<?php
/**
 * Template Name: Changelog
 */

get_header(); ?>

<?php affwp_page_header(); ?>

<div class="primary content-area">
	<div class="wrapper">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
				// Page thumbnail and title.
				affwp_post_thumbnail();
			?>

			<div class="entry-content">
				<?php
					$changelog = stripslashes( wpautop( get_post_meta( affwp_get_affiliatewp_id(), '_edd_sl_changelog', true ), true ) );
					echo apply_filters( 'the_content', $changelog );
				?>
			</div>
		</article>
	</div>
</div>
<?php
get_footer();
