(function( $ ) {
	
	// Use strict
	'use strict';

	// Run when the dom is ready
	$(function() {

		// If the action button has been clicked
		$( '.organic-contact-form #doaction' ).click( function() {

			// Get the action
			var action = $( '.organic-contact-form .bulkactions select[name="action"]' ).val()

			// Switch based on action
			switch ( action ) {

				// Export all records
				case 'export_all_records' :
					window.location.href = 'admin.php?page=organic-contact-form-submissions&export=1';
					break;

			}

		} );
	
	});

})( jQuery );
