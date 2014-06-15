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

$search_val = $wp_query->query_vars['name'];

$posts = get_posts();
$pages = get_pages();

$i = 0;
$j = 0;
$k = 0;

foreach($posts as $post) {
	similar_text( $search_val, $post->post_name, $percent );
	if ( $percent > 40 ) {
		if ( $i < 1 ) {
		    echo '<h4>Are you looking for a post like this?</h4>';
		}
	    echo '<a href="'.get_permalink( $post->ID ).'">'.$post->post_title.'</a><br />';
	}
	$i++;
}

foreach($pages as $page) {
	similar_text( $search_val, $page->post_name, $percent );
	if ( $percent > 40 ) {
		if ( $j < 1 ) {
			echo '<hr />';
			echo '<h4>Are you looking for a page like this?</h4>';
		}
	    echo '<a href="'.get_permalink( $page->ID ).'">'.$page->post_title.'</a><br />';
	}
	$j++;
}

$category_ids = get_all_category_ids();
foreach ($category_ids as $cat_id) {
	$cat_name = get_cat_name( $cat_id);
	if ( $k < 1 ) {
		echo '<hr />';
		echo 'Browse by category:<br />';
	}
	echo '<a href="'.get_category_link( $cat_id ).'">'.$cat_name.'</a><br />';
	$k++;
}

?>


</div><!-- .page-content -->
</section><!-- .error-404 -->

</div><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>