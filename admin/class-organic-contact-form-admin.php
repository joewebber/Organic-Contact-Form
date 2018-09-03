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
class Organic_Contact_Form_Admin extends Organic_Contact_Form {

	/**
	 * The parent class
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      Organic_Contact_Form    $private    An instance of the parent class
	 */
	private $parent;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		// Instantiate the parent class
		$this->parent = new Organic_Contact_Form( false );

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

		wp_enqueue_style( $this->parent->plugin_name, plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->parent->version, 'all' );

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

		wp_enqueue_script( $this->parent->plugin_name, plugin_dir_url( __FILE__ ) . 'js/admin-min.js', array( 'jquery' ), $this->parent->version, false );

	}

	/**
	 * Function for registering settings for the plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {
		
		// Add a Captcha section
		add_settings_section(
			$this->parent->option_name . '_captcha',
			__( 'reCAPTCHA', $this->parent->plugin_name ),
			array( $this, $this->parent->option_name . '_captcha_cb' ),
			$this->parent->plugin_name
		);

		// Add captcha public key option
		add_settings_field(
			$this->parent->option_name . '_captcha_public_key',
			__( 'reCAPTCHA Public Key', $this->parent->plugin_name ),
			array( $this, $this->parent->option_name . '_captcha_public_key_cb' ),
			$this->parent->plugin_name,
			$this->parent->option_name . '_captcha',
			array( 'label_for' => $this->parent->option_name . '_captcha_public_key' )
		);

		// Register the public captcha key field
		register_setting( $this->parent->plugin_name, $this->parent->option_name . '_captcha_public_key', array(
	        'sanitize_callback' => 'sanitize_text_field'
    	) );

		// Add a layout section
		add_settings_section(
			$this->parent->option_name . '_layout',
			__( 'Layout', $this->parent->plugin_name ),
			array( $this, $this->parent->option_name . '_layout_cb' ),
			$this->parent->plugin_name
		);

		// Add text before button option
		add_settings_field(
			$this->parent->option_name . '_text_before_submit',
			__( 'Text to show before submit button', $this->parent->plugin_name ),
			array( $this, $this->parent->option_name . '_text_before_submit_cb' ),
			$this->parent->plugin_name,
			$this->parent->option_name . '_layout',
			array( 'label_for' => $this->parent->option_name . '_text_before_submit' )
		);

		// Register the text before button field
		register_setting( $this->parent->plugin_name, $this->parent->option_name . '_text_before_submit', array(
	        'sanitize_callback' => 'sanitize_textarea_field'
    	) );

    	// Add submit button text option
		add_settings_field(
			$this->parent->option_name . '_submit_button_text',
			__( 'Text for the submit button', $this->parent->plugin_name ),
			array( $this, $this->parent->option_name . '_submit_button_text_cb' ),
			$this->parent->plugin_name,
			$this->parent->option_name . '_layout',
			array( 'label_for' => $this->parent->option_name . '_submit_button_text' )
		);

		// Register the submit button text field
		register_setting( $this->parent->plugin_name, $this->parent->option_name . '_submit_button_text', array(
	        'sanitize_callback' => 'sanitize_text_field'
    	) );

	}

	/**
	 * Render the text for the captcha section
	 *
	 * @since  1.0.0
	 */
	public function organic_contact_form_captcha_cb() {

		// Output the text for the captcha section
		echo '<p>' . __( 'Enter your public key to enable Google reCAPTCHA. Currently supports <strong>invisible reCAPTCHA v2</strong> (<a href="https://developers.google.com/recaptcha/docs/invisible">learn more</a>)', $this->parent->plugin_name );

		// Output the more info text
		echo '<p><i>' . __( 'More information on Google Recaptcha is availble <a href="https://www.google.com/recaptcha">here</a></i>', $this->parent->plugin_name );

	}

	/**
	 * Render the public captcha key for this plugin
	 *
	 * @since  1.0.0
	 */
	public function organic_contact_form_captcha_public_key_cb() {

		// Get the current value
		$value = get_option( $this->parent->option_name . '_captcha_public_key' );

		// Output the captcha public key field
		echo '<input type="text" name="' . $this->parent->option_name . '_captcha_public_key' . '" id="' . $this->parent->option_name . '_captcha_public_key' . '" value="' . $value . '" class="regular-text">';

	}

	/**
	 * Render the text for the layout section
	 *
	 * @since  1.0.0
	 */
	public function organic_contact_form_layout_cb() {

		// Output the text for the layout section
		echo '<p>' . __( 'Control elements of the frontend form layout. Fields can be added / edited <a href="admin.php?page=organic-contact-form-fields">here</a>', $this->parent->plugin_name ) . '</p>';

	}

	/**
	 * Render the text before submit option
	 *
	 * @since  1.0.0
	 */
	public function organic_contact_form_text_before_submit_cb() {

		// Get the current value
		$value = get_option( $this->parent->option_name . '_text_before_submit' );

		// Output the field
		echo '<textarea rows="10" cols="50" name="' . $this->parent->option_name . '_text_before_submit' . '" id="' . $this->parent->option_name . '_text_before_submit' . '" class="large-text">' . $value . '</textarea>';

	}

	/**
	 * Render the submit button text option
	 *
	 * @since  1.0.0
	 */
	public function organic_contact_form_submit_button_text_cb() {

		// Get the current value
		$value = get_option( $this->parent->option_name . '_submit_button_text', $this->parent::SUBMIT_BUTTON_TEXT );

		// Output the field
		echo '<input type="text" name="' . $this->parent->option_name . '_submit_button_text' . '" id="' . $this->parent->option_name . '_submit_button_text' . '" value="' . $value . '">';

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
		
		// Register options page
		add_options_page(
			__( 'Organic Contact Form Settings', $this->parent->plugin_name ),
			__( 'Organic Contact Form', $this->parent->plugin_name ),
			'manage_options',
			$this->parent->plugin_name,
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

    	// Add main menu page using Wordpress function
        add_menu_page(
            __( 'Organic Contact Form', $this->parent->plugin_name ),
            __( 'Organic Contact Form', $this->parent->plugin_name ),
            'read',
            'organic-contact-form-dashboard',
            array( $this, 'include_dashboard_partial' ),
            'dashicons-wordpress-alt',
            9999
        );

        // Add submissions submenu item
        add_submenu_page(
        	'organic-contact-form-dashboard',
        	__( 'Organic Contact Form Submissions', $this->parent->plugin_name ),
        	__( 'Submissions', $this->parent->plugin_name ),
            'read',
            'organic-contact-form-submissions',
            array( $this, 'include_submissions_partial' )
        );

        // Add form fields submenu item
        add_submenu_page(
        	'organic-contact-form-dashboard',
        	__( 'Organic Contact Form Fields', $this->parent->plugin_name ),
        	__( 'Fields', $this->parent->plugin_name ),
            'read',
            'organic-contact-form-fields',
            array( $this, 'include_fields_partial' )
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

    	// Get recent submissions
    	$recent_submissions = $this->get_submissions( false, 5 );

    	// Get top pages
    	$top_pages = $this->get_top_pages();

    	// Get top days
    	$top_days = $this->get_top_days();

    	// Include the view
        include_once( plugin_dir_path( __FILE__ ) . 'partials/organic-contact-form-dashboard.php' );

    }

    /**
     * Include Submissions Partial
     *
     * This function includes the submissions view
     *
	 * @since    1.0.0
     */
    public function include_submissions_partial() {

    	// Get the submission id (if present)
    	$submission_id = ( isset( $_GET['submission_id'] ) ) ? (int) $_GET['submission_id'] : 0;

    	// Get the export task status (if present)
    	$export = ( isset( $_GET['export'] ) ) ? (int) $_GET['export'] : 0;

    	// If we have no submission id, show the list of submissions
    	if ( $submission_id == 0 ) {

	    	// Get the submissions
	    	$submissions = $this->get_submissions();

	    	// If we are not exporting
	    	if ( $export == 0 ) {

	        	// Include the view
	        	include_once( plugin_dir_path( __FILE__ ) . 'partials/organic-contact-form-submissions.php' );

	        }

	    } else { // Else show the individual submission

	    	// Get the submission data
    		$submission = $this->get_submission( (int) $_GET['submission_id'] );

    		// Include the view
        	include_once( plugin_dir_path( __FILE__ ) . 'partials/organic-contact-form-submissions-view.php' );

	    }

    }

    /**
     * Include Fields Partial
     *
     * This function includes the fields view
     *
	 * @since    1.0.0
     */
    public function include_fields_partial() {

    	// If we have post data
    	if ( !empty( $_POST ) ) {

    		// Save the form fields
    		$errors = $this->save_fields( $_POST['field'] );

    		// If there are no errors
    		if ( empty( $errors ) ) {

    			// Set the message
    			$message = 'Fields have been saved';

    		} else { // Else there are errors

    			// Set the message
    			$message = implode( '<br>', $errors );

    		}

    	}

    	// If we have an id to delete
    	if ( isset( $_GET['delete_id'] ) && (int) $_GET['delete_id'] > 0 ) {

    		// Remove the field
    		$this->delete_field( (int) $_GET['delete_id'] );

    		// If there are no errors
    		if ( empty( $errors ) ) {

    			// Set the message
    			$message = 'Field has been deleted';

    		} else { // Else there are errors

    			// Set the message
    			$message = implode( '<br>', $errors );

    		}

    	}

    	// Get the fields
    	$fields = $this->parent->get_fields();

    	// Get the field types
    	$field_types = $this->get_field_types();

    	// Include the view
        include_once( plugin_dir_path( __FILE__ ) . 'partials/organic-contact-form-fields.php' );

    }

    /**
     * Get Submissions
     *
     * Retrieves the submissions from the database and returns them
     *
	 * @since    1.0.0
	 * @param    $start integer The record to start at
	 * @param    $limit integer The number of rows to return
	 * @param    $order string The field to order the results by
	 * @param    $order string The order direction
	 * @return   $fields array An array of the submission data
     */
    private function get_submissions( $paginate = true, $limit = 10, $order = 'created', $order_direction = 'DESC' ) {

    	// Use the Wordpress database global
		global $wpdb;

		// Set pagination output to empty
		$pagination = '';

		// If we are paginating the result
		if ( $paginate ) {

			// Get the page we are on (or set to 1 if nto supplied)
			$page = isset( $_GET['organic-page'] ) ? (int) $_GET['organic-page'] : 1;

			// Set the offset
			$offset = ( $page * $limit ) - $limit;

			// Get the total number of submissions
			$total = $wpdb->get_var( "SELECT COUNT(*) FROM " . $this->parent->db_prefix . "_submissions" );

			// Set the pagination output
			$pagination = paginate_links( 
				array(

                    'base' => add_query_arg( 'organic-page', '%#%' ),
                    'format' => '',
                    'prev_text' => __('« Previous'),
					'next_text' => __('Next »'),
                    'total' => ceil($total / $limit),
                    'current' => $page,
                    'show_all' => true

			    )
			);

		} else { // If we are not paginating the result

			// Set the offset to zero
			$offset = 0;

		}

		// Array to hold submission result data
		$result = array(

			'data' => array(),
			'pagination' => $pagination

		);

		// Structure the query to get the submissions
		$sql = "SELECT * FROM " . $this->parent->db_prefix . "_submissions
		ORDER BY " . $order . " " . $order_direction;

		// If the limit is zero or greater
		if ($limit >= 0) {

			// Limit the results
			$sql .= " LIMIT " . (int) $offset . ", " . (int) $limit;

		}

		// Run the query to get the submissions
		$submissions = $wpdb->get_results( $sql, OBJECT );

		// Loop through each submission
		foreach ( $submissions as $submission ) {

			// Get submission fields for this submission
			$submission_fields = $this->get_submission_fields( $submission->submission_id );

			// Add the submission data to the result
			$result['data'][] = array(

				'submission' => $submission,
				'submission_fields' => $submission_fields

			);

		}

		// Return the data
		return $result;

    }

    /**
     * Get Submission
     *
     * Retrieves the submission from the database and returns
     *
	 * @since    1.0.0
	 * @param    $submission_id integer The submission_id of the related row
	 * @return   $fields array An array of the field data
     */
    private function get_submission( $submission_id ) {

    	// Use the Wordpress database global
		global $wpdb;

		// Structure the query to get the submission and corresponding fields
		$sql = "SELECT * FROM " . $this->parent->db_prefix . "_submissions
		WHERE submission_id = " . $submission_id;

		// Run the query to get the submission
		$submissions = $wpdb->get_results( $sql, OBJECT );

		// Loop through each submission
		foreach ( $submissions as $submission ) {

			// Get submission fields for this submission
			$submission_fields = $this->get_submission_fields( $submission->submission_id );

			// Add the submission data to the result
			$result = array(

				'submission' => $submission,
				'submission_fields' => $submission_fields

			);

		}

		// Return the submission
		return $result;

    }

    /**
     * Get Submission fields
     *
     * Retrieves the submission fields from the database and returns them
     *
	 * @since    1.0.0
	 * @param    $submission_id integer The submission_id of the related row
	 * @return   $fields array An array of the field data
     */
    private function get_submission_fields( $submission_id ) {

    	// Use the Wordpress database global
		global $wpdb;

		// Structure the query to get the submissions
		$sql = "SELECT * FROM " . $this->parent->db_prefix . "_submissions_fields
		LEFT JOIN " . $this->parent->db_prefix . "_fields USING (form_field_id)
		WHERE submission_id = " . $submission_id;

		// Run the query to get the submission fields
		$submission_fields = $wpdb->get_results( $sql, OBJECT );

		// Return the submission fields
		return $submission_fields;

    }

    /**
     * Get top pages
     *
     * Retrieves the top pages from the database by counting number of submissions, grouped by page
     *
	 * @since    1.0.0
	 * @return   $fields array An array of the data
     */
    private function get_top_pages() {

    	// Use the Wordpress database global
		global $wpdb;

		// Structure the query to get the pages
		$sql = "SELECT COUNT(*) AS total_submissions, url FROM " . $this->parent->db_prefix . "_submissions
		GROUP BY url
		LIMIT 5";

		// Run the query to get the pages
		$pages = $wpdb->get_results( $sql, OBJECT );

		// Return the pages
		return $pages;

    }

    /**
     * Get top days
     *
     * Retrieves the topdays from the database by counting number of submissions, grouped by day
     *
	 * @since    1.0.0
	 * @return   $fields array An array of the data
     */
    private function get_top_days() {

    	// Use the Wordpress database global
		global $wpdb;

		// Structure the query to get the pages
		$sql = "SELECT COUNT(*) AS total_submissions, DAYNAME(FROM_UNIXTIME(UNIX_TIMESTAMP(created))) AS day_name FROM " . $this->parent->db_prefix . "_submissions
		GROUP BY day_name
		ORDER BY total_submissions DESC";

		// Run the query to get the dates
		$dates = $wpdb->get_results( $sql, OBJECT );

		// Return the dates
		return $dates;

    }

    /**
     * Get field types
     *
     * Output an array of the field types
     *
	 * @since    1.0.0
	 * @return   $fields array An array of the data
     */
    private function get_field_types() {

    	// Return the field types 
    	return array(

    		'text' => 'Text',
    		'email' => 'Email Address',
    		'textarea' => 'Text Box'

    	);
    }

    /**
     * Validate field type
     *
     *
	 * @since    1.0.0
	 * @return   $value string The input value to validate
     */
    private function validate_field_type( $value ) {

    	// Validate the field type and return the result
    	return array_key_exists( $value, $this->get_field_types() );
    }

    /**
     * Save fields
     *
     * Processes posted data from the field edit and saves it to the database
     *
	 * @since    1.0.0
	 * @param    $data array An array of the posted data
	 * @return   $errors array An array of errors
     */
    private function save_fields( $data ) {

    	// Use the Wordpress database global
		global $wpdb;

		// Array to hold errors
		$errors = array();

    	// loop through the data
    	foreach ( $data as $form_field_id => $values ) {

    		// Sanitize the label using preg_replace to strip anything not alphanumeric or spaces
    		$values['label'] = trim( preg_replace( "/[^a-zA-Z0-9 ]+/", "",  $values['label'] ) );

    		// If we have a value for the label
    		if ( !empty( $values['label'] ) ) {
 
	    		// Set the name (Use Wordpress sanitize_title_with_dashes to allow only alphanumeric and dashes)
	    		$values['name'] = sanitize_title_with_dashes( $values['label'] );

	    		// Validate the field type
	    		if ( !$this->validate_field_type( $values['field_type'] ) ) {

	    			$errors[] = '"Field Type" must be one of the following:<br>' . implode( '<br>', $this->get_field_types() );

	    		}

	    		// Sanitize the required field (convert to int)
	    		$values['required'] = (int) $values['required'];

	    		// If we have no errors
	    		if ( empty( $errors ) ) {

	    			// If we have an existing field
	    			if ( (int) $form_field_id > 0) {

	    				// Update the values in the database
	    				$wpdb->update($this->parent->db_prefix . '_fields', $values, array( 'form_field_id' => $form_field_id ) );

	    			} else { // Else we have a new field

	    				// Insert the values into the database
	    				$wpdb->insert($this->parent->db_prefix . '_fields', $values );

	    			}

	    		}

	    	}
    		
    	}

    	// Return the errors array
    	return $errors;
    	
    }

    /**
     * Delete field
     *
     * Removes a field from the database
     *
	 * @since    1.0.0
	 * @param    $form_field_id int The ID of the form field to delete
	 * @return   $errors array An array of errors
     */
    private function delete_field( $form_field_id ) {

    	// Use the Wordpress database global
		global $wpdb;

		// Array to hold errors
		$errors = array();

    	// Remove the corresponding record from the database
    	$delete = $wpdb->delete($this->parent->db_prefix . '_fields', array( 'form_field_id' => $form_field_id ) );

    	// If we have an error
    	if ( $delete == false) {

    		// Add the error to the array
    		$errors[] = $wpdb->last_error;

    	}

    	// Return the errors array
    	return $errors;
    	
    }

    /**
     * Export CSV of submissions
     *
     *
	 * @since    1.0.0
     */
    public function csv_export() {

	    // Start the output buffering
	    ob_start();
	    
	    // Set the filename
	    $filename = $this->parent->plugin_name . '_export_' . date('d-m-Y_H-i-s') . '.csv';

	    // Get the submissions
	    $submissions = $this->get_submissions();
	    
	    // Add the created and URL fields to the header row
	    $header_row = array(

	        'Created',
	        'URL'

	    );

    	// Loop through submission fields from first row of data
    	foreach ( $submissions['data'][0]['submission_fields'] as $submission_field ) {

    		// Add the field name to the header row
    		$header_row[] = $submission_field->label;

    	}

	    // Open the PHP output for writing
	    $fh = fopen( 'php://output', 'w' );

	    // Output the padding characters for the CSV
	    fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );

	    // Set the cache control header
	    header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );

	    // Set the content description header
	    header( 'Content-Description: File Transfer' );

	    // Set the content type header
	    header( 'Content-type: text/csv' );

	    // Set the content disposition header
	    header( "Content-Disposition: attachment; filename={$filename}" );

	    // Set the expires header
	    header( 'Expires: 0' );

	    // Set the pragma header
	    header( 'Pragma: public' );

	    // Add the header row to the CSV
	    fputcsv( $fh, $header_row );

	    // Loop through the submissions
	    foreach ( $submissions['data'] as $submission ) {

	    	// Array to hold row data
	    	$row = array();

	    	// Add created date to row array
	    	$row[] = date('d/m/Y H:i:s', strtotime($submission['submission']->created));

	    	// Add URL to row array
	    	$row[] = $submission['submission']->url;

	    	// Loop through fields
	    	foreach ( $submission['submission_fields'] as $submission_field ) {

	    		// Add the field value to the row array
	    		$row[] = $submission_field->value;

	    	}

	        // Add the submission data to the CSV
	        fputcsv( $fh, $row );

	    }

	    // Close the file handler
	    fclose( $fh );
	    
	    // Flush the output buffer
	    ob_end_flush();
	    
	    // Kill the script
	    die();

	}

}
