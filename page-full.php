<?php
/*
Template Name: Full Page
*/
?>

<?php get_header(); ?>

	<div class="container content">

		<div class="row">

			<div class="col-md-12">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<h1><?php the_title(); ?></h1>

			<?php the_content(); ?>

			<?php comments_template('', true); ?>

			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
