<?php
/**
 * Term meta configuration.
 *
 * @package Techguide
 */

add_action( 'after_setup_theme', 'techguide_init_term_meta', 10 );

/**
 * Add `Inherit` value to options.
 *
 * @param array $options Options.
 *
 * @return array
 */
function techguide_prepare_meta_options( $options = array() ) {
	return array_merge(
		array(
			'inherit' => esc_html__( 'Inherit', 'techguide' ),
		),
		$options
	);
}

/**
 * Init term meta.
 */
function techguide_init_term_meta() {

	$fields = array(
		'techguide_term_settings' => array(
			'element'     => 'section',
			'scroll'      => false,
			'title'       => esc_html__( 'Archive Page Layout Settings', 'techguide' ),
			'description' => esc_html__( 'You can override the global settings for a archive page. If you select inherit option, global setting will be applied.', 'techguide' ),
		),

		'techguide_term_tabs' => array(
			'element' => 'component',
			'type'    => 'component-accordion',
			'parent'  => 'techguide_term_settings',
		),

		'layout_tab' => array(
			'element' => 'settings',
			'parent'  => 'techguide_term_tabs',
			'title'   => esc_html__( 'Layout Settings', 'techguide' ),
		),

		'meta_tab' => array(
			'element' => 'settings',
			'parent'  => 'techguide_term_tabs',
			'title'   => esc_html__( 'Post Meta Settings', 'techguide' ),
		),

		'sidebar_position' => array(
			'type'    => 'select',
			'parent'  => 'layout_tab',
			'title'   => esc_html__( 'Sidebar Position', 'techguide' ),
			'options' => techguide_prepare_meta_options(
				array(
					'one-left-sidebar'  => esc_html__( 'Sidebar on left side', 'techguide' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'techguide' ),
					'fullwidth'         => esc_html__( 'No sidebars', 'techguide' ),
				)
			),
			'value'   => 'inherit',
		),

		'blog_layout_type' => array(
			'type'    => 'select',
			'parent'  => 'layout_tab',
			'title'   => esc_html__( 'Layout', 'techguide' ),
			'options' => techguide_prepare_meta_options( techguide_get_blog_layouts() ),
			'value'   => 'inherit',
		),

		'blog_layout_columns' => array(
			'type'        => 'select',
			'parent'      => 'layout_tab',
			'title'       => esc_html__( 'Columns', 'techguide' ),
			'description' => esc_html__( 'This setting is used for grid and masonry layouts.', 'techguide' ),
			'options'     => techguide_prepare_meta_options( array(
				'2-cols' => esc_html__( '2 columns', 'techguide' ),
				'3-cols' => esc_html__( '3 columns', 'techguide' ),
				'4-cols' => esc_html__( '4 columns', 'techguide' ),
			) ),
			'value'       => 'inherit',
		),

		'posts_per_page' => array(
			'type'      => 'stepper',
			'parent'    => 'layout_tab',
			'value'     => '',
			'min_value' => 1,
			'max_value' => 100,
			'title'     => esc_html__( 'Posts Number', 'techguide' ),
		),

		'blog_pagination_type' => array(
			'type'    => 'select',
			'parent'  => 'layout_tab',
			'title'   => esc_html__( 'Pagination Type', 'techguide' ),
			'options' => techguide_prepare_meta_options( array(
				'default'   => esc_html__( 'Default', 'techguide' ),
				'load-more' => esc_html__( 'Load More', 'techguide' ),
			) ),
			'value'   => 'inherit',
		),

		'blog_posts_content' => array(
			'type'    => 'select',
			'parent'  => 'layout_tab',
			'title'   => esc_html__( 'Post content', 'techguide' ),
			'options' => techguide_prepare_meta_options( array(
				'excerpt' => esc_html__( 'Only excerpt', 'techguide' ),
				'full'    => esc_html__( 'Full content', 'techguide' ),
				'none'    => esc_html__( 'Hide', 'techguide' ),
			) ),
			'value'   => 'inherit',
		),

		'blog_read_more_btn' => array(
			'type'    => 'radio',
			'parent'  => 'layout_tab',
			'title'   => esc_html__( 'Show Read More button', 'techguide' ),
			'options' => techguide_enable_disable_radio_options(),
			'value'   => 'inherit',
		),

		'blog_post_author' => array(
			'type'    => 'radio',
			'parent'  => 'meta_tab',
			'title'   => esc_html__( 'Show post author', 'techguide' ),
			'options' => techguide_enable_disable_radio_options(),
			'value'   => 'inherit',
		),

		'blog_post_publish_date' => array(
			'type'    => 'radio',
			'parent'  => 'meta_tab',
			'title'   => esc_html__( 'Show publish date', 'techguide' ),
			'options' => techguide_enable_disable_radio_options(),
			'value'   => 'inherit',
		),

		'blog_post_categories' => array(
			'type'    => 'radio',
			'parent'  => 'meta_tab',
			'title'   => esc_html__( 'Show categories', 'techguide' ),
			'options' => techguide_enable_disable_radio_options(),
			'value'   => 'inherit',
		),

		'blog_post_tags' => array(
			'type'    => 'radio',
			'parent'  => 'meta_tab',
			'title'   => esc_html__( 'Show tags', 'techguide' ),
			'options' => techguide_enable_disable_radio_options(),
			'value'   => 'inherit',
		),

		'blog_post_comments' => array(
			'type'    => 'radio',
			'parent'  => 'meta_tab',
			'title'   => esc_html__( 'Show comments', 'techguide' ),
			'options' => techguide_enable_disable_radio_options(),
			'value'   => 'inherit',
		),
	);

	if ( techguide_is_cherry_trending_posts_activated() ) {
		$fields['blog_post_trend_views'] = array(
			'type'    => 'radio',
			'parent'  => 'meta_tab',
			'title'   => esc_html__( 'Show views counter', 'techguide' ),
			'options' => techguide_enable_disable_radio_options(),
			'value'   => 'inherit',
		);

		$fields['blog_post_trend_rating'] = array(
			'type'    => 'radio',
			'parent'  => 'meta_tab',
			'title'   => esc_html__( 'Show rating', 'techguide' ),
			'options' => techguide_enable_disable_radio_options(),
			'value'   => 'inherit',
		);
	}

	if ( techguide_is_cherry_trending_posts_activated() ) {
		$fields['blog_post_share_buttons'] = array(
			'type'    => 'radio',
			'parent'  => 'meta_tab',
			'title'   => esc_html__( 'Show social sharing buttons', 'techguide' ),
			'options' => techguide_enable_disable_radio_options(),
			'value'   => 'inherit',
		);
	}

	if ( class_exists( 'Techguide_Term_Meta' ) ) {
		new Techguide_Term_Meta( array(
			'tax'      => 'category',
			'priority' => 20,
			'fields'   => $fields,
			'meta_key' => 'techguide_term_layout_settings',
		) );

		new Techguide_Term_Meta( array(
			'tax'      => 'post_tag',
			'priority' => 20,
			'fields'   => $fields,
			'meta_key' => 'techguide_term_layout_settings',
		) );
	}
}
