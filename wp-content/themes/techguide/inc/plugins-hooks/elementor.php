<?php
/**
 * Elementor hooks.
 *
 * @package Techguide
 */

// Set theme icon.
add_action( 'elementor/controls/controls_registered', 'techguide_add_theme_icons_to_icon_control', 20 );
add_action( 'elementor/editor/after_enqueue_styles', 'techguide_enqueue_icon_font' );

// Modify theme mods into elementor library page.
add_filter( 'theme_mod_sidebar_position', 'techguide_elementor_library_sidebar_position' );
add_filter( 'theme_mod_page_layout_style', 'techguide_elementor_library_page_layout_style' );

// Modify wp widget arguments.
add_filter( 'elementor/widgets/wordpress/widget_args', 'techguide_modify_elementor_wp_widget_args', 10, 2 );

// Modify jet-blog available prev arrows.
add_filter( 'jet-blog/carousel/available-arrows/prev', 'techguide_modify_jet_blog_available_prev_arrows' );

// Modify jet-blog available next arrows.
add_filter( 'jet-blog/carousel/available-arrows/next', 'techguide_modify_jet_blog_available_next_arrows' );

// Modify post-title html format in smart-listing widget.
add_filter( 'jet-blog/smart-listing/post-title-format', 'techguide_modify_smart_listing_post_title_format', 10, 2 );

// Modify meta controls in smart-listing widget.
add_action( 'elementor/element/jet-blog-smart-listing/section_featured_meta_style/before_section_end', 'techguide_modify_smart_listing_featured_meta_controls', 10, 2 );
add_action( 'elementor/element/jet-blog-smart-listing/section_meta_style/before_section_end', 'techguide_modify_smart_listing_meta_controls', 10, 2 );
add_action( 'elementor/element/jet-blog-smart-listing/section_post_style/before_section_end', 'techguide_modify_smart_listing_post_content_styles', 10, 2 );
add_action( 'elementor/element/jet-blog-smart-listing/section_featured_style/before_section_end', 'techguide_modify_smart_listing_featured_post_content_styles', 10, 2 );

// Modify meta controls in smart-tiles widget.
add_action( 'elementor/element/jet-blog-smart-tiles/section_meta_style/before_section_end', 'techguide_modify_smart_tiles_meta_controls', 10, 2 );

// Modify jet-tabs controls.
add_action( 'elementor/element/jet-tabs/section_tabs_control_style/before_section_end', 'techguide_modify_jet_tabs_controls', 10, 2 );

// Modify icon-color control to social-icons widget.
add_action( 'elementor/element/social-icons/section_social_style/before_section_end', 'techguide_modify_social_icon_color_control', 10, 2 );

/**
 * Add theme icons to the icon control.
 *
 * @param object $controls_manager Object Controls manager.
 */
function techguide_add_theme_icons_to_icon_control( $controls_manager ) {
	$default_icons = $controls_manager->get_control( 'icon' )->get_settings( 'options' );

	$mdi_icons_data = array(
		'icons'  => techguide_get_mdi_icons_set(),
		'format' => 'mdi %s',
	);

	$mdi_icons_array = array();

	foreach ( $mdi_icons_data['icons'] as $icon ) {
		$key = sprintf( $mdi_icons_data['format'], $icon );

		$mdi_icons_array[ $key ] = $icon;
	}

	$new_icons = array_merge( $default_icons, $mdi_icons_array );

	$controls_manager->get_control( 'icon' )->set_settings( 'options', $new_icons );
}

/**
 * Enqueue icon font.
 */
function techguide_enqueue_icon_font() {
	wp_enqueue_style( 'material-design-icons', get_parent_theme_file_uri( 'assets/css/materialdesignicons.min.css' ), array(), '2.1.19' );
}

/**
 * Modify sidebar position into elementor library page.
 *
 * @param string $value Sidebar position.
 *
 * @return string
 */
function techguide_elementor_library_sidebar_position( $value ) {

	if ( is_singular( 'elementor_library' ) ) {
		return 'fullwidth';
	}

	return $value;
}

/**
 * Modify page layout style into elementor library page.
 *
 * @param string $value Page layout style.
 *
 * @return string
 */
function techguide_elementor_library_page_layout_style( $value ) {

	if ( is_singular( 'elementor_library' ) ) {
		return 'fullwidth';
	}

	return $value;
}

/**
 * Modify wp widget arguments.
 *
 * @param array  $widget_args Widgets arguments.
 * @param object $widget      Elementor widget instance.
 *
 * @return array
 */
function techguide_modify_elementor_wp_widget_args( $widget_args, $widget ) {

	$instance       = $widget->get_widget_instance();
	$uniq_widget_id = sprintf( '%1$s-%2$s', $widget->get_name(), $widget->get_id() );

	$widget_args['widget_id']     = $uniq_widget_id;
	$widget_args['before_widget'] = sprintf( '<aside id="%1$s" class="widget elementor-wp-widget %2$s">', $uniq_widget_id, $instance->widget_options['classname'] );
	$widget_args['after_widget']  = '</aside>';
	$widget_args['before_title']  = '<h4 class="widget-title">';
	$widget_args['after_title']   = '</h4>';

	return $widget_args;
}

