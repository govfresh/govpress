<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package GovPress
 */
?>

		</div><!-- #content -->
	</div><!-- .col-width -->

	<footer class="site-footer" role="contentinfo">
		<?php
			/*
			 * A sidebar in the footer? Yep. You can can customize
			 * your footer with three columns of widgets.
			 */
			if ( ! is_404() )
				get_sidebar( 'footer' );
		?>

		<?php if ( 'bottom' === govpress_site_banner_position() ) : ?>
			<?php govpress_site_banner(); ?>
		<?php endif; ?>
	</footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
