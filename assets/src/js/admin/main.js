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