/**
 * Modify jet-blog available prev arrows.
 *
 * @param array $prev_list Available prev arrows.
 *
 * @return array
 */
function techguide_modify_jet_blog_available_prev_arrows( $prev_list = array() ) {

	$prev_list['mdi mdi-arrow-left'] = esc_html__( 'Material Arrow', 'techguide' );

	return $prev_list;
}

/**
 * Modify jet-blog available next arrows.
 *
 * @param array $next_list Available next arrows.
 *
 * @return array
 */
function techguide_modify_jet_blog_available_next_arrows( $next_list = array() ) {

	$next_list['mdi mdi-arrow-right'] = esc_html__( 'Material Arrow', 'techguide' );

	return $next_list;
}

/**
 * Modify post-title html format in smart-listing widget.
 *
 * @param string $format  Post Title html format.
 * @param string $context Context.
 *
 * @return string
 */
function techguide_modify_smart_listing_post_title_format( $format, $context ) {

	if ( 'featured' === $context ) {
		$format = '<h5 class="jet-smart-listing__post-title post-title-%2$s">%1$s</h5>';
	} else {
		$format = '<h6 class="jet-smart-listing__post-title post-title-%2$s">%1$s</h6>';
	}

	return $format;
}

/**
 * Modify featured post meta controls in smart-listing widget.
 *
 * @param object $widget Widget instance.
 * @param array  $args   Widget arguments.
 */
function techguide_modify_smart_listing_featured_meta_controls( $widget = null, $args = array() ) {

	$widget->add_control(
		'featured_meta_icon_color',
		array(
			'label'     => esc_html__( 'Meta Icon Color', 'techguide' ),
			'type'      => Elementor\Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-listing__featured .jet-smart-listing__meta-item .jet-smart-listing__meta-icon' => 'color: {{VALUE}};',
			),
		),
		array(
			'position' => array(
				'of' => 'featured_meta_icon_gap',
			)
		)
	);

	$widget->update_control(
		'featured_meta_divider',
		array(
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-listing__featured .jet-smart-listing__meta-item:not(:last-child):after' => 'content: "{{VALUE}}";',
			),
		)
	);

	$widget->update_responsive_control(
		'featured_meta_divider_gap',
		array(
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-listing__featured .jet-smart-listing__meta-item:not(:last-child):after' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
			),
		)
	);
}

/**
 * Modify post meta controls in smart-listing widget.
 *
 * @param object $widget Widget instance.
 * @param array  $args   Widget arguments.
 */
function techguide_modify_smart_listing_meta_controls( $widget = null, $args = array() ) {

	$widget->add_control(
		'meta_icon_color',
		array(
			'label'     => esc_html__( 'Meta Icon Color', 'techguide' ),
			'type'      => Elementor\Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-listing__post .jet-smart-listing__meta-item .jet-smart-listing__meta-icon' => 'color: {{VALUE}};',
			),
		),
		array(
			'position' => array(
				'of' => 'meta_icon_gap',
			)
		)
	);

	$widget->update_control(
		'meta_divider',
		array(
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-listing__post .jet-smart-listing__meta-item:not(:last-child):after' => 'content: "{{VALUE}}";',
			),
		)
	);

	$widget->update_responsive_control(
		'meta_divider_gap',
		array(
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-listing__post .jet-smart-listing__meta-item:not(:last-child):after' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
			),
		)
	);
}

/**
 * Modify meta controls in smart-tiles widget.
 *
 * @param object $widget Widget instance.
 * @param array  $args   Widget arguments.
 */
function techguide_modify_smart_tiles_meta_controls( $widget = null, $args = array() ) {
	$widget->update_control(
		'meta_divider',
		array(
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-tiles__meta-item:not(:last-child):after' => 'content: "{{VALUE}}";',
			),
		)
	);

	$widget->update_control(
		'meta_divider_gap',
		array(
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-tiles__meta-item:not(:last-child):after' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
			),
		)
	);
}


/**
 * Modify post inner content controls in smart-listing widget.
 *
 * @param object $widget Widget instance.
 * @param array  $args   Widget arguments.
 */
