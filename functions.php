<?php

// Register Theme Features
function custom_theme_features()  {

  // Add theme support for Custom Background
  $background_args = array(
    'default-color'          => 'f8f8f8',
    'default-image'          => '',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => '',
  );
  add_theme_support( 'custom-background', $background_args );

  // Add theme support for Custom Header
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

// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'custom_theme_features' );

/**
 * If more than one page exists, return TRUE.
 */
function show_posts_nav() {
  global $wp_query;
  return ($wp_query->max_num_pages > 10);
}

if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   
}
if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'thumb', 100, 100, true ); 
}

// register wp_nav_menu
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus( array(
	'quick-links' => __( 'Quick Links', 'govfreshwp' ))
	);
}

/* Ties WordPress menu to Bootstrap style */
add_action( 'after_setup_theme', 'wpt_setup' );
    if ( ! function_exists( 'wpt_setup' ) ):
        function wpt_setup() {  
            register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );
        } endif;

 function wpt_register_js() {
    wp_register_script('jquery.bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery');
    wp_enqueue_script('jquery.bootstrap.min');
}
add_action( 'init', 'wpt_register_js' );
function wpt_register_css() {
    wp_register_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap.min' );
}
add_action( 'wp_enqueue_scripts', 'wpt_register_css' );

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

if ( function_exists('register_sidebar') )

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
'name' => 'Footer text',
'before_widget' => '<div id="">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));

register_sidebar(array(
'name' => 'Quick links',
'before_widget' => '<div id="quick-links">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));

register_sidebar(array(
'name' => 'Home Page Featured',
'before_widget' => '<div class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar(array(
'name' => 'Home Page Hero Unit',
'before_widget' => '<div class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

function my_new_contactmethods( $contactmethods ) {
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
add_filter('user_contactmethods','my_new_contactmethods',10,1);

add_shortcode( 'entry-link-published', 'my_entry_published_link' );

function my_entry_published_link() {

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

function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

// custom excerpt ellipses for 2.9
function custom_excerpt_more($more) {
return '…';
}
add_filter('excerpt_more', 'custom_excerpt_more');

/* custom excerpt ellipses for 2.8-
function custom_excerpt_more($excerpt) {
return str_replace('[...]', '…', $excerpt);
}
add_filter('wp_trim_excerpt', 'custom_excerpt_more');
*/

function new_excerpt_length($length) {
return 100;
}
add_filter('excerpt_length', 'new_excerpt_length');

/*Prevents YouTube embed override*/

function add_video_wmode_transparent($html, $url, $attr) {

if ( strpos( $html, "<embed src=" ) !== false )
   { return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); }
elseif ( strpos ( $html, 'feature=oembed' ) !== false )
   { return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html ); }
else
   { return $html; }
}
add_filter( 'embed_oembed_html', 'add_video_wmode_transparent', 10, 3);

/*Tag cloud*/

add_filter( 'widget_tag_cloud_args', my_tag_cloud_args );
function my_tag_cloud_args($in){
return 'smallest=11&amp;largest=11&amp;number=25&amp;orderby=name&amp;unit=px';
}

function wpb_first_and_last_menu_class($items) {
    $items[1]->classes[] = 'first';
    $items[count($items)]->classes[] = 'last';
    return $items;
}
add_filter('wp_nav_menu_objects', 'wpb_first_and_last_menu_class');

//---------------------------- [ Pagenavi Function ] ------------------------------//
 
function wp_pagenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
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
 if ($max > 1) echo '</div>
';
}

?>