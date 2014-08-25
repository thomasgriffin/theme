<?php
/**		
 * Account
 * @since 1.0 
*/
function affwp_account() { ?>
	
	<?php
	global $current_user;
	get_currentuserinfo();

/**
 * Logout message
 */
if ( isset( $_GET['logout'] ) && $_GET['logout'] == 'success' ) { ?>
	<p class="alert notice">
		<?php _e( 'You have been successfully logged out', 'affwp' ); ?>
	</p>
<?php } ?>



	<?php 
	// user is not logged in
	if ( ! is_user_logged_in() ) : ?>
		<p>
			<a href="<?php echo site_url( 'account/affiliates' ); ?>">Looking for our affiliate area?</a>
		</p>

		<?php echo edd_login_form( add_query_arg( array('login' => 'success', 'logout' => false ), site_url( $_SERVER['REQUEST_URI'] ) ) ); ?>
		
	<?php 
	// user is logged in
	else : ?>




	<h2>Developer Add-ons</h2>
	<?php 

	global $post;
	/**
	 * Displays the most recent post
	 */
	$args = array(
		'posts_per_page' 	=> -1,
		'post_type'			=> 'download',
		'tax_query' => array(
				array(
					'taxonomy' => 'download_category',
					'field' => 'slug',
					'terms' => 'developer-add-ons'
				),
			)
	);

	$add_ons = new WP_Query( $args ); ?>
	<table id="edd-developer-add-ons">
		<thead>
			<tr>
				<th><?php _e( 'Name', 'affwp' ); ?></th>
				<th><?php _e( 'Version', 'affwp' ); ?></th>
				<th><?php _e( 'Affiliate WP version required', 'affwp' ); ?></th>
				<th><?php _e( 'Download', 'affwp' ); ?></th>
			</tr>
		</thead>

		<tbody>

	<?php if ( have_posts() ) : ?>
			
			<?php while ( $add_ons->have_posts() ) : $add_ons->the_post(); ?>
			
			<?php

				$version 	= get_post_meta( get_the_ID(), '_edd_sl_version', true );
				$requires 	= get_post_meta( get_the_ID(), '_affwp_addon_requires', true );
			?>
			<tr>
				<td>
					<?php if ( affwp_addon_is_coming_soon( get_the_ID() ) && current_user_can( 'manage_options' ) ) : ?>	
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php elseif ( affwp_addon_is_coming_soon( get_the_ID() ) ) : ?>
						<?php the_title(); ?> - coming soon
					<?php else : ?>	
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php endif; ?>

				</td>
				<td><?php echo esc_attr( $version ); ?></td>
				<td><?php echo esc_attr( $requires ); ?></td>
				<td>
					<?php if ( edd_get_download_files( get_the_ID() ) ) : ?>

						<?php if ( ! edd_has_user_purchased( get_current_user_id(), array( affwp_get_affiliatewp_id() ), 2 ) ) : ?>
							<?php if ( ! affwp_addon_is_coming_soon( get_the_ID() ) || current_user_can( 'manage_options' ) ) : ?>
							<a title="Upgrade License To Download" href="<?php echo affwp_get_license_upgrade_url( 'developer' ); ?>">Upgrade License To Download</a>
							<?php endif; ?>	
						<?php else : ?>
							<?php if ( edd_has_user_purchased( get_current_user_id(), array( affwp_get_affiliatewp_id() ), 2 ) ) : ?>
								
								<?php if ( ! affwp_addon_is_coming_soon( get_the_ID() ) || current_user_can( 'manage_options' ) ) : ?>

									<a href="<?php echo affwp_get_add_on_download_url( get_the_ID() ); ?>">Download add-on</a>

								<?php endif; ?>	

							<?php endif; ?>
						<?php endif; ?>

					<?php endif; ?>
				</td>
			</tr>
			
		<?php endwhile; ?>
			
	<?php endif; wp_reset_postdata(); ?>
		</tbody>
	</table>

	<h2>Your License</h2>
	<?php if ( edd_has_user_purchased( get_current_user_id(), array( affwp_get_affiliatewp_id() ), 0 ) ) : // user is on personal license ?>
		<p>You currently have the <strong>Personal License</strong> (1 site)<br/>
		
			<a title="Upgrade to Business License" href="<?php echo affwp_get_license_upgrade_url( 'business' ); ?>">Upgrade to Business License (3 sites)</a><br/>
			<a title="Upgrade to Developer License" href="<?php echo affwp_get_license_upgrade_url( 'developer' ); ?>">Upgrade to Developer License (unlimited sites)</a>
		</p>
	<?php elseif ( edd_has_user_purchased( get_current_user_id(), array( affwp_get_affiliatewp_id() ), 1 ) ) : ?>
		<p>You currently have the <strong>Business License</strong> (3 sites)<br/>
		<a title="Upgrade to Developer License" href="<?php echo affwp_get_license_upgrade_url( 'developer' ); ?>">Upgrade to Developer License (unlimited sites)</a>
		</p>
	<?php elseif ( edd_has_user_purchased( get_current_user_id(), array( affwp_get_affiliatewp_id() ), 2 ) ) : ?>
		<p>You currently have the <strong>Developer License</strong> (unlimited sites).</p>

	<?php else : ?>
		<p>You do not have a <a title="You do not have a license yet" href="<?php echo site_url( 'pricing' ); ?>">license</a> yet.</p>	
	<?php endif; ?>	
	

	<?php
		// purchase history
		echo '<h2>' . __( 'Purchase History', 'affwp' ) . '</h2>';
		echo edd_purchase_history();

		// download history
		echo '<h2>' . __( 'Download History', 'affwp' ) . '</h2>';
		echo edd_download_history();
		
	

		// profile editor
		echo '<h2>' . __( 'Edit your profile', 'affwp' ) . '</h2>';
		echo do_shortcode( '[edd_profile_editor]' ); 
	?>
	
	<?php endif; ?>

<?php }