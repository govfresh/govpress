<?php
/**
 * GovPress functions and definitions
 *
 * @package GovPress
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

/**
 * Set constant for version
 */
define( 'GOVPRESS_VERSION', wp_get_theme()->get( 'Version' ) );

if ( ! function_exists( 'govpress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function govpress_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on govpress, use a find and replace
	 * to change 'govpress' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'govpress', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'govpress' ),
		'icon' => __( 'Icon Menu', 'govpress' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'govpress_custom_background_args', array(
		'default-color' => 'f8f8f8',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );

	// Post editor styles
	add_editor_style( 'editor-style.css' );

	// Enable support for custom logos in the Customizer.
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Enable support for wide and full-width block alignment.
	add_theme_support( 'align-wide' );

	// Enable support for core block styling.
	add_theme_support( 'wp-block-styles' );

	// Enable support for responsive embedded content (oEmbeds).
	add_theme_support( 'responsive-embeds' );

	// Theme layouts
	add_theme_support(
		'theme-layouts',
		array(
			'single-column' => __( '1 Column', 'govpress' ),
			'sidebar-right' => __( '2 Columns: Content / Sidebar', 'govpress' ),
			'sidebar-left' => __( '2 Columns: Sidebar / Content', 'govpress' )
		),
		array( 'default' => 'sidebar-right' )
	);

}
endif; // govpress_setup
add_action( 'after_setup_theme', 'govpress_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function govpress_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'govpress' ),
		'id'            => 'primary',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
				'name'          => __( 'Home Page Hero', 'govpress' ),
				'id'            => 'home-page-hero',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
		) );

		register_sidebar( array(
				'name'          => __( 'Home Page Featured', 'govpress' ),
				'id'            => 'home-page-featured',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
		) );

	register_sidebar( array(
		'name'          => __( 'Footer Area One', 'govpress' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Area Two', 'govpress' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Area Three', 'govpress' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Text', 'govpress' ),
		'id'            => 'footer-text',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'govpress_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function govpress_scripts() {

	wp_enqueue_style( 'govpress-style', get_stylesheet_uri(), array(), GOVPRESS_VERSION );

	// Use style-rtl.css for RTL layouts
	wp_style_add_data( 'govpress-style', 'rtl', 'replace' );

	wp_enqueue_script(
		'govpress-theme',
		get_template_directory_uri() . '/js/combined-min.js',
		array( 'jquery' ),
		GOVPRESS_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'govpress_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * JSON-LD structured data.
 */
require get_template_directory() . '/inc/structured-data.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Icon Menu Walker
 */
require get_template_directory() . '/inc/icon-menu-extras.php';

/**
 * Layout options
 */
require get_template_directory() . '/inc/theme-layouts.php';

/**
 * Block styles and patterns
 */
require get_template_directory() . '/inc/block-patterns.php';
