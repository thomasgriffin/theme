<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enqueue scripts.
 *
 * @since 1.2.2
 *
 * @return void
 */
function pp_theme_enqueue_countdown_scripts() {

	// Register countdown script.
	wp_register_script( 'countdown', get_stylesheet_directory_uri() . '/js/jquery.countdown.min.js', array( 'jquery' ), PP_THEME_VERSION );

	wp_register_script( 'moment-timezone', get_stylesheet_directory_uri() . '/js/moment-timezone-with-data.min.js', array(), PP_THEME_VERSION );
	wp_register_script( 'moment', get_stylesheet_directory_uri() . '/js/moment.min.js', array(), PP_THEME_VERSION );

	// Only enqueue script if a sale notice is published.
	if ( pp_theme_sale_notice_active() ) {
		wp_enqueue_script( 'moment' );
		wp_enqueue_script( 'moment-timezone' );
		wp_enqueue_script( 'countdown' );
	}

}
add_action( 'wp_enqueue_scripts', 'pp_theme_enqueue_countdown_scripts' );

/**
 * Determine if a sale notice is active (published)
 *
 * @since 1.2.2
 *
 * @return boolean $found true if found, false otherwise
 */
function pp_theme_sale_notice_active() {

	$args = array(
		'posts_per_page'   => -1,
		'meta_key'         => 'pp_notice_is_sale',
		'meta_value'       => true,
		'post_type'        => 'notices',
		'post_status'      => 'publish',
	);

	$posts = get_posts( $args );

	$found = false;

	if ( $posts ) {
		foreach ( $posts as $post ) {
			if ( 'publish' === $post->post_status && get_post_meta( $post->ID, '_enabled', true ) ) {
				$found = true;
			}
		}
	}

	return $found;

}

/**
 * Add a [countdown] shortcode
 *
 * @since 1.2.2
 *
 * @return $content
 */
function pp_theme_countdown_shortcode( $atts, $content = null ) {

	$atts = shortcode_atts(
		array(
			'end' => '',
		),
		$atts,
		'countdown'
	);

	$end_date = isset( $atts['end'] ) ? $atts['end'] : false;

	if ( ! $end_date ) {
		return $content;
	}

	// Bail if countdown script hasn't been enqueued.
	if ( ! wp_script_is( 'countdown', 'enqueued' ) ) {
		return $content;
	}

	$content = pp_theme_get_countdown( $end_date );

	return $content;
}
add_shortcode( 'countdown', 'pp_theme_countdown_shortcode');

/**
 * Get the countdown timer
 *
 * @since 1.2.2
 *
 * @return string
 */
function pp_theme_get_countdown( $end_date = '' ) {

	if ( empty( $end_date ) ) {
		return;
	}

	ob_start();
	?>
	<span id="countdown"><span id="countdown-text">Sale ends in</span><br><span id="countdown-date"></span></span><script type="text/javascript">
			var endDate = moment.tz("<?php echo $end_date; ?>", "America/Chicago");

		jQuery('#countdown-date').countdown( endDate.toDate() ).on('update.countdown', function(event) {

			var format = '%H:%M:%S';

			if ( event.offset.totalDays > 0 ) {
				format = '%-d day%!d ' + format;
			}

			if ( event.offset.weeks > 0 ) {
				format = '%-w week%!w ' + format;
			}

			jQuery(this).html(event.strftime(format));

		}).on('finish.countdown', function(event) {
			jQuery('#notification-area').hide();
		});
	</script>

	<?php
	return ob_get_clean();
}
