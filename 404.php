
<?php get_header(); ?>

	<div class="container content">

		<div class="row">

			<div class="col-md-8">

				<h1><?php _e( 'Whoops', 'govfreshwp' ); ?></h1>
				<p><?php _e( 'The page you were looking for is no longer available.', 'govfreshwp' ); ?></p>
				<p></p>

				<div class="search-result">
					<?php /* @DEBUG - Should not be hardcoded */ ?>
					<p>Try searching or see our <a href="/sitemap">sitemap</a>:</p>
					<?php get_search_form(); ?>
				</div>

			</div>

				<?php get_sidebar(); ?>

		</div>

	</div>

<?php get_footer(); ?>
