<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Techguide
 */

// Set specific page layout settings.
add_filter( 'theme_mod_sidebar_position',        'techguide_set_post_meta_value', 20 );
add_filter( 'theme_mod_page_layout_style',       'techguide_set_post_meta_value' );
add_filter( 'theme_mod_breadcrumbs_visibillity', 'techguide_set_post_meta_value' );

// Set specific post settings.
add_filter( 'theme_mod_single_post_author',           'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_publish_date',     'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_categories',       'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_tags',             'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_comments',         'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_reading_time',     'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_trend_views',      'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_trend_rating',     'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_share_buttons',    'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_sources',          'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_via',              'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_respond_button',   'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_author_block',     'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_navigation',       'techguide_set_post_meta_value' );
add_filter( 'theme_mod_single_post_reading_progress', 'techguide_set_post_meta_value' );
add_filter( 'theme_mod_related_posts_visible',        'techguide_set_post_meta_value' );

// Set specific post listing settings in the categories and tags pages.
add_filter( 'theme_mod_sidebar_position',        'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_layout_type',        'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_layout_columns',     'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_pagination_type',    'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_posts_content',      'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_read_more_btn',      'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_post_author',        'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_post_publish_date',  'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_post_categories',    'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_post_tags',          'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_post_comments',      'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_post_trend_views',   'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_post_trend_rating',  'techguide_set_post_term_meta_value' );
add_filter( 'theme_mod_blog_post_share_buttons', 'techguide_set_post_term_meta_value' );
add_filter( 'option_posts_per_page',             'techguide_set_post_term_meta_value' );

/**
 * Set post specific meta value.
 *
 * @param  string $value Default meta-value.
 * @return string
 */
function techguide_set_post_meta_value( $value ) {
	$queried_obj = techguide_get_queried_obj();

	if ( ! $queried_obj ) {
		return $value;
	}

	$meta_key   = 'techguide_' . str_replace( 'theme_mod_', '', current_filter() );
	$meta_value = get_post_meta( $queried_obj, $meta_key, true );

	if ( ! $meta_value || 'inherit' === $meta_value ) {
		return $value;
	}

	$meta_value = techguide_prepare_meta_value( $meta_value );

	return $meta_value;
}

/**
 * Get queried object.
 *
 * @return string|boolean
 */
function techguide_get_queried_obj() {
	$queried_obj = apply_filters( 'techguide_queried_object_id', false );

	if ( ! $queried_obj && ! techguide_maybe_need_rewrite_mod() ) {
		return false;
	}

	$queried_obj = is_home() ? get_option( 'page_for_posts' ) : $queried_obj;
	$queried_obj = ! $queried_obj ? get_the_id() : $queried_obj;

	return $queried_obj;
}

/**
 * Check if we need to try rewrite theme mod or not
 *
 * @return boolean
 */
function techguide_maybe_need_rewrite_mod() {

	if ( is_front_page() && 'page' !== get_option( 'show_on_front' ) ) {
		return false;
	}

	if ( is_home() && 'page' == get_option( 'show_on_front' ) ) {
		return true;
	}

	if ( ! is_singular() ) {
		return false;
	}

	return true;
}

/**
 * Set specific term meta value.
 *
 * @param  string $value Default meta-value.
 * @return string
 */
function techguide_set_post_term_meta_value( $value ) {

	if ( ! techguide_is_category_or_tag() ) {
		return $value;
	}

	$term_settings = techguide_get_term_layout_settings();

	if ( ! $term_settings ) {
		return $value;
	}

	$meta_key   = preg_replace( array( '/theme_mod_/', '/option_/' ), '', current_filter() );
	$meta_value = isset( $term_settings[ $meta_key ] ) ? $term_settings[ $meta_key ] : false;

	if ( ! $meta_value || 'inherit' === $meta_value ) {
		return $value;
	}

	$meta_value = techguide_prepare_meta_value( $meta_value );

	return $meta_value;
}

/**
 * Get term meta settings.
 *
 * @return mixed
 */
