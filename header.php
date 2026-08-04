<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package GovPress
 */
?><!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/public-sans/PublicSans-Regular.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="hfeed site">

	<?php do_action( 'before' ); ?>

	<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary', 'govpress' ); ?>">
		<div class="col-width">
			<button type="button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
				<?php _e( 'Menu', 'govpress' ); ?>
			</button>
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'govpress' ); ?></a>

			<?php wp_nav_menu( array('theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
		</div>
	</nav><!-- #site-navigation -->

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding col-width">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php endif; ?>
			<?php if ( get_header_image() ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
				</a>
			<?php endif; // End header image check. ?>
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
			<?php if ( $govpress_description = get_bloginfo( 'description' ) ) : ?>
				<h2 class="site-description"><?php echo esc_html( $govpress_description ); ?></h2>
			<?php endif; ?>
		</div>
	</header><!-- #masthead -->

	<?php if ( is_page_template('templates/home-page.php') ) {
		get_template_part( 'templates/above', 'home-page' );
	} ?>

	<div class="col-width">
		<div id="content" class="site-content">
