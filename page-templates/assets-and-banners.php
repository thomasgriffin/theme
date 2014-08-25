<?php
/**
 * Template Name: Assets and Banners
 *
 */

get_header(); ?>

<?php affwp_page_header(); ?>



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
		?>
	</div>
</div>

<section class="section">
	<h2>Square button - 125x125</h2>	
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-125x125-1.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-125x125-2.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-125x125-3.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-125x125-4.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-125x125-5.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-125x125-6.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-125x125-7.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-125x125-8.png'; ?>">
</section>

<section class="section">
	<h2>Half banner - 234x60</h2>
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-234x60-1.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-234x60-2.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-234x60-3.png'; ?>">
</section>

<section class="section">
	<h2>Square pop-up - 250x250</h2>
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-250x250-1.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-250x250-2.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-250x250-3.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-250x250-4.png'; ?>">
</section>

<section class="section">
	<h2>Medium rectangle - 300x250</h2>
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-300x250-1.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-300x250-2.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-300x250-3.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-300x250-4.png'; ?>">
</section>

<section class="section">
	<h2>Large rectangle - 336x280</h2>
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-336x280-1.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-336x280-2.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-336x280-3.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-336x280-4.png'; ?>">
</section>

<section class="section">
	<h2>Half page ad - 300x600</h2>
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-300x600-1.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-300x600-2.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-300x600-3.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-300x600-4.png'; ?>">
</section>

<section class="section">
	<h2>Full banner - 468x60</h2>
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-468x60-1.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-468x60-2.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-468x60-3.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-468x60-4.png'; ?>">
</section>

<section class="section">
	<h2>Leaderboard - 728x90</h2>
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-728x90-1.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-728x90-2.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-728x90-3.png'; ?>">
	<img alt="AffiliateWP" src="<?php echo get_stylesheet_directory_uri() . '/images/affiliate-banners/affiliatewp-728x90-4.png'; ?>">
</section>

<?php
get_footer();
