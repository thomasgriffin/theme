<?php
/**
 * Functions
 */

/**
 * Checks for existance of function in custom functionality plugin
 * @return [type] [description]
 */
function pp_product_is_coming_soon( $id ) {
	if ( ! function_exists( 'pp_custom_product_is_coming_soon' ) ) {
		return;
	}

	return pp_custom_product_is_coming_soon( $id );	

}