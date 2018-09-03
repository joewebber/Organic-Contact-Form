<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/includes
 * @author     Joe Webber <signup@joewebber.co.uk>
 */
class Organic_Contact_Form {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Organic_Contact_Form_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The database prefix for the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $db_prefix    The database prefix for the plugin.
	 */
	protected $db_prefix;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	The option name of this plugin
	 */
	protected $option_name;

	/**
	 * Default submit button text
	 *
	 * @since  	1.0.0
	 */
	const SUBMIT_BUTTON_TEXT = 'Send Enquiry';

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @param    boolean $load Whether to run the setup methods or not
	 * @since    1.0.0
	 */
	public function __construct( $run = true ) {

		// Use the Wordpress database global (required to get database prefix)
		global $wpdb;

		// If the plugin version is defined
		if ( defined( 'ORGANIC_CONTACT_FORM_VERSION' ) ) {

			// Set the variable to the defined version
			$this->version = ORGANIC_CONTACT_FORM_VERSION;

		} else { // Else not defined

			// Set version to 1.0.0
			$this->version = '1.0.0';

		}

		// Set the plugin name
		$this->plugin_name = 'organic-contact-form';

		// Set the option name
		$this->option_name = 'organic_contact_form';

		// Set the plugin db prefix
		$this->db_prefix = $wpdb->prefix . 'organic_contact_form';

		// If we are running the setup methods
		if ( $run ) {

			// Load dependencies
			$this->load_dependencies();

			// Set locale
			$this->set_locale();

			// Define admin hooks
			$this->define_admin_hooks();

			// Define public hooks
			$this->define_public_hooks();

		}

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Organic_Contact_Form_Loader. Orchestrates the hooks of the plugin.
	 * - Organic_Contact_Form_i18n. Defines internationalization functionality.
	 * - Organic_Contact_Form_Admin. Defines all hooks for the admin area.
	 * - Organic_Contact_Form_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-organic-contact-form-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-organic-contact-form-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-organic-contact-form-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-organic-contact-form-public.php';

		$this->loader = new Organic_Contact_Form_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Organic_Contact_Form_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Organic_Contact_Form_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Organic_Contact_Form_Admin();

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Add the options page
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_options_page' );

		// Add register setting hook
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_setting' );

		// Add the dashboard page (which is the default)
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'register_dashboard_page' );

		// Get the export task status (if present)
    	$export = ( isset( $_GET['export'] ) ) ? (int) $_GET['export'] : 0;

    	if ( $export == 1 ) {

    		// Register the CSV export function on admin init
	    	$this->loader->add_action( 'admin_init', $plugin_admin, 'csv_export' );

	    }

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Organic_Contact_Form_Public();

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// Add shortcode to show the form
		$this->loader->add_shortcode( 'organic-contact-form', $plugin_public, 'include_form_partial' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Organic_Contact_Form_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the database prefix of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The database prefix of the plugin.
	 */
	public function get_db_prefix() {
		return $this->db_prefix;
	}

	/**
     * Get Form Field
     *
     * Retrieves single form field from the database
     *
	 * @since    1.0.0
	 * @param    $form_field_id int The id of the form field
	 * @return   $fields object An object containing the field data
     */
    protected function get_field( $form_field_id ) {

    	// Use the Wordpress database global
		global $wpdb;

		// Structure the query to get the field
		$sql = "SELECT * FROM " . $this->db_prefix . "_fields WHERE form_field_id = " . (int) $form_field_id;

		// Run the query to get the field
		$field = $wpdb->get_results( $sql, OBJECT );

		// Return the field
		return $field[0];

    }

    /**
     * Get Form Fields
     *
     * Retrieves the fields from the database and returns them
     *
	 * @since    1.0.0
	 * @return   $fields array An array of the form fields
     */
    protected function get_fields() {

    	// Use the Wordpress database global
		global $wpdb;

		// Structure the query to get the fields
		$sql = "SELECT * FROM " . $this->db_prefix . "_fields";

		// Run the query to get the fields
		$fields = $wpdb->get_results( $sql, OBJECT );

		// Return the fields
		return $fields;

    }

}
