<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package GovPress
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function govpress_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'govpress_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function govpress_body_classes( $classes ) {

	if ( is_404() || is_search() ) {
		return $classes;
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Body class for portfolio page template
	if ( is_page_template( 'templates/full-page.php' ) )
		$classes[] = 'full-width';

	// Pages with children have a left sidebar layout applied
	if ( govpress_is_page_parent( get_the_ID() ) ) {
		if ( !is_page_template( 'templates/full-page.php' ) )
			$classes[] = 'layout-sidebar-left';
	}

	return $classes;
}
add_filter( 'body_class', 'govpress_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function govpress_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'govpress' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'govpress_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function govpress_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'govpress_setup_author' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer.
 */
function govpress_footer_widget_count() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'widgets-count-1';
			break;
		case '2':
			$class = 'widgets-count-2';
			break;
		case '3':
			$class = 'widgets-count-3';
			break;
	}

	if ( $class )
		echo $class;
}

/**
 * Checks if current page is a page parent.
 * Conditional code lifted from /wp-includes/post-template.php.
 *
 * @returns boolean
 */
function govpress_is_page_parent( $id ) {
	global $wpdb;
	return ( $wpdb->get_var( $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'page' LIMIT 1", $id ) ) );
}