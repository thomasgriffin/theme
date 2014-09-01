<?php

// prevent easy image gallery from inserting gallery into content area
remove_filter( 'the_content', 'easy_image_gallery_append_to_content' );

/**
 * Remove CSS
 */
function pp_eig_remove_styles() {
	wp_deregister_style( 'easy-image-gallery' ); 
}
add_action( 'wp_enqueue_scripts', 'pp_eig_remove_styles', 20 );

/**
 * Modify HTML
 */
function pp_easy_image_gallery_html( $html, $rel, $image_link, $image_class, $image_caption, $image, $attachment_id, $post_id, $count ) {

	$class = $count > 4 ? ' class="hidden"' : '';

	if ( easy_image_gallery_has_linked_images() ) {
		$html = sprintf( ' <li' . $class .'><a %s href="%s" class="%s" title="%s"><i class="icon-view"></i><span class="overlay">' . $image_caption . '</span>%s</a></li>', $rel, $image_link, $image_class, $image_caption, $image );
	}
	else {
		$html = sprintf( '<li>%s</li>', $image );
	}

	return $html;
}
add_filter( 'easy_image_gallery_html', 'pp_easy_image_gallery_html', 10, 9 );

function pp_easy_image_gallery_end() {
	echo '<li class="gap"></li> ';
	echo '<li class="gap"></li> ';
	echo '<li class="gap"></li> ';
}
add_action( 'easy_image_gallery_end', 'pp_easy_image_gallery_end' );

/**
 * Add new options to the select menu on the settings -> media page
 * @param  array $lightboxes 
 * @return array $lightboxes
 */
function pp_extend_easy_image_gallery_lightbox( $lightboxes ) {
    $lightboxes['fancybox2'] 	= 'fancyBox 2';

    return $lightboxes;
}
add_filter( 'easy_image_gallery_lightbox', 'pp_extend_easy_image_gallery_lightbox' );

/**
 * Enqueue the required scripts for the lightboxes
 * @return void
 */
function pp_extend_easy_image_gallery_scripts() {	
   	$lightbox = function_exists( 'easy_image_gallery_get_lightbox' ) ? easy_image_gallery_get_lightbox() : '';

   	if ( 'fancybox2' == $lightbox ) {
   		wp_enqueue_script( 'fancybox2',  get_template_directory_uri() . '/includes/lib/fancybox/jquery.fancybox.js', array( 'jquery' ), AFFWP_THEME_VERSION, true );
   	//	wp_enqueue_style( 'fancybox2', get_template_directory_uri() . '/includes/lib/fancybox/jquery.fancybox.css', '', AFFWP_THEME_VERSION, 'screen' );
   	}
}
add_action( 'easy_image_gallery_scripts', 'pp_extend_easy_image_gallery_scripts' );

/**
 * Load the required JS in the footer
 *
 * Easy Image Gallery has an action hook within the wp_footer. Adding the script to the 'easy_image_gallery_js' hook below will ensure that the lightbox script is loaded correctly only if we're on a singular page and the images are linked to larger versions
 * @return [type] [description]
 */
function pp_extend_easy_image_gallery_js() { 
	$lightbox = function_exists( 'easy_image_gallery_get_lightbox' ) ? easy_image_gallery_get_lightbox() : '';

	if ( 'fancybox2' == $lightbox ) { ?>
		<script>

			jQuery(document).ready(function() {
				jQuery("a[rel^='fancybox2']").fancybox({
					openEffect: 'elastic',
					closeEffect: 'elastic',
					helpers: {
					    overlay: {
					      locked: false,
							css : {
				                'opacity': 0
				            }
					    }
					  }
				});
			});
		</script>
	<?php }
}
add_action( 'easy_image_gallery_js', 'pp_extend_easy_image_gallery_js' );