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
			foreach ( $recent_submissions['data'] as $submission ) {

				// Include the submission result
				include( plugin_dir_path( __FILE__ ) . '/organic-contact-form-submissions-result.php' );

			}

		?>

	</tbody>

</table>
