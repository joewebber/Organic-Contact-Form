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
