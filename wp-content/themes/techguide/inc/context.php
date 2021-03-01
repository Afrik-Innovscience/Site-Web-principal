<?php
/**
 * Contextual functions for the header, footer, content and sidebar classes.
 *
 * @package Techguide
 */

/**
 * Contain utility module from Cherry framework
 *
 * @since  1.0.0
 * @return object
 */
function techguide_utility() {
	return techguide_theme()->get_core()->modules['cherry-utility'];
}

/**
 * Prints site CSS classes.
 *
 * @since  1.0.0
 * @param  array $classes Additional classes.
 * @return void
 */
function techguide_site_class( $classes = array() ) {
	$layout_style = techguide_get_mod( 'page_layout_style' );

	$classes[] = 'site';
	$classes[] = 'site--layout-' . sanitize_html_class( $layout_style );

	echo 'class="' . join( ' ', $classes ) . '"';
}

/**
 * Prints site header container CSS classes
 *
 * @since   1.0.0
 * @param   array $classes Additional classes.
 * @return  void
 */
function techguide_header_container_class( $classes = array() ) {
	$classes[] = 'header-container';

	if ( techguide_get_mod( 'header_bg_transparent' ) ) {
		$classes[] = 'header-container--transparent';
	}

	echo 'class="' . join( ' ', $classes ) . '"';
}

/**
 * Prints site content CSS classes.
 *
 * @since  1.0.0
 * @param  array $classes Additional classes.
 * @return void
 */
function techguide_content_class( $classes = array() ) {
	$classes[] = 'site-content';

	echo 'class="' . join( ' ', $classes ) . '"';
}

/**
 * Prints site content wrap CSS classes.
 *
 * @since  1.0.0
 * @param  array $classes Additional classes.
 * @return void
 */
function techguide_content_wrap_class( $classes = array() ) {
	$classes[] = 'site-content__wrap';

	echo techguide_get_container_classes( $classes, 'content' );
}

/**
 * Retrieve a CSS class attribute for container option.
 *
 * @since  1.0.0
 * @param  array  $classes Additional classes.
 * @param  string $target
 * @return string
 */
function techguide_get_container_classes( $classes, $target = 'content' ) {
	$layout_map = apply_filters( 'techguide_layout_container_map', array(
		'content' => 'boxed',
	) );

	if ( isset( $layout_map[ $target ] ) ) {
		if ( 'boxed' == $layout_map[ $target ] ) {
			$classes[] = 'container';
		} else {
			$classes[] = 'container-fluid';
		}
	}

	return 'class="' . join( ' ', $classes ) . '"';
}

/**
 * Prints primary content wrapper CSS classes.
 *
 * @since  1.0.0
 * @param  array $classes Additional classes.
 * @return void
 */
function techguide_primary_content_class( $classes = array() ) {
	echo techguide_get_layout_classes( 'content', $classes );
}

/**
 * Get CSS class attribute for passed layout context.
 *
 * @since  1.0.0
 * @param  string $layout  Layout context.
 * @param  array  $classes Additional classes.
 * @return string
 */
function techguide_get_layout_classes( $layout = 'content', $classes = array() ) {
	$sidebar_position = techguide_get_mod( 'sidebar_position' );
	$sidebar_width    = techguide_get_mod( 'sidebar_width' );

	if ( 'fullwidth' === $sidebar_position ) {
		$sidebar_width = 0;
	}

	$layout_classes = ! empty( techguide_theme()->layout[ $sidebar_position ][ $sidebar_width ][ $layout ] ) ? techguide_theme()->layout[ $sidebar_position ][ $sidebar_width ][ $layout ] : array();

	$layout_classes = apply_filters( "techguide_{$layout}_classes", $layout_classes );

	if ( ! empty( $classes ) ) {
		$layout_classes = array_merge( $layout_classes, $classes );
	}

	if ( empty( $layout_classes ) ) {
		return '';
	}

	return 'class="' . join( ' ', $layout_classes ) . '"';
}

/**
 * Retrieve or print `class` attribute for Post List wrapper.
 *
 * @since  1.0.0
 * @param  array   $classes Additional classes.
 * @param  boolean $echo    True for print. False - return.
 * @return string|void
 */
function techguide_posts_list_class( $classes = array(), $echo = true ) {
	$layout_type = techguide_get_mod( 'blog_layout_type' );
	$layout_type = ! is_search() ? $layout_type : 'search';
	$columns     = techguide_get_mod( 'blog_layout_columns' );

	$classes[] = 'posts-list';
	$classes[] = 'posts-list--' . sanitize_html_class( $layout_type );

	if ( in_array( $layout_type, array( 'grid', 'grid-2' ) ) ) {
		$classes[] = 'card-deck';
		$classes[] = sprintf( 'card-deck--%1$s', sanitize_html_class( $columns ) );
	}

	if ( 'masonry' === $layout_type ) {
		$classes[] = 'card-columns';
		$classes[] = sprintf( 'card-columns--%1$s', sanitize_html_class( $columns ) );
	}

	$classes = apply_filters( 'techguide_posts_list_class', $classes );

	$output = 'class="' . join( ' ', $classes ) . '"';

	if ( ! $echo ) {
		return wp_kses_post( $output );
	}

	echo wp_kses_post( $output );
}
