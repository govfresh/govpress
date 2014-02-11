<?php
/**
 * govfreshwp functions and definitions
 *
 * @package GovFreshWP
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'govfreshwp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function govfreshwp_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on govfreshwp, use a find and replace
	 * to change 'govfreshwp' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'govfreshwp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'govfreshwp' ),
		'icon' => __( 'Icon Menu', 'govfreshwp' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'govfreshwp_custom_background_args', array(
		'default-color' => 'f8f8f8',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // govfreshwp_setup
add_action( 'after_setup_theme', 'govfreshwp_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function govfreshwp_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'govfreshwp' ),
		'id'            => 'primary',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
        'name'          => __( 'Home Page Hero', 'govfreshwp' ),
        'id'            => 'home-page-hero',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Home Page Featured', 'govfreshwp' ),
        'id'            => 'home-page-featured',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );


	register_sidebar( array(
		'name'          => __( 'Footer Area One', 'govfreshwp' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Area Two', 'govfreshwp' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Area Three', 'govfreshwp' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Text', 'govfreshwp' ),
		'id'            => 'footer-text',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'govfreshwp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function govfreshwp_scripts() {
	wp_enqueue_style( 'govfreshwp-style', get_stylesheet_uri() );

	wp_enqueue_script( 'govfreshwp-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'govfreshwp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'govfreshwp_scripts' );

/**
 * Enqueue fonts
 */
function govfreshwp_fonts() {
	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/fonts/font-awesome/font-awesome.css', array(), '4.0.3' );
	wp_register_style( 'govfreshwp-open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300', '', null, 'screen' );
		wp_enqueue_style( 'govfreshwp-open-sans' );
}
add_action( 'wp_enqueue_scripts', 'govfreshwp_fonts' );

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Icon Menu Walker
 */
require get_template_directory() . '/inc/icon-menu-nav-walker.php';
