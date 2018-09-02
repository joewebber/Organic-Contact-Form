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

		<?php

			// Include the table header
			include( plugin_dir_path( __FILE__ ) . '/organic-contact-form-submissions-table-header.php' );

		?>

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