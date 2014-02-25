<?php
/*
 * Template Name: Home Page
 * Description: A template with additional widget areas for the home page
 *
 * @package GovPress
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php if ( is_active_sidebar( 'home-page-featured' ) ) : ?>
				<div id="home-page-featured" class="widget-area clear">
					<div class="section-wrap">
						<?php dynamic_sidebar( 'home-page-featured' ); ?>
					</div>
				</div>
			<?php endif; // End home page top widget module ?>

		</div><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
