<?php
/*
Template Name: Sitemap
*/
?>

<?php get_header(); ?>

	<div class="container content">

		<div class="row">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>

		</div>

		<div class="row">

			<div class="col-md-8 sitemap">

				<?php the_content(); ?>

				<ul>
					<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
				</ul>

				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

			</div>

				<?php get_sidebar(); ?>

		</div>

	</div>

<?php get_footer(); ?>
