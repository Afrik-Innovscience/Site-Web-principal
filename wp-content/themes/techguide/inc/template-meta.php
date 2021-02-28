<?php
/**
 * Post Meta Template Functions.
 *
 * @package Techguide
 */

/**
 * Get post reading time.
 *
 * @param array $args
 *
 * @return string
 */
function techguide_get_post_reading_time( $args = array() ) {

	$default_args = array(
		'visible' => true,
		'icon'    => '',
		'prefix'  => esc_html__( 'The estimated reading time is ', 'techguide' ),
		'html'    => '<span %1$s>%2$s%3$s%4$s</span>',
		'class'   => 'post-reading-time',
		'unit'    => 'min', // sec, min
		'echo'    => false,
	);

	$args = wp_parse_args( $args, $default_args );

	$html = '';

	if ( filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN ) ) {

		$html_class = ( $args['class'] ) ? 'class="' . esc_attr( $args['class'] ) . '"' : '';

		$content = get_the_content();
		$content = strip_shortcodes( $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		$content = wp_strip_all_tags( $content );

		$word_count = count( preg_split( "/[\n\r\t ]+/", $content, - 1, PREG_SPLIT_NO_EMPTY ) );

		/**
		 * Filter the average reading speed value.
		 *
		 * @since 1.0.0
		 * @var   int
		 */
		$reading_speed = apply_filters( 'techguide_average_reading_speed_value', 250 );

		$reading_time = $word_count / intval( $reading_speed );

		switch ( $args['unit'] ):

			case 'sec' :

				$reading_time = round( $reading_time * 60 );
				$reading_time = sprintf( '%1$s %2$s', $reading_time, _nx( 'second', 'seconds', $reading_time, 'reading time in second', 'techguide' ) );

				break;

			default:

				$reading_time = round( $reading_time );

				if ( $reading_time < 1 ) {
					$reading_time = esc_html__( 'less than a minute', 'techguide' );
				} else {
					$reading_time = sprintf( '%1$s %2$s', $reading_time, _nx( 'minute', 'minutes', $reading_time, 'reading time in minutes', 'techguide' ) );
				}

		endswitch;

		$html = sprintf( $args['html'], $html_class, wp_kses_post( $args['icon'] ), wp_kses_post( $args['prefix'] ), $reading_time );
	}

	if ( ! filter_var( $args['echo'], FILTER_VALIDATE_BOOLEAN ) ) {
		return wp_kses_post( $html );
	} else {
		echo wp_kses_post( $html );
	}
}

/**
 * Get post sources.
 *
 * @param array $args
 *
 * @return string
 */
function techguide_get_post_sources( $args = array() ) {

	$default_args = array(
		'visible'   => true,
		'icon'      => '',
		'prefix'    => '',
		'delimiter' => ' ',
		'html'      => '<div %1$s>%2$s%3$s%4$s</div>',
		'class'     => 'post-sources',
		'echo'      => false,
	);

	$args = wp_parse_args( $args, $default_args );
	$html = '';

	if ( filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN ) ) {
		$html_class = ( $args['class'] ) ? 'class="' . esc_attr( $args['class'] ) . '"' : '';

		$sources = get_post_meta( get_the_ID(), 'techguide-post-sources', true );

		if ( empty( $sources ) || ! is_array( $sources ) ) {
			return false;
		}

		/**
		 * Filter the source link html format.
		 *
		 * @since 1.0.0
		 * @var   string
		 */
		$source_link_format = apply_filters(
			'techguide_post_source_link_format',
			'<a href="%1$s" target="_blank" rel="nofollow">%2$s</a>'
		);

		$links = array();

		foreach ( $sources as $data ) {
			$url   = esc_url( $data['url'] );
			$label = wp_kses_post( $data['label'] );

			if ( ! $url || ! $label ) {
				continue;
			}

			$links[] = sprintf( $source_link_format, $url, $label );
		}

		if ( ! $links ) {
			return false;
		}

		$sources_links = join( wp_kses_post( $args['delimiter'] ), $links );

		$html = sprintf( $args['html'], $html_class, wp_kses_post( $args['icon'] ), wp_kses_post( $args['prefix'] ), $sources_links );
	}

	if ( ! filter_var( $args['echo'], FILTER_VALIDATE_BOOLEAN ) ) {
		return wp_kses_post( $html );
	} else {
		echo wp_kses_post( $html );
	}
}

/**
 * Get post via.
 *
 * @param array $args
 *
 * @return string
 */
function techguide_get_post_via( $args = array() ) {

	$default_args = array(
		'visible'   => true,
		'icon'      => '',
		'prefix'    => '',
		'delimiter' => ' ',
		'html'      => '<div %1$s>%2$s%3$s%4$s</div>',
		'class'     => 'post-via',
		'echo'      => false,
	);

	$args = wp_parse_args( $args, $default_args );
	$html = '';

	if ( filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN ) ) {
		$html_class = ( $args['class'] ) ? 'class="' . esc_attr( $args['class'] ) . '"' : '';

		$via = get_post_meta( get_the_ID(), 'techguide-post-via', true );

		if ( empty( $via ) || ! is_array( $via ) ) {
			return false;
		}

		/**
		 * Filter the via link html format.
		 *
		 * @since 1.0.0
		 * @var   string
		 */
		$via_link_format = apply_filters(
			'techguide_post_via_link_format',
			'<a href="%1$s" target="_blank" rel="nofollow">%2$s</a>'
		);

		$links = array();

		foreach ( $via as $data ) {
			$url   = esc_url( $data['url'] );
			$label = wp_kses_post( $data['label'] );

			if ( ! $url || ! $label ) {
				continue;
			}

			$links[] = sprintf( $via_link_format, $url, $label );
		}

		if ( ! $links ) {
			return false;
		}

		$via_links = join( wp_kses_post( $args['delimiter'] ), $links );

		$html = sprintf( $args['html'], $html_class, wp_kses_post( $args['icon'] ), wp_kses_post( $args['prefix'] ), $via_links );
	}

	if ( ! filter_var( $args['echo'], FILTER_VALIDATE_BOOLEAN ) ) {
		return wp_kses_post( $html );
	} else {
		echo wp_kses_post( $html );
	}
}
