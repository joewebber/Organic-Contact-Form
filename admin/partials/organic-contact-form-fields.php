<?php

/**
 * The form fields view
 *
 * This file is used to markup the HTML for editing the form fields
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/admin/partials
 */
?>

<div class="wrap organic-contact-form">

	<header>

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	</header>

	<?php

	// If we have saved the data (or attempted to)
	if ( isset( $message )) {

	?>

	<div class="<?php echo ( empty( $errors ) ) ? 'updated' : 'error'; ?> notice">

	    <p><?php echo $message; ?></p>

	</div>

	<?php

		}

	?>

	<div id="poststuff">

		<div class="metabox-holder">

			<div class="edit-form-section edit-form-fields">

				<form name="edit-form-fields" action="" method="post">

					<?php

						// Loop through all submission fields
						foreach ( $fields as $field ) {

					?>

					<div class="stuffbox">

						<div class="inside">

							<fieldset>

								<div>

									<input type="text" name="field[<?php echo $field->form_field_id; ?>][label]" id="field_<?php echo $field->form_field_id; ?>_label" value="<?php echo $field->label; ?>">

								</div>

								<div>

									<label for="">Field Type</label>

									<select name="field[<?php echo $field->form_field_id; ?>][field_type]" id="field_<?php echo $field->form_field_id; ?>_field_type">

										<?php

											// Loop through the field types
											foreach ( $field_types as $type => $label ) {

										?>

										<option value="<?php echo $type; ?>" <?php echo $field->field_type == $type ? 'selected="selected"' : ''; ?>><?php echo $label; ?></option>

										<?php

											}

										?>

									</select>

								</div>

								<div>

									<label for="">Required</label>

									<input type="checkbox" name="field[<?php echo $field->form_field_id; ?>][required]" id="field_<?php echo $field->form_field_id; ?>_required" <?php echo (int) $field->required == 1 ? 'checked="checked"' : ''; ?> value="1">

								</div>
							
							</fieldset>

						</div>

					</div>

					<?php
							
						}

					?>

					<button type="reset" class="button button-large">Reset</button>

					<button type="submit" class="button button-primary button-large">Update</button>

				</form>

			</div>

		</div>

	</div>

</div>