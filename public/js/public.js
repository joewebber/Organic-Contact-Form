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
