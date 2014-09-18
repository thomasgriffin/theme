<?php

/**
 * Connect icon in the main navigation
 *
 * @since 1.0
 */
function pp_share_icon() {

?>
	<a href="#" class="menu-icon connect" title="">
		<svg width="24px" height="24px">
		   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-plus'; ?>"></use>
		</svg>
	</a>
<?php }


function pp_sharing_navigation() {
	?>
	<ul class="menu-connect">	
		<li>
			<a href="http://twitter.com/pippinsplugins" target="_blank" title="Twitter">
				<svg width="30px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-twitter'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="http://vimeo.com/pippinspages" target="_blank" title="Vimeo">
				<svg width="29px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-vimeo'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="http://facebook.com/pippinsplugins" target="_blank" title="Facebook">
				<svg width="11px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-facebook'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="https://github.com/pippinsplugins" target="_blank" title="GitHub">
				<svg width="25px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-github'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="http://www.youtube.com/user/pippinsplugins" target="_blank" title="YouTube">
				<svg width="35px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-youtube'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="https://plus.google.com/101358949601627875484/posts" target="_blank" title="Google+">
				<svg width="35px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-googleplus'; ?>"></use>
				</svg>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url('feed/rss'); ?>" title="RSS">
				<svg width="24px" height="24px">
				   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-connect-rss'; ?>"></use>
				</svg>
			</a>
		</li>
	</ul>

<?php	
}



/**
 * Add social sharing to purchase confirmation header
 */
function affwp_edd_purchase_confirmation_sharing() {
	if ( function_exists( 'edd_is_success_page' ) && ! edd_is_success_page() )
		return;
	
	echo affwp_share_box( '', 'I just purchased AffiliateWP, the best affiliate marketing plugin for WordPress!' );
}
//add_action( 'affwp_page_header_end', 'affwp_edd_purchase_confirmation_sharing' );



/**
 * Add message above sharing boxes on purchase confirmation page
 */
function affwp_edd_purchase_confirmation_message() {
	if ( function_exists( 'edd_is_success_page' ) && ! edd_is_success_page() )
		return;
	?>
	<p>Now tell the world you have the best affiliate marketing plugin for WordPress</p>
	<?php
}
//add_action( 'affwp_share_box_start', 'affwp_edd_purchase_confirmation_message' );


/**
 * Load ShareDaddy buttons
 *
 * @since 1.0
*/
function affwp_sharing_display() {
	if ( function_exists('sharing_display') ) {
		echo sharing_display();
	}
	?>
	<?php
	/* <script src="http://managewp.org/share.js" data-type="small" data-title="" data-url=""></script>
	*/ ?>
	<?php
}


/**
 * Load sharing icons
 *
 * @since 1.0
*/
function affwp_share_display_repositioning() {
	if ( is_singular() ) {
		// remove default sharing buttons
		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
		// add ours
		add_action( 'affwp_single_right_column', 'affwp_sharing_display', 20 );
	}
}
add_action( 'template_redirect', 'affwp_share_display_repositioning' );


/**
 * Main share box that is displayed on the page
 */
function affwp_share_box( $url = '', $twitter_text = '' ) {
	
	
	//$twitter_text = isset( $twitter_text ) ? $twitter_text : 'I just purchased AffiliateWP, the best affiliate marketing plugin for WordPress!';

	// URL to share

	if ( $url )
		$share_url = $url;
	else
		$share_url = get_home_url( '', '', 'http' );

	ob_start();

?>
	<div class="sharing">
	<?php do_action( 'affwp_share_box_start' ); ?>

		<?php 
			$twitter_username = 'affwp';
			$twitter_count_box = 'vertical';
			$twitter_button_size = 'medium';
		?>
		<div class="share twitter">
			<a href="https://twitter.com/share" data-lang="en" class="twitter-share-button" data-count="<?php echo $twitter_count_box; ?>" data-size="<?php echo $twitter_button_size; ?>" data-counturl="<?php echo $share_url; ?>" data-url="<?php echo $share_url; ?>" data-text="<?php echo $twitter_text; ?>" data-via="<?php echo $twitter_username; ?>" data-related="pippinsplugins, sumobi_">
				Share
			</a>
		</div>

		<?php
			$data_share = 'true';
			$facebook_button_layout = 'box_count';
		?>
		
		<?php /* */ ?>
		<div class="share facebook">
			<div class="fb-like" data-href="<?php echo $share_url; ?>" data-send="true" data-action="like" data-layout="<?php echo $facebook_button_layout; ?>" data-share="<?php echo $data_share; ?>" data-width="" data-show-faces="false"></div>
		</div>
		
		<?php 
			$googleplus_button_size = 'tall';
			$google_button_annotation = 'bubble';
			$google_button_recommendations = 'false';
		?>
		<div class="share googleplus">
			<div class="g-plusone" data-recommendations="<?php echo $google_button_recommendations; ?>" data-annotation="<?php echo $google_button_annotation;?>" data-callback="plusOned" data-size="<?php echo $googleplus_button_size; ?>" data-href="<?php echo $share_url; ?>"></div>
		</div>

		<?php 
			$linkedin_counter = 'top';
		?>
		<div class="share linkedin">
			<script type="IN/Share" data-counter="<?php echo $linkedin_counter; ?>" data-onSuccess="share" data-url="<?php echo $share_url; ?>"></script>
		</div>

	</div>

<?php 
	return ob_get_clean();
}

/**
 * Social sharing scripts
 *
 * @since 2.0
*/
function affwp_social_scripts() {
	global $post;

	$success_page =  function_exists( 'edd_get_option' ) && edd_get_option( 'success_page' ) ? is_page( edd_get_option( 'success_page' ) ) : false;

	if ( ! $success_page )
		return;
	
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {

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

			<?php
			/**
			 * LinkedIn
			*/
			?>
	       	if ( typeof (IN) != 'undefined' ) {
	       	    IN.parse();
	       	} 
	       	else {
	       	   $.getScript("https://platform.linkedin.com/in.js");
	       	}
		});	
	</script>
	<?php
}
//add_action( 'wp_footer', 'affwp_social_scripts', 9999 );





