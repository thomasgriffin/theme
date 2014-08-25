<?php
/**
 * Append cart onto primary navigation
 *
 * @since 1.0
*/
function affwp_wp_nav_menu_items( $items, $args ) {
    if ( 'primary' == $args->theme_location ) {
    	
    	$home = ! is_front_page() ? affwp_nav_home() : '';
  //  	$items .= affwp_nav_account();
//    	$items .= affwp_nav_buy_now();

    	return $home . $items;
    }

	return $items;
}
add_filter( 'wp_nav_menu_items', 'affwp_wp_nav_menu_items', 10, 2 );

/**
 * Highlight add-ons menu item if on single download page
 */
function affwp_highlight_menu_item( $classes ) {

	if ( is_singular( 'download' ) ) {
	    if ( in_array ( 'products', $classes ) ) {
	      $classes[] = 'current-menu-item';
	    }
	}

	// if ( is_singular( 'docs' ) ) {
	//     if ( in_array ( 'support', $classes ) ) {
	//       $classes[] = 'current-menu-item';
	//     }
	// }

	if ( is_singular( 'post' ) ) {
	    if ( in_array ( 'blog', $classes ) ) {
	      $classes[] = 'current-menu-item';
	    }
	} 

	return $classes;
}
add_filter( 'nav_menu_css_class', 'affwp_highlight_menu_item' );

/**
 * Append account to main navigation
 * @return [type] [description]
 */
function affwp_nav_account() { 
	global $current_user;
	get_currentuserinfo();

	$account_link_text 	= 'Account';
	$account_page 		= '/account';
	$affiliates_page 	= '/affiliates';
	$active 			= is_page( 'account' ) || is_page( 'affiliates' ) ? ' current-menu-item' : '';


	 ob_start();
	?>


		<li class="menu-item has-sub-menu account<?php echo $active; ?>">
			<a title="<?php echo $account_link_text; ?>" href="<?php echo site_url( $account_page ); ?>"><?php echo $account_link_text; ?></a>
			<ul class="sub-menu">
				<?php if (  is_user_logged_in() ) : ?>
					<li>
						<a title="<?php echo $account_link_text; ?>" href="<?php echo site_url( $account_page ); ?>"><?php echo $account_link_text; ?></a>
					</li>
				<?php endif; ?>	
				<li>
					<a title="<?php _e( 'Affiliates', 'affwp' ); ?>" href="<?php echo site_url( $account_page . $affiliates_page ); ?>"><?php _e( 'Affiliates', 'affwp' ); ?></a>
				</li>
				<?php if( ! is_user_logged_in() ) : ?>
					<li>
						<a title="<?php _e( 'Log in', 'affwp' ); ?>" href="<?php echo site_url( $account_page ); ?>"><?php _e( 'Log in', 'affwp' ); ?></a>
					</li>
				<?php else: ?>
					
					<li>
						<a title="<?php _e( 'Log out', 'affwp' ); ?>" href="<?php echo wp_logout_url( add_query_arg( 'logout', 'success', site_url( $account_page ) ) ); ?>"><?php _e( 'Log out', 'affwp' ); ?></a>
					</li>
				<?php endif; ?>		

				
			</ul>
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
function affwp_nav_home() { 
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




