<?php

/**
 * The pagination view
 *
 * This file is used to markup the HTML for submission pagination
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/admin/partials
 */
?>
<div class="tablenav">

	<div class="alignleft actions bulkactions">

		<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>

		<select name="action" id="bulk-action-selector-top">

			<option value="-1">Bulk Actions</option>

			<option value="export_all_records">Export All Submissions</option>

		</select>

		<input type="submit" id="doaction" class="button action" value="Apply">

	</div>

	<div class="tablenav-pages">

		<span class="displaying-num"><?php echo count( $submissions['data'] ); ?> items</span>

		<?php echo $submissions['pagination']; ?>

	</div>

</div>