<?php
/**
 * Enqueue scripts and styles
 */


function pp_enqueue_scripts() {

	// Loads our main stylesheet.
	wp_enqueue_style( 'affwp-style', get_stylesheet_uri(), array(), AFFWP_THEME_VERSION );

	/**
	 * JS
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
add_action( 'wp_enqueue_scripts', 'pp_enqueue_scripts' );

/**
 * Simple masthead parallax scrolling effect
 * @since  1.0
 */
function pp_home_masthead() {
	if ( ! is_home() ) {
		return;
	}

	?>

	<script>
		jQuery(document).ready(function($) {

			var div = jQuery('#masthead'),
			divHeight = div.height(),
			    scroll;

			jQuery(window).scroll(function(e){

			if ( jQuery("#masthead").css("min-height") == "600px" ) {
			    scroll = jQuery(this).scrollTop();
			    div.height(divHeight - scroll)
			}
		});
	});
	</script>
	<?php
}
add_action( 'wp_footer', 'pp_home_masthead' );

/**
 * Lightbox JS
 * @since  1.0
 */
function pp_lightbox_js() {
?>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			
			// single images
			$("a:has(img)[href$='.jpg'], a:has(img)[href$='.png'], a:has(img)[href$='.gif']").not(".gallery a").addClass('zoom').magnificPopup({
				type: 'image',
				mainClass: 'mfp-with-zoom', // this class is for CSS animation below
				closeOnContentClick: true,
				closeBtnInside: true,
				zoom: {
					enabled: true,
					duration: 250,
					easing: 'ease-in-out',
					opener: function(openerElement) {
						return openerElement.is('img') ? openerElement : openerElement.find('img');
					}
				}

			});

		});
	</script>
<?php }
add_action( 'wp_footer', 'pp_lightbox_js' );

/**
 * Changelog
 */
function pp_product_changelog() {

	$changelog = get_post_meta( get_the_ID(), '_edd_sl_changelog', true );


	if ( ! ( is_singular( 'download' ) || $changelog || edd_is_checkout() ) ) {
		return;
	}

	?>

	<script type="text/javascript">
		jQuery(document).ready(function($) {

		// inline
		$('.popup-content').magnificPopup({
			type: 'inline',
			fixedContentPos: true,
			fixedBgPos: true,
			overflowY: 'scroll',
			closeBtnInside: true,
			preloader: false,
			callbacks: {
				beforeOpen: function() {
				this.st.mainClass = this.st.el.attr('data-effect');
				}
			},
			midClick: true,
			removalDelay: 300
        });

		});
	</script>

	<?php
}
add_action( 'wp_footer', 'pp_product_changelog', 100 );

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