<?php

/**
 * Sharing message
*/
function affwp_share_thanks() {

	// check nonce

	check_ajax_referer( 'affwp_ajax_nonce', 'nonce' );

//	EDD()->session->set( 'affwp_shared', true );

	$return = array(
		'msg'				=> 'valid',
		'success_title'		=> 'Thanks for sharing!',
	);

	echo json_encode( $return );

	edd_die();
}

// share product + apply discount using ajax
add_action( 'wp_ajax_share_thanks', 'affwp_share_thanks' );
add_action( 'wp_ajax_nopriv_share_thanks', 'affwp_share_thanks' );