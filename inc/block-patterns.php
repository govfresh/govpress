<?php
/**
 * Block styles and patterns
 *
 * @package GovPress
 */

/**
 * Register custom block styles.
 */
function govpress_register_block_styles() {
	register_block_style(
		'core/quote',
		array(
			'name'         => 'govpress',
			'label'        => __( 'GovPress', 'govpress' ),
			'style_handle' => 'govpress-style',
		)
	);
}
add_action( 'init', 'govpress_register_block_styles' );

/**
 * Register a GovPress block pattern category and a starter pattern.
 */
function govpress_register_block_patterns() {
	register_block_pattern_category(
		'govpress',
		array( 'label' => __( 'GovPress', 'govpress' ) )
	);

	register_block_pattern(
		'govpress/call-to-action',
		array(
			'title'       => __( 'Call to Action', 'govpress' ),
			'description' => __( 'A centered heading, paragraph, and button, useful for prompting visitors to take action.', 'govpress' ),
			'categories'  => array( 'govpress' ),
			'content'     => "<!-- wp:group {\"align\":\"wide\",\"layout\":{\"type\":\"constrained\"}} -->\n" .
				"<div class=\"wp-block-group alignwide\">" .
				"<!-- wp:heading {\"textAlign\":\"center\"} -->\n" .
				'<h2 class="wp-block-heading has-text-align-center">' . esc_html__( 'Ready to get started?', 'govpress' ) . "</h2>\n" .
				"<!-- /wp:heading -->\n\n" .
				"<!-- wp:paragraph {\"align\":\"center\"} -->\n" .
				'<p class="has-text-align-center">' . esc_html__( 'Add a short description of what you want visitors to do next.', 'govpress' ) . "</p>\n" .
				"<!-- /wp:paragraph -->\n\n" .
				"<!-- wp:buttons {\"layout\":{\"type\":\"flex\",\"justifyContent\":\"center\"}} -->\n" .
				'<div class="wp-block-buttons"><!-- wp:button -->' .
				'<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">' . esc_html__( 'Learn More', 'govpress' ) . "</a></div>\n" .
				"<!-- /wp:button --></div>\n" .
				"<!-- /wp:buttons --></div>\n" .
				'<!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'govpress_register_block_patterns' );
