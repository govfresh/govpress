<?php
/*
Template Name: Feeds
*/
get_header(); ?>

	<div class="container">

		<div class="row">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>

		</div>

		<div class="row">

			<div class="col-md-8">

				<?php the_content(); ?>

				<div class="links">

					<ul>
						<?php wp_list_cats('feed=RSS&children=0'); ?>
					</ul>

				</div>

				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<div class="breadcrumb">','</div>');
					} ?>

			</div>

			<?php get_sidebar(); ?>

		</div>

	</div>

<?php get_footer(); ?>