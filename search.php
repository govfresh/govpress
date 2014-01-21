<?php get_header(); ?>

	<div class="container content">

		<div class="row">

			<div class="col-md-12">
				<h1>Results for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' ('); echo $count . ''; _e(')'); wp_reset_query(); ?></h1>
			</div>

			<div class="col-md-8">

				<div class="search-result">
					<?php get_search_form(); ?>
				</div>

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="search-result-entry">
					<?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="search-excerpt">\0</span>', $title); ?>
					<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $title; ?></a></h4>
					<?php the_excerpt(); ?>
				</div>

					<?php endwhile; else: ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.', 'govfreshwp' ); ?></p>
					<?php endif; ?>

				<?php if(function_exists('wp_pagenavi')) { ?>
				<?php wp_pagenavi(); ?>
				<?php } else { ?>
				<div class="navigation"><p><?php posts_nav_link('&#8734;','&laquo;&laquo; Newer','Older &raquo;&raquo;'); ?></p></div>
				<?php } ?>

			</div>

				<?php get_sidebar(); ?>

		</div>

	</div>

<?php get_footer(); ?>
