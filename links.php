<?php
/*
Template Name: Links
*/
get_header(); ?>

	<div class="container content">

		<div class="row">

			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>

		</div>

		<div class="row">

			<div class="col-md-3">

				<div class="">
					<?php
					$children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
					if ($children) { ?>
					<ul class="nav nav-stacked">
					<?php echo $children; ?>
					</ul>
					<?php } ?>
				</div>

			</div>

			<div class="col-md-9 links">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

				<?php wp_list_bookmarks(); ?> 

				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<div class="breadcrumb">','</div>');
					} ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
