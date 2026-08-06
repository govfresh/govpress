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

	$wp_customize->add_section( 'govpress_layout', array(
		'title'    => __( 'Banner & Menu Position', 'govpress' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'govpress[site_banner_position]', array(
		'default'           => 'bottom',
		'type'              => 'option',
		'sanitize_callback' => 'govpress_sanitize_site_banner_position',
	) );

	$wp_customize->add_control( 'govpress_site_banner_position', array(
		'label'       => __( 'Site Banner Position', 'govpress' ),
		'description' => __( 'The site banner shows your "Banner Text" widget content (e.g. an official government website notice), or "Powered by GovPress" if none is set.', 'govpress' ),
		'section'     => 'govpress_layout',
		'settings'    => 'govpress[site_banner_position]',
		'type'        => 'radio',
		'choices'     => array(
			'bottom' => __( 'Bottom of page', 'govpress' ),
			'top'    => __( 'Top of page', 'govpress' ),
		),
	) );

	$wp_customize->add_setting( 'govpress[site_banner_align]', array(
		'default'           => 'center',
		'type'              => 'option',
		'sanitize_callback' => 'govpress_sanitize_site_banner_align',
	) );

	$wp_customize->add_control( 'govpress_site_banner_align', array(
		'label'    => __( 'Site Banner Alignment', 'govpress' ),
		'section'  => 'govpress_layout',
		'settings' => 'govpress[site_banner_align]',
		'type'     => 'radio',
		'choices'  => array(
			'center' => __( 'Center', 'govpress' ),
			'left'   => __( 'Left', 'govpress' ),
		),
	) );

	$wp_customize->add_setting( 'govpress[nav_position]', array(
		'default'           => 'above',
		'type'              => 'option',
		'sanitize_callback' => 'govpress_sanitize_nav_position',
	) );

	$wp_customize->add_control( 'govpress_nav_position', array(
		'label'       => __( 'Primary Menu Position', 'govpress' ),
		'description' => __( 'Position of the primary menu relative to the logo, site title, and tagline. If the Site Banner is also set to the top of the page, the menu renders just below it.', 'govpress' ),
		'section'     => 'govpress_layout',
		'settings'    => 'govpress[nav_position]',
		'type'        => 'radio',
		'choices'     => array(
			'above' => __( 'Above logo/title', 'govpress' ),
			'below' => __( 'Below logo/title', 'govpress' ),
		),
	) );

	$wp_customize->add_setting( 'govpress_dark_logo', array(
		'type' => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'govpress_dark_logo', array(
		'label' => __( 'Dark Mode Logo', 'govpress' ),
		'description' => __( "Optional. Shown instead of the main logo when a visitor's device is set to dark mode. If left blank, the main logo is used in both modes.", 'govpress' ),
		'section' => 'title_tagline',
		'settings' => 'govpress_dark_logo',
	) ) );

	$wp_customize->add_setting( 'govpress[header_taglinecolor]', array(
		'default' => '#1c1d1f',
		'type' => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	if ( get_theme_mod( 'header_textcolor') !== 'blank' ) {
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_tagline_color', array(
			'label' => __( 'Header Tagline Color', 'govpress' ),
			'section' => 'colors',
			'settings' => 'govpress[header_taglinecolor]'
		) ) );
	}

	$wp_customize->add_setting( 'govpress[primary_color]', array(
		'default' => '#005ea2',
		'type' => 'option',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
		'label' => __( 'Primary Color', 'govpress' ),
		'section' => 'colors',
		'settings' => 'govpress[primary_color]'
	) ) );

	$wp_customize->add_setting( 'govpress[primary_link_color]', array(
		'default' => '#005ea2',
		'type' => 'option',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_link_color', array(
		'label' => __( 'Primary Link Color', 'govpress' ),
		'section' => 'colors',
		'settings' => 'govpress[primary_link_color]'
	) ) );

	$wp_customize->add_setting( 'govpress[primary_link_hover]', array(
		'default' => '#005ea2',
		'type' => 'option',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_link_hover', array(
		'label' => __( 'Primary Link Hover', 'govpress' ),
		'section' => 'colors',
		'settings' => 'govpress[primary_link_hover]'
	) ) );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
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
 * Output the site logo, swapping in the Dark Mode Logo (if one is set) for
 * visitors whose device is set to dark mode. Falls back to a plain light
 * logo when no dark logo has been uploaded.
 */
