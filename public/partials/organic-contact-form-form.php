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

// Variable to hold the html (opening tag for form)
$html = '<form name="organic_contact_form" method="post" action="">';

// Loop through the fields
foreach ($fields as $field) {

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

}

// Add the submit button
$html .= '<button type="submit">Send Enquiry</button>';

// Close the form tag
$html .= '</form>';