<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/includes
 * @author     Joe Webber <signup@joewebber.co.uk>
 */
class Organic_Contact_Form_Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * The array of shortcodes registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $shortcodes    The shortcodes registered with WordPress to fire when the plugin loads.
	 */
	protected $shortcodes;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		// Set the actions
		$this->actions = array();

		// Set the filters
		$this->filters = array();

		// Set the shortcodes
		$this->shortcodes = array();

	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress action that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the action is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {

		// Add the specified action
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );

	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {

		// Add the specified filter
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );

	}

	/**
     * Add a new shortcode to the collection to be registered with WordPress
     *
     * @since     1.0.0
     * @param     string        $tag           The name of the new shortcode.
     * @param     object        $component      A reference to the instance of the object on which the shortcode is defined.
     * @param     string        $callback       The name of the function that defines the shortcode.
     */
    public function add_shortcode( $tag, $component, $callback) {

    	// Add the specified shortcode
        $this->shortcodes = $this->add( $this->shortcodes, $tag, $component, $callback, 10, 1 );

    }

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         The priority at which the function should be fired.
	 * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		// Add the hook to the array
		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		// Return the hooks
		return $hooks;

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		// Loop through the filters
		foreach ( $this->filters as $hook ) {

			// Run the Wordpress command to add the filter
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );

		}

		// Loop through the actions
		foreach ( $this->actions as $hook ) {

			// Run the Wordpress command to add the hook
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );

		}

		// Loop through the shortcodes
		foreach ( $this->shortcodes as $hook ) {

			// Run the Wordpress command to add the hook
            add_shortcode( $hook['hook'], array( $hook['component'], $hook['callback'] ) );

        }

	}

}
