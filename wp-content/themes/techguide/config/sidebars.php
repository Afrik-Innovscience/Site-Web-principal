<?php
/**
 * Sidebars configuration.
 *
 * @package Techguide
 */

add_action( 'after_setup_theme', 'techguide_register_sidebars', 5 );
/**
 * Register sidebars.
 */
function techguide_register_sidebars() {

	techguide_widget_area()->widgets_settings = apply_filters( 'techguide_widget_area_default_settings', array(
		'sidebar' => array(
			'name'           => esc_html__( 'Sidebar', 'techguide' ),
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h4 class="widget-title">',
			'after_title'    => '</h4>',
			'before_wrapper' => '<div id="%1$s" %2$s role="complementary">',
			'after_wrapper'  => '</div>',
			'is_global'      => true,
		),
		'shop-sidebar' => array(
			'name'           => esc_html__( 'Shop Sidebar', 'techguide' ),
			'description'    => '',
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h4 class="widget-title">',
			'after_title'    => '</h4>',
			'before_wrapper' => '<div id="%1$s" %2$s role="complementary">',
			'after_wrapper'  => '</div>',
			'is_global'      => true,
		),
	) );
}
