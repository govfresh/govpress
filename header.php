<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package GovPress
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/fonts/public-sans/PublicSans-Regular.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="hfeed site">

	<?php do_action( 'before' ); ?>

	<?php if ( 'top' === govpress_site_banner_position() ) : ?>
		<?php govpress_site_banner(); ?>
	<?php endif; ?>

	<?php if ( 'above' === govpress_nav_position() ) : ?>
		<?php govpress_primary_nav(); ?>
	<?php endif; ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding col-width">
			<?php if ( has_custom_logo() ) : ?>
				<?php govpress_custom_logo(); ?>
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
				<p class="site-description"><?php echo esc_html( $govpress_description ); ?></p>
			<?php endif; ?>
		</div>
	</header><!-- #masthead -->

	<?php if ( 'below' === govpress_nav_position() ) : ?>
		<?php govpress_primary_nav(); ?>
	<?php endif; ?>

	<?php if ( is_page_template('templates/home-page.php') ) {
		get_template_part( 'templates/above', 'home-page' );
	} ?>

	<div class="col-width">
		<div id="content" class="site-content">
