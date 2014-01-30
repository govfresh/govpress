<?php get_header(); ?>

	<div class="container content">

		<div class="row">

			<div class="col-md-12">

				<?php if (have_posts()) : ?>

				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1><?php single_cat_title(); ?></h1>
				<?php /* If this is a tag archive */ } elseif ( is_tag() ) { ?>
				<h1><?php single_tag_title(); ?></h1>
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1><?php the_time('F j, Y'); ?></h1>
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1><?php the_time('F Y'); ?></h1>
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1><?php the_time('Y'); ?></h1>
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1><?php _e( 'Blog', 'govfreshwp' ); ?></h1>
				<?php } ?>

			</div>

		</div>

		<div class="row">

			<div class="col-md-8">

				<?php
			    $category_description = category_description();
			    if (!empty( $category_description)) {
			        echo '<div class="category-description">'
			              . do_shortcode($category_description) .
			             '</div>';
			    }
			    ?>

				<?php while (have_posts()) : the_post(); ?>

				<div class="row post">

					<div class="col-md-12">

						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						<p class="byline"><?php echo govfresh_publish_link(); ?> &middot; <?php the_time('g:i a') ?></p>

					</div>

				</div>

				<?php endwhile; ?>

				<?php if(function_exists('wp_pagenavi')) { ?>
				<?php wp_pagenavi(); ?>
				<?php } else { ?>
				<div class="navigation"><p><?php posts_nav_link('&#8734;','&laquo;&laquo; Newer','Older &raquo;&raquo;'); ?></p></div>
				<?php } ?>

				<?php else : ?>

				<?php

				if ( is_category() ) { // If this is a category archive
				printf("<h2>Sorry, but there aren&rsquo;t any posts in the %s category yet.</h2>", single_cat_title('',false));
				} else if ( is_date() ) { // If this is a date archive
				echo("<h2>Sorry, but there aren&rsquo;t any posts with this date.</h2>");
				} else if ( is_author() ) { // If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf("<h2>Sorry, but there aren&rsquo;t any posts by %s yet.</h2>", $userdata->display_name);
				} else {
				echo("<h2>No posts found.</h2>");
				}
				get_search_form();

				?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>

		</div>

	</div>

<?php get_footer(); ?>
