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

/**
 * Get number of posts in each category
 * @return string number of posts
 */
function pp_get_category_post_count( $category_to_search = '' ) {
	
	if ( ! $category_to_search ) {
		return;
	}

	$args = array(
		'type'     => 'post',
		'taxonomy' => 'category',
	); 

	$categories = get_categories( $args );

	foreach ( $categories as $category ) {

		if ( $category->slug == $category_to_search ) {
			$count = $category->count;
		}
	}

	return $count;
}