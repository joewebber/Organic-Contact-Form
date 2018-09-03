<?php

/**
 * The top days view
 *
 * This file is used to markup the HTML for top days on the dashboard
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/admin/partials
 */
?>
<table class="wp-list-table widefat fixed striped posts">

	<thead>

	<tr>

		<th scope="col" id="date" class="manage-column column-date column-primary"><span>Day</span></th>

		<th scope="col" id="total_submissions" class="manage-column column-total_submissions"><span>Total Submissions</span></td>

	</tr>

	</thead>

	<tbody>

		<?php

			//  Loop through days
			foreach ( $top_days as $top_day ) {

		?>

		<tr>

			<td><?php echo $top_day->day_name; ?></td>

			<td><?php echo $top_day->total_submissions; ?></td>

		</tr>

		<?php

			}

		?>

	</tbody>

</table>