<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @since AffiliateWP 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="site" class="hfeed">

	<div id="masthead">
		
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="masthead-logo" rel="home" title="<?php echo get_bloginfo( 'name' ); ?>">
			<svg width="40px" height="48px" viewBox="0 0 40 48">
				<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-logo'; ?>"></use>
			</svg>
		</a>

		<?php do_action( 'pp_masthead' ); ?>

		<?php if ( is_home() ) : ?>
			<header class="page-header">
				<h1 class="page-title">Pippin’s Plugins</h1>
				<h2>Finely crafted WordPress plugins, tutorials, reviews and more</h2>
				
				<a class="button huge" href="<?php echo site_url( 'products' ); ?>">View the plugins</a>
				
			</header>

			<section class="section columns columns-3 products">
		<div class="wrapper">
		<div class="col">
			<a id="p1" href="<?php echo site_url('products/affiliatewp'); ?>">
				<svg width="307px" height="45px">
					<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-affwp'; ?>"></use>
				</svg>
				<p>The best WordPress affiliate management system <span>&rarr;</span></p>
			</a>	

		</div>

		<div class="col">
			<a id="p2" href="<?php echo site_url('products/easy-digital-downloads'); ?>">
				<svg width="307px" height="45px">
					<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-edd'; ?>"></use>
				</svg>
				<p>The best WordPress e-commerce solution for digital products <span>&rarr;</span></p>
			</a>
				
		</div>

		<div class="col">
			<a id="p3" href="<?php echo site_url('products/restrict-content-pro'); ?>">
				<svg width="307px" height="45px">
					<use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-rcp'; ?>"></use>
				</svg>
				<p>The best WordPress membership &amp; premium content manager solution <span>&rarr;</span></p>
			</a>

		</div>
		</div>
		
	</section>
		<?php endif; ?>
	</div>	

	

	<?php do_action( 'affwp_content_before' ); ?>
	<div id="content">
		<?php do_action( 'affwp_content_start' ); ?>
		<div class="wrapper">
