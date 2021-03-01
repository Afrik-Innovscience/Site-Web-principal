<?php
/**
 * Jet Plugins Wizard configuration.
 *
 * @package Techguide
 */
$license = array(
	'enabled' => false,
);

/**
 * Plugins configuration
 *
 * @var array
 */
$plugins = array(
	'jet-data-importer' => array(
		'name'   => esc_html__( 'Jet Data Importer', 'techguide' ),
		'source' => 'remote', // 'local', 'remote', 'wordpress' (default).
		'path'   => 'https://github.com/ZemezLab/jet-data-importer/archive/master.zip',
		'access' => 'base',
	),

	'cherry-socialize' => array(
		'name'   => esc_html__( 'Cherry Socialize', 'techguide' ),
		'access' => 'skins',
	),
	'cherry-popups' => array(
		'name'   => esc_html__( 'Cherry Cherry PopUps', 'techguide' ),
		'access' => 'skins',
	),
	'cherry-trending-posts' => array(
		'name'   => esc_html__( 'Cherry Trending Posts', 'techguide' ),
		'access' => 'skins',
	),

	'elementor' => array(
		'name'   => esc_html__( 'Elementor Page Builder', 'techguide' ),
		'access' => 'base',
	),
	'jet-blog' => array(
		'name'   => esc_html__( 'Jet Blog For Elementor', 'techguide' ),
		'source' => 'local',
		'path'   => get_parent_theme_file_path( 'assets/includes/plugins/jet-blog.zip' ),
		'access' => 'base',
	),
	'jet-blocks' => array(
		'name'   => esc_html__( 'Jet Blocks For Elementor', 'techguide' ),
		'source' => 'local',
		'path'   => get_parent_theme_file_path( 'assets/includes/plugins/jet-blocks.zip' ),
		'access' => 'base',
	),
	'jet-elements' => array(
		'name'   => esc_html__( 'Jet Elements For Elementor', 'techguide' ),
		'source' => 'local',
		'path'   => get_parent_theme_file_path( 'assets/includes/plugins/jet-elements.zip' ),
		'access' => 'base',
	),
	'jet-tabs' => array(
		'name'   => esc_html__( 'Jet Tabs For Elementor', 'techguide' ),
		'source' => 'local',
		'path'   => get_parent_theme_file_path( 'assets/includes/plugins/jet-tabs.zip' ),
		'access' => 'base',
	),
	'jet-theme-core' => array(
		'name'   => esc_html__( 'Jet Theme Core', 'techguide' ),
		'source' => 'local',
		'path'   => get_parent_theme_file_path( 'assets/includes/plugins/jet-theme-core.zip' ),
		'access' => 'base',
	),
	'jet-tricks' => array(
		'name'   => esc_html__( 'Jet Tricks', 'techguide' ),
		'source' => 'local',
		'path'   => get_parent_theme_file_path( 'assets/includes/plugins/jet-tricks.zip' ),
		'access' => 'base',
	),
	'jet-menu' => array(
		'name'   => esc_html__( 'Jet Menu', 'techguide' ),
		'source' => 'local',
		'path'   => get_parent_theme_file_path( 'assets/includes/plugins/jet-menu.zip' ),
		'access' => 'base',
	),

	'better-recent-comments' => array(
		'name'   => esc_html__( 'Better Recent Comments', 'techguide' ),
		'access' => 'skins',
	),
	'highlight-and-share' => array(
		'name'   => esc_html__( 'Highlight and Share', 'techguide' ),
		'access' => 'skins',
	),
	'wordpress-social-login' => array(
		'name'   => esc_html__( 'WordPress Social Login', 'techguide' ),
		'access' => 'skins',
	),

);

/**
 * Skins configuration
 *
 * @var array
 */
$skins = array(
	'base' => array(
		'jet-data-importer',
		'elementor',
		'jet-blog',
		'jet-blocks',
		'jet-elements',
		'jet-tabs',
		'jet-theme-core',
		'jet-tricks',
		'jet-menu',
	),
	'advanced' => array(
		'default' => array(
			'full'  => array(
				'cherry-popups',
				'cherry-socialize',
				'cherry-trending-posts',

				'better-recent-comments',
				'highlight-and-share',
				'wordpress-social-login',
			),
			'lite'  => false,
			'demo'  => '',
			'thumb' => get_template_directory_uri() . '/assets/demo-content/default/default-thumb.jpg',
			'name'  => esc_html__( 'Techguide', 'techguide' ),
		),
	),
);

$texts = array(
	'theme-name' => esc_html__( 'Techguide', 'techguide' ),
);

$config = array(
	'license' => $license,
	'plugins' => $plugins,
	'skins'   => $skins,
	'texts'   => $texts,
);
