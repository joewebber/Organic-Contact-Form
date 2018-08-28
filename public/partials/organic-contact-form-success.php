<?php

/**
 * The success message view
 *
 * This file is used to output the success message
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/public/partials
 */

// Variable to hold the html
$html = '<div class="organic-contact-form' . ( $this->form_submitted ? ' submitted' : '' ) . '">';

// Open the div
$html .= '<div class="organic-form-message organic-form-success">';

// Output the message text
$html .= 'Thank you. Your message has been received and will be responded to shortly';

// Close the div
$html .= '</div>';

// Close the wrapper div
$html .= '</div>';