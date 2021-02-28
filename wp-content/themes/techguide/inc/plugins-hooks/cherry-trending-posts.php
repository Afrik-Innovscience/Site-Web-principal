<?php
/**
 * Cherry Trending Posts hooks.
 *
 * @package Techguide
 */
// Enable cherry_trend_posts cache fix.
add_filter( 'cherry_trend_posts_cache_fix', '__return_true' );

// Customization cherry_trend_posts views.
add_filter( 'cherry_trend_posts_views_format', 'techguide_modify_cherry_posts_views_format', 10, 3 );
// Customization cherry_trend_posts rating.
add_filter( 'cherry_trend_posts_rating_defaults', 'techguide_modify_default_rating_html_format' );

// Customization cherry_trend_posts widgets.
add_filter( 'cherry_trend_posts_image_args', 'techguide_cherry_trend_posts_image_args' );
add_filter( 'cherry_trend_posts_date_args', 'techguide_cherry_trend_posts_date_args' );
add_filter( 'cherry_trend_posts_comments_args', 'techguide_cherry_trend_posts_comments_args' );
add_filter( 'cherry_trend_posts_author_args', 'techguide_cherry_trend_posts_author_args' );
add_filter( 'cherry_trend_posts_category_args', 'techguide_cherry_trend_posts_category_args' );
add_filter( 'cherry_trend_posts_tag_args', 'techguide_cherry_trend_posts_tag_args' );
add_filter( 'cherry_trend_posts_button_args', 'techguide_cherry_trend_posts_button_args' );

/**
 * Modify views html format.
 *
 * @param string $format  Default html format.
 * @param int    $views   Post views.
 * @param int    $post_id Post id.
 *
 * @return string
 */
function techguide_modify_cherry_posts_views_format( $format, $views = null, $post_id = null ) {

	$additional_class = '';

	if ( $views > 5000 ) {
		$additional_class = ' very-hot';
	} elseif ( $views > 2000 ) {
		$additional_class = ' hot';
	} elseif ( $views > 500 ) {
		$additional_class = ' warm';
	}

	$format = '<span class="cherry-trend-views__count' . $additional_class . '" data-id="%2$s">%1$s</span>';

	if ( is_single() ) {
		$suffix_text = _n( 'View', 'Views', $views, 'techguide' );

		$format .= ' <span class="cherry-trend-views__suffix' . $additional_class . '">' . $suffix_text . '</span>';
	}

	return $format;
}

/**
 * Modify default rating html format.
 *
 * @param array $args Default rating html arguments.
 *
 * @return array
 */
function techguide_modify_default_rating_html_format( $args = array() ) {

	$args['format'] = esc_html__( '%1$s %3$s (%2$s)', 'techguide' );

	return $args;
}

/**
 * Customization image arguments.
 *
 * @param array $args Image arguments.
 *
 * @return array
 */
function techguide_cherry_trend_posts_image_args( $args = array() ) {

	$args['size']        = 'techguide-thumb-110-78';
	$args['mobile_size'] = 'techguide-thumb-110-78';

	return $args;
}

/**
 * Customization date arguments.
 *
 * @param array $args Date arguments.
 *
 * @return array
 */
function techguide_cherry_trend_posts_date_args( $args = array() ) {

	$human_time = apply_filters( 'techguide_cherry_trend_posts_date_human_format', true );
	$suffix     = $human_time ? esc_html__( ' ago', 'techguide' ) : '';

	$theme_args = array(
		'html'       => '<span class="post__date">%1$s<a href="%2$s" %3$s %4$s ><time datetime="%5$s">%6$s%7$s' . $suffix . '</time></a></span>',
		'icon'       => '<i class="mdi mdi-calendar-clock"></i>',
		'human_time' => $human_time,
	);

	$args = wp_parse_args( $theme_args, $args );

	return $args;
}

/**
 * Customization comments arguments.
 *
 * @param array $args Comments arguments.
 *
 * @return array
 */
function techguide_cherry_trend_posts_comments_args( $args = array() ) {

	$theme_args = array(
		'html'  => '<span class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></span>',
		'sufix' => '%s',
		'icon'  => '<i class="mdi mdi-comment"></i>',
	);

	$args = wp_parse_args( $theme_args, $args );

	return $args;
}

/**
 * Customization author arguments.
 *
 * @param array $args Author arguments.
 *
 * @return array
 */
function techguide_cherry_trend_posts_author_args( $args = array() ) {

	$theme_args = array(
		'html' => '<span class="posted-by">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></span>',
		'icon' => '<i class="mdi mdi-account"></i>',
	);

	$args = wp_parse_args( $theme_args, $args );

	return $args;
}

/**
 * Customization category arguments.
 *
 * @param array $args Category arguments.
 *
 * @return array
 */
function techguide_cherry_trend_posts_category_args( $args = array() ) {

	$theme_args = array(
		'before'    => '<span class="cherry-trend-post__meta-cats post__cats">',
		'after'     => '</span>',
		'delimiter' => ' ',
	);

	$args = wp_parse_args( $theme_args, $args );

	return $args;
}

/**
 * Customization tags arguments.
 *
 * @param array $args Tags arguments.
 *
 * @return array
 */
function techguide_cherry_trend_posts_tag_args( $args = array() ) {

	$theme_args = array(
		'before'    => '<div class="cherry-trend-post__meta-tags post__tags">',
		'after'     => '</div>',
		'icon'      => '<i class="mdi mdi-tag"></i>',
		'delimiter' => ', ',
	);

	$args = wp_parse_args( $theme_args, $args );

	return $args;
}

/**
 * Customization button arguments.
 *
 * @param array $args Button arguments.
 *
 * @return array
 */
function techguide_cherry_trend_posts_button_args( $args = array() ) {

	$args['class'] = 'cherry-trend-post__btn btn btn-primary';

	return $args;
}
