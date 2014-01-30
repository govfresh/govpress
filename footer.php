<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package govfresh
 */
?>

		</div><!-- #content -->
	</div><!-- .col-width -->

	<?php
		/*
		 * A sidebar in the footer? Yep. You can can customize
		 * your footer with three columns of widgets.
		 */
		if ( ! is_404() )
			get_sidebar( 'footer' );
	?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-width">
			<div class="site-info">
				<?php do_action( 'govfresh_credits' ); ?>
				<a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'govfresh' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'govfresh' ), 'govfresh', '<a href="http://govfresh.com/" rel="designer">GovFresh</a>' ); ?>
			</div><!-- .site-info -->
		</div><!-- .col-width -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>