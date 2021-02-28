<?php
/**
 * Theme Core config file.
 *
 * @var array
 *
 * @package Techguide
 */
$config = array(
	'dashboard_page_name' => esc_html__( 'Techguide Theme', 'techguide' ),
	'library_button'      => false,
	'menu_icon'           => 'dashicons-admin-generic',

	'guide' => array(
		'enabled' => false,
	),

	'api' => array(
		'enabled' => false,
	),
);
