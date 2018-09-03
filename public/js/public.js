(function( $ ) {

	// Use strict
	'use strict';

	// Run when the dom is ready
	$(function() {

		// If we are including recpatcha
		if ( typeof grecaptcha !== 'undefined' ) {

			// Additonal submit handler for form required to prevent recaptcha from overiding the browser validation
			// (See https://stackoverflow.com/questions/41665935/html5-form-validation-before-recaptchas/41694352#41694352)
			$( '#organic_contact_form' ).submit( function (event) {

				// Prevent the form from submitting
			    event.preventDefault();

			    // Reset the captcha
			    grecaptcha.reset();

			    // Execute the captcha validation
			    grecaptcha.execute();

	 		});

	 	}
	 	
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
 * Run when form is submitted (bound to recaptcha div)
 *
 * @since    1.0.0
 */
function onSubmit(token) {

	// Submit the form
	document.getElementById( 'organic_contact_form' ).submit();

}