function techguide_get_term_layout_settings() {
	static $term_meta;

	if ( ! $term_meta ) {
		$queried_obj = apply_filters( 'techguide_queried_object_id', get_queried_object_id() );

		$term_meta = get_term_meta( $queried_obj, 'techguide_term_layout_settings', true );
	}

	return $term_meta;
}

/**
 * Check is category or tag page.
 *
 * @return bool
 */
function techguide_is_category_or_tag() {

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {

		if ( isset( $_REQUEST['techguideIsCategoryOrTag'] ) ) {
			return (boolean) $_REQUEST['techguideIsCategoryOrTag'];
		}
	}

	if ( is_category() || is_tag() ) {
		return true;
	}

	return false;
}

/**
 * Prepare meta value.
 *
 * @param mixed $value
 *
 * @return mixed
 */
function techguide_prepare_meta_value( $value ) {

	if ( in_array( $value, array( 'yes', 'true' ) ) ) {
		return true;
	}

	if ( in_array( $value, array( 'no', 'false' ) ) ) {
		return false;
	}

	return $value;
}

/**
 * Render existing macros in passed string.
 *
 * @since  1.0.0
 * @param  string $string String to parse.
 * @return string
 */
function techguide_render_macros( $string ) {

	static $macros;

	if ( ! $macros ) {
		$macros = apply_filters( 'techguide_data_macros', array(
			'/%%year%%/'      => date( 'Y' ),
			'/%%date%%/'      => date( get_option( 'date_format' ) ),
			'/%%site-name%%/' => get_bloginfo( 'name' ),
			'/%%home_url%%/'  => esc_url( home_url( '/' ) ),
			'/%%theme_url%%/' => get_stylesheet_directory_uri(),
		) );
	}

	return preg_replace( array_keys( $macros ), array_values( $macros ), $string );
}

/**
 * Render font icons in content
 *
 * @param  string $content Content to render.
 * @return string
 */
function techguide_render_icons( $content ) {
	$icons     = techguide_get_render_icons_set();
	$icons_set = implode( '|', array_keys( $icons ) );

	$regex = '/icon:(' . $icons_set . ')?:?([a-zA-Z0-9-_]+)/';

	return preg_replace_callback( $regex, 'techguide_render_icons_callback', $content );
}

/**
 * Callback for icons render.
 *
 * @param  array $matches Search matches array.
 * @return string
 */
function techguide_render_icons_callback( $matches ) {

	if ( empty( $matches[1] ) && empty( $matches[2] ) ) {
		return $matches[0];
	}

	if ( empty( $matches[1] ) ) {
		return sprintf( '<i class="fa fa-%s"></i>', $matches[2] );
	}

	$icons = techguide_get_render_icons_set();

	if ( ! isset( $icons[ $matches[1] ] ) ) {
		return $matches[0];
	}

	return sprintf( $icons[ $matches[1] ], $matches[2] );
}

/**
 * Get list of icons to render.
 *
 * @return array
 */
function techguide_get_render_icons_set() {
	return apply_filters( 'techguide_render_icons_set', array(
		'fa' => '<i class="fa fa-%s"></i>',
	) );
}

/**
 * Replace %s with theme URL.
 *
 * @param  string $url Formatted URL to parse.
 * @return string
 */
function techguide_render_theme_url( $url ) {
	$path = apply_filters( 'techguide_render_theme_url_path', get_template_directory_uri() );
	return sprintf( $url, $path );
}

/**
 * Get image ID by URL.
 *
 * @param  string $image_src Image URL to search it in database.
 * @return int|bool false
 */
function techguide_get_image_id_by_url( $image_src ) {
	global $wpdb;

	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid = %s";
	$id    = $wpdb->get_var( $wpdb->prepare( $query, esc_url( $image_src ) ) );

	return $id;
}

/**
 * Check if passed meta data is visible in current context.
 *
 * @since  1.0.0
 * @param  string $meta    Meta setting to check.
 * @param  string $context Current post context - 'single' or 'loop'.
 * @return bool
 */
