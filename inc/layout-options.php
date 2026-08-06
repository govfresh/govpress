<?php
/**
 * Layout options: site banner position/alignment, primary menu position.
 *
 * @package GovPress
 */

/**
 * Get the configured position for the site banner.
 *
 * @return string 'top' or 'bottom'.
 */
function govpress_site_banner_position() {
	$options  = get_option( 'govpress', false );
	$position = ( $options && isset( $options['site_banner_position'] ) ) ? $options['site_banner_position'] : 'bottom';
	return in_array( $position, array( 'top', 'bottom' ), true ) ? $position : 'bottom';
}

/**
 * Get the configured text alignment for the site banner.
 *
 * @return string 'center' or 'left'.
 */
function govpress_site_banner_align() {
	$options = get_option( 'govpress', false );
	$align   = ( $options && isset( $options['site_banner_align'] ) ) ? $options['site_banner_align'] : 'center';
	return in_array( $align, array( 'center', 'left' ), true ) ? $align : 'center';
}

/**
 * Get the configured position for the primary menu relative to the site
 * branding (logo/title/tagline).
 *
 * @return string 'above' or 'below'.
 */
function govpress_nav_position() {
	$options  = get_option( 'govpress', false );
	$position = ( $options && isset( $options['nav_position'] ) ) ? $options['nav_position'] : 'above';
	return in_array( $position, array( 'above', 'below' ), true ) ? $position : 'above';
}

/**
 * Output the site banner: an agency's custom "Banner Text" widget
 * content (e.g. an official government website notice) if one is set,
 * otherwise a default "Powered by GovPress" credit. Can render at the
 * top or bottom of the page depending on the Site Banner Position
 * setting; this function only outputs the markup itself.
 *
 * @return void
 */
function govpress_site_banner() {
	$class  = 'site-banner';
	$class .= is_active_sidebar( 'footer-text' ) ? ' widgets' : ' no-widgets';
	$class .= 'left' === govpress_site_banner_align() ? ' align-left' : '';
	?>
	<div class="<?php echo esc_attr( $class ); ?>">
		<div class="col-width">
			<?php if ( is_active_sidebar( 'footer-text' ) ) : ?>
				<div class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-text' ); ?>
				</div>
			<?php else : ?>
				<?php printf( __( 'Powered by %s', 'govpress' ), '<a href="https://github.com/govfresh/govpress">GovPress</a>' ); ?>
			<?php endif; ?>
		</div><!-- .col-width -->
	</div><!-- .site-banner -->
	<?php
}

/**
 * Output the primary navigation. Can render above or below the site
 * branding (logo/title/tagline) depending on the Primary Menu Position
 * setting; this function only outputs the markup itself.
 *
 * @return void
 */
function govpress_primary_nav() {
	?>
	<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary', 'govpress' ); ?>">
		<div class="col-width">
			<button type="button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
				<span class="screen-reader-text"><?php _e( 'Menu', 'govpress' ); ?></span>
			</button>
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'govpress' ); ?></a>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
		</div>
	</nav><!-- #site-navigation -->
	<?php
}
