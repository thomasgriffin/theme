<?php
/**
 * Enqueue scripts and styles
 */


function affwp_enqueue_scripts() {

	// Loads our main stylesheet.
	wp_enqueue_style( 'affwp-style', get_stylesheet_uri(), array(), AFFWP_THEME_VERSION );

	/**
	 * AffiliateWP JS
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
 * Fittext
 *
 * @since 1.0
*/
function affwp_flexslider() {

	if ( ! is_front_page() )
		return;
?>
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery('.flexslider').flexslider({
				animation: "fade",
				easing: "easeInOutQuad",
				manualControls: "#slider-nav .item div",
				directionNav: false,
				animationSpeed: 250,
				pauseOnHover: true,
				after: function( slider ) {
					var targetText = jQuery('.flex-active-slide img').attr('alt');
					jQuery( 'section.featured h2' ).text( targetText );
				}
			});

			// wraps the next/prev text with <span> tag for the arrows
			jQuery('.flexslider .flex-direction-nav li a').wrapInner('<span class="screen-reader-text" />');

			// duplicate the class of the anchor links and add them to the <li>
			jQuery('.flexslider .flex-direction-nav li a').each(function(){
			 $this = jQuery(this);
			 $this.closest('li').addClass( $this.attr('class') ); 
			 $this.removeClass();
			});
		});
	</script>
<?php }
add_action( 'wp_footer', 'affwp_flexslider', 50 );

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
 * Home JS
 */
function affwp_social_js() {

	if ( is_front_page() ) :
	
	?>

	<script type="text/javascript">
		jQuery(document).ready(function($) {

	      $("#sharing-home").waypoint(function( direction ) {

	       	// LinkedIn
	       	if ( typeof (IN) != 'undefined' ) {
	       	    IN.parse();
	       	} 
	       	else {
	       	   $.getScript("https://platform.linkedin.com/in.js");
	       	}

	        	<?php 
	        	/**
	        	 * Twitter
	        	*/
	        	?>
	          	window.twttr = (function (d,s,id) {
	        	  var t, js, fjs = d.getElementsByTagName(s)[0];
	        	  if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
	        	  js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
	        	  return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
	        	}(document, "script", "twitter-wjs"));

	        	<?php 
	        	/**
	        	 * Google +
	        	*/
	        	?>
	        	window.___gcfg = {
	        	  lang: 'en-US',
	        	  parsetags: 'onload'
	        	};

	        	(function() {
	        	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	        	    po.src = 'https://apis.google.com/js/plusone.js';
	        	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	        	  })();

	        	<?php
	        	/**
	        	 * Facebook
	        	*/
	        	?>
	        	(function(d, s, id) {
	        	     var js, fjs = d.getElementsByTagName(s)[0];
	        	     if (d.getElementById(id)) {return;}
	        	     js = d.createElement(s); js.id = id;
	        	     js.src = "//connect.facebook.net/en_US/all.js";
	        	     fjs.parentNode.insertBefore(js, fjs);
	        	 }(document, 'script', 'facebook-jssdk'));

	        	window.fbAsyncInit = function() {
	        	    // init the FB JS SDK
	        	    FB.init({
	        	      status	: true,
	        	      cookie	: true,                               
	        	      xfbml		: true                              
	        	    });

	        	};

	      },{
	        offset: 'bottom-in-view'
	      });

		});
	</script>
	<?php endif; ?>

	

<?php }
add_action( 'wp_footer', 'affwp_social_js', 100 );

/**
 * Adjust layout of items in header to compensate for the admin bar if it's showing
 */
function pp_offset_admin_bar() {
	if ( is_admin_bar_showing() ) {
		?>
		<style>#masthead-logo,#masthead .search-form{top:32px;}</style>
	<?php }
}
add_action( 'wp_head', 'pp_offset_admin_bar', 100 );