function techguide_modify_smart_listing_post_content_styles( $widget = null, $args = array() ) {
	$widget->add_control(
		'post_content_title',
		array(
			'label'     => esc_html__( 'Inner Content Options', 'techguide' ),
			'type'      => Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		)
	);

	$widget->add_control(
		'post_content_background',
		array(
			'label'     => esc_html__( 'Background', 'techguide' ),
			'type'      => Elementor\Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-listing__post .jet-smart-listing__post-content' => 'background-color: {{VALUE}};',
			),
		)
	);

	$widget->add_responsive_control(
		'post_content_padding',
		array(
			'label'      => esc_html__( 'Padding', 'techguide' ),
			'type'       => Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => array( 'px', '%', 'em' ),
			'selectors'  => array(
				'{{WRAPPER}} .jet-smart-listing__post .jet-smart-listing__post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			)
		)
	);

	$widget->add_control(
		'post_content_border_type',
		array(
			'label'      => esc_html__( 'Border Type', 'techguide' ),
			'type'       => Elementor\Controls_Manager::SELECT,
			'options' => array(
				''       => __( 'None', 'techguide' ),
				'solid'  => _x( 'Solid', 'Border Control', 'techguide' ),
				'double' => _x( 'Double', 'Border Control', 'techguide' ),
				'dotted' => _x( 'Dotted', 'Border Control', 'techguide' ),
				'dashed' => _x( 'Dashed', 'Border Control', 'techguide' ),
			),
			'selectors'  => array(
				'{{WRAPPER}} .jet-smart-listing__post .jet-smart-listing__post-content' => 'border-style: {{VALUE}};',
			)
		)
	);

	$widget->add_control(
		'post_content_border_width',
		array(
			'label'     => esc_html__( 'Width', 'techguide' ),
			'type'      => Elementor\Controls_Manager::DIMENSIONS,
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-listing__post .jet-smart-listing__post-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			),
			'condition' => array(
				'post_content_border_type!' => '',
			),
		)
	);

	$widget->add_control(
		'post_content_border_color',
		array(
			'label'     => esc_html__( 'Color', 'techguide' ),
			'type'      => Elementor\Controls_Manager::COLOR,
			'default' => '',
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-listing__post .jet-smart-listing__post-content' => 'border-color: {{VALUE}};',
			),
			'condition' => array(
				'post_content_border_type!' => '',
			),
		)
	);
}

/**
 * Modify featured post inner content controls in smart-listing widget.
 *
 * @param object $widget Widget instance.
 * @param array  $args   Widget arguments.
 */
function techguide_modify_smart_listing_featured_post_content_styles( $widget = null, $args = array() ) {
	$widget->add_control(
		'featured_post_content_title',
		array(
			'label'     => esc_html__( 'Inner Content Options', 'techguide' ),
			'type'      => Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		)
	);

	$widget->add_control(
		'featured_post_content_background',
		array(
			'label'     => esc_html__( 'Background', 'techguide' ),
			'type'      => Elementor\Controls_Manager::COLOR,
			'selectors' => array(
				'{{WRAPPER}} .jet-smart-listing__featured .jet-smart-listing__featured-content' => 'background-color: {{VALUE}};',
			),
		)
	);

	$widget->add_responsive_control(
		'featured_post_content_padding',
		array(
			'label'      => esc_html__( 'Padding', 'techguide' ),
			'type'       => Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => array( 'px', '%', 'em' ),
			'selectors'  => array(
				'{{WRAPPER}} .jet-smart-listing__featured .jet-smart-listing__featured-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			)
		)
	);
}

/**
 * Modify jet-tabs controls.
 *
 * @param object $widget Widget instance.
 * @param array  $args   Widget arguments.
 */
function techguide_modify_jet_tabs_controls( $widget = null, $args = array() ) {
	$widget->update_responsive_control(
		'tabs_controls_aligment',
		array(
			'options' => array(
				'flex-start'    => array(
					'title' => esc_html__( 'Left', 'techguide' ),
					'icon'  => 'fa fa-arrow-left',
				),
				'center' => array(
					'title' => esc_html__( 'Center', 'techguide' ),
					'icon'  => 'fa fa-align-center',
				),
				'stretch' => array(
					'title' => esc_html__( 'Stretch', 'techguide' ),
					'icon'  => 'fa fa-align-justify',
				),
				'flex-end' => array(
					'title' => esc_html__( 'Right', 'techguide' ),
					'icon'  => 'fa fa-arrow-right',
				),
			),
			'prefix_class' => 'jet-tabs-controls%s-align-',
		)
	);
}

/**
 * Modify icon-color control to social-icons widget.
 *
 * @param object $widget Widget instance.
 * @param array  $args   Widget arguments.
 */
function techguide_modify_social_icon_color_control( $widget, $args ) {
	$widget->update_control(
		'icon_color',
		array(
			'options' => array(
				'default'  => esc_html__( 'Official Color', 'techguide' ),
				'official' => esc_html__( 'Official Color 2', 'techguide' ),
				'custom'   => esc_html__( 'Custom', 'techguide' ),
			),
			'prefix_class' => 'elementor-social-icons-color-',
		)
	);

	$widget->add_responsive_control(
		'icon_bottom_spacing',
		array(
			'label' => esc_html__( 'Bottom Spacing', 'techguide' ),
			'type'  => Elementor\Controls_Manager::SLIDER,
			'range' => array(
				'px' => array(
					'min' => 0,
					'max' => 100,
				),
			),
			'selectors' => array(
				'{{WRAPPER}} .elementor-social-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			),
		),
		array(
			'position' => array(
				'of' => 'icon_spacing_mobile',
			)
		)
	);
}
