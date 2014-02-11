<?php
/*
 * Template part for displaying special home page sections above the page content.
 * This template is called from header.php.
 *
 * @package GovFreshWP
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
			$menu = wp_nav_menu( array(
				'theme_location' => 'icon',
				'echo' => false,
			) );
			$count = substr_count( $menu, 'class="menu-item ');
			wp_nav_menu( array(
				'theme_location' => 'icon',
				'menu_class' => 'icon-menu menu-items-' . ( $count + 1 ),
				'depth' => '1',
				'walker' => new govfreshwp_icon_menu_nav_walker()
			) ); ?>
		</div>
	</div>
<?php endif; // Icon Menu ?>