<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package GovPress
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="main" class="site-main" role="main">

	<section class="error-404 not-found">
	<header class="entry-header">
	<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'govpress' ); ?></h1>
</header><!-- .entry-header -->

<div class="page-content">
   

<?php

$usage = getrusage();
    
if ( $usage['ru_stime.tv_usec'] < 100000 ) {
    $search_val = $wp_query->query_vars['name'];
    $args = array( 'posts_per_page' => 1000, 'order' => 'ASC', 'hide_empty' => 1, 'post_type' => array('page','post') );

    $posts_raw = new WP_Query;
    $posts = $posts_raw->query($args);

    if ( !empty( $posts ) ) {
        echo '<h4>Are you looking for something like this?</h4>';
    }

    foreach($posts as $post) {
        similar_text( $search_val, $post->post_name, $percent );
        if ( $percent > 40 ) {
            echo '<a href="'.get_permalink( $post->ID ).'">'.$post->post_title.'</a><br />';
        }
    }
}

$i = 0;
$category_ids = get_all_category_ids();
foreach ($category_ids as $cat_id) {
    $cat_name = get_cat_name( $cat_id);
    if ( $i < 1 ) {
        echo '<hr />';
        echo 'Browse by category:<br />';
    }
    echo '<a href="'.get_category_link( $cat_id ).'">'.$cat_name.'</a><br />';
    $i++;
}

    
?>


</div><!-- .page-content -->
</section><!-- .error-404 -->

</div><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>