function techguide_is_meta_visible( $meta, $context = 'loop' ) {

	if ( ! $meta ) {
		return false;
	}

	$meta_enabled = techguide_get_mod( $meta );

	switch ( $context ) {

		case 'loop':

			if ( ! is_single() && $meta_enabled ) {
				return true;
			} else {
				return false;
			}

		case 'single':

			if ( is_single() && $meta_enabled ) {
				return true;
			} else {
				return false;
			}
	}

	return false;
}

/**
 * Get post thumbnail size.
 *
 * @param array $args Arguments.
 *
 * @return array
 */
function techguide_post_thumbnail_size( $args = array() ) {
	$sidebar_position = techguide_get_mod( 'sidebar_position' );
	$layout           = techguide_get_mod( 'blog_layout_type' );
	$format           = get_post_format();

	$args = wp_parse_args( $args, array(
		'default'      => 'post-thumbnail',
		'small'        => ( ! wp_is_mobile() ) ? 'techguide-thumb-s' : 'techguide-thumb-m',
		'fullwidth'    => ( 'fullwidth' !== $sidebar_position ) ? 'techguide-thumb-l' : 'techguide-thumb-xl',
		'masonry'      => 'techguide-thumb-masonry',
		'justify'      => 'techguide-thumb-l-2',
		'single'       => 'techguide-thumb-l',
		'class_prefix' => 'post-thumbnail--',
	) );

	$size       = $args['default'];
	$link_class = sanitize_html_class( $args['class_prefix'] ) . 'fullwidth';

	if ( 'default' === $layout ) {
		$size = $args['fullwidth'];
	}

	if ( in_array( $layout, array( 'default-small-img', 'timeline' ) ) ) {
		$size       = $args['small'];
		$link_class = sanitize_html_class( $args['class_prefix'] ) . 'small';
	}

	if ( 'masonry' === $layout && ! in_array( $format, array( 'gallery', 'video' ) ) ) {
		$size = $args['masonry'];
	}

	if ( 'vertical-justify' === $layout ) {
		$size = $args['justify'];
	}

	if ( is_single() ) {
		$size = $args['single'];
	}

	return apply_filters( 'techguide_post_thumbnail_size', array(
		'size'  => $size,
		'class' => $link_class,
	) );
}

/**
 * Check if product page currently displaying.
 *
 * @return bool
 */
function techguide_is_product_page() {
	if ( ! function_exists( 'is_product' ) || ! function_exists( 'is_shop' ) || ! function_exists( 'is_product_taxonomy' ) ) {
		return false;
	}

	return is_product() || is_shop() || is_product_taxonomy();
}

/**
 * Check if Cherry Trending Posts plugin is activated.
 */
function techguide_is_cherry_trending_posts_activated() {
	return class_exists( 'Cherry_Trending_Posts' );
}

/**
 * Check if Cherry Socialize plugin is activated.
 */
function techguide_is_cherry_socialize_activated() {
	return class_exists( 'Cherry_Socialize' );
}

/**
 * Remove elementor content filter.
 */
function techguide_remove_elementor_content_filter(){
	if ( ! class_exists( 'Elementor\Plugin' ) ) {
		return;
	}

	techguide_elementor()->remove_elementor_content_filter();
}

/**
 * Add elementor content filter.
 */
function techguide_add_elementor_content_filter(){
	if ( ! class_exists( 'Elementor\Plugin' ) ) {
		return;
	}

	techguide_elementor()->add_elementor_content_filter();
}

/**
 * Return a list of allowed tags and attributes.
 *
 * @param array $additional_allowed_html Additional allowed tags and attributes
 *
 * @return array
 */
function techguide_kses_post_allowed_html( $additional_allowed_html = array() ) {
	$allowed_html = wp_kses_allowed_html( 'post' );

	if ( ! empty( $additional_allowed_html ) ) {
		foreach ( $additional_allowed_html as $tag => $attr ) {
			if ( array_key_exists( $tag, $allowed_html ) ) {
				$allowed_html[ $tag ] = array_merge( $allowed_html[ $tag ], $attr );
			} else {
				$allowed_html[ $tag ] = $attr;
			}
		}
	}

	return $allowed_html;
}
