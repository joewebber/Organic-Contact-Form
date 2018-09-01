<table class="wp-list-table widefat fixed striped posts">

	<thead>

	<tr>

		<th scope="col" id="url" class="manage-column column-url column-primary"><span>URL</span></th>

		<th scope="col" id="total_submissions" class="manage-column column-total_submissions"><span>Total Submissions</span></td>

	</tr>

	</thead>

	<tbody>

		<?php

			//  Loop through pages
			foreach ( $top_pages as $top_page ) {

		?>

		<tr>

			<td><a href="<?php echo $top_page->url; ?>"><?php echo $top_page->url; ?></a></td>

			<td><?php echo $top_page->total_submissions; ?></td>

		</tr>

		<?php

			}

		?>

	</tbody>

</table>