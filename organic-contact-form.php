<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://joewebber.co.uk
 * @since             1.0.0
 * @package           Organic_Contact_Form
 *
 * @wordpress-plugin
 * Plugin Name:       Organic Contact Form
 * Plugin URI:        https://github.com/joewebber/organic-contact-form
 * Description:       Simple contact form plugin that can be used to display a contact form on any page. Use the shortcode [organic-contact-form] to include on a page
 * Version:           1.0.0
 * Author:            Joe Webber
 * Author URI:        http://joewebber.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       organic-contact-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Include plugin definitions
include_once ( plugin_dir_path( __FILE__ ) . 'definitions.php' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-organic-contact-form-activator.php
 */
function activate_organic_contact_form() {

	// Require the activator class file
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-organic-contact-form-activator.php';

	// Run the plugin activation method
	Organic_Contact_Form_Activator::activate();

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-organic-contact-form-deactivator.php
 */
function deactivate_organic_contact_form() {

	// Require the deactivator class file
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-organic-contact-form-deactivator.php';

	// Run the plugin deactivation method
	Organic_Contact_Form_Deactivator::deactivate();

}

// Register activation hook
register_activation_hook( __FILE__, 'activate_organic_contact_form' );

// Register deactivation hook
register_deactivation_hook( __FILE__, 'deactivate_organic_contact_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-organic-contact-form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_organic_contact_form() {

	// Instantiate the plugin class
	$plugin = new Organic_Contact_Form();

	// Run the plugin
	$plugin->run();

}

// Run the plugin
run_organic_contact_form();
