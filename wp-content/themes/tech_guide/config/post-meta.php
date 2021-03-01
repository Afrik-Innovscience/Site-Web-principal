<?php
/**
 * Post meta configuration.
 *
 * @package Techguide
 */

add_action( 'after_setup_theme', 'techguide_init_post_options_meta', 10 );
add_action( 'after_setup_theme', 'techguide_init_page_setting_meta', 10 );

/**
 * Enable/disable radio options.
 *
 * @return array
 */
function techguide_enable_disable_radio_options() {
	return array(
		'inherit' => array(
			'label'   => esc_html__( 'Inherit', 'techguide' ),
			'img_src' => get_parent_theme_file_uri( 'assets/images/admin/inherit.svg' ),
		),
		'true' => array(
			'label'   => esc_html__( 'Enable', 'techguide' ),
			'img_src' => get_parent_theme_file_uri( 'assets/images/admin/enable.svg' ),
		),
		'false' => array(
			'label'   => esc_html__( 'Disable', 'techguide' ),
			'img_src' => get_parent_theme_file_uri( 'assets/images/admin/disable.svg' ),
		),
	);
}

/**
 *  Init post options meta.
 */
function techguide_init_post_options_meta() {

	techguide_theme()->get_core()->init_module( 'cherry-post-meta', apply_filters( 'techguide_post_options_meta_args', array(
		'id'            => 'techguide-post-options',
		'title'         => esc_html__( 'Post Options', 'techguide' ),
		'page'          => array( 'post' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'callback_args' => false,
		'fields'        => array(
			'techguide-post-tabs' => array(
				'element' => 'component',
				'type'    => 'component-tab-vertical',
			),

			/** `Post Settings` tab */
			'techguide-settings-tab' => array(
				'element'     => 'settings',
				'parent'      => 'techguide-post-tabs',
				'title'       => esc_html__( 'Post Settings', 'techguide' ),
				'description' => esc_html__( 'You can override the global settings for a single post. If you select inherit option, global setting will be applied.', 'techguide' ),
			),

			'techguide_single_post_author' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show post author', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_publish_date' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show publish date', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_categories' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show categories', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_tags' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show tags', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_comments' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show comments', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_reading_time' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show reading time', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_trend_views' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show views counter', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_trend_rating' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show rating', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_share_buttons' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show social sharing buttons', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_sources' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show source', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_via' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show via', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_respond_button' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show the respond button after post content', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_author_block' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show the author block after each post', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_navigation' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show post navigation', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_single_post_reading_progress' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show reading progress bar', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			'techguide_related_posts_visible' => array(
				'type'    => 'radio',
				'parent'  => 'techguide-settings-tab',
				'title'   => esc_html__( 'Show related posts block', 'techguide' ),
				'value'   => 'inherit',
				'options' => techguide_enable_disable_radio_options(),
			),

			/** `Post Featured` tab */
			'techguide-featured-tab' => array(
				'element' => 'settings',
				'parent'  => 'techguide-post-tabs',
				'title'   => esc_html__( 'Post Format Featured', 'techguide' ),
			),

			'techguide-post-video-source-type' => array(
				'type'        => 'radio',
				'parent'      => 'techguide-featured-tab',
				'title'       => esc_html__( 'Video Source Type', 'techguide' ),
				'description' => esc_html__( 'Choose video source type. This setting is used for your video post formats.', 'techguide' ),
				'options'     => array(
					'embed' => array(
						'label' => esc_html__( 'Embed URL', 'techguide' ),
						'slave' => 'embed-video',
					),
					'media-library' => array(
						'label' => esc_html__( 'Media Library', 'techguide' ),
						'slave' => 'media-library-video',
					),
				),
				'value'       => 'embed',
			),

			'techguide-post-video-embed-url' => array(
				'type'        => 'text',
				'parent'      => 'techguide-featured-tab',
				'title'       => esc_html__( 'Video Embed URL', 'techguide' ),
				'description' => esc_html__( 'Enter a URL that is compatible with WP built-in oEmbed feature. This setting is used for your video post formats.', 'techguide' ) . ' <a href="http://codex.wordpress.org/Embeds" target="_blank">' .  esc_html__( 'Learn More', 'techguide' ) .'</a>',
				'placeholder' => esc_html__( 'URL', 'techguide' ),
				'master'      => 'embed-video',
			),

			'techguide-post-wp-video' => array(
				'type'               => 'media',
				'parent'             => 'techguide-featured-tab',
				'value'              => '',
				'multi_upload'       => false,
				'library_type'       => 'video',
				'title'              => esc_html__( 'Video', 'techguide' ),
				'description'        => esc_html__( 'Add video from the media library. This setting is used for your video post formats.', 'techguide' ),
				'upload_button_text' => esc_html__( 'Add Video', 'techguide' ),
				'master'             => 'media-library-video',
			),

			'techguide-post-audio-source-type' => array(
				'type'        => 'radio',
				'parent'      => 'techguide-featured-tab',
				'title'       => esc_html__( 'Audio Source Type', 'techguide' ),
				'description' => esc_html__( 'Choose audio source type. This setting is used for your audio post formats.', 'techguide' ),
				'options'     => array(
					'embed' => array(
						'label' => esc_html__( 'Embed URL', 'techguide' ),
						'slave' => 'embed-audio',
					),
					'media-library' => array(
						'label' => esc_html__( 'Media Library', 'techguide' ),
						'slave' => 'media-library-audio',
					),
				),
				'value'       => 'embed',
			),

			'techguide-post-audio-embed-url' => array(
				'type'        => 'text',
				'parent'      => 'techguide-featured-tab',
				'title'       => esc_html__( 'Audio Embed URL', 'techguide' ),
				'description' => esc_html__( 'Enter a URL that is compatible with WP built-in oEmbed feature. This setting is used for your audio post formats.', 'techguide' ) . ' <a href="http://codex.wordpress.org/Embeds" target="_blank">' .  esc_html__( 'Learn More', 'techguide' ) .'</a>',
				'placeholder' => esc_html__( 'URL', 'techguide' ),
				'master'      => 'embed-audio',
			),

			'techguide-post-wp-audio' => array(
				'type'               => 'media',
				'parent'             => 'techguide-featured-tab',
				'value'              => '',
				'multi_upload'       => false,
				'library_type'       => 'audio',
				'title'              => esc_html__( 'Audio', 'techguide' ),
				'description'        => esc_html__( 'Add audio from the media library. This setting is used for your audio post formats.', 'techguide' ),
				'upload_button_text' => esc_html__( 'Add Audio', 'techguide' ),
				'master'             => 'media-library-audio',
			),

			'techguide-post-gallery' => array(
				'type'               => 'media',
				'parent'             => 'techguide-featured-tab',
				'value'              => '',
				'multi_upload'       => true,
				'library_type'       => 'image',
				'title'              => esc_html__( 'Image Gallery', 'techguide' ),
				'description'        => esc_html__( 'Choose image(s) for the gallery. This setting is used for your gallery post formats.', 'techguide' ),
				'upload_button_text' => esc_html__( 'Add Image(s)', 'techguide' ),
			),

			'techguide-post-link' => array(
				'type'        => 'text',
				'parent'      => 'techguide-featured-tab',
				'title'       => esc_html__( 'Link', 'techguide' ),
				'description' => esc_html__( 'Enter your external url. This setting is used for your link post formats.', 'techguide' ),
				'placeholder' => esc_html__( 'URL', 'techguide' ),
			),

			'techguide-post-link-target' => array(
				'type'        => 'select',
				'parent'      => 'techguide-featured-tab',
				'title'       => esc_html__( 'Link Target', 'techguide' ),
				'description' => esc_html__( 'Choose your target for the url. This setting is used for your link post formats.', 'techguide' ),
				'options'     => array(
					'_self'  => esc_html__( 'The same frame as it was clicked', 'techguide' ),
					'_blank' => esc_html__( 'A new window or tab', 'techguide' ),
				),
				'value'       => '_self',
			),

			'techguide-post-quote' => array(
				'type'        => 'textarea',
				'parent'      => 'techguide-featured-tab',
				'title'       => esc_html__( 'Quote', 'techguide' ),
				'description' => esc_html__( 'Enter your quote. This setting is used for your quote post formats.', 'techguide' ),
				'placeholder' => esc_html__( 'Quote text', 'techguide' ),
			),

			'techguide-post-quote-cite' => array(
				'type'        => 'text',
				'parent'      => 'techguide-featured-tab',
				'title'       => esc_html__( 'Quote Cite', 'techguide' ),
				'description' => esc_html__( 'Enter the quote source. This setting is used for your quote post formats.', 'techguide' ),
				'placeholder' => esc_html__( 'Cite', 'techguide' ),
			),

			/** `Post Source and Via` tab */
			'techguide-sources-via-tab' => array(
				'element' => 'settings',
				'parent'  => 'techguide-post-tabs',
				'title'   => esc_html__( 'Post Source and Via', 'techguide' ),
			),

			'techguide-post-sources' => array(
				'type'        => 'repeater',
				'parent'      => 'techguide-sources-via-tab',
				'title'       => esc_html__( 'Post Source', 'techguide' ),
				'description' => esc_html__( 'Add the links to the sources which provided information for the post.', 'techguide' ),
				'label'       => esc_html__( 'Post Sources', 'techguide' ),
				'add_label'   => esc_html__( 'Add Post Source', 'techguide' ),
				'title_field' => 'label',
				'fields'      => array(
					'label' => array(
						'type'        => 'text',
						'id'          => 'label',
						'name'        => 'label',
						'placeholder' => esc_html__( 'Label', 'techguide' ),
						'label'       => esc_html__( 'Label*', 'techguide' ),
					),
					'url'   => array(
						'type'        => 'text',
						'id'          => 'url',
						'name'        => 'url',
						'placeholder' => esc_html__( 'URL', 'techguide' ),
						'label'       => esc_html__( 'URL*', 'techguide' ),
					),
				),
			),

			'techguide-post-via' => array(
				'type'        => 'repeater',
				'parent'      => 'techguide-sources-via-tab',
				'title'       => esc_html__( 'Via', 'techguide' ),
				'description' => esc_html__( 'Add the link to the source where the post is currently published.', 'techguide' ),
				'label'       => esc_html__( 'Via', 'techguide' ),
				'add_label'   => esc_html__( 'Add Via', 'techguide' ),
				'title_field' => 'label',
				'fields'      => array(
					'label' => array(
						'type'        => 'text',
						'id'          => 'label',
						'name'        => 'label',
						'placeholder' => esc_html__( 'Label', 'techguide' ),
						'label'       => esc_html__( 'Label*', 'techguide' ),
					),
					'url'   => array(
						'type'        => 'text',
						'id'          => 'url',
						'name'        => 'url',
						'placeholder' => esc_html__( 'URL', 'techguide' ),
						'label'       => esc_html__( 'URL*', 'techguide' ),
					),
				),
			),
		),
	) ) );
}

