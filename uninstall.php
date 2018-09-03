<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Include plugin definitions
include_once ( 'definitions.php' );

// If post isset, and the slug matches
if ( isset( $_POST ) && $_POST['slug'] == ORGANIC_CONTACT_FORM_NAME ) {

	// If admin
	if ( is_admin() ) {

		// Use the Wordpress database
		global $wpdb;

		// Set the plugin db prefix
		$db_prefix = $wpdb->prefix . ORGANIC_CONTACT_FORM_OPTION_NAME;

		// Delete submissions table
		$wpdb->query( 'DROP TABLE IF EXISTS ' . $db_prefix . '_submissions' );

		// Delete fields table
		$wpdb->query( 'DROP TABLE IF EXISTS ' . $db_prefix . '_fields' );

		// Delete submissions_fields table
		$wpdb->query( 'DROP TABLE IF EXISTS ' . $db_prefix . '_submissions_fields' );

		// Remove captcha public key option
		delete_option( ORGANIC_CONTACT_FORM_OPTION_NAME . '_captcha_public_key' );

		// Remove text before submit option
		delete_option( ORGANIC_CONTACT_FORM_OPTION_NAME . '_text_before_submit' );

		// Remove submit button text option
		delete_option( ORGANIC_CONTACT_FORM_OPTION_NAME . '_submit_button_text' );

	}

}
