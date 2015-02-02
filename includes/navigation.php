<?php


function pp_load_main_navigation() {

	// don't load navigation on checkout
	if ( function_exists( 'edd_is_checkout' ) && edd_is_checkout() )
		return;

		ob_start();
	?>

	

	<nav id="main" class="site-navigation primary-navigation" role="navigation">
	<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'pp' ); ?></a>
	<?php
		wp_nav_menu(
		  array(
		    'menu' 				=> 'main_nav',
		    'menu_class' 		=> 'menu',
		    'theme_location' 	=> 'primary',
		    'container' 		=> '',
		    'container_id' 		=> 'main',
		    'depth' 			=> '1',
		  )
		);
	?>
	
	</nav>

	<?php pp_sharing_navigation(); ?>

<?php 
	echo ob_get_clean(); 
}
add_action( 'pp_masthead_col_2', 'pp_load_main_navigation' );

/**
 * Navigation extras
 *
 * @since 1.0
*/
function pp_load_navigation_extras() {

	// don't load on checkout
	if ( function_exists( 'edd_is_checkout' ) && edd_is_checkout() )
		return;

	if ( function_exists( 'pp_share_icon' ) ) {
		pp_share_icon();
	}	

	if ( function_exists( 'pp_show_cart_quantity_icon' ) ) {
		pp_show_cart_quantity_icon();
	}

	get_search_form();
}
add_action( 'pp_masthead_col_3', 'pp_load_navigation_extras' );


/**
 * Append cart onto primary navigation
 *
 * @since 1.0
*/
function pp_wp_nav_menu_items( $items, $args ) {
    if ( 'primary' == $args->theme_location ) {
    	$items .= pp_nav_account();

    	return $items;
    }

	return $items;
}
add_filter( 'wp_nav_menu_items', 'pp_wp_nav_menu_items', 10, 2 );


/**
 * Highlight menu items
 *
 * @since 1.0
 */
function pp_highlight_menu_item( $classes ) {

	if ( is_singular( 'download' ) ) {
	    if ( in_array ( 'products', $classes ) ) {
	      $classes[] = 'current-menu-item';
	    }
	}

	if ( is_singular( 'post' ) && has_category( 'tutorials' ) ) {
	    if ( in_array ( 'learn', $classes ) ) {
	      $classes[] = 'current-menu-item';
	    }
	}

	if ( is_singular( 'post' ) && ! has_category( 'tutorials' ) && ! has_category( 'reviews' ) ) {
	    if ( in_array ( 'blog', $classes ) ) {
	      $classes[] = 'current-menu-item';
	    }
	}

	if ( is_singular( 'post' ) && has_category( 'reviews' ) ) {
	    if ( in_array ( 'reviews', $classes ) ) {
	      $classes[] = 'current-menu-item';
	    }
	} 

	return $classes;
}
add_filter( 'nav_menu_css_class', 'pp_highlight_menu_item' );


/**
 * Append account to main navigation
 * @return [type] [description]
 */
function pp_nav_account() { 
	global $current_user;
	get_currentuserinfo();

	$account_page 		= '/account';
	$affiliates_page 	= '/affiliates';
	
	ob_start();
	?>

	<?php
		$active = is_page( 'join-the-site' ) ? ' current-menu-item' : '';

		if ( ! is_user_logged_in() ) :
	?>
		<li class="menu-item account<?php echo $active; ?>">
			<a title="<?php _e( 'Join the site', 'pp' ); ?>" href="<?php echo site_url( 'join-the-site' ); ?>"><?php _e( 'Join', 'pp' ); ?></a>
		</li>
	<?php endif; ?>


	<?php
		$active = is_page( 'account' ) || ( function_exists( 'affiliate_wp' ) && is_page( affiliate_wp()->settings->get( 'affiliates_page' ) ) ) ? ' current-menu-item' : '';
	?>
		<li class="menu-item account<?php echo $active; ?>">
			
			<?php if ( is_user_logged_in() ) : ?>
				<a title="<?php echo 'Your Account'; ?>" href="<?php echo site_url( $account_page ); ?>"><?php echo 'Account'; ?></a>
			<?php else : ?>
				<a title="<?php _e( 'Log in', 'pp' ); ?>" href="<?php echo site_url( $account_page ); ?>"><?php _e( 'Log in', 'pp' ); ?></a>
			<?php endif; ?>	

		</li>

	<?php $content = ob_get_contents();
    ob_end_clean();

    return $content;

    ?>

<?php }

/**
 * Prepend home link to main navigation
 * @return [type] [description]
 */
function pp_nav_home() { 
	 ob_start();
	?>
	
	<li class="menu-item home">
		<a title="Home" href="/">Home</a>
	</li>

	<?php $content = ob_get_contents();
    ob_end_clean();

    return $content;

    ?>

<?php }