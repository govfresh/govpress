<?php
/**
 * JSON-LD structured data (schema.org) for search engines.
 *
 * @package GovPress
 */

/**
 * Whether structured data output should be skipped.
 *
 * Bails when a dedicated SEO plugin is active, since those already emit
 * their own structured-data graph and a second one would be redundant
 * or conflicting.
 *
 * @return bool
 */
function govpress_structured_data_disabled() {
	$disabled = defined( 'WPSEO_VERSION' )
		|| defined( 'RANK_MATH_VERSION' )
		|| defined( 'AIOSEO_VERSION' )
		|| class_exists( 'SEOPress' );

	return apply_filters( 'govpress_structured_data_disable', $disabled );
}

/**
 * Build the GovernmentOrganization node describing the site itself.
 *
 * @return array
 */
function govpress_structured_data_organization() {
	$node = array(
		'@type' => 'GovernmentOrganization',
		'@id'   => home_url( '/#organization' ),
		'name'  => get_bloginfo( 'name' ),
		'url'   => home_url( '/' ),
	);

	$description = get_bloginfo( 'description' );
	if ( $description ) {
		$node['description'] = $description;
	}

	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		if ( $logo ) {
			$node['logo'] = array(
				'@type'  => 'ImageObject',
				'url'    => $logo[0],
				'width'  => $logo[1],
				'height' => $logo[2],
			);
		}
	}

	return $node;
}

/**
 * Build the WebSite node, including a SearchAction for the theme's search.
 *
 * @return array
 */
function govpress_structured_data_website() {
	return array(
		'@type'           => 'WebSite',
		'@id'             => home_url( '/#website' ),
		'name'            => get_bloginfo( 'name' ),
		'url'             => home_url( '/' ),
		'publisher'       => array( '@id' => home_url( '/#organization' ) ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'       => 'EntryPoint',
				'urlTemplate' => home_url( '/?s={search_term_string}' ),
			),
			'query-input' => 'required name=search_term_string',
		),
	);
}

/**
 * Get the current request's canonical-ish URL.
 *
 * Uses get_permalink() for singular content; falls back to the raw
 * request (path + query string) for archives and search results, since
 * those aren't tied to a single post/page permalink.
 *
 * @return string
 */
function govpress_structured_data_current_url() {
	if ( is_singular() ) {
		return get_permalink();
	}

	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';

	return esc_url_raw( home_url( $request_uri ) );
}

/**
 * Build the WebPage-family node for the current request.
 *
 * @return array
 */
function govpress_structured_data_webpage() {
	$url = govpress_structured_data_current_url();

	$node = array(
		'@id'      => $url . '#webpage',
		'url'      => $url,
		'name'     => wp_get_document_title(),
		'isPartOf' => array( '@id' => home_url( '/#website' ) ),
	);

	if ( is_search() ) {
		$node['@type'] = 'SearchResultsPage';
	} elseif ( is_author() ) {
		$author_id          = get_queried_object_id();
		$node['@type']      = 'ProfilePage';
		$node['mainEntity'] = array(
			'@type' => 'Person',
			'name'  => get_the_author_meta( 'display_name', $author_id ),
			'url'   => get_author_posts_url( $author_id ),
		);
	} elseif ( is_home() || is_archive() ) {
		$node['@type'] = 'CollectionPage';
	} else {
		$node['@type'] = 'WebPage';
	}

	if ( is_singular() ) {
		$node['datePublished'] = get_the_date( DATE_W3C );
		$node['dateModified']  = get_the_modified_date( DATE_W3C );
	}

	return $node;
}

/**
 * Build the Article node for a single post.
 *
 * @return array
 */
function govpress_structured_data_article() {
	$permalink = get_permalink();

	$node = array(
		'@type'            => 'Article',
		'@id'              => $permalink . '#article',
		'headline'         => get_the_title(),
		'url'              => $permalink,
		'datePublished'    => get_the_date( DATE_W3C ),
		'dateModified'     => get_the_modified_date( DATE_W3C ),
		'mainEntityOfPage' => array( '@id' => $permalink . '#webpage' ),
		'publisher'        => array( '@id' => home_url( '/#organization' ) ),
	);

	// Read the author straight off the post rather than get_the_author(),
	// since that relies on $authordata, which isn't populated until the
	// template's own the_post() call runs (after wp_head has fired).
	$author_id = (int) get_post_field( 'post_author', get_the_ID() );
	if ( $author_id ) {
		$node['author'] = array(
			'@type' => 'Person',
			'name'  => get_the_author_meta( 'display_name', $author_id ),
			'url'   => get_author_posts_url( $author_id ),
		);
	}

	if ( has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		if ( $image ) {
			$node['image'] = array(
				'@type'  => 'ImageObject',
				'url'    => $image[0],
				'width'  => $image[1],
				'height' => $image[2],
			);
		}
	}

	return $node;
}

/**
 * Build a BreadcrumbList node for singular content.
 *
 * Skipped when Yoast SEO's breadcrumb function is available, since
 * templates use `yoast_breadcrumb()` for on-page breadcrumbs in that case.
 *
 * @return array|null
 */
function govpress_structured_data_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		return null;
	}

	$items    = array();
	$position = 1;

	$items[] = array(
		'@type'    => 'ListItem',
		'position' => $position++,
		'name'     => __( 'Home', 'govpress' ),
		'item'     => home_url( '/' ),
	);

	if ( is_singular( 'post' ) ) {
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $position++,
				'name'     => $categories[0]->name,
				'item'     => get_category_link( $categories[0] ),
			);
		}
	}

	$items[] = array(
		'@type'    => 'ListItem',
		'position' => $position++,
		'name'     => get_the_title(),
	);

	return array(
		'@type'           => 'BreadcrumbList',
		'@id'             => get_permalink() . '#breadcrumb',
		'itemListElement' => $items,
	);
}

/**
 * Assemble and output the JSON-LD graph for the current request.
 *
 * @return void
 */
function govpress_structured_data() {
	if ( is_404() || govpress_structured_data_disabled() ) {
		return;
	}

	$graph = array(
		govpress_structured_data_organization(),
		govpress_structured_data_website(),
		govpress_structured_data_webpage(),
	);

	if ( is_singular( 'post' ) ) {
		$graph[] = govpress_structured_data_article();
	}

	if ( is_singular() ) {
		$breadcrumbs = govpress_structured_data_breadcrumbs();
		if ( $breadcrumbs ) {
			$graph[] = $breadcrumbs;
		}
	}

	$graph = apply_filters( 'govpress_structured_data_graph', $graph );

	if ( empty( $graph ) ) {
		return;
	}

	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => array_values( $graph ),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n";
}
add_action( 'wp_head', 'govpress_structured_data' );
