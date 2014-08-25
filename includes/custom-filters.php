<?php
/**
 * Custom Filters for headings etc used specifically for this website
 */

/**
 * Support page - customer header
 */
function affwp_the_title_support( $title ) {
	if ( ! is_page_template( 'page-templates/support.php' ) )
		return $title;
	
	ob_start();
	?>
	
	<h1 id="rotate">
		<div>Something not working?</div>
		<div>Have a pre-sale question?</div>
		<div>Want to request a feature?</div>
	</h1>
<?php 
	return ob_get_clean();
}
add_filter( 'affwp_the_title', 'affwp_the_title_support' );


/**
 * Modify the page header excerpt on the testimonials page
 */
function affwp_testimonials_sub_header( $sub_header ) {
	if ( ! is_page_template( 'page-templates/testimonials.php' ) )
		return $sub_header;

	$sub_header = '<h2><a href="' . site_url( 'pricing' ) .'" title="Join these happy customers">Join these happy customers</a></h2>';

	return $sub_header;
}
add_filter( 'affwp_excerpt', 'affwp_testimonials_sub_header' );

/**
 * Modify the age header excerpt on the success page
 */
function affwp_edd_modify_excerpt( $sub_header ) {
	if ( function_exists( 'edd_is_success_page' ) && ! edd_is_success_page() )
		return $sub_header;

	$sub_header = affwp_edd_thank_customer();

	return $sub_header;
}
add_filter( 'affwp_excerpt', 'affwp_edd_modify_excerpt' );

/**
 * Filter the page titles
 *
 * @since 1.0
*/
function affwp_show_the_title( $title, $id ) {

	// about
	if ( 'page-templates/about.php' == get_post_meta( $id, '_wp_page_template', true ) ) {
		$title = __( 'Who we are', 'affwp' );
	}

	// purchase confirmation
	if ( function_exists( 'edd_is_success_page' ) && edd_is_success_page() && $id == get_the_ID() ) {
		if ( edd_get_purchase_session() ) {
			$title = sprintf( __( 'Thanks %s!', 'affwp' ), affwp_edd_purchase_get_first_name() );
		}
		// no purchase session
		else {
			$title = __( 'Thanks!', 'affwp' );
		}
	}

    return $title;
}
add_filter( 'the_title', 'affwp_show_the_title', 10, 2 );