<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package GovPress
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'That page can&rsquo;t be found.', 'govpress' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'govpress' ); ?></p>

					<?php get_search_form(); ?>

					<?php
					$search = new WP_Query( array(
						's' => $wp_query->query_vars['name'],
						'cache_results' => false,
						'no_found_rows' => true
						)
					);
				 	if ( $search->have_posts() ) : ?>
				 		<div class="widget search_results_404">
				 			<h2 class="widgettitle">
				 				<?php printf( __( 'Search Results for: %s', 'govpress' ), '<span>' . $wp_query->query_vars['name'] . '</span>' ); ?>
				 			</h2>
				 			<ul>
						 		<?php while ( $search ->have_posts() ) : $search ->the_post(); ?>
						 			<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
						 		<?php endwhile; ?>
				 			</ul>
				 		</div>
				 	<?php endif; ?>

				 	<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php if ( govpress_categorized_blog() ) : ?>
					<div class="widget widget_categories">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'govpress' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php endif; ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</div><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>