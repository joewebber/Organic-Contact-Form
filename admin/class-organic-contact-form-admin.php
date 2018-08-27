<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/admin
 * @author     Joe Webber <signup@joewebber.co.uk>
 */
class Organic_Contact_Form_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The title of this plugin.
	 *
	 * Used for display purposes only
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_title    The title of this plugin.
	 */
	private $plugin_title;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		// Set plugin name
		$this->plugin_name = $plugin_name;

		// Set plugin version
		$this->version = $version;

		// Set plugin title
		$this->plugin_title = ucwords(str_replace('-', ' ', $plugin_name));

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Organic_Contact_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Organic_Contact_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Organic_Contact_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Organic_Contact_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
     * Register Dashboard Page
     *
     * This function adds the main menu item
     *
	 * @since    1.0.0
     */
    public function register_dashboard_page() {

    	// Add menu page using Wordpress function
        add_menu_page(
            __( 'Organic Contact Form', $this->plugin_name ),
            __( 'Organic Contact Form', $this->plugin_name ),
            'read',
            'organic-contact-form-dashboard',
            array( $this, 'include_dashboard_partial' ),
            'dashicons-wordpress-alt',
            9999
        );

    }

    /**
     * Include Dashboard Partial
     *
     * This function includes the dashboard view
     *
	 * @since    1.0.0
     */
    public function include_dashboard_partial() {

    	// Include the view
        include_once( plugin_dir_path( __FILE__ ) . 'partials/organic-contact-form-dashboard.php' );

    }

}
