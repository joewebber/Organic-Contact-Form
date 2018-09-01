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
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	The option name of this plugin
	 */
	private $option_name = 'organic_contact_form';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $db_prefix ) {

		// Set plugin name
		$this->plugin_name = $plugin_name;

		// Set plugin version
		$this->version = $version;

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/admin-min.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Function for registering settings for the plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {
		
		// Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', $this->plugin_name ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		// Add captcha public key
		add_settings_field(
			$this->option_name . '_captcha_public_key',
			__( 'Captcha Public Key', $this->plugin_name ),
			array( $this, $this->option_name . '_captcha_public_key_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_captcha_public_key' )
		);

		// Register the public captcha key field
		register_setting( $this->plugin_name, $this->option_name . '_captcha_public_key', 'filter_sanitize_string' );

		// Add captcha private key
		add_settings_field(
			$this->option_name . '__captcha_private_key',
			__( 'Captcha Private Key', $this->plugin_name ),
			array( $this, $this->option_name . '_captcha_private_key_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_captcha_private_key' )
		);

		// Register the private captcha key field
		register_setting( $this->plugin_name, $this->option_name . '_captcha_private_key', 'filter_sanitize_string' );
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function organic_contact_form_general_cb() {

		// Output the text for the general section
		echo '<p>' . __( 'Update the settings below', $this->plugin_name ) . '</p>';

	}

	/**
	 * Render the public captcha key for this plugin
	 *
	 * @since  1.0.0
	 */
	public function organic_contact_form_captcha_public_key_cb() {

		// Get the current value
		$value = get_option( $this->option_name . '_captcha_public_key' );

		// Output the captcha public key field
		echo '<input type="text" name="' . $this->option_name . '_captcha_public_key' . '" id="' . $this->option_name . '_captcha_public_key' . '" value="' . $value . '">';
	}

	/**
	 * Render the private captcha key for this plugin
	 *
	 * @since  1.0.0
	 */
	public function organic_contact_form_captcha_private_key_cb() {

		// Get the current value
		$value = get_option( $this->option_name . '_captcha_private_key' );

		// Output the captcha private key field
		echo '<input type="text" name="' . $this->option_name . '_captcha_private_key' . '" id="' . $this->option_name . '_captcha_private_key' . '" value="' . $value . '">';
	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
		
		// Register options page
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Organic Contact Form Settings', $this->plugin_name ),
			__( 'Organic Contact Form', $this->plugin_name ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	
	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {

		// Include the view
		include_once( plugin_dir_path( __FILE__ ) . 'partials/organic-contact-form-admin-options.php' );

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
