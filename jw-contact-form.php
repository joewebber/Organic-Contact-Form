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
 * @package           Jw_Contact_Form
 *
 * @wordpress-plugin
 * Plugin Name:       JW Contact Form
 * Plugin URI:        https://github.com/joewebber/jw-contact-form
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Joe Webber
 * Author URI:        http://joewebber.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jw-contact-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-jw-contact-form-activator.php
 */
function activate_jw_contact_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jw-contact-form-activator.php';
	Jw_Contact_Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-jw-contact-form-deactivator.php
 */
function deactivate_jw_contact_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jw-contact-form-deactivator.php';
	Jw_Contact_Form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_jw_contact_form' );
register_deactivation_hook( __FILE__, 'deactivate_jw_contact_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-jw-contact-form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_jw_contact_form() {

	$plugin = new Jw_Contact_Form();
	$plugin->run();

}
run_jw_contact_form();
