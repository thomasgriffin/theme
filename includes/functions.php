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

	if ( 'free-members' === $category_to_search ) {
		$free  = get_term_by( 'slug', 'free', 'category' );
		$count = isset( $free->count ) ? $free->count : '';
	} else {
		$cat   = get_term_by( 'slug', $category_to_search, 'category' );
		$count = isset( $cat->count ) ? $cat->count : '';
	}

	if ( $count ) {
		return $count;
	}
	
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
	  'category_name'  => 'news'
	);

	$posts = new WP_Query( $args );

	return $posts->post_count;
}

/**
 * Get number of series
 * @return string number of series
 */
function pp_get_series_count() {

	$args = array(
	  'post_type' => 'series',
	  'posts_per_page' => -1,
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


/**
 * Exclude certain categories from the Blog
 */
function pp_pre_get_posts( $query ) {

	if( is_home() && $query->is_main_query() ) {

		$query->set( 'category__not_in', array( 29, 20, 114 ) );

	}

}
add_action( 'pre_get_posts', 'pp_pre_get_posts', 9999 );