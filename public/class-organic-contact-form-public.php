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
	 * The data
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var     array    $data    The data being posted.
	 */
	public $data;

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

				// Set the data (the parent class calls the 'save_submission' method, as it needs to be added to the loader, in order to make use of the $wp global)
				$this->data = $_POST['organic_form_fields'];

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

		// Enqueue the public css
		wp_enqueue_style( $this->parent->plugin_name . '_public-css', plugin_dir_url( __FILE__ ) . 'css/public.css', array(), $this->parent->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// Enqueue the public js
		wp_enqueue_script( $this->parent->plugin_name . '_public-js', plugin_dir_url( __FILE__ ) . 'js/public-min.js', array( 'jquery' ), $this->parent->version, false );

		// Get captcha public key
    	$public_key = get_option( $this->parent->option_name . '_captcha_public_key' );

    	// If we have a captcha public key
    	if ( !empty( $public_key ) ) {

    		// Enqueue the Google recaptcha script
			wp_enqueue_script( $this->parent->plugin_name . '_recaptcha', 'https://www.google.com/recaptcha/api.js', array(), $this->parent->version, false );

		}

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
    		$public_key = get_option( $this->parent->option_name . '_captcha_public_key', '' );

    		// Get text before submit
    		$text_before_submit = get_option( $this->parent->option_name . '_text_before_submit', '' );

    		// Get the submit button text
    		$submit_button_text = get_option( $this->parent->option_name . '_submit_button_text', $this->parent::SUBMIT_BUTTON_TEXT );

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
	 * @since   1.0.0
	 * @access 	public
	 * @param   $data array An array of the form data
     */
    public function save_submission() {

    	// Use the Wordpress database global
		global $wpdb;

		// Use the Wordpress global
		global $wp;

		// Save the submission
		$wpdb->insert( $this->parent->db_prefix . '_submissions',
			array(
				'created' 	=> date( 'Y-m-d H:i:s' ),
				'url' 		=> home_url( add_query_arg( $_GET, $wp->request ) ),
				'page_id'	=> get_the_ID()
			)
		);

		// Get submission id
		$submission_id = $wpdb->insert_id;

		// Loop through the form data
		foreach( $this->data as $form_field_id => $value ) {

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
