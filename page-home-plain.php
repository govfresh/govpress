<?php
/*
Template Name: Home Page Plain
*/
?>

<?php get_header(); ?>

	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-md-12 callout">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page Hero Unit') ) ?>
				</div>
			</div>
		</div>
	</div>

	<div class="container content">

		<div class="row">

			<div class="col-md-8">

				<h3>Latest news</h3>

				<?php $the_query = new WP_Query( 'showposts=3' ); ?>
				<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

				<div class="row post">

					<div class="col-md-12">

						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						<p class="byline"><?php echo my_entry_published_link(); ?> &middot; <?php the_time('g:i a') ?></p>

					</div>

				</div>

				<?php endwhile;?>

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page Featured') ) ?>

			</div>

			<div class="col-md-4 sidebar">

				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Top') ) ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
