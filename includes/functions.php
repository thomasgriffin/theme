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

	if( 'free-members' === $category_to_search ) {

		$all   = get_category( 'tutorials' );
		$paid  = get_category( 'subscriber-only' );
		$count = $all->category_count - $paid->category_count;

	} else {

		$cat   = get_category( $category_to_search );
		$count = $cat->category_count;

	}

	return $count;
}

/**
 * Get number of posts
 * Excludes free or premium posts
 * @return string number of posts
 */
function pp_get_post_count() {

	$args = array(
	  'post_type' => 'post',
	  'posts_per_page' => -1,
	  'category__not_in' => array( 21 )
	);

	$posts = new WP_Query( $args );

	return $posts->post_count;
}

/**
 * Get number of posts
 * Excludes free or premium posts
 * @return string number of posts
 */
function pp_get_download_count() {

	$args = array(
	  'post_type' => 'download',
	  'posts_per_page' => -1,
	);

	$posts = new WP_Query( $args );

	return $posts->post_count;
}