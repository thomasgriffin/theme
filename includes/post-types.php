<?php
/**
 * Post Type Functions
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;




/**
 * Setup Documentation Post Type
 *
 * Registers the Documentation CPT.
 *
 * @access      private
 * @since       1.0
 * @return      void
*/
function affwp_post_types() {

	$labels = array(
		'name' 				=> '%2$s',
		'singular_name' 	=> '%1$s',
		'add_new' 			=> __('Add New', 'affwp'),
		'add_new_item' 		=> __('Add New %1$s', 'affwp'),
		'edit_item' 		=> __('Edit %1$s', 'affwp'),
		'new_item' 			=> __('New %1$s', 'affwp'),
		'all_items' 		=> __('All %2$s', 'affwp'),
		'view_item' 		=> __('View %1$s', 'affwp'),
		'search_items' 		=> __('Search %2$s', 'affwp'),
		'not_found' 		=>  __('No %2$s found', 'affwp'),
		'not_found_in_trash'=> __('No %2$s found in Trash', 'affwp'),
		'parent_item_colon' => '',
		'menu_name' 		=> __('%2$s', 'affwp')
	);

	foreach ( $labels as $key => $value ) {
	   $labels[ $key ] = sprintf( $value, affwp_get_label_singular(), affwp_get_label_plural() );
	}

	$args = array(
		'labels'    			=> $labels,
		'public'    			=> true, 
		'publicly_queryable' 	=> true,
		'show_ui'    			=> true,
		'show_in_menu'  		=> true,
		'query_var'   			=> true,
		'rewrite' 				=> array( 'slug' => 'docs', 'with_front' => false ),
		'map_meta_cap' 			=> true, 
		'has_archive'   		=> false,
		'hierarchical'   		=> false,
		'supports'    			=> array( 'title', 'editor', 'page-attributes', 'revisions', 'comments', 'excerpt', 'thumbnail' ),
	);

	register_post_type( 'docs', $args );

	

}
add_action( 'init', 'affwp_post_types', 100 );

/**
 * Get Default Label
 *
 * @access      public
 * @since       1.0
 * @return      array
*/
function affwp_get_default_labels() {
	$defaults = array(
	   'singular' => __( 'Documentation', 'affwp' ),
	   'plural' => __( 'Documentation', 'affwp' ),
	);

	return $defaults;
}


/**
 * Get Label Singular
 *
 * @access      public
 * @since       1.0
 * @return      string
*/
function affwp_get_label_singular( $lowercase = false ) {
	$defaults = affwp_get_default_labels();
	return ($lowercase) ? strtolower( $defaults['singular'] ) : $defaults['singular'];
}


/**
 * Get Label Plural
 *
 * @access      public
 * @since       1.0
 * @return      string
*/
function affwp_get_label_plural( $lowercase = false ) {
	$defaults = affwp_get_default_labels();
	return ( $lowercase ) ? strtolower( $defaults['plural'] ) : $defaults['plural'];
}

/**
 * Change default "enter title here" input
 *
 * @access      public
 * @since       1.0
 * @return      string
*/
function affwp_change_default_title( $title ) {
     $screen = get_current_screen();
 
     if  ( 'docs' == $screen->post_type ) {
     	$label = affwp_get_label_singular();
        $title = sprintf( __( 'Enter %s title here', 'affwp' ), $label );
     }
 
     return $title;
}
add_filter( 'enter_title_here', 'affwp_change_default_title' );


/**
 * Setup Documentation Taxonomies
 *
 * Registers the custom taxonomies.
 *
 * @access      private
 * @since       1.0
 * @return      void
*/

function affwp_setup_taxonomies() {

	$labels = array(
		'name' 				=> _x( 'Category', 'taxonomy general name', 'affwp' ),
		'singular_name' 	=> _x( 'Category', 'taxonomy singular name', 'affwp' ),
		'search_items' 		=> __( 'Search Categories', 'affwp'  ),
		'all_items' 		=> __( 'All Categories', 'affwp'  ),
		'parent_item' 		=> __( 'Parent Category', 'affwp'  ),
		'parent_item_colon' => __( 'Parent Category:', 'affwp'  ),
		'edit_item' 		=> __( 'Edit Category', 'affwp'  ),
		'update_item' 		=> __( 'Update Category', 'affwp'  ),
		'add_new_item' 		=> __( 'Add New Category', 'affwp'  ),
		'new_item_name' 	=> __( 'New Category Name', 'affwp'  ),
		'menu_name' 		=> __( 'Categories', 'affwp'  ),
	);

	$args = array(
		'hierarchical' 	=> true,
		'labels' 		=> $labels,
		'show_ui' 		=> true,
		'query_var' 	=> 'doc_category',
		'public'		=> true,
		'rewrite' 		=> array( 'slug' => 'docs' . '/section', 'with_front' => false, 'hierarchical' => true  )
	);

	register_taxonomy( 'doc_category', array( 'docs' ), $args );
}
add_action( 'init', 'affwp_setup_taxonomies', 10 );


/**
 * Updated Messages
 *
 * Returns an array of with all updated messages.
 *
 * @access      public
 * @since       1.0
 * @return      array
*/
function affwp_updated_messages( $messages ) {
	global $post, $post_ID;

	$url1 = '<a href="' . get_permalink( $post_ID ) . '">';
	$url2 = affwp_get_label_singular();
	$url3 = '</a>';

	$messages['docs'] = array(
		1 => sprintf( __( 'Documentation updated. %1$sView %2$s%3$s.', 'affwp' ), $url1, $url2, $url3 ),
		4 => sprintf( __( 'Documentation updated. %1$sView %2$s%3$s.', 'affwp' ), $url1, $url2, $url3 ),
		6 => sprintf( __( 'Documentation published. %1$sView %2$s%3$s.', 'affwp' ), $url1, $url2, $url3 ),
		7 => sprintf( __( 'Documentation saved. %1$sView %2$s%3$s.', 'affwp' ), $url1, $url2, $url3 ),
		8 => sprintf( __( 'Documentation submitted. %1$sView %2$s%3$s.', 'affwp' ), $url1, $url2, $url3 )
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'affwp_updated_messages' );