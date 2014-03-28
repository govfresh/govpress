/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	// Header tagline color
	wp.customize( 'govpress[header_taglinecolor]', function( value ) {
		value.bind( function( to ) {
			$( 'site-branding .site-description' ).css( {
				'color' : to
			} );
		} );
	} );

	// Primary color
	wp.customize( 'govpress[primary_color]', function( value ) {
		value.bind( function( to ) {
			$( '#site-navigation, #hero-widgets, #secondary .widget-title, #home-page-featured .widget-title, .site-footer' ).css( {
				'background' : to
			} );
		} );
	} );

	// Primary link color
	wp.customize( 'govpress[primary_link_color]', function( value ) {
		value.bind( function( to ) {
			$( 'a' ).css( {
				'color' : to
			} );
		} );
	} );

	// Primary link hover
	wp.customize( 'govpress[primary_link_hover]', function( value ) {
		value.bind( function( to ) {
			$( 'a:hover, a:focus, a:active' ).css( {
				'color' : to
			} );
		} );
	} );

} )( jQuery );
