<?php

/**
 * The form view
 *
 * This file is used to markup the HTML for the form
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/public/partials
 */

// Variable to hold the html
$html = '<div class="organic-contact-form' . ( $this->form_submitted ? ' submitted' : '' ) . '">';

// If we have errors
if ( !empty( $this->errors ) ) {

	// Open the error div
	$html .= '<div class="organic-form-message organic-form-error">';

	// Error intro text
	$html .= '<span class="organic-message-title">The following errors have occurred:</span>';

	// Loop through the errors
	foreach ( $this->errors as $error ) {

		// Output the error in a span
		$html .= '<span>' . $error . '</span>';

	}

	// Close the error div
	$html .= '</div>';

}

// Variable to hold the html (opening tag for form)
$html .= '<form name="organic_contact_form" id="organic_contact_form" method="post" action="" class="organic-frontend-form">';

// Loop through the fields
foreach ($fields as $field) {

	// Open the containing div (add the error class if an error is present for this field)
	$html .= '<div class="input-' . $field->field_type . '' . ( ( !empty( $this->errors ) && isset( $this->errors[ $field->form_field_id ] ) ) ? ' error' : '') . '">';

	// Set the label tag for the field
	$label = '<label for="' . $field->name . '">' . $field->label . '</label>';

	// Open the tag
	$tag = '<';

	// Switch the output by the field type
	switch ($field->field_type) {

		// Text input
		default:
		case 'text' :
			$tag .= 'input type="text"';
			break;

		// Email input
		case 'email' :
			$tag .= 'input type="email"';
			break;

		// Textarea
		case 'textarea' :
			$tag .= 'textarea';
			break;

	}

	// Add the field name
	$tag .= ' name="organic_form_fields[' . $field->form_field_id . ']"';

	// If the field is required
	if ( (int) $field->required == 1) {

		// Add required attribute to the tag
		$tag .= ' required';

	}

	// Close the tag
	$tag .= '>';

	// If the field is a textarea
	if ($field->field_type == 'textarea') {

		// Add the closing tag
		$tag .= '</textarea>';

	}

	// Add the label to the output
	$html .= $label;

	// Add the tag to the output
	$html .= $tag;

	// Close the containing div
	$html .= '</div>';

}

// If there is text to show before the submit button
if ( !empty( $text_before_submit ) ) {

	// Add the text to the html
	$html .= '<p class="text-before-submit">' . nl2br( $text_before_submit ) . '</p>';

}

// If we have a value for the recaptcha public key
if ( !empty( $public_key ) ) {

	// Add the recaptcha div
	$html .= ' <div class="g-recaptcha" 
       data-sitekey="' . $public_key . '"
       data-size="invisible"
       data-callback="onSubmit">
  	</div>';

}

// Add the submit button, with the user defined text
$html .= '<button type="submit">' . $submit_button_text . '</button>';

// Close the form tag
$html .= '</form>';

// Close the wrapper div
$html .= '</div>';