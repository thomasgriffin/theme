<?php

function pp_home_products() {
	?>

	<div id="masthead">

	

		<?php do_action( 'pp_masthead_start' ); ?>

		<?php if ( ! edd_is_checkout() ) : ?>
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
					<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-logo'; ?>"></use>
				</svg>
			</a>
		<?php endif; ?>

		<?php do_action( 'pp_masthead_end' ); ?>

	

	<?php if ( is_home() ) : ?>

		

			<header class="page-header">
				<h1 class="page-title">Pippin’s Plugins</h1>
				<h2>Finely crafted WordPress plugins, tutorials, reviews and more</h2>
				
				<a class="button huge" href="<?php echo site_url( 'products' ); ?>">View the plugins</a>
			</header>

			<section class="section columns columns-3 home-products">
				<div class="wrapper">
				<div class="col">
					<a id="p1" href="<?php echo site_url('products/affiliatewp'); ?>">
						<svg width="378px" height="45px">
							<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-affwp'; ?>"></use>
						</svg>
						<p>The best WordPress affiliate management system <span>&rarr;</span></p>
					</a>	

				</div>

				<div class="col">
					<a id="p2" href="<?php echo site_url('products/easy-digital-downloads'); ?>">
						<svg width="378px" height="45px">
							<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-edd'; ?>"></use>
						</svg>
						<p>The best WordPress e-commerce solution for digital products <span>&rarr;</span></p>
					</a>
						
				</div>

				<div class="col">
					<a id="p3" href="<?php echo site_url('products/restrict-content-pro'); ?>">
						<svg width="378px" height="45px">
							<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-rcp'; ?>"></use>
						</svg>
						<p>The best WordPress membership &amp; premium content manager solution <span>&rarr;</span></p>
					</a>

				</div>
				</div>
				
			</section>
		
	<?php endif; ?>

	</div>	

	<?php
}
add_action( 'affwp_content_before', 'pp_home_products' );