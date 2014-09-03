<?php
/**
 * Restrict Content Pro modifications
 */

// remove the forms.css
remove_action( 'init', 'rcp_register_css' );

/**
 * The discount field
 * @return [type] [description]
 */
function pp_register_show_discount_field() {
	?>

	<?php if ( rcp_has_discounts() ) : ?>
	<fieldset class="rcp_discounts_fieldset">
		<p id="rcp_discount_code_wrap">
			<label for="rcp_discount_code">
				<?php _e( 'Discount Code', 'rcp' ); ?>
				<span class="rcp_discount_valid" style="display: none;"> - <?php _e( 'Valid', 'rcp' ); ?></span>
				<span class="rcp_discount_invalid" style="display: none;"> - <?php _e( 'Invalid', 'rcp' ); ?></span>
			</label>
			<input type="text" id="rcp_discount_code" name="rcp_discount" class="rcp_discount_code" value=""/>
		</p>
	</fieldset>
	<?php endif; ?>

	<?php
}