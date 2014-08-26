<?php


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