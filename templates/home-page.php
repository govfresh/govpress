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

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<?php if ( trim( get_the_content() ) !== '' ): ?>
						<div class="entry-content">
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'govpress' ),
									'after'  => '</div>',
								) );
							?>
						</div><!-- .entry-content -->
					<?php endif ?>

					<?php edit_post_link( __( 'Edit', 'govpress' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>


				</article><!-- #post-## -->

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
