<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/public
 * @author     Joe Webber <signup@joewebber.co.uk>
 */
class Organic_Contact_Form_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The database prefix for the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $db_prefix    The database prefix for the plugin.
	 */
	private $db_prefix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $db_prefix ) {

		// Set the plugin name
		$this->plugin_name = $plugin_name;

		// Set the plugin version
		$this->version = $version;

		// Set the db prefix
		$this->db_prefix = $db_prefix;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/public.js', array( 'jquery' ), $this->version, false );

	}

	/**
     * Include Form Partial
     *
     * This function includes contact form view
     * As the shortcode requires a return value, the html is stored in a variable and returned
     *
	 * @since    1.0.0
	 * @return   $html string The HTML form output
     */
    public function include_form_partial() {

    	// Get the form fields
    	$fields = $this->get_fields();

    	// Include the file that generates the html
        include_once( plugin_dir_path( __FILE__ ) . 'partials/organic-contact-form-form.php' );

        // Return the html for the form
        return $html;

    }

    /**
     * Get Form Fields
     *
     * Retrieves the fields from the database and returns them
     *
	 * @since    1.0.0
	 * @return   $fields array An array of the form fields
     */
    private function get_fields() {

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
