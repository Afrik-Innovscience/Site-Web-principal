<?php
/**
 * Menus configuration.
 *
 * @package Techguide
 */

add_action( 'after_setup_theme', 'techguide_register_menus', 5 );
/**
 * Register menus.
 */
function techguide_register_menus() {

	register_nav_menus( array(
		'main'   => esc_html__( 'Main', 'techguide' ),
	) );
}
