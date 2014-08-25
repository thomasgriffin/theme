<?php

/**
 * Prevent tabbing from one form to another accidentally
 *
 * @since 1.4.8
*/
add_filter( 'gform_tabindex', '__return_false' );

/**
 * Gravity Forms - remove validation message
 *
 * @since 1.0
*/
function affwp_gform_validation_message( $validation_message, $form ) {
	return '';
}
add_filter( 'gform_validation_message', 'affwp_gform_validation_message', 10, 2 );

/**
 * Gravity Forms - change spinner
 *
 * @since 1.0
*/
function affwp_gform_ajax_spinner_url( $uri, $form ) {
	return get_stylesheet_directory_uri() . '/images/ajax-loader.gif';
}
add_filter( 'gform_ajax_spinner_url', 'affwp_gform_ajax_spinner_url', 10, 2 );

/**
 * Gravity Forms - add note after button
 *
 * @since 1.0
*/
function affwp_gform_submit_button( $button_input, $form ) {

	ob_start();
?>
	<?php if ( is_home() ) : ?>
		<span class="no-spam">(we hate spam just as much as you)</span>

	<?php endif; ?>

	<?php 
	return $button_input . ob_get_clean();
}
// only applies to form #1
add_filter( 'gform_submit_button_1', 'affwp_gform_submit_button', 10, 2 );

/**
 * Gravity Forms - add icon after email submission
 *
 * @since 1.0
*/
function affwp_gform_pre_enqueue_scripts() { ?>
	<i class="icon icon-mail"></i>
<?php }
add_action( 'gform_post_submission', 'affwp_gform_pre_enqueue_scripts' );