<?php

function pp_home_products() {
	?>

	<div id="masthead">



		<?php do_action( 'pp_masthead_start' ); ?>

		<?php if ( ! ( function_exists('edd_is_checkout') && edd_is_checkout() ) ) : ?>
		<div class="columns">
			<div class="wrapper">
				<div class="col col-1">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="masthead-logo" rel="home" title="<?php echo get_bloginfo( 'name' ); ?>">

						<svg width="40px" height="48px">
							<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-logo'; ?>"></use>
						</svg>
					</a>
				</div>

				<div class="col col-2">
					<?php do_action( 'pp_masthead_col_2' ); ?>
				</div>

				<div class="col col-3">
					<?php do_action( 'pp_masthead_col_3' ); ?>
				</div>
			</div>
		</div>

		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="masthead-logo" rel="home" title="<?php echo get_bloginfo( 'name' ); ?>">

				<svg width="40px" height="48px">
					<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-logo-checkout'; ?>"></use>
				</svg>
			</a>
		<?php endif; ?>

		<?php do_action( 'pp_masthead_end' ); ?>



	<?php if ( is_front_page() ) : ?>



			<header class="page-header">
				<h1 class="page-title">Pippin’s Plugins</h1>
				<h2>Finely crafted WordPress plugins, tutorials, reviews and more</h2>

				<a class="button huge" href="<?php echo site_url( 'products' ); ?>">See my plugins</a>
				<span class="or">or</span>
				<a class="button huge" href="<?php echo site_url( 'learn' ); ?>">Start learning</a>

				<?php
				/*
				<a class="button huge" href="<?php echo site_url( 'join-the-site' ); ?>">Join the site</a>
				*/
				?>
			</header>

			<section class="section columns columns-5 home-products">

				<div class="wrapper">

					<div class="col awp-col">
						<a id="p1" href="<?php echo AWP_URL; ?>">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/logos/affiliatewp-logo.svg'; ?>">
							<p>Affiliate marketing for WordPress, made easy <span>&rarr;</span></p>
						</a>
					</div>

					<div class="col edd-col">
						<a id="p2" href="<?php echo EDD_URL; ?>">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/logos/easy-digital-downloads-logo.svg'; ?>">
							<p>Sell digital downloads with WordPress for free <span>&rarr;</span></p>
						</a>
					</div>

					<div class="col sc-col">
						<a id="p3" href="<?php echo SC_URL; ?>">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/logos/sugar-calendar-logo.svg'; ?>">
							<p>WordPress event management made simple <span>&rarr;</span></p>
						</a>
					</div>

					<div class="col wpsp-col">
						<a id="p4" href="<?php echo WPSP_URL; ?>">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/logos/wp-simple-pay-logo.svg'; ?>">
							<p>The #1 Stripe payments plugin for WordPress <span>&rarr;</span></p>
						</a>
					</div>

					<div class="col ps-col">
						<a id="p5" href="<?php echo PS_URL; ?>">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/logos/payouts-service-logo.svg'; ?>">
							<p>The easiest way to pay your affiliates <span>&rarr;</span></p>
						</a>
					</div>

				</div>

			</section>

	<?php endif; ?>

	</div>

	<?php
}
add_action( 'affwp_content_before', 'pp_home_products' );