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
	 * @access   private
	 * @var      string    $db_prefix    The database prefix for the plugin.
	 */
	private $db_prefix;

	/**
	 * Validation errors
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var     array    $errors    An array to hold validation errors.
	 */
	private $errors;

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

		// Empty the errors array
		$this->errors = array();

		// If the form has been posted, and the data is there
		if ( isset( $_POST['organic_form_fields'] ) && !empty( $_POST['organic_form_fields'] ) ) {

			// Validate the data
			$this->validate_form_data( $_POST['organic_form_fields'] );

			// If we have no errors
			if ( empty( $this->errors ) ) {

				// Save the submission
				$this->save_submission( $_POST['organic_form_fields'] );

			}

		}

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
     * Get Form Field
     *
     * Retrieves single form field from the database
     *
	 * @since    1.0.0
	 * @param    $form_field_id int The id of the form field
	 * @return   $fields object An object containing the field data
     */
    private function get_field( $form_field_id ) {

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

    /**
     * Validate form data
     *
     * Validates the posted form data
     *
	 * @since    1.0.0
	 * @param   $data array An array of the form data
     */
    private function validate_form_data( $data ) {

    	// Loop through the form data
		foreach( $data as $form_field_id => $value ) {

			// Get the field data from the database
			$field = $this->get_field( $form_field_id );

			// If the field is required
			if( (int) $field->required == 1) {

				// If the value is empty
				if( empty( $value ) ) {

					// Add to errors array
					$this->errors[ $field->form_field_id ] = 'The "' . $field->label . '" field must be filled in';

				}

			}

		}

    }

    /**
     * Saves user submission
     *
     * Stores the data into the database
     *
	 * @since    1.0.0
	 * @param   $data array An array of the form data
     */
    private function save_submission( $data ) {

    	// Use the Wordpress database global
		global $wpdb;

		// Use the Wordpress global
		global $wp;

		// Save the submission
		$wpdb->insert( $this->db_prefix . '_submissions',
			array(
				'created' 	=> date( 'Y-m-d H:i:s' ),
				'url' 		=> home_url( add_query_arg( $_GET, $wp->request ) )
			)
		);

		// Get submission id
		$submission_id = $wpdb->insert_id;

		// Loop through the form data
		foreach( $data as $form_field_id => $value ) {

			// Save the field / value
			$wpdb->insert( $this->db_prefix . '_submissions_fields',
				array(
					'submission_id' 	=> $submission_id,
					'form_field_id' 	=> $form_field_id,
					'value'				=> $value
				)
			);

		}

    }

}
