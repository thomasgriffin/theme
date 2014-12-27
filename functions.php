<?php

if ( ! defined( 'PP_THEME_VERSION' ) )
	define( 'PP_THEME_VERSION', '1.0.6' );

if ( ! defined( 'PP_INCLUDES_DIR' ) )
	define( 'PP_INCLUDES_DIR', trailingslashit( get_template_directory() ) . 'includes' ); /* Sets the path to the theme's includes directory. */

/**
 * Includes
 * @since 1.0
*/
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'masthead.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'scripts.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'page-mods.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'sharing.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'gforms.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'ajax-functions.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'navigation.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'template-tags.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'testimonials.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'affiliatewp.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'gallery.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'functions.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'comment.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'checkout.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'banners.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'custom-filters.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'blog.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'restrict-content-pro.php' );
require_once( trailingslashit( PP_INCLUDES_DIR ) . 'edd.php' );

/**
 * Set up the content width value based on the theme's design.
 *
 * @since 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 592;
}

if ( ! function_exists( 'pp_setup' ) ) :
/**
 * Setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since 1.0
 */
function pp_setup() {

	load_theme_textdomain( 'pp', get_template_directory() . '/languages' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// add post format support
	add_theme_support( 'post-formats', array( 'video' ) );

	add_post_type_support( 'page', 'excerpt' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
//	set_post_thumbnail_size( 672, 372, true );

	add_image_size( 'pp-full-width', 1038, 576, true );
	add_image_size( 'pp-grid-thumbnail', 480, 240, true );
	add_image_size( 'pp-large', 592, 296, true );

	register_nav_menus( array(
		'primary'      => __( 'Primary menu', 'pp' ),
		'footer'       => __( 'Footer menu', 'pp' ),
		'useful_links' => __( 'Useful links', 'pp' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}
endif; // pp_setup
add_action( 'after_setup_theme', 'pp_setup' );


/**
 * Filter menu and add 'has-sub-menu' class to parent
 *
 * @since 1.0
*/
function pp_add_has_sub_menu_parent_class( $items ) {
  
  $parents = array();
  foreach ( $items as $item ) {
    if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
      $parents[] = $item->menu_item_parent;
    }
  }
  
  foreach ( $items as $item ) {
    if ( in_array( $item->ID, $parents ) ) {
      $item->classes[] = 'has-sub-menu'; 
    }
  }
  
  return $items;    
}
add_filter( 'wp_nav_menu_objects', 'pp_add_has_sub_menu_parent_class' );


/**
 * Remove unwanted class names from homepage
 */
function pp_remove_body_classes( $wp_classes, $extra_classes ) {
    $blacklist = array( 'blog' );

    $wp_classes = array_diff( $wp_classes, $blacklist );

    // Add the extra classes back untouched
    return array_merge( $wp_classes, (array) $extra_classes );
}
add_filter( 'body_class', 'pp_remove_body_classes', 10, 2 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0
 */
function pp_body_classes( $classes ) {
	global $post;

	// Adds a class of 'has-featured-image' if the current post has a featured image
	if ( isset( $post->ID ) && get_the_post_thumbnail( $post->ID ) )
		$classes[] = 'has-featured-image';

	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() )
		$classes[] = 'group-blog';

	// Adds a class of 'blog' if the blog template is being used. The homepage when used as a blog also has this class already
	if ( is_page_template( 'page-templates/blog.php' ) )
		$classes[] = 'blog';

	if ( is_page_template( 'page-templates/testimonials.php' ) )
		$classes[] = 'testimonials';

	if ( is_post_type_archive( 'download' ) )
		$classes[] = 'products';

	if ( is_page_template( 'page-templates/assets-and-banners.php' ) )
		$classes[] = 'assets-and-banners';

	if ( is_page_template( 'page-templates/brand-assets.php' ) )
		$classes[] = 'brand-assets';

	if ( is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';
	
	if ( is_page_template( 'page-templates/pricing.php' ) )
		$classes[] = 'pricing';

	if ( is_page_template( 'page-templates/join-the-site.php' ) )
		$classes[] = 'join';

	if ( is_page( 'register' ) )
		$classes[] = 'register';

	if ( is_page_template( 'page-templates/no-sidebar.php' ) )
		$classes[] = 'no-sidebar';

	if ( is_page_template( 'page-templates/support.php' ) )
		$classes[] = 'support';

	if ( is_page( 'about' ) )
		$classes[] = 'about';

	if ( is_user_logged_in() && isset( $post->post_content ) && has_shortcode( $post->post_content, 'purchase_history' ) )
		$classes[] = 'purchase-history';

	if ( is_page_template( 'page-templates/changelog.php' ) )
		$classes[] = 'changelog';


	if ( wp_unslash( site_url('/') ) == wp_get_referer() )
		$classes[] = 'from-home';

	if ( edd_get_cart_contents() ) {
		$classes[] = 'edd-items-in-cart';
	}

	if ( function_exists( 'edd_is_success_page' ) && edd_is_success_page() )
		$classes[] = 'purchase-confirmation';

	if ( is_page_template( 'page-templates/account.php' ) ) {
		$classes[] = 'account';
	
		if ( ! is_user_logged_in() ) {
			$classes[] = 'account-logged-out';
		}
		else {
			$classes[] = 'account-logged-in';
		}
	}

	if ( is_page_template( 'page-templates/affiliates.php' ) )
		$classes[] = 'affiliates';

	return $classes;
}
add_filter( 'body_class', 'pp_body_classes' );

/**
 * Register sidebars
 *
 * @since 1.0
 *
 * @return void
 */
function pp_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'pp' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar', 'pp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		
	) );

	register_sidebar( array(
		'name'          => __( 'About', 'pp' ),
		'id'            => 'sidebar-about',
		'description'   => __( 'About sidebar', 'pp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		
	) );

	
}
add_action( 'widgets_init', 'pp_widgets_init' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since AffiliateWP 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function pp_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'pp' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'pp_wp_title', 10, 2 );