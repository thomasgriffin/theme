<?php

/**
 * Get post by title
 * 
 * @since 1.0
 */
function affwp_get_post_by_title( $page_title, $post_type = 'post' , $output = OBJECT ) {
    global $wpdb;
    $post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type= %s", $page_title, $post_type) );

    if ( $post ) {
        return get_post($post, $output);
    }

    return null;
}

/**
 * Get ID of AffiliateWP product
 * 
 * @since  1.0.3
 */
function affwp_get_affiliatewp_id() {
	$id = affwp_get_post_by_title( 'affiliatewp', 'download' );
	
	if ( $id ) {
		$id = $id->ID;
		return $id;
	}

	return null;
}

/**
 * Determine if the download is coming soon or not
 * @param  $download_id ID of download to check
 * @return boolean true if addon is coming soon, false otherwise
 * @since  1.1.9
 */
function affwp_addon_is_coming_soon( $download_id ) {
	$coming_soon = get_post_meta( $download_id, '_affwp_addon_coming_soon', true );

	if ( $coming_soon ) {
		return (bool) true;
	}

	return (bool) false;
}