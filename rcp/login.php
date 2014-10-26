<?php global $rcp_login_form_args; ?>
<?php if( ! is_user_logged_in() ) : ?>

	<?php rcp_show_error_messages( 'login' ); ?>

	<form id="rcp_login_form" class="rcp_form" method="POST" action="<?php echo esc_url( rcp_get_current_url() ); ?>">
		<fieldset class="rcp_login_data">
			<p>
				<label for="rcp_user_Login"><?php _e( 'Username', 'rcp' ); ?></label>
				<input name="rcp_user_login" id="rcp_user_login" class="required" type="text"/>
			</p>
			<p>
				<label for="rcp_user_pass"><?php _e( 'Password', 'rcp' ); ?></label>
				<input name="rcp_user_pass" id="rcp_user_pass" class="required" type="password"/>
			</p>
			<p>
				<label for="rcp_user_remember">
				<input type="checkbox" name="rcp_user_remember" id="rcp_user_remember" value="1" /> <?php _e( 'Remember Me', 'rcp' ); ?>
				</label>
			</p>
			<p class="rcp_lost_password"><a href="<?php echo esc_url( wp_lostpassword_url( rcp_get_current_url() ) ); ?>"><?php _e( 'Lost your password?', 'rcp' ); ?></a></p>
			<p>
				<input type="hidden" name="rcp_action" value="login"/>
				<input type="hidden" name="rcp_redirect" value="<?php echo esc_url( $rcp_login_form_args['redirect'] ); ?>"/>
				<input type="hidden" name="rcp_login_nonce" value="<?php echo wp_create_nonce( 'rcp-login-nonce' ); ?>"/>
				<input id="rcp_login_submit" class="button" type="submit" value="Login"/>
			</p>
		</fieldset>
	</form>
<?php else : ?>
	
	<?php 
	$class = is_page( 'account' ) ? ' class="active"' : '';
	$current_user = wp_get_current_user();

	$greeting = $current_user->user_firstname ? $current_user->user_firstname : $current_user->display_name;

	?>
	<div class="box">
		<h3>Hi <?php echo $greeting; ?></h3>
		<ul class="linked list">

			<?php /*
			<li <?php echo $class; ?>><a href="<?php echo home_url('account'); ?>"><?php _e( 'Your Account', 'rcp' ); ?></a></li>
			*/ ?>
		
			<li><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php _e( 'Logout', 'rcp' ); ?></a></li>
		</ul>
		
	</div>
	
<?php endif; ?>