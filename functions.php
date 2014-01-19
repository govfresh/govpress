<?php
/**
 * GovFresh functions and definitions
 *
 * @package GovFresh
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
        $content_width = 880; /* pixels */
}

if ( ! function_exists( 'govfreshwp_setup' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function govfresh_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on GovFresh, use a find and replace
         * to change 'govfresh' to the name of your theme in all the template files
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

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
        		'primary' => __( 'Primary navigation', 'govfreshwp' ),
                'quick-links' => __( 'Quick Links', 'govfreshwp' ),
        ) );

        // Enable support for Post Formats.
        //add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

        // Setup the WordPress core custom background feature.
        add_theme_support(
        	'custom-background', apply_filters( 'govfresh_custom_background_args',
        	array(
                'default-color' => 'f8f8f8',
                'default-image' => ''
        ) ) );

        // Add theme support for Custom Header
        // Fixes for this coming in a later commit (@DEBUG)
		$header_args = array(
			'default-image'          => 'http://govfresh.com/wp-content/themes/govfreshwp/images/logo.png',
			'width'                  => 125,
			'height'                 => 125,
			'flex-width'             => true,
			'flex-height'            => true,
			'random-default'         => false,
			'header-text'            => false,
			'default-text-color'     => '',
			'uploads'                => true,

		);

		add_theme_support( 'custom-header', $header_args );
}
endif;

// @DEBUG will be be moving this in a later commit
if ( function_exists( 'add_theme_support' ) ) {
	set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions
}

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'thumb', 100, 100, true );
}

/**
 * Register Javascript
 */
function govfreshwp_register_js() {
	wp_register_script('jquery.bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery');
	wp_enqueue_script('jquery.bootstrap.min');
}

add_action( 'wp_enqueue_scripts', 'govfreshwp_register_js' );

/**
 * Register Styles
 */
function govfreshwp_register_css() {
	wp_register_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap.min' );
}
add_action( 'wp_enqueue_scripts', 'govfreshwp_register_css' );

// Register Custom Navigation Walker
require_once( 'wp_bootstrap_navwalker.php' );

/**
 * Register Widget Areas
 */
if ( function_exists( 'register_sidebar' ) ) {

	register_sidebar(array(
		'name' => 'Sidebar Top',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Footer 1',
		'before_widget' => '<div class="footerwidget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => 'Footer 2',
		'before_widget' => '<div class="footerwidget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => 'Footer 3',
		'before_widget' => '<div class="footerwidget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => 'Footer Text',
		'before_widget' => '<div id="">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => 'Home Page Hero Unit',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Home Page Featured',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

}

/**
 * Contact Methods
 */
function govfresh_contactmethods( $contactmethods ) {
	// Add Twitter
	$contactmethods['twitter'] = 'Twitter @';
	//add Facebook
	$contactmethods['facebook'] = 'Facebook URL';
	//add LinkedIn
	$contactmethods['linkedin'] = 'LinkedIn URL';
	//add Instagram
	$contactmethods['instagram'] = 'Instagram URL';
	//add Tumblr
	$contactmethods['tumblr'] = 'Tumblr URL';
	//add Flickr
	$contactmethods['flickr'] = 'Flickr URL';
	//add LinkedIn
	$contactmethods['googleplus'] = 'Google+ URL';
	//add GitHub
	$contactmethods['github'] = 'GitHub URL';
	return $contactmethods;
}

add_filter('user_contactmethods','govfresh_contactmethods',10,1);


/**
 * Output for bylines
 */
function govfresh_publish_link() {

	/* Get the year, month, and day of the current post. */
	$year = get_the_time( 'Y' );
	$month = get_the_time( 'm' );
	$day = get_the_time( 'd' );
	$out = '';

	/* Add a link to the monthly archive. */
	$out .= '<a href="' . get_month_link( $year, $month ) . '"' . esc_attr( get_the_time( 'F Y' ) ) . '">' . get_the_time( 'F' ) . '</a>';

	/* Add a link to the daily archive. */
	$out .= ' <a href="' . get_day_link( $year, $month, $day ) . '"' . esc_attr( get_the_time( 'F d, Y' ) ) . '">' . $day . '</a>';

	/* Add a link to the yearly archive. */
	$out .= ', <a href="' . get_year_link( $year ) . '"' . esc_attr( $year ) . '">' . $year . '</a>';

	return $out;
}

add_shortcode( 'entry-link-published', 'govfresh_publish_link' );

/**
 * Remove version number
 */
function govfreshwp_remove_version() {
	return '';
}
add_filter('the_generator', 'govfreshwp_remove_version');

/**
 * Custom ellipses for more tag
 */
function govfreshwp_excerpt_more( $more ) {
	return '…';
}
add_filter('excerpt_more', 'govfreshwp_excerpt_more');

/**
 * Trim Excerpts to 100 characters
 */
function govfreshwp_excerpt_length($length) {
	return 100;
}
add_filter('excerpt_length', 'govfreshwp_excerpt_length');

/**
 * Prevents YouTube embed override
 */
function govfreshwp_video_wmode_transparent( $html, $url, $attr ) {

	if ( strpos( $html, "<embed src=" ) !== false )
		{ return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); }
	elseif ( strpos( $html, 'feature=oembed' ) !== false )
		{ return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html ); }
	else
		{ return $html; }
}
add_filter( 'embed_oembed_html', 'govfreshwp_video_wmode_transparent', 10, 3);

/**
 * Tag cloud
 */
add_filter( 'widget_tag_cloud_args', 'govfreshwp_tag_cloud_args' );

function govfreshwp_tag_cloud_args($in){
	return 'smallest=11&amp;largest=11&amp;number=25&amp;orderby=name&amp;unit=px';
}

/**
 * Add first and last classes to menus
 */
function govfreshwp_first_and_last_menu_class($items) {
	$items[1]->classes[] = 'first';
	$items[count($items)]->classes[] = 'last';
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'govfreshwp_first_and_last_menu_class' );

/**
 * Pagenavi Functions
 * @DEBUG this will create a name conflict if wp_pagenavi plugin is installed
 * Leaving for update for later commit
 */

function wp_pagenavi() {
	global $wp_query, $wp_rewrite;
	$pages = '';
	$max = $wp_query->max_num_pages;
	if ( !$current = get_query_var( 'paged') ) $current = 1;
	$args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
	$args['total'] = $max;
	$args['current'] = $current;

	$total = 1;
	$args['mid_size'] = 3;
	$args['end_size'] = 1;
	$args['prev_text'] = '«';
	$args['next_text'] = '»';

	if ($max > 1) echo '
<div class="wp-pagenavi">';
	if ($total == 1 && $max > 1) $pages = '<span class="pages">Page ' . $current . ' of ' . $max . '</span>';
	echo $pages . paginate_links($args);
	if ($max > 1) echo '</div>';
}
