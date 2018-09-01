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
class Organic_Contact_Form_Public extends Organic_Contact_Form {

	/**
	 * The parent class
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Organic_Contact_Form    $private    An instance of the parent class
	 */
	private $parent;

	/**
	 * Validation errors
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var     array    $errors    An array to hold validation errors.
	 */
	private $errors;

	/**
	 * Show Form
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var     boolean    $show_form    Whether to show the form or not.
	 */
	private $show_form;

	/**
	 * Show Success Message
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var     boolean    $show_success_message    Whether to show the success message or not.
	 */
	private $show_success_message;

	/**
	 * Form Submitted
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var     boolean    $form_submitted    Whether the form has been submitted.
	 */
	private $form_submitted;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		// Instantiate the parent class
		$this->parent = new Organic_Contact_Form( false );

		// Empty the errors array
		$this->errors = array();

		// Set the form to be shown
		$this->show_form = true;

		// Set the success message to be hidden
		$this->show_success_message = false;

		// Set the form submitted status
		$this->form_submitted = false;

		// If the form has been posted, and the data is there
		if ( isset( $_POST['organic_form_fields'] ) && !empty( $_POST['organic_form_fields'] ) ) {

			// Set the form submitted status
			$this->form_submitted = true;

			// Validate the data
			$this->validate_form_data( $_POST['organic_form_fields'] );

			// If we have no errors
			if ( empty( $this->errors ) ) {

				// Save the submission
				$this->save_submission( $_POST['organic_form_fields'] );

				// Set the form to be hidden
				$this->show_form = false;

				// Set the success message to be shown
				$this->show_success_message = true;

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

		wp_enqueue_style( $this->parent->plugin_name, plugin_dir_url( __FILE__ ) . 'css/public.css', array(), $this->parent->version, 'all' );

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

		wp_enqueue_script( $this->parent->plugin_name, plugin_dir_url( __FILE__ ) . 'js/public-min.js', array( 'jquery' ), $this->parent->version, false );

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
    	$fields = $this->parent->get_fields();

    	// If we are showing the form
    	if ( $this->show_form ) {

    		// Get captcha public key
    		$public_key = get_option( $this->parent->option_name . '_captcha_public_key' );

    		// Include the file that generates the html
        	include_once( plugin_dir_path( __FILE__ ) . 'partials/organic-contact-form-form.php' );

        }

        // If we are showing the success message
        if ( $this->show_success_message ) {

        	// Include the file that generates the html
        	include_once( plugin_dir_path( __FILE__ ) . 'partials/organic-contact-form-success.php' );

        }

        // Return the html for the form
        return $html;

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
			$field = $this->parent->get_field( $form_field_id );

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
		$wpdb->insert( $this->parent->db_prefix . '_submissions',
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
			$wpdb->insert( $this->parent->db_prefix . '_submissions_fields',
				array(
					'submission_id' 	=> $submission_id,
					'form_field_id' 	=> $form_field_id,
					'value'				=> $value
				)
			);

		}

    }

}
