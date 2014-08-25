<?php
/**		
 * Metaboxes
 * @since 1.1.9
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Add-on meta Box
 *
 * @since 1.1.9
 */
function affwp_add_meta_box() {
	add_meta_box( 'affwp_addon_meta_box', esc_html__( 'Add-on Information', 'affwp' ), 'affwp_addon_meta_box', 'download', 'side' );
}
add_action( 'add_meta_boxes', 'affwp_add_meta_box' );

/**		
 * Metabox callback
 * @since 1.0
*/
function affwp_addon_meta_box( $post_id ) { 
	?>
	
	<p>
		<label for="affwp-addon-coming-soon">
			<input type="checkbox" name="affwp_addon_coming_soon" id="affwp-addon-coming-soon" value="1" <?php checked( true, affwp_addon_is_coming_soon( get_the_ID() ) ); ?> />
			<?php _e( 'Add-on is coming soon', 'affwp' ); ?>
		</label>
	</p>

	<p><strong><?php _e( 'AffiliateWP Version Required', 'affwp' ); ?></strong></p>
	<p>
		<label for="affwp_addon_requires" class="screen-reader-text">
			<?php _e( 'Requires', 'affwp' ); ?>
		</label>
		<input class="widefat" type="text" name="affwp_addon_requires" id="affwp_addon_requires" value="<?php echo esc_attr( get_post_meta( get_the_ID(), '_affwp_addon_requires', true ) ); ?>" size="30" />
	</p>

	<p><strong><?php _e( 'EDD Version Required', 'affwp' ); ?></strong></p>
	<p>
		<label for="affwp-addon-requires-edd" class="screen-reader-text">
			<?php _e( 'Requires', 'affwp' ); ?>
		</label>
		<input class="widefat" type="text" name="affwp_addon_edd_version_required" id="affwp-addon-requires-edd" value="<?php echo esc_attr( get_post_meta( get_the_ID(), '_affwp_addon_edd_version_required', true ) ); ?>" size="30" />
	</p>

	<p><strong><?php _e( 'External Download URL', 'affwp' ); ?></strong></p>
	<p>
		<label for="affwp-addon-download-url" class="screen-reader-text">
			<?php _e( 'External Download URL', 'affwp' ); ?>
		</label>	
		<input class="widefat" type="text" name="affwp_addon_download_url" id="affwp-addon-download-url" value="<?php echo esc_attr( get_post_meta( get_the_ID(), '_affwp_addon_download_url', true ) ); ?>" size="30" />
	</p>

	<p><strong><?php _e( 'Developer', 'affwp' ); ?></strong></p>
	<p>
		<label for="affwp-addon-download-developer" class="screen-reader-text">
			<?php _e( 'Developer', 'affwp' ); ?>
		</label>	
		<input class="widefat" type="text" name="affwp_addon_developer" id="affwp-addon-developer" value="<?php echo esc_attr( get_post_meta( get_the_ID(), '_affwp_addon_developer', true ) ); ?>" size="30" />
	</p>

	<p><strong><?php _e( 'Developer URL', 'affwp' ); ?></strong></p>
	<p>
		<label for="affwp-addon-download-developer-url" class="screen-reader-text">
			<?php _e( 'Developer URL', 'affwp' ); ?>
		</label>	
		<input class="widefat" type="text" name="affwp_addon_developer_url" id="affwp-addon-developer-url" value="<?php echo esc_attr( get_post_meta( get_the_ID(), '_affwp_addon_developer_url', true ) ); ?>" size="30" />
	</p>

	<?php wp_nonce_field( 'affwp_addon_metaboxes', 'affwp_addon_metaboxes' ); ?>

<?php }


/**
 * Save function
 *
 * @since 1.1.9
*/
function affwp_addon_save_post( $post_id ) {

	if ( ( isset( $_POST['post_type'] ) && 'download' == $_POST['post_type'] )  ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
	    	return;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
	    	return;
	}
	
	if ( ! isset( $_POST['affwp_addon_metaboxes'] ) || ! wp_verify_nonce( $_POST['affwp_addon_metaboxes'], 'affwp_addon_metaboxes' ) ) {
		return;
	}

	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX') && DOING_AJAX ) || isset( $_REQUEST['bulk_edit'] ) ) {
		return;
	}
	
	if ( isset( $post->post_type ) && 'revision' == $post->post_type ) {
		return;
	} 
	
	if ( ! current_user_can( 'edit_product', $post_id ) ) {
		return;
	}

	$fields = apply_filters( 'affwp_addon_metabox_fields_save', array(
			'affwp_addon_coming_soon',
			'affwp_addon_release_date',
			'affwp_addon_requires',
			'affwp_addon_edd_version_required',
			'affwp_addon_download_url',
			'affwp_addon_developer',
			'affwp_addon_developer_url'
		)
	);
	
	$edd_sl_version = isset( $_POST['edd_sl_version'] ) ? $_POST['edd_sl_version'] : '';

	// software licensing version number
	if ( isset( $edd_sl_version ) ) {
		$current = get_post_meta( $post_id, '_edd_sl_version', true );
		
		if ( $edd_sl_version !== $current ) {
			update_post_meta( $post_id, '_affwp_addon_last_updated', current_time( 'timestamp' ) );
		}
	}

	foreach ( $fields as $field ) {

		$new = ( isset( $_POST[ $field ] ) ? esc_attr( $_POST[ $field ] ) : '' );

		// http
		if ( $field == 'affwp_addon_download_url' || $field == 'affwp_addon_developer_url' )
			$new = esc_url_raw( $_POST[ $field ] );

		$new = apply_filters( 'affwp_addon_save_' . $field, $new );

		$meta_key = '_' . $field;

		// Get the meta value of the custom field key.
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		// If a new meta value was added and there was no previous value, add it. 
		if ( $new && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new, true );

		// If the new meta value does not match the old value, update it. 
		elseif ( $new && $new != $meta_value )
			update_post_meta( $post_id, $meta_key, $new );

		// If there is no new meta value but an old value exists, delete it. 
		elseif ( '' == $new && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );
		
	}
}
add_action( 'save_post', 'affwp_addon_save_post', 1 );