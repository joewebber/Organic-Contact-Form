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
	 * @access   protected
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
		
		// Add a General section
		add_settings_section(
			$this->parent->option_name . '_general',
			__( 'General', $this->parent->plugin_name ),
			array( $this, $this->parent->option_name . '_general_cb' ),
			$this->parent->plugin_name
		);

		// Add captcha public key
		add_settings_field(
			$this->parent->option_name . '_captcha_public_key',
			__( 'Captcha Public Key', $this->parent->plugin_name ),
			array( $this, $this->parent->option_name . '_captcha_public_key_cb' ),
			$this->parent->plugin_name,
			$this->parent->option_name . '_general',
			array( 'label_for' => $this->parent->option_name . '_captcha_public_key' )
		);

		// Register the public captcha key field
		register_setting( $this->parent->plugin_name, $this->parent->option_name . '_captcha_public_key', 'filter_sanitize_string' );

		// Add captcha private key
		add_settings_field(
			$this->parent->option_name . '__captcha_private_key',
			__( 'Captcha Private Key', $this->parent->plugin_name ),
			array( $this, $this->parent->option_name . '_captcha_private_key_cb' ),
			$this->parent->plugin_name,
			$this->parent->option_name . '_general',
			array( 'label_for' => $this->parent->option_name . '_captcha_private_key' )
		);

		// Register the private captcha key field
		register_setting( $this->parent->plugin_name, $this->parent->option_name . '_captcha_private_key', 'filter_sanitize_string' );
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function organic_contact_form_general_cb() {

		// Output the text for the general section
		echo '<p>' . __( 'Update the settings below', $this->parent->plugin_name ) . '</p>';

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
		echo '<input type="text" name="' . $this->parent->option_name . '_captcha_public_key' . '" id="' . $this->parent->option_name . '_captcha_public_key' . '" value="' . $value . '">';
	}

	/**
	 * Render the private captcha key for this plugin
	 *
	 * @since  1.0.0
	 */
	public function organic_contact_form_captcha_private_key_cb() {

		// Get the current value
		$value = get_option( $this->parent->option_name . '_captcha_private_key' );

		// Output the captcha private key field
		echo '<input type="text" name="' . $this->parent->option_name . '_captcha_private_key' . '" id="' . $this->parent->option_name . '_captcha_private_key' . '" value="' . $value . '">';
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

    	// Get the submissions
    	$submissions = $this->get_submissions();

    	// Include the view
        include_once( plugin_dir_path( __FILE__ ) . 'partials/organic-contact-form-submissions.php' );

    }

    /**
     * Include Fields Partial
     *
     * This function includes the fields view
     *
	 * @since    1.0.0
     */
    public function include_fields_partial() {

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

}
