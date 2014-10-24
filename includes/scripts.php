<?php
/**
 * Enqueue scripts and styles
 */


function affwp_enqueue_scripts() {

	// Loads our main stylesheet.
	wp_enqueue_style( 'affwp-style', get_stylesheet_uri(), array(), AFFWP_THEME_VERSION );

	/**
	 * JS
	 * Modernizer, FancyBox, Respond.js, affwp.js
	 */
	wp_register_script( 'pippinsplugins-js', get_template_directory_uri() . '/js/pippinsplugins.min.js', array( 'jquery' ), AFFWP_THEME_VERSION, true );
	wp_enqueue_script( 'pippinsplugins-js' );

	/**
	 * Comments
	 */
	wp_register_script( 'comment-reply', '', '', '',  true );

	// We don't need the script on pages where there is no comment form and not on the homepage if it's a page. Neither do we need the script if comments are closed or not allowed. In other words, we only need it if "Enable threaded comments" is activated and a comment form is displayed.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// dequeue AffiliateWP's form.css stylesheet
	wp_dequeue_style( 'affwp-forms' );
}
add_action( 'wp_enqueue_scripts', 'affwp_enqueue_scripts' );

/**
 * Fancybox
 * @since  1.0
 */
function affwp_fancybox() {
?>


	<script type="text/javascript">
		jQuery(document).ready(function() {
		//	jQuery(".enlarge").fancybox({
			jQuery("a:has(img)[href$='.jpg'], a:has(img)[href$='.png'], a:has(img)[href$='.gif']").addClass('enlarge').append('<span class="enlarge"><span class="icon"></span></span>').fancybox({	
				helpers: {
				    overlay: null
				  },
				openEffect	: 'elastic',
				closeEffect	: 'elastic'
			});

		});
	</script>
<?php }
add_action( 'wp_footer', 'affwp_fancybox', 100 );


/**
 * Adjust layout of items in header to compensate for the admin bar if it's showing
 */
function pp_offset_admin_bar() {
	if ( is_admin_bar_showing() ) {
		?>
		<style>#masthead-logo,#masthead .search-form,#masthead .cart{top:32px;}</style>
	<?php }
}
//add_action( 'wp_head', 'pp_offset_admin_bar', 100 );