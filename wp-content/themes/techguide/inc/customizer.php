<?php
/**
 * Theme Customizer.
 *
 * @package Techguide
 */

/**
 * Retrieve a holder for Customizer options.
 *
 * @since  1.0.0
 * @return array
 */
function techguide_get_customizer_options() {
	/**
	 * Filter a holder for Customizer options (for theme/plugin developer customization).
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'techguide_get_customizer_options', array(
		'prefix'     => 'techguide',
		'capability' => 'edit_theme_options',
		'type'       => 'theme_mod',
		'options'    => array(

			/** `Site Identity` section */
			'show_tagline' => array(
				'title'    => esc_html__( 'Show tagline after logo', 'techguide' ),
				'section'  => 'title_tagline',
				'priority' => 60,
				'default'  => false,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			'totop_visibility' => array(
				'title'    => esc_html__( 'Show ToTop button', 'techguide' ),
				'section'  => 'title_tagline',
				'priority' => 61,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),

			/** `General Site settings` panel */
			'general_settings' => array(
				'title'    => esc_html__( 'General Site settings', 'techguide' ),
				'priority' => 40,
				'type'     => 'panel',
			),

			/** `Logo & Favicon` section */
			'logo_favicon' => array(
				'title'    => esc_html__( 'Logo &amp; Favicon', 'techguide' ),
				'priority' => 25,
				'panel'    => 'general_settings',
				'type'     => 'section',
			),

			/** `Breadcrumbs` section */
			'breadcrumbs' => array(
				'title'    => esc_html__( 'Breadcrumbs', 'techguide' ),
				'priority' => 30,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'breadcrumbs_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs', 'techguide' ),
				'section' => 'breadcrumbs',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_front_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs on front page', 'techguide' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_page_title' => array(
				'title'   => esc_html__( 'Enable page title in breadcrumbs area', 'techguide' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_path_type' => array(
				'title'   => esc_html__( 'Show full/minified path', 'techguide' ),
				'section' => 'breadcrumbs',
				'default' => 'full',
				'field'   => 'select',
				'choices' => array(
					'full'     => esc_html__( 'Full', 'techguide' ),
					'minified' => esc_html__( 'Minified', 'techguide' ),
				),
				'type'    => 'control',
			),

			/** `Page Layout` section */
			'page_layout' => array(
				'title'    => esc_html__( 'Page Layout', 'techguide' ),
				'priority' => 55,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'page_layout_style' => array(
				'title'   => esc_html__( 'Page Layout Style', 'techguide' ),
				'section' => 'page_layout',
				'default' => 'fullwidth',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'techguide' ),
					'framed'    => esc_html__( 'Framed', 'techguide' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'techguide' ),
				),
				'type'    => 'control',
			),
			'page_boxed_width' => array(
				'title'       => esc_html__( 'Page width (px)', 'techguide' ),
				'section'     => 'page_layout',
				'default'     => 1230,
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 960,
					'max'  => 1920,
					'step' => 1,
				),
				'type'            => 'control',
				'active_callback' => 'techguide_is_page_type_boxed',
			),
			'page_boxed_bg_color' => array(
				'title'           => esc_html__( 'Page Inner Background', 'techguide' ),
				'section'         => 'page_layout',
				'default'         => '#ffffff',
				'field'           => 'hex_color',
				'type'            => 'control',
				'active_callback' => 'techguide_is_page_type_boxed',
			),
			'container_width' => array(
				'title'       => esc_html__( 'Container width (px)', 'techguide' ),
				'section'     => 'page_layout',
				'default'     => 1200,
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 960,
					'max'  => 1920,
					'step' => 1,
				),
				'type'        => 'control',
			),
			'sidebar_width' => array(
				'title'   => esc_html__( 'Sidebar width', 'techguide' ),
				'section' => 'page_layout',
				'default' => '1/3',
				'field'   => 'select',
				'choices' => array(
					'1/3' => '1/3',
					'1/4' => '1/4',
				),
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'control',
			),

			/** `Page Preloader` section */
			'page_preloader_section' => array(
				'title'    => esc_html__( 'Page Preloader', 'techguide' ),
				'priority' => 60,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'page_preloader' => array(
				'title'    => esc_html__( 'Show page preloader', 'techguide' ),
				'section'  => 'page_preloader_section',
				'priority' => 10,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			'page_preloader_bg' => array(
				'title'           => esc_html__( 'Preloader Cover Background Color', 'techguide' ),
				'section'         => 'page_preloader_section',
				'default'         => '#ffffff',
				'field'           => 'hex_color',
				'type'            => 'control',
				'active_callback' => 'techguide_is_page_preloader_enable',
			),
			'page_preloader_url' => array(
				'title'           => esc_html__( 'Preloader Image Upload', 'techguide' ),
				'section'         => 'page_preloader_section',
				'field'           => 'image',
				'default'         => '%s/assets/images/preloader-image.png',
				'type'            => 'control',
				'active_callback' => 'techguide_is_page_preloader_enable',
			),
			'page_preloader_url_retina' => array(
				'title'           => esc_html__( 'Preloader Retina Image Upload', 'techguide' ),
				'section'         => 'page_preloader_section',
				'field'           => 'image',
				'default'         => '%s/assets/images/preloader-image-retina.png',
				'type'            => 'control',
				'active_callback' => 'techguide_is_page_preloader_enable',
			),

			/** `Color Scheme` panel */
			'color_scheme' => array(
				'title'       => esc_html__( 'Color Scheme', 'techguide' ),
				'description' => esc_html__( 'Configure Color Scheme', 'techguide' ),
				'priority'    => 40,
				'type'        => 'panel',
			),

			/** `Regular scheme` section */
			'regular_scheme' => array(
				'title'    => esc_html__( 'Regular scheme', 'techguide' ),
				'priority' => 10,
				'panel'    => 'color_scheme',
				'type'     => 'section',
			),
			'regular_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#dd0d82',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_2' => array(
				'title'   => esc_html__( 'Accent color (2)', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#32caff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_text_color' => array(
				'title'   => esc_html__( 'Text color', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#5b5b60',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_color' => array(
				'title'   => esc_html__( 'Link color', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#dd0d82',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#29293a',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h1_color' => array(
				'title'   => esc_html__( 'H1 color', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#29293a',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h2_color' => array(
				'title'   => esc_html__( 'H2 color', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#29293a',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h3_color' => array(
				'title'   => esc_html__( 'H3 color', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#29293a',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h4_color' => array(
				'title'   => esc_html__( 'H4 color', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#29293a',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h5_color' => array(
				'title'   => esc_html__( 'H5 color', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#29293a',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h6_color' => array(
				'title'   => esc_html__( 'H6 color', 'techguide' ),
				'section' => 'regular_scheme',
				'default' => '#29293a',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Additional colors` section */
			'additional_colors' => array(
				'title'    => esc_html__( 'Additional colors', 'techguide' ),
				'priority' => 30,
				'panel'    => 'color_scheme',
				'type'     => 'section',
			),
			'light_color' => array(
				'title'   => esc_html__( 'Light color', 'techguide' ),
				'section' => 'additional_colors',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'grey_color_1' => array(
				'title'   => esc_html__( 'Grey color (1)', 'techguide' ),
				'section' => 'additional_colors',
				'default' => '#c3c3c9',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'dark_color' => array(
				'title'   => esc_html__( 'Dark color', 'techguide' ),
				'section' => 'additional_colors',
				'default' => '#29293a',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Typography Settings` panel */
			'typography' => array(
				'title'       => esc_html__( 'Typography', 'techguide' ),
				'description' => esc_html__( 'Configure typography settings', 'techguide' ),
				'priority'    => 50,
				'type'        => 'panel',
			),

			/** `Logo` section */
			'header_logo_typography' => array(
				'title'    => esc_html__( 'Logo', 'techguide' ),
				'priority' => 5,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'header_logo_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'techguide' ),
				'section' => 'header_logo_typography',
				'default' => 'Roboto, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'header_logo_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'techguide' ),
				'section' => 'header_logo_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
			),
			'header_logo_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'techguide' ),
				'section' => 'header_logo_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
			),
			'header_logo_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'techguide' ),
				'section'     => 'header_logo_typography',
				'default'     => '30',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type'        => 'control',
			),
			'header_logo_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'techguide' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'techguide' ),
				'section'     => 'header_logo_typography',
				'default'     => '1',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type'        => 'control',
			),
			'header_logo_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'techguide' ),
				'section'     => 'header_logo_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => - 1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type'        => 'control',
			),
			'header_logo_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'techguide' ),
				'section' => 'header_logo_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => techguide_get_character_sets(),
				'type'    => 'control',
			),
			'header_logo_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'techguide' ),
				'section' => 'header_logo_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => techguide_get_text_transform(),
				'type'    => 'control',
			),

			/** `Body text` section */
			'body_typography' => array(
				'title'    => esc_html__( 'Body text', 'techguide' ),
				'priority' => 5,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'body_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'techguide' ),
				'section' => 'body_typography',
				'default' => 'Lato, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'body_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'techguide' ),
				'section' => 'body_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
			),
			'body_font_style_italic' => array(
				'title'   => esc_html__( 'Additional Font Style', 'techguide' ),
				'section' => 'body_typography',
				'default' => 'italic',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
				'active_callback' => '__return_false',
			),
			'body_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'techguide' ),
				'section' => 'body_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
			),
			'body_font_weight_bold' => array(
				'title'   => esc_html__( 'Additional Font Weight', 'techguide' ),
				'section' => 'body_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
				'active_callback' => '__return_false',
			),
			'body_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'techguide' ),
				'section'     => 'body_typography',
				'default'     => '14',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type'        => 'control',
			),
			'body_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'techguide' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'techguide' ),
				'section'     => 'body_typography',
				'default'     => '1.71',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type'        => 'control',
			),
			'body_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'techguide' ),
				'section'     => 'body_typography',
				'default'     => '0.02',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => - 1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type'        => 'control',
			),
			'body_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'techguide' ),
				'section' => 'body_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => techguide_get_character_sets(),
				'type'    => 'control',
			),
			'body_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'techguide' ),
				'section' => 'body_typography',
				'default' => 'left',
				'field'   => 'select',
				'choices' => techguide_get_text_aligns(),
				'type'    => 'control',
			),
			'body_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'techguide' ),
				'section' => 'body_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => techguide_get_text_transform(),
				'type'    => 'control',
			),

			/** `H1 Heading` section */
			'h1_typography' => array(
				'title'    => esc_html__( 'H1 Heading', 'techguide' ),
				'priority' => 10,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h1_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'techguide' ),
				'section' => 'h1_typography',
				'default' => 'Teko, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h1_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'techguide' ),
				'section' => 'h1_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
			),
			'h1_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'techguide' ),
				'section' => 'h1_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
			),
			'h1_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'techguide' ),
				'section'     => 'h1_typography',
				'default'     => '44',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type'        => 'control',
			),
			'h1_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'techguide' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'techguide' ),
				'section'     => 'h1_typography',
				'default'     => '1.05',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type'        => 'control',
			),
			'h1_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'techguide' ),
				'section'     => 'h1_typography',
				'default'     => '0.02',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => - 1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type'        => 'control',
			),
			'h1_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'techguide' ),
				'section' => 'h1_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => techguide_get_character_sets(),
				'type'    => 'control',
			),
			'h1_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'techguide' ),
				'section' => 'h1_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => techguide_get_text_aligns(),
				'type'    => 'control',
			),
			'h1_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'techguide' ),
				'section' => 'h1_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => techguide_get_text_transform(),
				'type'    => 'control',
			),

			/** `H2 Heading` section */
			'h2_typography' => array(
				'title'    => esc_html__( 'H2 Heading', 'techguide' ),
				'priority' => 15,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h2_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'techguide' ),
				'section' => 'h2_typography',
				'default' => 'Teko, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h2_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'techguide' ),
				'section' => 'h2_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
			),
			'h2_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'techguide' ),
				'section' => 'h2_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
			),
			'h2_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'techguide' ),
				'section'     => 'h2_typography',
				'default'     => '32',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type'        => 'control',
			),
			'h2_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'techguide' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'techguide' ),
				'section'     => 'h2_typography',
				'default'     => '1.25',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type'        => 'control',
			),
			'h2_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'techguide' ),
				'section'     => 'h2_typography',
				'default'     => '0.02',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => - 1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type'        => 'control',
			),
			'h2_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'techguide' ),
				'section' => 'h2_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => techguide_get_character_sets(),
				'type'    => 'control',
			),
			'h2_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'techguide' ),
				'section' => 'h2_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => techguide_get_text_aligns(),
				'type'    => 'control',
			),
			'h2_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'techguide' ),
				'section' => 'h2_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => techguide_get_text_transform(),
				'type'    => 'control',
			),

			/** `H3 Heading` section */
			'h3_typography' => array(
				'title'    => esc_html__( 'H3 Heading', 'techguide' ),
				'priority' => 20,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h3_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'techguide' ),
				'section' => 'h3_typography',
				'default' => 'Teko, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h3_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'techguide' ),
				'section' => 'h3_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
			),
			'h3_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'techguide' ),
				'section' => 'h3_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
			),
			'h3_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'techguide' ),
				'section'     => 'h3_typography',
				'default'     => '26',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type'        => 'control',
			),
			'h3_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'techguide' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'techguide' ),
				'section'     => 'h3_typography',
				'default'     => '1.15',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type'        => 'control',
			),
			'h3_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'techguide' ),
				'section'     => 'h3_typography',
				'default'     => '0.02',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => - 1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type'        => 'control',
			),
			'h3_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'techguide' ),
				'section' => 'h3_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => techguide_get_character_sets(),
				'type'    => 'control',
			),
			'h3_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'techguide' ),
				'section' => 'h3_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => techguide_get_text_aligns(),
				'type'    => 'control',
			),
			'h3_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'techguide' ),
				'section' => 'h3_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => techguide_get_text_transform(),
				'type'    => 'control',
			),

			/** `H4 Heading` section */
			'h4_typography' => array(
				'title'    => esc_html__( 'H4 Heading', 'techguide' ),
				'priority' => 25,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h4_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'techguide' ),
				'section' => 'h4_typography',
				'default' => 'Teko, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h4_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'techguide' ),
				'section' => 'h4_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
			),
			'h4_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'techguide' ),
				'section' => 'h4_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
			),
			'h4_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'techguide' ),
				'section'     => 'h4_typography',
				'default'     => '22',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type'        => 'control',
			),
			'h4_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'techguide' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'techguide' ),
				'section'     => 'h4_typography',
				'default'     => '1.18',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type'        => 'control',
			),
			'h4_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'techguide' ),
				'section'     => 'h4_typography',
				'default'     => '0.02',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => - 1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type'        => 'control',
			),
			'h4_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'techguide' ),
				'section' => 'h4_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => techguide_get_character_sets(),
				'type'    => 'control',
			),
			'h4_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'techguide' ),
				'section' => 'h4_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => techguide_get_text_aligns(),
				'type'    => 'control',
			),
			'h4_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'techguide' ),
				'section' => 'h4_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => techguide_get_text_transform(),
				'type'    => 'control',
			),

			/** `H5 Heading` section */
			'h5_typography' => array(
				'title'    => esc_html__( 'H5 Heading', 'techguide' ),
				'priority' => 30,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h5_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'techguide' ),
				'section' => 'h5_typography',
				'default' => 'Teko, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h5_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'techguide' ),
				'section' => 'h5_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
			),
			'h5_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'techguide' ),
				'section' => 'h5_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
			),
			'h5_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'techguide' ),
				'section'     => 'h5_typography',
				'default'     => '18',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type'        => 'control',
			),
			'h5_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'techguide' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'techguide' ),
				'section'     => 'h5_typography',
				'default'     => '1.33',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type'        => 'control',
			),
			'h5_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'techguide' ),
				'section'     => 'h5_typography',
				'default'     => '0.14',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => - 1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type'        => 'control',
			),
			'h5_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'techguide' ),
				'section' => 'h5_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => techguide_get_character_sets(),
				'type'    => 'control',
			),
			'h5_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'techguide' ),
				'section' => 'h5_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => techguide_get_text_aligns(),
				'type'    => 'control',
			),
			'h5_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'techguide' ),
				'section' => 'h5_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => techguide_get_text_transform(),
				'type'    => 'control',
			),

			/** `H6 Heading` section */
			'h6_typography' => array(
				'title'    => esc_html__( 'H6 Heading', 'techguide' ),
				'priority' => 35,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h6_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'techguide' ),
				'section' => 'h6_typography',
				'default' => 'Lato, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h6_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'techguide' ),
				'section' => 'h6_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
			),
			'h6_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'techguide' ),
				'section' => 'h6_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
			),
			'h6_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'techguide' ),
				'section'     => 'h6_typography',
				'default'     => '16',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type'        => 'control',
			),
			'h6_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'techguide' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'techguide' ),
				'section'     => 'h6_typography',
				'default'     => '1.5',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type'        => 'control',
			),
			'h6_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'techguide' ),
				'section'     => 'h6_typography',
				'default'     => '0.02',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => - 1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type'        => 'control',
			),
			'h6_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'techguide' ),
				'section' => 'h6_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => techguide_get_character_sets(),
				'type'    => 'control',
			),
			'h6_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'techguide' ),
				'section' => 'h6_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => techguide_get_text_aligns(),
				'type'    => 'control',
			),
			'h6_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'techguide' ),
				'section' => 'h6_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => techguide_get_text_transform(),
				'type'    => 'control',
			),

			/** `Custom Font Style` section */
			'custom_typography' => array(
				'title'       => esc_html__( 'Custom Font Style', 'techguide' ),
				'description' => esc_html__( 'Used in typography of buttons, categories, etc.', 'techguide' ),
				'priority'    => 45,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'custom_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'techguide' ),
				'section' => 'custom_typography',
				'default' => 'Teko, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'custom_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'techguide' ),
				'section' => 'custom_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
			),
			'custom_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'techguide' ),
				'section' => 'custom_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
			),
			'custom_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'techguide' ),
				'section'     => 'custom_typography',
				'default'     => '0.14',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => - 1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type'        => 'control',
			),
			'custom_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'techguide' ),
				'section' => 'custom_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => techguide_get_character_sets(),
				'type'    => 'control',
			),

			/** `Breadcrumbs` section */
			'breadcrumbs_typography' => array(
				'title'    => esc_html__( 'Breadcrumbs', 'techguide' ),
				'priority' => 45,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'breadcrumbs_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'techguide' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'Roboto, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'breadcrumbs_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'techguide' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => techguide_get_font_styles(),
				'type'    => 'control',
			),
			'breadcrumbs_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'techguide' ),
				'section' => 'breadcrumbs_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => techguide_get_font_weight(),
				'type'    => 'control',
			),
			'breadcrumbs_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'techguide' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '12',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type'        => 'control',
			),
			'breadcrumbs_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'techguide' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'techguide' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '1.5',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type'        => 'control',
			),
			'breadcrumbs_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'techguide' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => - 1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type'        => 'control',
			),
			'breadcrumbs_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'techguide' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => techguide_get_character_sets(),
				'type'    => 'control',
			),
			'breadcrumbs_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'techguide' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => techguide_get_text_transform(),
				'type'    => 'control',
			),

			/** `Typography misc` section */
			'misc_styles' => array(
				'title'    => esc_html__( 'Misc', 'techguide' ),
				'priority' => 60,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'word_wrap' => array(
				'title'   => esc_html__( 'Enable Word Wrap', 'techguide' ),
				'section' => 'misc_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Header` panel */
			'header_options' => array(
				'title'    => esc_html__( 'Header', 'techguide' ),
				'priority' => 60,
				'type'     => 'panel',
			),

			/** `Header styles` section */
			'header_styles' => array(
				'title'    => esc_html__( 'Header Styles', 'techguide' ),
				'priority' => 5,
				'panel'    => 'header_options',
				'type'     => 'section',
			),
			'header_bg_transparent' => array(
				'title'   => esc_html__( 'Background Transparent', 'techguide' ),
				'section' => 'header_styles',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_bg_color' => array(
				'title'           => esc_html__( 'Background Color', 'techguide' ),
				'section'         => 'header_styles',
				'field'           => 'hex_color',
				'default'         => '#ffffff',
				'type'            => 'control',
				'active_callback' => 'techguide_is_not_header_bg_transparent',
			),
			'header_bg_image' => array(
				'title'           => esc_html__( 'Background Image', 'techguide' ),
				'section'         => 'header_styles',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'techguide_is_not_header_bg_transparent',
			),
			'header_bg_repeat' => array(
				'title'           => esc_html__( 'Background Repeat', 'techguide' ),
				'section'         => 'header_styles',
				'default'         => 'no-repeat',
				'field'           => 'select',
				'choices'         => techguide_get_bg_repeat(),
				'type'            => 'control',
				'active_callback' => 'techguide_is_not_header_bg_transparent',
			),
			'header_bg_position' => array(
				'title'           => esc_html__( 'Background Position', 'techguide' ),
				'section'         => 'header_styles',
				'default'         => 'center',
				'field'           => 'select',
				'choices'         => techguide_get_bg_position(),
				'type'            => 'control',
				'active_callback' => 'techguide_is_not_header_bg_transparent',
			),
			'header_bg_size' => array(
				'title'           => esc_html__( 'Background Size', 'techguide' ),
				'section'         => 'header_styles',
				'default'         => 'cover',
				'field'           => 'select',
				'choices'         => techguide_get_bg_size(),
				'type'            => 'control',
				'active_callback' => 'techguide_is_not_header_bg_transparent',
			),
			'header_bg_attachment' => array(
				'title'           => esc_html__( 'Background Attachment', 'techguide' ),
				'section'         => 'header_styles',
				'default'         => 'scroll',
				'field'           => 'select',
				'choices'         => techguide_get_bg_attachment(),
				'type'            => 'control',
				'active_callback' => 'techguide_is_not_header_bg_transparent',
			),

			/** `Sidebar` section */
			'sidebar_settings' => array(
				'title'    => esc_html__( 'Sidebar', 'techguide' ),
				'priority' => 105,
				'type'     => 'section',
			),
			'sidebar_position' => array(
				'title'   => esc_html__( 'Sidebar Position', 'techguide' ),
				'section' => 'sidebar_settings',
				'default' => 'one-right-sidebar',
				'field'   => 'select',
				'choices' => array(
					'one-left-sidebar'  => esc_html__( 'Sidebar on left side', 'techguide' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'techguide' ),
					'fullwidth'         => esc_html__( 'No sidebars', 'techguide' ),
				),
				'type'    => 'control',
			),
			'sidebar_position_post' => array(
				'title'   => esc_html__( 'Sidebar Position on Blog Post', 'techguide' ),
				'section' => 'sidebar_settings',
				'default' => 'one-right-sidebar',
				'field'   => 'select',
				'choices' => array(
					'one-left-sidebar'  => esc_html__( 'Sidebar on left side', 'techguide' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'techguide' ),
					'fullwidth'         => esc_html__( 'No sidebars', 'techguide' ),
				),
				'type'    => 'control',
			),
			'sidebar_position_product' => array(
				'title'           => esc_html__( 'Sidebar Position on Single Product', 'techguide' ),
				'section'         => 'sidebar_settings',
				'default'         => 'one-left-sidebar',
				'field'           => 'select',
				'choices'         => array(
					'one-left-sidebar'  => esc_html__( 'Sidebar on left side', 'techguide' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'techguide' ),
					'fullwidth'         => esc_html__( 'No sidebars', 'techguide' ),
				),
				'type'            => 'control',
			),
			'sidebar_sticky' => array(
				'title'   => esc_html__( 'Enable sticky sidebar', 'techguide' ),
				'section' => 'sidebar_settings',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Ads Management` panel */
			'ads_management' => array(
				'title'    => esc_html__( 'Ads Management', 'techguide' ),
				'priority' => 110,
				'type'     => 'section',
			),
			'ads_header' => array(
				'title'             => esc_html__( 'Header', 'techguide' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_home_before_loop' => array(
				'title'             => esc_html__( 'Posts Page Before Loop', 'techguide' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_post_before_content' => array(
				'title'             => esc_html__( 'Post Before Content', 'techguide' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_post_before_comments' => array(
				'title'             => esc_html__( 'Post Before Comments', 'techguide' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => '',
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),

			/** `Footer` panel */
			'footer_options' => array(
				'title'    => esc_html__( 'Footer', 'techguide' ),
				'priority' => 110,
				'type'     => 'panel',
			),

			/** `Footer styles` section */
			'footer_styles' => array(
				'title'    => esc_html__( 'Footer Styles', 'techguide' ),
				'priority' => 5,
				'panel'    => 'footer_options',
				'type'     => 'section',
			),
			'footer_copyright' => array(
				'title'   => esc_html__( 'Copyright text', 'techguide' ),
				'section' => 'footer_styles',
				'default' => techguide_get_default_footer_copyright(),
				'field'   => 'textarea',
				'type'    => 'control',
			),
			'footer_bg' => array(
				'title'   => esc_html__( 'Footer Background color', 'techguide' ),
				'section' => 'footer_styles',
				'default' => '#1c1c21',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'footer_text_color' => array(
				'title'   => esc_html__( 'Footer color', 'techguide' ),
				'section' => 'footer_styles',
				'default' => '#c3c3c9',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Blog Settings` panel */
			'blog_settings' => array(
				'title'    => esc_html__( 'Blog Settings', 'techguide' ),
				'priority' => 115,
				'type'     => 'panel',
			),

			/** `Blog` section */
			'blog' => array(
				'title'    => esc_html__( 'Blog', 'techguide' ),
				'panel'    => 'blog_settings',
				'priority' => 10,
				'type'     => 'section',
			),
			'blog_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'techguide' ),
				'section' => 'blog',
				'default' => 'default',
				'field'   => 'select',
				'choices' => techguide_get_blog_layouts(),
				'type'    => 'control',
			),
			'blog_layout_columns' => array(
				'title'           => esc_html__( 'Columns', 'techguide' ),
				'section'         => 'blog',
				'default'         => '2-cols',
				'field'           => 'select',
				'choices'         => array(
					'2-cols' => esc_html__( '2 columns', 'techguide' ),
					'3-cols' => esc_html__( '3 columns', 'techguide' ),
					'4-cols' => esc_html__( '4 columns', 'techguide' ),
				),
				'type'            => 'control',
				'active_callback' => 'techguide_is_blog_layout_type_grid_masonry',
			),
			'blog_pagination_type' => array(
				'title'   => esc_html__( 'Pagination Type', 'techguide' ),
				'section' => 'blog',
				'default' => 'load-more',
				'field'   => 'select',
				'choices' => array(
					'default'   => esc_html__( 'Default', 'techguide' ),
					'load-more' => esc_html__( 'Load More', 'techguide' ),
				),
				'type'    => 'control',
			),
			'blog_sticky_type' => array(
				'title'   => esc_html__( 'Sticky label type', 'techguide' ),
				'section' => 'blog',
				'default' => 'icon',
				'field'   => 'select',
				'choices' => array(
					'label' => esc_html__( 'Text Label', 'techguide' ),
					'icon'  => esc_html__( 'Font Icon', 'techguide' ),
					'both'  => esc_html__( 'Text with Icon', 'techguide' ),
				),
				'type'    => 'control',
			),
			'blog_sticky_icon' => array(
				'title'           => esc_html__( 'Icon for sticky post', 'techguide' ),
				'section'         => 'blog',
				'field'           => 'iconpicker',
				'default'         => 'fa-star-o',
				'icon_data'       => techguide_get_fa_icons_data(),
				'type'            => 'control',
				'transport'       => 'postMessage',
				'active_callback' => 'techguide_is_sticky_icon',
			),
			'blog_sticky_label' => array(
				'title'           => esc_html__( 'Featured Post Label', 'techguide' ),
				'description'     => esc_html__( 'Label for sticky post', 'techguide' ),
				'section'         => 'blog',
				'default'         => esc_html__( 'Featured', 'techguide' ),
				'field'           => 'text',
				'active_callback' => 'techguide_is_sticky_text',
				'type'            => 'control',
				'transport'       => 'postMessage',
			),
			'blog_posts_content' => array(
				'title'   => esc_html__( 'Post content', 'techguide' ),
				'section' => 'blog',
				'default' => 'excerpt',
				'field'   => 'select',
				'choices' => array(
					'excerpt' => esc_html__( 'Only excerpt', 'techguide' ),
					'full'    => esc_html__( 'Full content', 'techguide' ),
					'none'    => esc_html__( 'Hide', 'techguide' ),
				),
				'type'    => 'control',
			),
			'blog_posts_content_length' => array(
				'title'           => esc_html__( 'Number of words in the excerpt', 'techguide' ),
				'section'         => 'blog',
				'default'         => '30',
				'field'           => 'number',
				'input_attrs'     => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
				'type'            => 'control',
				'active_callback' => 'techguide_is_blog_posts_content_type_excerpt',
			),
			'blog_read_more_btn' => array(
				'title'   => esc_html__( 'Show Read More button', 'techguide' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_read_more_text' => array(
				'title'           => esc_html__( 'Read More button text', 'techguide' ),
				'section'         => 'blog',
				'default'         => esc_html__( 'Read more', 'techguide' ),
				'field'           => 'text',
				'type'            => 'control',
				'transport'       => 'postMessage',
				'active_callback' => 'techguide_is_blog_read_more_btn_enable',
			),
			'blog_post_author' => array(
				'title'   => esc_html__( 'Show post author', 'techguide' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_publish_date' => array(
				'title'   => esc_html__( 'Show publish date', 'techguide' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_categories' => array(
				'title'   => esc_html__( 'Show categories', 'techguide' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_tags'  => array(
				'title'   => esc_html__( 'Show tags', 'techguide' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_comments' => array(
				'title'   => esc_html__( 'Show comments', 'techguide' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_trend_views' => array(
				'title'           => esc_html__( 'Show views counter', 'techguide' ),
				'section'         => 'blog',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'techguide_is_cherry_trending_posts_activated',
			),
			'blog_post_trend_rating' => array(
				'title'           => esc_html__( 'Show rating', 'techguide' ),
				'section'         => 'blog',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'techguide_is_cherry_trending_posts_activated',
			),
			'blog_post_share_buttons' => array(
				'title'           => esc_html__( 'Show social sharing buttons', 'techguide' ),
				'section'         => 'blog',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'techguide_is_cherry_socialize_activated',
			),

			/** `Post` section */
			'blog_post' => array(
				'title'           => esc_html__( 'Post', 'techguide' ),
				'panel'           => 'blog_settings',
				'priority'        => 20,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'single_post_author' => array(
				'title'   => esc_html__( 'Show post author', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_publish_date' => array(
				'title'   => esc_html__( 'Show publish date', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_categories' => array(
				'title'   => esc_html__( 'Show categories', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_tags' => array(
				'title'   => esc_html__( 'Show tags', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_comments' => array(
				'title'   => esc_html__( 'Show comments', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_reading_time' => array(
				'title'   => esc_html__( 'Show reading time', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_trend_views' => array(
				'title'           => esc_html__( 'Show views counter', 'techguide' ),
				'section'         => 'blog_post',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'techguide_is_cherry_trending_posts_activated',
			),
			'single_post_trend_rating' => array(
				'title'           => esc_html__( 'Show rating', 'techguide' ),
				'section'         => 'blog_post',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'techguide_is_cherry_trending_posts_activated',
			),
			'single_post_share_buttons' => array(
				'title'           => esc_html__( 'Show social sharing buttons', 'techguide' ),
				'section'         => 'blog_post',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'techguide_is_cherry_socialize_activated',
			),
			'single_post_sources' => array(
				'title'   => esc_html__( 'Show source', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_via' => array(
				'title'   => esc_html__( 'Show via', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_respond_button' => array(
				'title'   => esc_html__( 'Show the respond button after post content', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_author_block' => array(
				'title'   => esc_html__( 'Show the author block after each post', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_navigation' => array(
				'title'   => esc_html__( 'Show post navigation', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_reading_progress' => array(
				'title'   => esc_html__( 'Show reading progress bar', 'techguide' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Related Posts` section */
			'related_posts' => array(
				'title'           => esc_html__( 'Related posts block', 'techguide' ),
				'panel'           => 'blog_settings',
				'priority'        => 30,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'related_posts_visible' => array(
				'title'   => esc_html__( 'Show related posts block', 'techguide' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'related_posts_block_title' => array(
				'title'           => esc_html__( 'Related posts block title', 'techguide' ),
				'section'         => 'related_posts',
				'default'         => esc_html__( 'Other Posts', 'techguide' ),
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'techguide_is_related_posts_enable',
				'transport'       => 'postMessage',
			),
			'related_posts_query_type' => array(
				'title'           => esc_html__( 'Related posts query type', 'techguide' ),
				'section'         => 'related_posts',
				'default'         => 'post_tag',
				'field'           => 'select',
				'choices'         => array(
					'category' => esc_html__( 'Categories', 'techguide' ),
					'post_tag' => esc_html__( 'Tags', 'techguide' ),
				),
				'type'            => 'control',
				'active_callback' => 'techguide_is_related_posts_enable',
			),
			'related_posts_count' => array(
				'title'           => esc_html__( 'Number of post', 'techguide' ),
				'section'         => 'related_posts',
				'default'         => '8',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'techguide_is_related_posts_enable',
			),
			'related_posts_grid' => array(
				'title'           => esc_html__( 'Layout', 'techguide' ),
				'section'         => 'related_posts',
				'default'         => '2',
				'field'           => 'select',
				'choices'         => array(
					'2' => esc_html__( '2 columns', 'techguide' ),
					'3' => esc_html__( '3 columns', 'techguide' ),
				),
				'type'            => 'control',
				'active_callback' => 'techguide_is_related_posts_enable',
			),
			'related_posts_title_length' => array(
				'title'           => esc_html__( 'Number of words in the title', 'techguide' ),
				'section'         => 'related_posts',
				'default'         => '10',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'techguide_is_related_posts_enable',
			),
			'related_posts_content' => array(
				'title'           => esc_html__( 'Display content', 'techguide' ),
				'section'         => 'related_posts',
				'default'         => 'hide',
				'field'           => 'select',
				'choices'         => array(
					'hide'         => esc_html__( 'Hide', 'techguide' ),
					'post_excerpt' => esc_html__( 'Excerpt', 'techguide' ),
					'post_content' => esc_html__( 'Content', 'techguide' ),
				),
				'type'            => 'control',
				'active_callback' => 'techguide_is_related_posts_enable',
			),
			'related_posts_content_length' => array(
				'title'           => esc_html__( 'Number of words in the content', 'techguide' ),
				'section'         => 'related_posts',
				'default'         => '10',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'techguide_is_related_posts_enable',
			),
			'related_posts_author' => array(
				'title'           => esc_html__( 'Show post author', 'techguide' ),
				'section'         => 'related_posts',
				'default'         => false,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'techguide_is_related_posts_enable',
			),
			'related_posts_publish_date' => array(
				'title'           => esc_html__( 'Show post publish date', 'techguide' ),
				'section'         => 'related_posts',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'techguide_is_related_posts_enable',
			),
			'related_posts_comment_count' => array(
				'title'           => esc_html__( 'Show post comment count', 'techguide' ),
				'section'         => 'related_posts',
				'default'         => false,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'techguide_is_related_posts_enable',
			),

		),
	) );
}

/**
 * Return true if setting is value. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @param  string $setting Setting name to check.
 * @param  string $value   Setting value to compare.
 * @return bool
 */
function techguide_is_setting( $control, $setting, $value ) {

	if ( $value == $control->manager->get_setting( $setting )->value() ) {
		return true;
	}

	return false;
}

/**
 * Return true if value of passed setting is not equal with passed value.
 *
 * @param  object $control Parent control.
 * @param  string $setting Setting name to check.
 * @param  string $value   Setting value to compare.
 * @return bool
 */
function techguide_is_not_setting( $control, $setting, $value ) {

	if ( $value !== $control->manager->get_setting( $setting )->value() ) {
		return true;
	}

	return false;
}

/**
 * Return true if sticky label type set to text or text with icon.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function techguide_is_sticky_text( $control ) {
	return techguide_is_not_setting( $control, 'blog_sticky_type', 'icon' );
}

/**
 * Return true if sticky label type set to icon or text with icon.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function techguide_is_sticky_icon( $control ) {
	return techguide_is_not_setting( $control, 'blog_sticky_type', 'label' );
}

/**
 * Return true if option `Show Related Posts Block` is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function techguide_is_related_posts_enable( $control ) {
	return techguide_is_setting( $control, 'related_posts_visible', true );
}

/**
 * Return true if option `Blog posts content` is excerpt. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function techguide_is_blog_posts_content_type_excerpt( $control ) {
	return techguide_is_setting( $control, 'blog_posts_content', 'excerpt' );
}

/**
 * Return true if option `Show Read More button` is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function techguide_is_blog_read_more_btn_enable( $control ) {
	return techguide_is_setting( $control, 'blog_read_more_btn', true );
}

/**
 * Return true if `Blog layout` selected Grid or Masonry. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function techguide_is_blog_layout_type_grid_masonry( $control ) {
	if ( in_array( $control->manager->get_setting( 'blog_layout_type' )->value(), array( 'grid', 'grid-2', 'masonry' ) ) ) {
		return true;
	}

	return false;
}

/**
 * Return true if option `Show Page Preloader` is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function techguide_is_page_preloader_enable( $control ) {
	return techguide_is_setting( $control, 'page_preloader', true );
}

/**
 * Return true if option `Page type` is boxed or framed. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function techguide_is_page_type_boxed( $control ) {
	if ( in_array( $control->manager->get_setting( 'page_layout_style' )->value(), array( 'boxed', 'framed' ) ) ) {
		return true;
	}

	return false;
}

/**
 * Return true if option `Header Background Transparent` is not enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function techguide_is_not_header_bg_transparent( $control ) {
	return techguide_is_not_setting( $control, 'header_bg_transparent', true );
}

// Change native customizer control (based on WordPress core).
add_action( 'customize_register', 'techguide_customizer_change_core_controls', 20 );

// Bind JS handlers to instantly live-preview changes.
add_action( 'customize_preview_init', 'techguide_customize_preview_js' );

/**
 * Change native customize control (based on WordPress core).
 *
 * @since 1.0.0
 * @param  object $wp_customize Object wp_customize.
 * @return void
 */
function techguide_customizer_change_core_controls( $wp_customize ) {
	$wp_customize->get_control( 'custom_logo' )->section       = 'techguide_logo_favicon';
	$wp_customize->get_control( 'site_icon' )->section         = 'techguide_logo_favicon';
	$wp_customize->get_section( 'background_image' )->priority = 45;
	$wp_customize->get_control( 'background_color' )->label    = esc_html__( 'Body Background Color', 'techguide' );

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function techguide_customize_preview_js() {
	wp_enqueue_script( 'techguide-customize-preview', get_parent_theme_file_uri( 'assets/js/customize-preview.js' ), array( 'customize-preview' ), TECHGUIDE_THEME_VERSION, true );
}

// Typography utility function
/**
 * Get font styles
 *
 * @since 1.0.0
 * @return array
 */
function techguide_get_font_styles() {
	return apply_filters( 'techguide_get_font_styles', array(
		'normal'  => esc_html__( 'Normal', 'techguide' ),
		'italic'  => esc_html__( 'Italic', 'techguide' ),
		'oblique' => esc_html__( 'Oblique', 'techguide' ),
		'inherit' => esc_html__( 'Inherit', 'techguide' ),
	) );
}

/**
 * Get character sets
 *
 * @since 1.0.0
 * @return array
 */
function techguide_get_character_sets() {
	return apply_filters( 'techguide_get_character_sets', array(
		'latin'        => esc_html__( 'Latin', 'techguide' ),
		'greek'        => esc_html__( 'Greek', 'techguide' ),
		'greek-ext'    => esc_html__( 'Greek Extended', 'techguide' ),
		'vietnamese'   => esc_html__( 'Vietnamese', 'techguide' ),
		'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'techguide' ),
		'latin-ext'    => esc_html__( 'Latin Extended', 'techguide' ),
		'cyrillic'     => esc_html__( 'Cyrillic', 'techguide' ),
	) );
}

/**
 * Get text aligns
 *
 * @since 1.0.0
 * @return array
 */
function techguide_get_text_aligns() {
	return apply_filters( 'techguide_get_text_aligns', array(
		'inherit' => esc_html__( 'Inherit', 'techguide' ),
		'center'  => esc_html__( 'Center', 'techguide' ),
		'justify' => esc_html__( 'Justify', 'techguide' ),
		'left'    => esc_html__( 'Left', 'techguide' ),
		'right'   => esc_html__( 'Right', 'techguide' ),
	) );
}

/**
 * Get font weights
 *
 * @since 1.0.0
 * @return array
 */
function techguide_get_font_weight() {
	return apply_filters( 'techguide_get_font_weight', array(
		'100' => '100',
		'200' => '200',
		'300' => '300',
		'400' => '400',
		'500' => '500',
		'600' => '600',
		'700' => '700',
		'800' => '800',
		'900' => '900',
	) );
}

/**
 * Get tesx transform.
 *
 * @since 1.0.0
 * @return array
 */
function techguide_get_text_transform() {
	return apply_filters( 'techguide_get_text_transform', array(
		'none'       => esc_html__( 'None ', 'techguide' ),
		'uppercase'  => esc_html__( 'Uppercase ', 'techguide' ),
		'lowercase'  => esc_html__( 'Lowercase', 'techguide' ),
		'capitalize' => esc_html__( 'Capitalize', 'techguide' ),
	) );
}

// Background utility function
/**
 * Get background position
 *
 * @since 1.0.0
 * @return array
 */
function techguide_get_bg_position() {
	return apply_filters( 'techguide_get_bg_position', array(
		'top-left'      => esc_html__( 'Top Left', 'techguide' ),
		'top-center'    => esc_html__( 'Top Center', 'techguide' ),
		'top-right'     => esc_html__( 'Top Right', 'techguide' ),
		'center-left'   => esc_html__( 'Middle Left', 'techguide' ),
		'center'        => esc_html__( 'Middle Center', 'techguide' ),
		'center-right'  => esc_html__( 'Middle Right', 'techguide' ),
		'bottom-left'   => esc_html__( 'Bottom Left', 'techguide' ),
		'bottom-center' => esc_html__( 'Bottom Center', 'techguide' ),
		'bottom-right'  => esc_html__( 'Bottom Right', 'techguide' ),
	) );
}

/**
 * Get background size
 *
 * @since 1.0.0
 * @return array
 */
function techguide_get_bg_size() {
	return apply_filters( 'techguide_get_bg_size', array(
		'auto'    => esc_html__( 'Auto', 'techguide' ),
		'cover'   => esc_html__( 'Cover', 'techguide' ),
		'contain' => esc_html__( 'Contain', 'techguide' ),
	) );
}

/**
 * Get background repeat
 *
 * @since 1.0.0
 * @return array
 */
function techguide_get_bg_repeat() {
	return apply_filters( 'techguide_get_bg_repeat', array(
		'no-repeat' => esc_html__( 'No Repeat', 'techguide' ),
		'repeat'    => esc_html__( 'Tile', 'techguide' ),
		'repeat-x'  => esc_html__( 'Tile Horizontally', 'techguide' ),
		'repeat-y'  => esc_html__( 'Tile Vertically', 'techguide' ),
	) );
}

/**
 * Get background attachment
 *
 * @since 1.0.0
 * @return array
 */
function techguide_get_bg_attachment() {
	return apply_filters( 'techguide_get_bg_attachment', array(
		'scroll' => esc_html__( 'Scroll', 'techguide' ),
		'fixed'  => esc_html__( 'Fixed', 'techguide' ),
	) );
}

/**
 * Return array of arguments for dynamic CSS module
 *
 * @return array
 */
function techguide_get_dynamic_css_options() {
	return apply_filters( 'techguide_get_dynamic_css_options', array(
		'prefix'        => 'techguide',
		'type'          => 'theme_mod',
		'parent_handle' => 'techguide-theme-style',
		'single'        => true,
		'css_files'     => array(
			techguide_get_locate_template( 'assets/css/dynamic/dynamic.css' ),

			techguide_get_locate_template( 'assets/css/dynamic/site/elements.css' ),
			techguide_get_locate_template( 'assets/css/dynamic/site/header.css' ),
			techguide_get_locate_template( 'assets/css/dynamic/site/forms.css' ),
			techguide_get_locate_template( 'assets/css/dynamic/site/menus.css' ),
			techguide_get_locate_template( 'assets/css/dynamic/site/post.css' ),
			techguide_get_locate_template( 'assets/css/dynamic/site/navigation.css' ),
			techguide_get_locate_template( 'assets/css/dynamic/site/footer.css' ),
			techguide_get_locate_template( 'assets/css/dynamic/site/misc.css' ),
			techguide_get_locate_template( 'assets/css/dynamic/site/buttons.css' ),

			techguide_get_locate_template( 'assets/css/dynamic/widgets/widget-default.css' ),
		),
		'options' => array(
			'header_logo_font_style',
			'header_logo_font_weight',
			'header_logo_font_size',
			'header_logo_line_height',
			'header_logo_font_family',
			'header_logo_letter_spacing',
			'header_logo_text_transform',

			'body_font_style',
			'body_font_weight',
			'body_font_size',
			'body_line_height',
			'body_font_family',
			'body_letter_spacing',
			'body_text_align',
			'body_text_transform',

			'h1_font_style',
			'h1_font_weight',
			'h1_font_size',
			'h1_line_height',
			'h1_font_family',
			'h1_letter_spacing',
			'h1_text_align',
			'h1_text_transform',

			'h2_font_style',
			'h2_font_weight',
			'h2_font_size',
			'h2_line_height',
			'h2_font_family',
			'h2_letter_spacing',
			'h2_text_align',
			'h2_text_transform',

			'h3_font_style',
			'h3_font_weight',
			'h3_font_size',
			'h3_line_height',
			'h3_font_family',
			'h3_letter_spacing',
			'h3_text_align',
			'h3_text_transform',

			'h4_font_style',
			'h4_font_weight',
			'h4_font_size',
			'h4_line_height',
			'h4_font_family',
			'h4_letter_spacing',
			'h4_text_align',
			'h4_text_transform',

			'h5_font_style',
			'h5_font_weight',
			'h5_font_size',
			'h5_line_height',
			'h5_font_family',
			'h5_letter_spacing',
			'h5_text_align',
			'h5_text_transform',

			'h6_font_style',
			'h6_font_weight',
			'h6_font_size',
			'h6_line_height',
			'h6_font_family',
			'h6_letter_spacing',
			'h6_text_align',
			'h6_text_transform',

			'breadcrumbs_font_style',
			'breadcrumbs_font_weight',
			'breadcrumbs_font_size',
			'breadcrumbs_line_height',
			'breadcrumbs_font_family',
			'breadcrumbs_letter_spacing',
			'breadcrumbs_text_transform',

			'custom_font_style',
			'custom_font_weight',
			'custom_font_family',
			'custom_letter_spacing',

			'regular_accent_color_1',
			'regular_accent_color_2',
			'regular_text_color',
			'regular_link_color',
			'regular_link_hover_color',
			'regular_h1_color',
			'regular_h2_color',
			'regular_h3_color',
			'regular_h4_color',
			'regular_h5_color',
			'regular_h6_color',

			'light_color',
			'grey_color_1',
			'dark_color',

			'header_bg_color',
			'header_bg_image',
			'header_bg_repeat',
			'header_bg_position',
			'header_bg_attachment',
			'header_bg_size',

			'page_preloader_bg',

			'page_boxed_width',
			'page_boxed_bg_color',

			'container_width',

			'footer_bg',
			'footer_text_color',

			'onsale_badge_bg',
			'featured_badge_bg',
			'new_badge_bg',
		),
	) );
}

// Add dynamic css plugins files.
add_filter( 'techguide_get_dynamic_css_options', 'techguide_add_dynamic_css_plugins_files' );

/**
 * Add third party plugins dynamic css files.
 *
 * @param array $args Dynamic css arguments.
 *
 * @return array
 */
function techguide_add_dynamic_css_plugins_files( $args= array() ) {

	$plugins_config = array(

		'elementor' => array(
			'dynamic_css_file' => 'assets/css/dynamic/plugins/elementor.css',
			'conditional'      => array(
				'cb'  => 'class_exists',
				'arg' => 'Elementor\Plugin',
			),
		),
		'cherry-trending-posts' => array(
			'dynamic_css_file' => 'assets/css/dynamic/plugins/cherry-trending-posts.css',
			'conditional'      => array(
				'cb'  => 'class_exists',
				'arg' => 'Cherry_Trending_Posts',
			),
		),
		'cherry-socialize' => array(
			'dynamic_css_file' => 'assets/css/dynamic/plugins/cherry-socialize.css',
			'conditional'      => array(
				'cb'  => 'class_exists',
				'arg' => 'Cherry_Socialize',
			),
		),
		'cherry-popups' => array(
			'dynamic_css_file' => 'assets/css/dynamic/plugins/cherry-popups.css',
			'conditional'      => array(
				'cb'  => 'class_exists',
				'arg' => 'Cherry_Popups',
			),
		),
	);

	foreach ( $plugins_config as $plugin ) {

		if ( is_callable( $plugin['conditional']['cb'] )
		     && true === call_user_func( $plugin['conditional']['cb'], $plugin['conditional']['arg'] )
		) {
			$args['css_files'][] = techguide_get_locate_template( $plugin['dynamic_css_file'] );
		}
	}

	return $args;
}

/**
 * Return array of arguments for Google Font loader module.
 *
 * @since  1.0.0
 * @return array
 */
function techguide_get_fonts_options() {
	return apply_filters( 'techguide_get_fonts_options', array(
		'prefix'  => 'techguide',
		'type'    => 'theme_mod',
		'single'  => true,
		'options' => array(
			'body' => array(
				'family'  => 'body_font_family',
				'style'   => 'body_font_style',
				'weight'  => 'body_font_weight',
				'charset' => 'body_character_set',
			),
			'body_italic' => array(
				'family'  => 'body_font_family',
				'style'   => 'body_font_style_italic',
				'weight'  => 'body_font_weight',
				'charset' => 'body_character_set',
			),
			'body_bold' => array(
				'family'  => 'body_font_family',
				'style'   => 'body_font_style',
				'weight'  => 'body_font_weight_bold',
				'charset' => 'body_character_set',
			),
			'body_bold_italic' => array(
				'family'  => 'body_font_family',
				'style'   => 'body_font_style_italic',
				'weight'  => 'body_font_weight_bold',
				'charset' => 'body_character_set',
			),
			'h1' => array(
				'family'  => 'h1_font_family',
				'style'   => 'h1_font_style',
				'weight'  => 'h1_font_weight',
				'charset' => 'h1_character_set',
			),
			'h2' => array(
				'family'  => 'h2_font_family',
				'style'   => 'h2_font_style',
				'weight'  => 'h2_font_weight',
				'charset' => 'h2_character_set',
			),
			'h3' => array(
				'family'  => 'h3_font_family',
				'style'   => 'h3_font_style',
				'weight'  => 'h3_font_weight',
				'charset' => 'h3_character_set',
			),
			'h4' => array(
				'family'  => 'h4_font_family',
				'style'   => 'h4_font_style',
				'weight'  => 'h4_font_weight',
				'charset' => 'h4_character_set',
			),
			'h5' => array(
				'family'  => 'h5_font_family',
				'style'   => 'h5_font_style',
				'weight'  => 'h5_font_weight',
				'charset' => 'h5_character_set',
			),
			'h6' => array(
				'family'  => 'h6_font_family',
				'style'   => 'h6_font_style',
				'weight'  => 'h6_font_weight',
				'charset' => 'h6_character_set',
			),
			'header_logo' => array(
				'family'  => 'header_logo_font_family',
				'style'   => 'header_logo_font_style',
				'weight'  => 'header_logo_font_weight',
				'charset' => 'header_logo_character_set',
			),
			'custom' => array(
				'family'  => 'custom_font_family',
				'style'   => 'custom_font_style',
				'weight'  => 'custom_font_weight',
				'charset' => 'custom_character_set',
			),
			'breadcrumbs' => array(
				'family'  => 'breadcrumbs_font_family',
				'style'   => 'breadcrumbs_font_style',
				'weight'  => 'breadcrumbs_font_weight',
				'charset' => 'breadcrumbs_character_set',
			),
		),
	) );
}

/**
 * Get blog layouts.
 *
 * @since  1.0.0
 * @return array
 */
function techguide_get_blog_layouts() {
	return apply_filters( 'techguide_get_blog_layouts', array(
		'default'           => esc_html__( 'Listing 1', 'techguide' ),
		'default-small-img' => esc_html__( 'Listing 2', 'techguide' ),
		'grid'              => esc_html__( 'Grid 1', 'techguide' ),
		'grid-2'            => esc_html__( 'Grid 2', 'techguide' ),
		'masonry'           => esc_html__( 'Masonry', 'techguide' ),
		'vertical-justify'  => esc_html__( 'Vertical Justify', 'techguide' ),
		'timeline'          => esc_html__( 'Timeline', 'techguide' ),
	) );
}

/**
 * Get default footer copyright.
 *
 * @since  1.0.0
 * @return string
 */
function techguide_get_default_footer_copyright() {
	return esc_html__( '&copy; Copyright %%year%%. TEST.', 'techguide' );
}

/**
 * Get FontAwesome icons set
 *
 * @return array
 */
function techguide_get_icons_set() {

	static $font_icons;

	if ( ! $font_icons ) {

		ob_start();

		include get_parent_theme_file_path( 'assets/js/icons.json' );
		$json = ob_get_clean();

		$font_icons = array();
		$icons      = json_decode( $json, true );

		foreach ( $icons['icons'] as $icon ) {
			$font_icons[] = $icon['id'];
		}
	}

	return $font_icons;
}

function techguide_get_fa_icons_data() {
	return apply_filters( 'techguide_get_fa_icons_data', array(
		'icon_set'    => 'techguideFontAwesome',
		'icon_css'    => get_parent_theme_file_uri( 'assets/css/font-awesome.min.css' ),
		'icon_base'   => 'fa',
		'icon_prefix' => 'fa-',
		'icons'       => techguide_get_icons_set(),
	) );
}

/**
 * Get mdi icons set.
 *
 * @return array
 */
function techguide_get_mdi_icons_set() {

	static $mdi_icons;

	if ( ! $mdi_icons ) {
		ob_start();

		include get_parent_theme_file_path( 'assets/css/materialdesignicons.min.css' );

		$result = ob_get_clean();

		preg_match_all( '/\.([-_a-zA-Z0-9]+):before[, {]content:/', $result, $matches );

		if ( ! is_array( $matches ) || empty( $matches[1] ) ) {
			return;
		}

		$mdi_icons = $matches[1];
	}

	return $mdi_icons;
}

/**
 * Return sanitized theme mod value.
 *
 * @param  string       $mod               Mod name to get.
 * @param  bool         $use_default       Use or not default value.
 * @param  string|array $sanitize_callback Sanitize callback name.
 * @return mixed
 */
function techguide_get_mod( $mod = null, $use_default = true, $sanitize_callback = null ) {

	if ( ! $mod ) {
		return false;
	}

	$default = false;

	if ( true === $use_default ) {
		$default = techguide_theme()->customizer->get_default( $mod );
	}

	$value = get_theme_mod( $mod, $default );

	if ( is_callable( $sanitize_callback ) ) {
		return call_user_func( $sanitize_callback, $value );
	} else {
		return $value;
	}
}
