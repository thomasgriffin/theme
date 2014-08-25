<?php
/**
 * Template Name: Account
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 

global $current_user;
get_currentuserinfo();
?>

<header class="entry-header">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<h2>
		<?php if ( is_user_logged_in() ) : ?>
			<?php printf( __( 'Welcome %s', 'affwp' ), $current_user->display_name ); ?>
		<?php else : ?>
			<?php _e( 'Come on in!', 'affwp' ); ?>
		<?php endif; ?>

		
	</h2>


</header>

<div class="primary content-area">
	<div class="wrapper">
		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
			
			// account
			if ( function_exists( 'affwp_account' ) ) {
				echo affwp_account();
			}
		?>
	</div>
</div>
<?php
get_footer();



