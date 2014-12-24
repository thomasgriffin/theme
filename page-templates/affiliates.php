<?php
/**
 * Template Name: Affiliates
 */

get_header(); ?>


<?php affwp_page_header(); ?>


<?php 
// user is logged in and is an affiliate, load the dashboard
// uses a sidebar layout
if ( is_user_logged_in() && affwp_is_affiliate() ) : ?> 

	<div class="columns-main-side columns">
		<div class="wrapper">

			<div class="primary col content-area">
				<article class="page">
					<?php affiliate_wp()->templates->get_template_part( 'dashboard' ); ?>	
				</article>
				
			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php 
// user is logged in and affiliate registration is allowed
// show the affiliate registration form in a single colum
elseif ( is_user_logged_in() && affiliate_wp()->settings->get( 'allow_affiliate_registration' ) ) : ?>

	<div class="primary slim content-area">
		<div class="wrapper">
			<article class="page">
				<?php affiliate_wp()->templates->get_template_part( 'register' ); ?>
			</article>
		</div>
	</div>
		
<?php else : // show the dual login and register forms ?>

	<?php 
	// affiliate registration is allowed, show 2 columns with registration form and login form
	if ( affiliate_wp()->settings->get( 'allow_affiliate_registration' ) ) : ?>

		<div class="columns columns-2">

				<div class="wrapper clear">

					<div class="col">
						<article class="page">
						<?php affiliate_wp()->templates->get_template_part( 'register' ); ?>
						</article>

					</div>

					<div class="col">
						<article class="page">
						<?php affiliate_wp()->templates->get_template_part( 'login' ); ?>
						</article>
					</div>


				</div>

		</div>

	<?php 
	// just show login form in 1 column layout
	else : ?>

	<div class="primary slim content-area">
		<div class="wrapper">
			<article class="page">
			<?php affiliate_wp()->templates->get_template_part( 'login' ); ?>
			</article>
		</div>

	</div>

	<?php endif; ?>

	

<?php endif; ?>

<?php
get_footer();
