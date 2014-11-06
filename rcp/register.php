<?php global $rcp_options, $post; ?>

<?php if ( ! is_user_logged_in() ) { ?>
	
<?php } else { ?>
	<h3 class="rcp_header">
		<?php echo apply_filters( 'rcp_registration_header_logged_out', __( 'Upgrade Your Subscription', 'rcp' ) ); ?>
	</h3>
<?php }

// show any error messages after form submission
rcp_show_error_messages( 'register' ); ?>

<form id="rcp_registration_form" class="rcp_form" method="POST" action="<?php echo esc_url( rcp_get_current_url() ); ?>">

<?php 
	$section_classes = ! is_user_logged_in() ? 'columns columns-2 clear' : '';
?>

<section class="<?php echo $section_classes; ?>">

	<?php if ( ! is_user_logged_in() ) { ?>
	<div class="col">

		<?php do_action( 'rcp_before_register_form_fields' ); ?>

		<fieldset class="rcp_user_fieldset">
			<p id="rcp_user_login_wrap">
				<label for="rcp_user_Login"><?php echo apply_filters ( 'rcp_registration_username_label', __( 'Username', 'rcp' ) ); ?></label>
				<input name="rcp_user_login" id="rcp_user_login" class="required" type="text" <?php if( isset( $_POST['rcp_user_login'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_login'] ) . '"'; } ?>/>
				<span class="description">Usernames may not contain spaces, capital letters, or special characters.</span>
			</p>
			<p id="rcp_user_email_wrap">
				<label for="rcp_user_email"><?php echo apply_filters ( 'rcp_registration_email_label', __( 'Email', 'rcp' ) ); ?></label>
				<input name="rcp_user_email" id="rcp_user_email" class="required" type="text" <?php if( isset( $_POST['rcp_user_email'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_email'] ) . '"'; } ?>/>
			</p>
			<p id="rcp_user_first_wrap">
				<label for="rcp_user_first"><?php echo apply_filters ( 'rcp_registration_firstname_label', __( 'First Name', 'rcp' ) ); ?></label>
				<input name="rcp_user_first" id="rcp_user_first" type="text" <?php if( isset( $_POST['rcp_user_first'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_first'] ) . '"'; } ?>/>
			</p>
			<p id="rcp_user_last_wrap">
				<label for="rcp_user_last"><?php echo apply_filters ( 'rcp_registration_lastname_label', __( 'Last Name', 'rcp' ) ); ?></label>
				<input name="rcp_user_last" id="rcp_user_last" type="text" <?php if( isset( $_POST['rcp_user_last'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_last'] ) . '"'; } ?>/>
			</p>
			<p id="rcp_password_wrap">
				<label for="password"><?php echo apply_filters ( 'rcp_registration_password_label', __( 'Password', 'rcp' ) ); ?></label>
				<input name="rcp_user_pass" id="rcp_password" class="required" type="password"/>
			</p>
			<p id="rcp_password_again_wrap">
				<label for="password_again"><?php echo apply_filters ( 'rcp_registration_password_again_label', __( 'Password Again', 'rcp' ) ); ?></label>
				<input name="rcp_user_pass_confirm" id="rcp_password_again" class="required" type="password"/>
			</p>

			<?php do_action( 'rcp_after_password_registration_field' ); ?>

		</fieldset>
		
		<?php echo pp_register_show_discount_field(); ?>

	</div>
	<?php } ?>

	<?php if ( ! is_user_logged_in() ) : ?>
	<div class="col">
	<?php endif; ?>

		<fieldset class="rcp_subscription_fieldset">
		<?php $levels = rcp_get_subscription_levels( 'active' );
		if( $levels ) : ?>
			<p class="rcp_subscription_message"><?php echo apply_filters ( 'rcp_registration_choose_subscription', __( 'Choose your subscription level', 'rcp' ) ); ?></p>
			<ul id="rcp_subscription_levels">
				<?php foreach( $levels as $key => $level ) : ?>
					<?php if( rcp_show_subscription_level( $level->id ) ) : 

						if ( isset( $_GET['level'] ) && $_GET['level'] == $key ) {
							$checked = ' checked="checked"';
						}
						elseif ( ! isset( $_GET['level'] ) && 3 == $key ) {
							$checked = ' checked="checked"';
						}
						else {
							$checked = '';
						}

					?>

					<li id="rcp_subscription_level_<?php echo $level->id; ?>" class="rcp_subscription_level">
						<label for="level-<?php echo $level->id; ?>">
						
							<input id="level-<?php echo $level->id; ?>" type="radio" class="required rcp_level" <?php echo $checked; ?> name="rcp_level" rel="<?php echo esc_attr( $level->price ); ?>" value="<?php echo esc_attr( absint( $level->id ) ); ?>" <?php if( $level->duration == 0 ) { echo 'data-duration="forever"'; } ?>/>
						
							<span class="label">
								<span class="rcp_subscription_level_name"><?php echo rcp_get_subscription_name( $level->id ); ?></span>
								<span class="rcp_separator">&nbsp;&ndash;&nbsp;</span>
								<span class="rcp_price" rel="<?php echo esc_attr( $level->price ); ?>">
								<?php echo $level->price > 0 ? rcp_currency_filter( $level->price ) : __( 'free', 'rcp' ); ?>
								</span>

								<?php if ( 1 == $level->id ) : ?> 
								and
								<?php endif; ?>

								<?php if ( 1 != $level->id ) : ?> 
								for 
								<?php endif; ?>

								<span class="rcp_level_duration">
								<?php echo $level->duration > 0 ? $level->duration . '&nbsp;' . rcp_filter_duration_unit( $level->duration_unit, $level->duration ) : __( 'unlimited', 'rcp' ); ?>
								</span>

								<span class="rcp_level_description"> <?php echo rcp_get_subscription_description( $level->id ); ?></span>
								
							</span>

						</label>

					</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p><strong><?php _e( 'You have not created any subscription levels yet', 'rcp' ); ?></strong></p>
		<?php endif; ?>
		</fieldset>

		<?php if ( is_user_logged_in() ) : ?>
		<?php echo pp_register_show_discount_field(); ?>
		<?php endif; ?>

	<?php if ( ! is_user_logged_in() ) : ?>
	</div>
	<?php endif; ?>

	

</section>



	

	

	

	<?php do_action( 'rcp_after_register_form_fields', $levels ); ?>

	<?php
	$gateways = rcp_get_enabled_payment_gateways();

	if( count( $gateways ) > 1 ) : $display = rcp_has_paid_levels() ? '' : ' style="display: none;"'; ?>
		<fieldset class="rcp_gateways_fieldset">
			<p id="rcp_payment_gateways"<?php echo $display; ?>>
				<label for="rcp_gateway"><?php _e( 'Choose Your Payment Method', 'rcp' ); ?></label>
				<select name="rcp_gateway" id="rcp_gateway">
					<?php foreach( $gateways as $key => $gateway ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $gateway ); ?></option>
					<?php endforeach; ?>
				</select>
				
			</p>
		</fieldset>
	<?php else: ?>
		<?php foreach( $gateways as $key => $gateway ) : ?>
			<input type="hidden" name="rcp_gateway" value="<?php echo esc_attr( $key ); ?>"/>
		<?php endforeach; ?>
	<?php endif; ?>


	<?php do_action( 'rcp_before_registration_submit_field', $levels ); ?>

	<p id="rcp_submit_wrap">
		<input type="hidden" name="rcp_register_nonce" value="<?php echo wp_create_nonce('rcp-register-nonce' ); ?>"/>
		<input type="submit" name="rcp_submit_registration" id="rcp_submit" class="button" value="<?php echo apply_filters ( 'rcp_registration_register_button', __( 'Register', 'rcp' ) ); ?>"/>
	</p>
</form>