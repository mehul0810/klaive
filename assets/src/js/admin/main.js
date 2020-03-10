document.addEventListener( 'DOMContentLoaded', () => {

	const enableGlobally = document.querySelectorAll( 'input[name="klaive_enable_globally"]' );
	const enablePerForm = document.querySelectorAll( 'input[name="klaive_enable_per_form"]' );
	const wrappedSettingsField = document.querySelectorAll( '.klaive-wrapped-fields' );

	Array.prototype.forEach.call( enableGlobally, ( radioElement ) => {
		radioElement.addEventListener( 'change', ( e ) => {
			if ( null !== e.target.value && 'enabled' === e.target.value ) {
				Array.prototype.forEach.call( wrappedSettingsField, ( wrappedElement ) => {
					wrappedElement.classList.remove( 'give-hidden' );
				});
			} else {
				Array.prototype.forEach.call( wrappedSettingsField, ( wrappedElement ) => {
					wrappedElement.classList.add( 'give-hidden' );
				});
			}
		} );
	} );

	Array.prototype.forEach.call( enablePerForm, ( radioElement ) => {
		radioElement.addEventListener( 'change', ( e ) => {
			if ( null !== e.target.value && 'enabled' === e.target.value ) {
				Array.prototype.forEach.call( wrappedSettingsField, ( wrappedElement ) => {
					wrappedElement.classList.remove( 'give-hidden' );
				});
			} else {
				Array.prototype.forEach.call( wrappedSettingsField, ( wrappedElement ) => {
					wrappedElement.classList.add( 'give-hidden' );
				});
			}
		} );
	} );
} );

jQuery( document ).ready( function( $ ) {
	$( '.klaive-refresh-button' ).on( 'click', function( e ) {

		e.preventDefault();
		const spinner = $(this).parent().find( '.give-spinner' );
		const data    = {
			'action': $( this ).attr( 'data-action' ),
		};

		// Enable Spinner.
		spinner.attr( 'style', 'visibility: visible;');

		// Perform AJAX Call.
		$.post( ajaxurl, data, function( response ) {

			// Disable Spinner.
			spinner.attr( 'style', 'visibility: none;');

			if ( response.success ) {
				$( '.klaive-select-list' ).html( response.data );
			}
		} );
	} );
} );
