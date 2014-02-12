<?php
/**
 * Footer widget areas
 *
 * @package GovPress
 */
?>

<?php
	/*
	 * The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'footer-1'  )
		&& ! is_active_sidebar( 'footer-2' )
		&& ! is_active_sidebar( 'footer-3'  )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

<div id="footer-widgets" class="col-width clear <?php govpress_footer_widget_count(); ?>">
	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
	<div id="footer-widget-1" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div><!-- #first .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
	<div id="footer-widget-2" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-2' ); ?>
	</div><!-- #second .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
	<div id="footer-widget-3" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-3' ); ?>
	</div><!-- #third .widget-area -->
	<?php endif; ?>
</div><!-- #supplementary -->
