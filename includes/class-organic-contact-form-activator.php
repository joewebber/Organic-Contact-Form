<?php

/**
 * Fired during plugin activation
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/includes
 * @author     Joe Webber <signup@joewebber.co.uk>
 */
class Organic_Contact_Form_Activator {

	/**
	 * Run when plugin is activated.
	 *
	 * Checks whether tables exist, and creates if not
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// Use the Wordpress database global
		global $wpdb;

		// Set the plugin db prefix
		$db_prefix = $wpdb->prefix . ORGANIC_CONTACT_FORM_OPTION_NAME;

		// Array to hold sql
		$sql = array();

		// SQL to create the submissions table
		$sql[] = 'CREATE TABLE IF NOT EXISTS `' . $db_prefix . '_submissions` (
			`submission_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
			`created` DATETIME NOT NULL,
			`url` VARCHAR(200) NOT NULL,
			PRIMARY KEY (`submission_id`)
		)';

		// SQL to create the fields table
		$sql[] = 'CREATE TABLE IF NOT EXISTS `' . $db_prefix . '_fields` (
			`form_field_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
			`name` VARCHAR(50) NOT NULL,
			`label` VARCHAR(255) NOT NULL,
			`field_type` VARCHAR(15) NOT NULL,
			`required` TINYINT(1) UNSIGNED NOT NULL,
			PRIMARY KEY (`form_field_id`),
			UNIQUE INDEX `name` (`name`)
		)';

		// SQL to create the submissions_fields table
		$sql[] = 'CREATE TABLE IF NOT EXISTS `' . $db_prefix . '_submissions_fields` (
			`submission_id` INT(10) UNSIGNED NOT NULL,
			`form_field_id` INT(10) UNSIGNED NOT NULL,
			`value` TEXT NOT NULL
		)';

		// Require the Wordpress upgrade file
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		// Loop through the queries
		foreach ( $sql as $query ) {

			// Run the query to create table
			dbDelta( $query );

		}

		// Array of fields
		$fields = array(

			array(
				'name' => 'name',
				'label' => 'Name',
				'field_type' => 'text',
				'required' => 1
			),

			array(
				'name' => 'email-address',
				'label' => 'Email Address',
				'field_type' => 'email',
				'required' => 1
			),

			array(
				'name' => 'telephone-number',
				'label' => 'Telephone Number',
				'field_type' => 'text',
				'required' => 0
			),

			array(
				'name' => 'enquiry',
				'label' => 'Enquiry',
				'field_type' => 'textarea',
				'required' => 1
			)

		);

		// Loop through fields
		foreach ( $fields as $field ) {

			// Try to select this field by name
			$row_count = $wpdb->get_var( 'SELECT COUNT(*) FROM `' . $db_prefix . '_fields` WHERE `name` = "' . $field['name'] . '"' );

			// If the row doesn't already exist, insert it
			if ( $row_count == 0 ) { 

				// Insert field
				$wpdb->insert($db_prefix . '_fields', $field);

			}

		}

	}

}