function govpress_custom_logo() {
	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return;
	}

	$light_image = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( ! $light_image ) {
		return;
	}

	$alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );

	if ( ! $alt ) {
		// The logo is the only content inside its link to the homepage;
		// without alt text that link has no accessible name at all.
		$alt = get_bloginfo( 'name' );
	}

	$img = sprintf(
		'<img src="%1$s" width="%2$d" height="%3$d" class="custom-logo" alt="%4$s" decoding="async">',
		esc_url( $light_image[0] ),
		absint( $light_image[1] ),
		absint( $light_image[2] ),
		esc_attr( $alt )
	);

	// Stored as a URL, not an attachment ID: WP_Customize_Upload_Control (the
	// parent of WP_Customize_Image_Control) sets the setting to the selected
	// attachment's URL, unlike WP_Customize_Cropped_Image_Control (used for
	// the main Custom Logo), which stores an ID.
	$dark_logo_url = get_theme_mod( 'govpress_dark_logo' );

	echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home">';

	if ( $dark_logo_url ) {
		echo '<picture><source srcset="' . esc_url( $dark_logo_url ) . '" media="(prefers-color-scheme: dark)">' . $img . '</picture>';
	} else {
		echo $img;
	}

	echo '</a>';
}

/**
 * Output styles in the header
 */
function govpress_inline_styles() {

	// Ties the footer widget area to WordPress core's own Background Color
	// setting (Appearance > Customize > Colors) rather than a value baked
	// into the compiled stylesheet. Scoped to light mode only, since an
	// admin-chosen light background color isn't guaranteed to work in dark
	// mode; the compiled stylesheet's dark palette takes over there instead.
	$output = "@media (prefers-color-scheme: light) { #footer-widgets { background: #" . get_background_color() . " } }\n";

	$options = get_option( 'govpress', false );

	if ( $options ) {
		if ( isset( $options['header_taglinecolor'] ) ) {
			// Light mode only: dark mode uses the theme's own --color-text
			// token instead, since a light-mode tagline color isn't
			// guaranteed to stay readable against a dark background.
			$output .= "@media (prefers-color-scheme: light) { .site-description { color:" . sanitize_hex_color( $options['header_taglinecolor'] ) . " } }\n";
		}

		if ( isset( $options['primary_color'] ) ) {
			// Light mode only: dark mode always uses the theme's own neutral
			// --color-primary token instead of the site's Primary Color, so
			// this never fights with the compiled stylesheet's dark palette.
			$output .= "@media (prefers-color-scheme: light) { #site-navigation, #hero-widgets, #secondary .widget-title, #home-page-featured .widget-title, .site-banner { background:" . sanitize_hex_color( $options['primary_color'] ) . " } }\n";
		}

		if ( isset( $options['primary_link_color'] ) ) {
			$color = sanitize_hex_color( $options['primary_link_color'] );
			// Text color on an adaptive background: only safe to force in light
			// mode. Dark mode falls back to the theme's own --color-link token,
			// since a light-mode link color isn't guaranteed to stay AA-compliant
			// against a dark background.
			$output .= "@media (prefers-color-scheme: light) { #content a { color:" . $color . " } #menu-icon a, .menu-icon-container a:before { color:" . $color . " } }\n";
			// Background fill with white text: safe in both modes.
			$output .= "button, .button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"] { background: " . $color . " }\n";
		}

		if ( isset( $options['primary_link_hover'] ) ) {
			$hover = sanitize_hex_color( $options['primary_link_hover'] );
			$output .= "@media (prefers-color-scheme: light) { #content a:hover, #content a:focus, #content a:active { color:" . $hover . " } #menu-icon a:hover, #menu-icon a:focus, #menu-icon a:active { color:" . $hover . " } }\n";
		}
	}

	// Output styles
	if ($output <> '') {
		$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
		echo $output;
	}
}

add_action( 'wp_head', 'govpress_inline_styles', 100 );

/**
 * Sanitize the Site Banner Position setting.
 *
 * @param string $value The setting's raw value.
 * @return string
 */
function govpress_sanitize_site_banner_position( $value ) {
	return in_array( $value, array( 'top', 'bottom' ), true ) ? $value : 'bottom';
}

/**
 * Sanitize the Site Banner Alignment setting.
 *
 * @param string $value The setting's raw value.
 * @return string
 */
function govpress_sanitize_site_banner_align( $value ) {
	return in_array( $value, array( 'center', 'left' ), true ) ? $value : 'center';
}

/**
 * Sanitize the Primary Menu Position setting.
 *
 * @param string $value The setting's raw value.
 * @return string
 */
function govpress_sanitize_nav_position( $value ) {
	return in_array( $value, array( 'above', 'below' ), true ) ? $value : 'above';
}

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