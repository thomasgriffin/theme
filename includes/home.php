<?php

/**
 * Home
 */

function affwp_home_how_it_works() {

	if ( ! is_front_page() )
		return;
	?>


	<header class="entry-header">
		<h1 class="entry-title">Pippin’s Plugins</h1>
		<h2>Premium plugins, tutorials, reviews and more</h2>
		<a class="button huge" href="<?php echo site_url( 'pricing' ); ?>">View Plugins</a>
	</header>

	<section class="section columns-main-side columns products alt3">

		<div class="wrapper">

			<div class="col last">
				stuff here
			</div>
			
			<div class="col">
				<a href="#">

				<?php /*
					<svg width="104px" height="96px" id="affwp">
						<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-affwp'; ?>"></use>
					</svg>
				*/ ?>
					<img src="<?php echo get_stylesheet_directory_uri() . '/images/product1.png'; ?>" />

					<!-- <h1>AffiliateWP</h1> -->
					<!-- <p>A complete affiliate management system for your WordPress website.</p> -->
				</a>

				<a href="#">
					<?php /*
					<svg width="96px" height="96px">
						<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-edd'; ?>"></use>
					</svg>
					*/ ?>
					<img src="<?php echo get_stylesheet_directory_uri() . '/images/product2.png'; ?>" />
					<!-- <h1>Easy Digital Downloads</h1> -->
					<!-- <p>A complete e-commerce solution for selling digital products in a light, performant, and easy to use plugin.</p> -->
				</a>

				<a href="#">
				<?php /*
					<svg width="96px" height="96px">
						<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-rcp'; ?>"></use>
					</svg>
					*/ ?>
					<img src="<?php echo get_stylesheet_directory_uri() . '/images/product3.png'; ?>" />
					<!-- <h1>Restrict Content Pro</h1> -->
					<!-- <p>A complete membership and premium content manager plugin for WordPress.</p> -->
				</a>
			</div>
			
			
		</div>


	</section>


	


		
<section class="section home alt3">

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		<div class="wrapper">

			<a class="button huge" href="<?php echo site_url( 'pricing' ); ?>">View more plugins</a>
		</div>
	</section>	

	<section id="slider-nav" class="columns columns-4 section features">
		<div class="wrapper">
			<div class="col">
				<div>
					<h3>Complete Integration</h3>	
					<p>AffiliateWP has complete integration with all major WordPress ecommerce and membership plugins. </p>
				</div>
				<p><a class="feature-link" title="View all integrations" href="<?php echo site_url( 'docs/section/integrations' ); ?>">View all integrations</a></p>

			</div>

			<div class="col">
				<div>
					<h3>Manage Your Affiliates</h3>
					<p>See your top earning affiliates, view affiliate reports, and even moderate affiliate registrations.</p>
				</div>
			</div>
			
			<div class="col">
				<div>
					<h3>Affiliate Dashboard</h3>
					<p>Affiliates can easily see how much they have earned, how much is awaiting payment, and even how their referral URLs have done over time.</p>
				</div>
			</div>

			<div class="col">
				<div>
					<h3>Real Time Reporting</h3>	
					<p>View graphs of referrals over time, easily seeing your site's affiliate marketing performance.</p>
				</div>
			</div>
		</div>

		<div class="wrapper see-features">
			<p><a title="See a full list of features" href="<?php echo site_url( 'features' ); ?>">See a full list of features &rarr;</a></p>	
		</div>
	</section>

	<section class="section columns-4 columns more-features">
		<!-- <h1>More Goodies</h1> -->

		<div class="wrapper">
			
			<div class="col">
				
				<i class="icon-reliable-tracking"></i>
				
				<h3>Reliable Affiliate Tracking</h3>	
				<p>AffiliateWP tracks affiliate referrals reliably, even on servers with aggressive caching.</p>
			</div>

		
			<div class="col">
				<i class="icon-easy-setup"></i>
				<h3>Easy Setup</h3>	
				<p>Just install and activate and you've got your very own affiliate network within minutes.</p>
			</div>
			
			<div class="col">
				<i class="icon-unlimited-affiliates"></i>
				<h3>Unlimited Affiliates</h3>	
				<p>Have an unlimited number of affiliates actively promoting your products and services.</p>
			</div>

			<div class="col">
				<i class="icon-moderated-registration"></i>
				<h3>Moderated Registration</h3>
				<p>Affiliates' registrations can be moderated or fully open, you can even create accounts manually.</p>
			</div>

			<div class="col">
				<i class="icon-extensive-docs"></i>
				<h3>Extensive Documentation</h3>	
				<p>We've got all the documentation you need to quickly get up and running.</p>
			</div>

			<div class="col">
				<i class="icon-support"></i>
				<h3>World Class Support</h3>	
				<p>If you require assistance, our support is considered to be the best in the industry.</p>
			</div>

			<div class="col">
				<i class="icon-translation-ready"></i>
				<h3>Fully Internationalized</h3>	
				<p>AffiliateWP is ready to be translated into your language. As always, translations are welcome!</p>
			</div>

			<div class="col">
				<i class="icon-coupon-tracking"></i>
				<h3>Coupon Tracking</h3>	
				<p>Affiliate coupon tracking for WooCommerce, Easy Digital Downloads, and Restrict Content Pro.</p>
			</div>
		</div>

	</section>





	<section class="section home alt ">
		<div class="wrapper">
			<h1>Some heading</h1>	
			
		</div>
	</section>

	<section class="section home columns-2 columns testimonials">
		<h1>A few of our happy customers</h1>
		<a title="Testimonials" href="<?php echo site_url( 'testimonials' ); ?>">View more testimonials</a>

		<div class="wrapper">
			<div class="col">
				<blockquote>
		          <p>Affiliates can have a huge impact on sales, but the solutions out there are clunky. I wanted something self hosted, well written, and built on WordPress’ foundation. Coming from something dated, slow, and unstable: AffiliateWP is a breath of fresh air.</p>
		          <footer>Jonathan Christopher, SearchWP</footer>
		        </blockquote>
			</div>

			<div class="col">
				 <blockquote>
		          <p>AffiliateWP allowed me to have a feature rich affiliate system for WP-Push in less than 10 minutes. Super simple to setup, easy to maintain, and perfect for my needs.</p>
		          <footer>Chris Klosowski, WP-Push</footer>
		        </blockquote>
			</div>
			
			<div class="col">
				 <blockquote>
		          <p>I needed a simple, user friendly referral system to help promote my digital products on my site. AffiliateWP provides this for me along with an easy integration with my store. No other affiliate system available is better.</p>
		          <footer>Sebs Studio</footer>
		        </blockquote>
			</div>

			<div class="col last">
				 <blockquote>
		          <p>I spend all day in my WordPress dashboard so I wanted, nay, needed an affiliate solution that integrated flawlessly with WordPress. AffiliateWP was set up in minutes, is completely accurate, and helps me grow my business. It doesn't hurt that it's built by people you can trust either.</p>
		          <footer>James Laws, Ninja Forms</footer>
		        </blockquote>
			</div>
		</div>
	</section>

	<section class="section home alt2 guarantee">
		<div class="wrapper">
			<h1><span>30 Day Money Back Guarantee</span></h1>
			<p>If you are unhappy with your purchase, or you have an issue that we are unable to resolve that makes the system unusable, we are more than happy to provide a complete refund within 30 days of your original purchase. See our complete <a title="refund-policy" href="<?php echo site_url( 'refund-policy' ); ?>">refund policy</a>.</p>
			<a class="button huge" href="<?php echo site_url( 'pricing' ); ?>">Get Started</a>
		</div>
	</section>

	<section id="sign-up" class="section home subscribe">
		<h1>We’re only just getting started</h1>
		<h2>Sign up below and we'll keep you in the loop</h2>
		<div class="mailing-list">

			<div class="wrapper box">
				<?php 

					if ( function_exists( 'gravity_form' ) ) {
						gravity_form( 1, false, false, false, '', true );
					}
				?>

			</div>
			
		</div>
	</section>

		
	<section class="section home share" id="sharing-home">
		<?php echo affwp_share_box( '', 'AffiliateWP - The best affiliate marketing plugin for WordPress' ); ?>
	</section>
		

	
<?php }
add_action( 'affwp_content_before', 'affwp_home_how_it_works' );