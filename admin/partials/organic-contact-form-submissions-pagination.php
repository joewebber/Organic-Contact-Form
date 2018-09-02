<div class="tablenav">

	<div class="alignleft actions bulkactions">

		<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>

		<select name="action" id="bulk-action-selector-top">

			<option value="-1">Bulk Actions</option>

			<option value="export_all_records">Export All Records</option>

		</select>

		<input type="submit" id="doaction" class="button action" value="Apply">

	</div>

	<div class="tablenav-pages">

		<span class="displaying-num"><?php echo count( $submissions['data'] ); ?> items</span>

		<?php echo $submissions['pagination']; ?>

	</div>

</div>