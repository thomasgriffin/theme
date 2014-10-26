<?php
/**
 * Template Name: Account
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 

// global $current_user;
// get_currentuserinfo();

$current_user = wp_get_current_user();

$name = $current_user->user_firstname ? $current_user->user_firstname : $current_user->display_name;
?>

<header class="page-header">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<h2>
		<?php if ( is_user_logged_in() ) : ?>
			<?php printf( __( 'Welcome %s', 'affwp' ), $name ); ?>
		<?php else : ?>
			<?php _e( 'Welcome back!', 'affwp' ); ?>
		<?php endif; ?>
	</h2>
</header>

<?php

/**
 * Logout message
 */
if ( isset( $_GET['logout'] ) && $_GET['logout'] == 'success' ) { ?>
	<p class="alert notice">
		<?php _e( 'You have been successfully logged out', 'affwp' ); ?>
	</p>
<?php } ?>



<?php 
// user is not logged in
if ( ! is_user_logged_in() ) : ?>



<div class="primary content-area">
	<div class="wrapper">
		<article class="page type-page status-publish hentry">
			
			<div class="entry-content">
			
				<?php echo do_shortcode( '[subscription_details]' ); ?>
				
			</div>

		</article>
	</div>
</div>

<?php 
// user is logged in
else : ?>

<div class="columns-main-side columns">
	<div class="wrapper">

		<div class="primary col content-area">
			<article class="page type-page status-publish hentry">
				
				<div class="entry-content">
					<h2>Subscription Information</h2>
					<?php echo do_shortcode( '[subscription_details]' ); ?>
					
					<h2>Plugin Purchase History</h2>
					<?php echo do_shortcode( '[purchase_history]' ); ?>

					<h2>Profile Details</h2>
					<?php echo do_shortcode( '[rcp_profile_editor]' ); ?>
				</div>

			</article>	
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php endif; ?>


