<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Techguide
 */
$sidebar_position = techguide_get_mod( 'sidebar_position' );

if ( 'fullwidth' === $sidebar_position ) {
	return;
}

if ( is_active_sidebar( 'sidebar' ) && ! techguide_is_product_page() ) {
	do_action( 'techguide_render_widget_area', 'sidebar' );
}

if ( is_active_sidebar( 'shop-sidebar' ) && techguide_is_product_page() ) {
	do_action( 'techguide_render_widget_area', 'shop-sidebar' );
}
