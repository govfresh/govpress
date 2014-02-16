<?php
/*
 * Template part for displaying special home page sections above the page content.
 * This template is called from header.php.
 *
 * @package GovPress
 */
?>

<?php if ( is_active_sidebar( 'home-page-hero' ) ) : ?>
	<div id="hero-widgets" class="clear">
		<div class="col-width">
			<div class="section-wrap">
				<?php dynamic_sidebar( 'home-page-hero' ); ?>
			</div>
		</div>
	</div>
<?php endif; // End home page top widget module ?>

<?php if ( has_nav_menu( 'icon' ) ) : ?>
	<div id="icon-menu" class="clear">
		<div class="col-width">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'icon',
				'depth' => '1',
				'container_class' => 'icon-menu-container'
			) ); ?>
		</div>
	</div>
<?php endif; // Icon Menu ?>
