<?php
/**
 * GovPress Theme Customizer
 *
 * @package GovPress
 */

/**
 * Add additional options and postMessage support to the customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function govpress_customize_register( $wp_customize ) {

	$wp_customize->add_setting( 'govpress[header_taglinecolor]', array(
		'default' => '#222222',
		'type' => 'option'
	) );

	if ( get_theme_mod( 'header_textcolor') !== 'blank' ) {
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_tagline_color', array(
			'label' => __( 'Header Tagline Color', 'govpress' ),
			'section' => 'colors',
			'settings' => 'govpress[header_taglinecolor]'
		) ) );
	}

	$wp_customize->add_setting( 'govpress[primary_color]', array(
		'default' => '#0072BC',
		'type' => 'option'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
		'label' => __( 'Primary Color', 'govpress' ),
		'section' => 'colors',
		'settings' => 'govpress[primary_color]'
	) ) );

	$wp_customize->add_setting( 'govpress[primary_link_color]', array(
		'default' => '#428BCA',
		'type' => 'option'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_link_color', array(
		'label' => __( 'Primary Link Color', 'govpress' ),
		'section' => 'colors',
		'settings' => 'govpress[primary_link_color]'
	) ) );

	$wp_customize->add_setting( 'govpress[primary_link_hover]', array(
		'default' => '#0072BC',
		'type' => 'option'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_link_hover', array(
		'label' => __( 'Primary Link Hover', 'govpress' ),
		'section' => 'colors',
		'settings' => 'govpress[primary_link_hover]'
	) ) );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_taglinecolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'govpress[primary_color]' )->transport = 'postMessage';
	$wp_customize->get_setting( 'govpress[primary_link_color]' )->transport = 'postMessage';
	$wp_customize->get_setting( 'govpress[primary_link_hover]' )->transport = 'postMessage';
}
add_action( 'customize_register', 'govpress_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function govpress_customize_preview_js() {
	wp_enqueue_script( 'govpress_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140329', true );
}
add_action( 'customize_preview_init', 'govpress_customize_preview_js' );

/**
 * Output styles in the header
 */
function govpress_inline_styles() {

	$options = get_option( 'govpress', false );

	if ( ! $options ) {
		return;
	}

	$output = '';

	if ( isset( $options['header_taglinecolor'] ) ) {
		$output .= ".site-description { color:" . sanitize_hex_color( $options['header_taglinecolor'] ) . " }\n";
	}

	if ( isset( $options['primary_color'] ) ) {
		$output .= "#site-navigation, #hero-widgets, #secondary .widget-title, #home-page-featured .widget-title, .site-footer { background:" . sanitize_hex_color( $options['primary_color'] ) . " }\n";
	}

	if ( isset( $options['primary_link_color'] ) ) {
		$output .= "#content a { color:" . $options['primary_link_color'] . " }\n";
		$output .= "#icon-menu a, .icon-menu-container a:before { color:" . sanitize_hex_color( $options['primary_link_color'] ) . " }\n";
	}

	if ( isset( $options['primary_link_hover'] ) ) {
		$output .= "#content a:hover, #content a:focus, #content a:active { color:" . sanitize_hex_color( $options['primary_link_hover'] ) . " }\n";
		$output .= "#icon-menu a:hover, #icon-menu a:focus, #icon-menu a:active { color:" . sanitize_hex_color( $options['primary_link_hover'] ) . " }\n";
	}

	// Output styles
	if ($output <> '') {
		$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
		echo $output;
	}
}

add_action( 'wp_head', 'govpress_inline_styles', 100 );

/**
 * The core sanitize_hex_color function is only available
 * when the theme customizer is loaded.
 */
if ( !function_exists( 'sanitize_hex_color' ) ) {
	/**
	 * Sanitizes a hex color.
	 *
	 * Returns either '', a 3 or 6 digit hex color (with #), or null.
	 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
	 *
	 * @since 3.4.0
	 *
	 * @param string $color
	 * @return string|null
	 */
	function sanitize_hex_color( $color ) {
		if ( '' === $color )
			return '';

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
			return $color;

		return null;
	}
}