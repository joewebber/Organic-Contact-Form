<?php

/**
 * The submission table view
 *
 * This file is used to markup the HTML for submission table
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/admin/partials
 */
?>
<table class="wp-list-table widefat fixed striped posts">

	<?php

		// Include the table header
		include( plugin_dir_path( __FILE__ ) . '/organic-contact-form-submissions-table-header.php' );

	?>

	<tbody>

		<?php

			//  Loop through submissions
			foreach ( $recent_submissions['data'] as $submission ) {

				// Include the submission result
				include( plugin_dir_path( __FILE__ ) . '/organic-contact-form-submissions-result.php' );

			}

		?>

	</tbody>

</table>
