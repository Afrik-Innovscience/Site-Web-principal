<?php
/**
 * Menu Template Functions.
 *
 * @package Techguide
 */

/**
 * Get main menu.
 *
 * @since  1.0.0
 * @return string
 */
function techguide_get_main_menu() {
	$args = apply_filters( 'techguide_main_menu_args', array(
		'theme_location'   => 'main',
		'container'        => '',
		'menu_id'          => 'main-menu',
		'echo'             => false,
		'fallback_cb'      => 'techguide_set_nav_menu',
		'fallback_message' => esc_html__( 'Set main menu', 'techguide' ),
	) );

	return wp_nav_menu( $args );
}

/**
 * Show main menu.
 * 
 * @since  1.0.0
 * @return void
 */
function techguide_main_menu() {
	$main_menu = techguide_get_main_menu();
	$menu_btn  = techguide_get_menu_toggle();

	printf( '<nav id="site-navigation" class="main-navigation" role="navigation">%1$s%2$s</nav><!-- #site-navigation -->', $main_menu, $menu_btn );
}

/**
 * Set fallback callback for nav menu.
 *
 * @param  array $args Nav menu arguments.
 * @return null|string
 */
function techguide_set_nav_menu( $args ) {

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return null;
	}

	$format = '<div class="set-menu %3$s"><a href="%2$s" target="_blank" class="set-menu_link">%1$s</a></div>';
	$label  = $args['fallback_message'];
	$url    = esc_url( admin_url( 'nav-menus.php' ) );

	return sprintf( $format, $label, $url, $args['container_class'] );
}

/**
 * Get menu button.
 *
 * @since  1.0.0
 *
 * @return string
 */
function techguide_get_menu_toggle() {
	$format = apply_filters(
		'techguide_menu_toggle_html',
		'<button class="menu-toggle" aria-controls="main-menu" aria-expanded="false"><span class="menu-toggle-box"><span class="menu-toggle-inner"></span></span></button>'
	);

	return $format;
}
