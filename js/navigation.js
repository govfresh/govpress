/**
 * Javascript required for theme
 *
 */
( function( $ ) {
	var body    = $( 'body' ),
		_window = $( window );

	// Enable menu toggle for small screens.
	( function() {
		var nav = $( '.main-navigation' ), button, menu;
		if ( ! nav ) {
			return;
		}

		button = nav.find( '.menu-toggle' );
		if ( ! button ) {
			return;
		}

		// Hide button if menu is missing or empty.
		menu = nav.find( '.nav-menu' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		$( '.menu-toggle' ).on( 'click', function() {
			nav.toggleClass( 'toggled-on' );
		} );
	} )();

	$( function() {

		// Focus styles for menus.
		$( '.main-navigation' ).find( 'a' ).on( 'focus', function() {
			$( this ).parents().toggleClass( 'focus' );
		} );
	} );

} )( jQuery );
