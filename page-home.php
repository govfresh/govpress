<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>

	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page Hero Unit') ) ?>
				</div>
			</div>
		</div>
	</div>

	<div class="container content">

		<div class="row">

			<div class="col-md-12">

				<div class="row home-box">

					<div class="col-xs-4 col-md-2 home-links">
						<div class="home-links-icon">
							<a href="/calendar"><i class="fa fa-calendar fa-4x"></i></a>
						</div>
						<p><a href="/calendar">Calendar</i></a></p>
					</div>
					<div class="col-xs-4 col-md-2 home-links">
						<div class="home-links-icon">
							<a href="/pay"><i class="fa fa-money fa-4x"></i></a>
						</div>
						<p><a href="/pay">Pay a bill</i></a></p>
					</div>
					<div class="col-xs-4 col-md-2 home-links">
						<div class="home-links-icon">
							<a href="/codes"><i class="fa fa-gavel fa-4x"></i></a>
						</div>
						<p><a href="/codes">Codes & ordinances</i></a></p>
					</div>
					<div class="col-xs-4 col-md-2 home-links">
						<div class="home-links-icon">
							<a href="/news"><i class="fa fa-bars fa-4x"></i></a>
						</div>
						<p><a href="/news">News</i></a></p>
					</div>
					<div class="col-xs-4 col-md-2 home-links">
						<div class="home-links-icon">
							<a href="/feedback"><i class="fa fa-comment fa-4x"></i></a>
						</div>
						<p><a href="/feedback">Feedback</i></a></p>
					</div>
					<div class="col-xs-4 col-md-2 home-links">
						<div class="home-links-icon">
							<a href="/contact"><i class="fa fa-envelope fa-4x"></i></a>
						</div>
						<p><a href="/contact">Contact</i></a></p>
					</div>

				</div>
		
			</div>

		</div>

		<div class="row">

			<div class="col-md-8">

				<h3>Latest news</h3>

				<?php $the_query = new WP_Query( 'showposts=3' ); ?>
				<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

				<div class="row post">

					<div class="col-xs-4 col-md-3">

						<?php if ( has_post_thumbnail()) : ?>
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail( 'thumbnail' , array('alt' => '' , 'title' => '')); ?>
							</a>
						</div>
						<?php endif; ?>

					</div>

					<div class="col-xs-8 col-md-9">

						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						<p class="byline"><?php echo my_entry_published_link(); ?> &middot; <?php the_time('g:i a') ?></p>
						<?php the_excerpt(); ?> 

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

				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Sidebar') ) ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
