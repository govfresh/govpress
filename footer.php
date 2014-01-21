
		<div class="footer">

			<div class="container">

				<div class="row">

					<div class="col-md-4">
						<?php if ( !dynamic_sidebar( 'footer-1' ) ) ?>
					</div>
					<div class="col-md-4">
						<?php if ( !dynamic_sidebar( 'footer-2' ) ) ?>
					</div>
					<div class="col-md-4">
						<?php if ( !dynamic_sidebar( 'footer-3') ) ?>
					</div>

				</div>

			</div>

		</div>

		<div class="copyright">
			<div class="container">

				<div class="row">
					<div class="col-md-12">
						<div class="copyright-search">
							<?php get_search_form(); ?>
						</div>
						<?php // @DEBUG Remove hardcoded References // ?>
						<p><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &middot; <a href="/sitemap">Sitemap</a> &middot; <a href="http://wp.govfresh.com">GovFresh WP Theme</a></p>
						<?php if ( !dynamic_sidebar( 'footer-text' ) ) ?>
					</div>
				</div>

			</div>

		</div>

	<?php wp_footer(); ?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/jquery.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/dist/js/bootstrap.min.js"></script>

</body>

</html>