/**
 *  Init page settings meta.
 */
function techguide_init_page_setting_meta() {

	techguide_theme()->get_core()->init_module( 'cherry-post-meta', apply_filters( 'techguide_page_settings_meta_args',  array(
		'id'            => 'page-settings',
		'title'         => esc_html__( 'Page settings', 'techguide' ),
		'page'          => array( 'post', 'page' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'callback_args' => false,
		'fields'        => array(
			'tabs' => array(
				'element' => 'component',
				'type'    => 'component-tab-horizontal',
			),

			/** `Layout Options` tab */
			'layout_tab' => array(
				'element' => 'settings',
				'parent'  => 'tabs',
				'title'   => esc_html__( 'Layout Options', 'techguide' ),
			),
			'techguide_page_layout_style' => array(
				'type'          => 'radio',
				'parent'        => 'layout_tab',
				'title'         => esc_html__( 'Page Layout Style', 'techguide' ),
				'description'   => esc_html__( 'Page layout style global settings redefining. If you select inherit option, global setting will be applied for this layout', 'techguide' ),
				'value'         => 'inherit',
				'display_input' => false,
				'options'       => array(
					'inherit'   => array(
						'label'   => esc_html__( 'Inherit', 'techguide' ),
						'img_src' => get_parent_theme_file_uri( 'assets/images/admin/inherit.svg' ),
					),
					'boxed'     => array(
						'label'   => esc_html__( 'Boxed', 'techguide' ),
						'img_src' => get_parent_theme_file_uri( 'assets/images/admin/type-boxed.svg' ),
					),
					'framed' => array(
						'label'   => esc_html__( 'Framed', 'techguide' ),
						'img_src' => get_parent_theme_file_uri( 'assets/images/admin/type-framed.svg' ),
					),
					'fullwidth' => array(
						'label'   => esc_html__( 'Fullwidth', 'techguide' ),
						'img_src' => get_parent_theme_file_uri( 'assets/images/admin/type-fullwidth.svg' ),
					),
				),
			),
			'techguide_sidebar_position' => array(
				'type'          => 'radio',
				'parent'        => 'layout_tab',
				'title'         => esc_html__( 'Sidebar layout', 'techguide' ),
				'description'   => esc_html__( 'Sidebar position global settings redefining. If you select inherit option, global setting will be applied for this layout', 'techguide' ),
				'value'         => 'inherit',
				'display_input' => false,
				'options'       => array(
					'inherit' => array(
						'label'   => esc_html__( 'Inherit', 'techguide' ),
						'img_src' => get_parent_theme_file_uri( 'assets/images/admin/inherit.svg' ),
					),
					'one-left-sidebar' => array(
						'label'   => esc_html__( 'Sidebar on left side', 'techguide' ),
						'img_src' => get_parent_theme_file_uri( 'assets/images/admin/left-sidebar.svg' ),
					),
					'one-right-sidebar' => array(
						'label'   => esc_html__( 'Sidebar on right side', 'techguide' ),
						'img_src' => get_parent_theme_file_uri( 'assets/images/admin/right-sidebar.svg' ),
					),
					'fullwidth' => array(
						'label'   => esc_html__( 'No sidebar', 'techguide' ),
						'img_src' => get_parent_theme_file_uri( 'assets/images/admin/no-sidebar.svg' ),
					),
				),
			),

			/** `Breadcrumbs` tab */
			'breadcrumbs_tab' => array(
				'element' => 'settings',
				'parent'  => 'tabs',
				'title'   => esc_html__( 'Breadcrumbs', 'techguide' ),
			),
			'techguide_breadcrumbs_visibillity' => array(
				'type'          => 'radio',
				'parent'        => 'breadcrumbs_tab',
				'title'         => esc_html__( 'Breadcrumbs visibility', 'techguide' ),
				'description'   => esc_html__( 'Breadcrumbs visibility global settings redefining. If you select inherit option, global setting will be applied for this layout', 'techguide' ),
				'value'         => 'inherit',
				'display_input' => false,
				'options'       => techguide_enable_disable_radio_options(),
			),
		),
	) ) );
}
