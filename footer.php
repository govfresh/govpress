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

	<?php
	$fclass = 'site-footer-credit no-widgets';
	if ( is_active_sidebar( 'footer-text' ) ) {
		$fclass = 'site-footer-credit widgets';
	} ?>

	<footer class="site-footer" role="contentinfo">
		<?php
			/*
			 * A sidebar in the footer? Yep. You can can customize
			 * your footer with three columns of widgets.
			 */
			if ( ! is_404() )
				get_sidebar( 'footer' );
		?>

		<div class="<?php echo $fclass; ?>">
			<div class="col-width">
				<?php if ( is_active_sidebar( 'footer-text' ) ) { ?>
					<div class="widget-area" role="complementary">
						<?php dynamic_sidebar( 'footer-text' ); ?>
					</div>
				<?php } else { ?>
					<?php printf( __( 'Powered by %s', 'govpress' ), '<a href="https://github.com/govfresh/govpress">GovPress</a>' ); ?>
				<?php } ?>
			</div><!-- .col-width -->
		</div><!-- .site-footer-credit -->
	</footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
