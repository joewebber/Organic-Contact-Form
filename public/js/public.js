(function( $ ) {

	// Use strict
	'use strict';

	// Run when the dom is ready
	$(function() {

		// If the form has been submitted
		if ( $( '.organic-contact-form.submitted' ).length > 0 ) {

			// Scroll to the containing div
			$( [document.documentElement, document.body] ).animate({

        		scrollTop: $( '.organic-contact-form.submitted' ).offset().top

    		}, 1000);

		}
	
	});

})( jQuery );

/**
 * Run when form is submitted
 *
 * @since    1.0.0
 */
function onSubmit(token) {
	
	// Submit the form
	document.getElementById("organic_contact_form").submit();

}
