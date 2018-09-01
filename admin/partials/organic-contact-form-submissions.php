<?php

/**
 * The submissions view
 *
 * This file is used to markup the HTML for the submissions page
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/admin/partials
 */
?>

<div class="wrap organic-contact-form">

	<header>

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	</header>

	<?php // Include the pagination
		include( plugin_dir_path( __FILE__ ) . '/organic-contact-form-submissions-pagination.php' );
	?>

	<table class="wp-list-table widefat fixed striped posts">

		<thead>

		<tr>

			<th scope="col" id="date" class="manage-column column-date column-primary"><span>Date</span></th>

			<th scope="col" id="page" class="manage-column column-page"><span>Page</span></th>

			<th scope="col" id="name" class="manage-column column-name"><span>Name</span></th>

			<th scope="col" id="email_address" class="manage-column column-email_address"><span>Email Address</span></th>

		</tr>

		</thead>

		<tbody>

			<?php

				//  Loop through submissions
				foreach ( $submissions['data'] as $submission ) {

					// Include the submission result
					include( plugin_dir_path( __FILE__ ) . '/organic-contact-form-submissions-result.php' );

				}

			?>

		</tbody>

	</table>

	<?php // Include the pagination
		include( plugin_dir_path( __FILE__ ) . '/organic-contact-form-submissions-pagination.php' );
	?>

</div>