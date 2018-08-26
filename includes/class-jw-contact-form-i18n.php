<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Jw_Contact_Form
 * @subpackage Jw_Contact_Form/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Jw_Contact_Form
 * @subpackage Jw_Contact_Form/includes
 * @author     Joe Webber <signup@joewebber.co.uk>
 */
class Jw_Contact_Form_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'jw-contact-form',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
