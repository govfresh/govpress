<?php
/**
 * Head <meta> output not already handled by WordPress core.
 *
 * @package GovPress
 */

/**
 * Whether the fallback meta description should be skipped.
 *
 * Bails when a dedicated SEO plugin is active, since those already emit
 * their own (usually more configurable) meta description and a second
 * one would be redundant or conflicting.
 *
 * @return bool
 */
function govpress_meta_description_disabled() {
	$disabled = defined( 'WPSEO_VERSION' )
		|| defined( 'RANK_MATH_VERSION' )
		|| defined( 'AIOSEO_VERSION' )
		|| class_exists( 'SEOPress' );

	return apply_filters( 'govpress_meta_description_disable', $disabled );
}

/**
 * Output a fallback <meta name="description"> tag.
 *
 * @return void
 */
function govpress_meta_description() {
	if ( is_404() || govpress_meta_description_disabled() ) {
		return;
	}

	if ( is_front_page() || is_home() ) {
		$description = get_bloginfo( 'description' );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$description = term_description();
	} elseif ( is_singular() ) {
		$post = get_post();
		if ( $post && has_excerpt( $post ) ) {
			$description = get_the_excerpt( $post );
		} elseif ( $post ) {
			$description = wp_trim_words( wp_strip_all_tags( $post->post_content ), 30 );
		} else {
			$description = '';
		}
	} else {
		$description = '';
	}

	$description = trim( wp_strip_all_tags( $description ) );

	if ( ! $description ) {
		return;
	}

	echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
}
add_action( 'wp_head', 'govpress_meta_description', 1 );

/**
 * Remove the WordPress version number from the front end. A minor
 * hardening step: no reason to advertise the exact core version running.
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Remove the shortlink tag. Nothing meaningful consumes it today.
 */
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/**
 * Remove the RSD (Really Simple Discovery) link, used by legacy desktop
 * blog clients to auto-discover the XML-RPC endpoint. This only stops
 * advertising the endpoint - xmlrpc.php itself is untouched and still
 * responds, so this isn't a substitute for actually disabling XML-RPC.
 */
remove_action( 'wp_head', 'rsd_link' );

/**
 * Output theme-color meta tags matching the site's Primary Color (light
 * mode) and the theme's fixed neutral dark-mode banner color, so mobile
 * browser chrome matches the page.
 *
 * @return void
 */
function govpress_meta_theme_color() {
	$options     = get_option( 'govpress', false );
	$light_color = ( $options && ! empty( $options['primary_color'] ) )
		? sanitize_hex_color( $options['primary_color'] )
		: '#005ea2';

	if ( ! $light_color ) {
		$light_color = '#005ea2';
	}

	echo '<meta name="theme-color" content="' . esc_attr( $light_color ) . '" media="(prefers-color-scheme: light)">' . "\n";
	echo '<meta name="theme-color" content="#2d2e30" media="(prefers-color-scheme: dark)">' . "\n";
}
add_action( 'wp_head', 'govpress_meta_theme_color' );
