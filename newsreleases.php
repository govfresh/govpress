<?php
/*
Template Name Posts: News releases
*/
get_header(); ?>

	<div class="container content">

		<div class="row">

			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>

		</div>

		<div class="row">

			<div class="col-md-8">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<p class="byline">FOR IMMEDIATE RELEASE:<br>
					<?php echo govfresh_publish_link(); ?> &middot; <?php the_time('g:i a') ?></p>

				<?php the_content(); ?>

				<p><?php wp_link_pages('parameters'); ?></p>

				<div class="post-meta">
					<ul>
						<li><?php the_category(' '); ?> <?php the_tags(' ',' '); ?></li>
					</ul>
				</div>

				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

			</div>

				<?php get_sidebar(); ?>

		</div>

	</div>

<?php get_footer(); ?>
