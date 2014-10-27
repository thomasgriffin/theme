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
<!--[if IE]>
<html class="ie no-js" <?php language_attributes(); ?>>
<![endif]-->

<!--[if !(IE) ]><!-->
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

	

	

	<?php do_action( 'affwp_content_before' ); ?>
	<div id="content">
		<?php //do_action( 'affwp_content_start' ); ?>
		<!-- <div class="wrapper"> -->