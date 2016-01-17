<form id="rcp_update_card_form" class="rcp_form" action="" method="POST">
	<fieldset class="rcp_card_fieldset">
		<p id="rcp_card_number_wrap">
			<label><?php _e( 'Card Number', 'rcp' ); ?></label>
			<input type="text" size="20" maxlength="20" name="rcp_card_number" class="rcp_card_number card-number" />
		</p>
		<p id="rcp_card_cvc_wrap">
			<label><?php _e( 'Card CVC', 'rcp' ); ?></label>
			<input type="text" size="4" maxlength="4" name="rcp_card_cvc" class="rcp_card_cvc card-cvc" />
		</p>
		<p id="rcp_card_zip_wrap">
			<label><?php _e( 'Card ZIP or Postal Code', 'rcp' ); ?></label>
			<input type="text" size="4" name="rcp_card_zip" class="rcp_card_zip card-zip" />
		</p>
		<p id="rcp_card_name_wrap">
			<label><?php _e( 'Name on Card', 'rcp' ); ?></label>
			<input type="text" size="20" name="rcp_card_name" class="rcp_card_name card-name" />
		</p>
		<p id="rcp_card_exp_wrap">
			<label><?php _e( 'Expiration (MM/YYYY)', 'rcp' ); ?></label>
			<select name="rcp_card_exp_month" class="rcp_card_exp_month card-expiry-month">
				<?php for( $i = 1; $i <= 12; $i++ ) : ?>
					<option value="<?php echo $i; ?>"><?php echo $i . ' - ' . rcp_get_month_name( $i ); ?></option>
				<?php endfor; ?>
			</select>
			<span class="rcp_expiry_separator"> / </span>
			<select name="rcp_card_exp_year" class="rcp_card_exp_year card-expiry-year">
				<?php
				$year = date( 'Y' );
				for( $i = $year; $i <= $year + 10; $i++ ) : ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p>
	</fieldset>
	<div class="rcp_message error">
	</div>
	<p id="rcp_submit_wrap">
		<input type="hidden" name="rcp_update_card_nonce" value="<?php echo wp_create_nonce( 'rcp-update-card-nonce' ); ?>"/>
		<input type="submit" name="rcp_submit_card_update" id="rcp_submit" class="button" value="<?php _e( 'Update Card', 'rcp' ); ?>"/>
	</p>
</form>
