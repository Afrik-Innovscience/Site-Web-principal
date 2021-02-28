<?php
/**
 * Post Formats Template Functions.
 *
 * @package Techguide
 */

/**
 * Get a featured gallery HTML.
 *
 * @param array $args
 *
 * @return string
 */
function techguide_get_post_format_gallery( $args = array() ) {
	$default_args = array(
		'echo' => false,
	);

	$args = wp_parse_args( $args, $default_args );

	$img_ids = get_post_meta( get_the_ID(), 'techguide-post-gallery', true );

	if ( empty( $img_ids ) ) {
		return false;
	}

	$img_ids      = explode( ',', $img_ids );
	$gallery_args = array();

	if ( isset( $args['size'] ) ) {
		$gallery_args['size'] = $args['size'];
	}

	$html = techguide_theme()->post_formats_api->get_gallery_html( $img_ids, $gallery_args );

	return techguide_utility()->utility->satellite->output_method( $html, $args['echo'] );
}

/**
 * Get a featured external link HTML.
 *
 * @param array $args
 *
 * @return string
 */
function techguide_get_post_format_link( $args = array() ) {
	$default_args = array(
		'class' => '',
		'echo'  => false,
	);

	$args = wp_parse_args( $args, $default_args );

	$url = get_post_meta( get_the_ID(), 'techguide-post-link', true );

	if ( empty( $url ) ) {
		return false;
	}

	$target = get_post_meta( get_the_ID(), 'techguide-post-link-target', true );

	$link_format = apply_filters( 'techguide_post_format_link_html',
		'<a href="%1$s" class="post-format-link %2$s" target="%3$s">%1$s</a>'
	);

	$html = sprintf( $link_format, esc_url( $url ), esc_attr( $args['class'] ), esc_attr( $target ) );

	return techguide_utility()->utility->satellite->output_method( $html, $args['echo'] );
}

/**
 * Get a featured quote HTML.
 *
 * @param array $args
 *
 * @return string
 */
function techguide_get_post_format_quote( $args = array() ) {
	$default_args = array(
		'class' => '',
		'echo'  => false,
	);

	$args = wp_parse_args( $args, $default_args );

	$quote = get_post_meta( get_the_ID(), 'techguide-post-quote', true );

	if ( empty( $quote ) ) {
		return false;
	}

	$cite = get_post_meta( get_the_ID(), 'techguide-post-quote-cite', true );

	$cite_html = ( ! empty( $cite ) ) ? sprintf( ' <cite>%s</cite>', wp_kses_post( $cite ) ) : '';

	$quote_format = apply_filters( 'techguide_post_format_quote_html',
		'<blockquote class="post-format-quote %2$s">%1$s%3$s</blockquote>'
	);

	$html = sprintf( $quote_format, wp_kses_post( $quote ), esc_attr( $args['class'] ), $cite_html );

	return techguide_utility()->utility->satellite->output_method( $html, $args['echo'] );
}

/**
 * Get a featured video HTML.
 *
 * @param array $args
 *
 * @return string
 */
function techguide_get_post_format_video( $args = array() ) {
	$default_args = array(
		'width'            => 600,
		'height'           => 400,
		'popup'            => false,
		'overlay_img_size' => 'full',
		'echo'             => false,
	);

	$args = wp_parse_args( $args, $default_args );

	$source      = get_post_meta( get_the_ID(), 'techguide-post-video-source-type', true );
	$embed_url   = get_post_meta( get_the_ID(), 'techguide-post-video-embed-url', true );
	$wp_video_id = get_post_meta( get_the_ID(), 'techguide-post-wp-video', true );

	if ( empty( $source ) || 'embed' === $source ) {

		if ( empty( $embed_url ) ) {
			return false;
		}

		if ( true === $args['popup'] ) {

			$img_overlay = get_the_post_thumbnail( null, $args['overlay_img_size'] );

			$html = techguide_get_video_popup_markup(
				esc_url( $embed_url ),
				'iframe',
				$img_overlay
			);

		} else {
			$embed = wp_oembed_get(
				esc_url( $embed_url ),
				array(
					'width'  => $args['width'],
					'height' => $args['height'],
				)
			);

			$html = sprintf( '<div class="entry-video embed-responsive embed-responsive-16by9">%s</div>', $embed );
		}

	} else {

		if ( empty( $wp_video_id ) ) {
			return false;
		}

		$shortcode_attr = array(
			'width'  => $args['width'],
			'height' => $args['height'],
			'src'    => wp_get_attachment_url( $wp_video_id ),
			'poster' => get_the_post_thumbnail_url( $wp_video_id, 'full' ),
		);

		if ( true === $args['popup'] ) {

			if ( get_the_post_thumbnail( $wp_video_id, $args['overlay_img_size'] ) ) {
				$img_overlay = get_the_post_thumbnail( $wp_video_id, $args['overlay_img_size'] );
			} else {
				$img_overlay = get_the_post_thumbnail( null, $args['overlay_img_size'] );
			}

			$popup_cnt = '<div id="video-' . $wp_video_id . '" class="video-popup__content">' . wp_video_shortcode( $shortcode_attr ) . '</div>';

			$html = techguide_get_video_popup_markup(
				'#video-' . $wp_video_id,
				'inline',
				$img_overlay,
				$popup_cnt
			);

		} else {
			$html = wp_video_shortcode( $shortcode_attr );
		}
	}

	return techguide_utility()->utility->satellite->output_method( $html, $args['echo'] );
}

/**
 * Get video popup html markup.
 *
 * @param string $trigger_url
 * @param string $type
 * @param string $overlay_image
 * @param string $popup_content
 *
 * @return string
 */
function techguide_get_video_popup_markup( $trigger_url = '', $type = 'iframe', $overlay_image = '', $popup_content = '' ) {

	wp_enqueue_script( 'magnific-popup' );

	$template = '
	<div class="entry-video video-popup">
		<a href="%1$s" class="video-popup__trigger" data-type="%2$s">
			<div class="video-popup__overlay">
				<div class="video-popup__overlay-image %3$s">%4$s</div>
				<div class="video-popup__play-icon"></div>
			</div>
		</a>
		%5$s
	</div>';

	$overlay_class = $overlay_image ? 'has-overlay-image' : 'no-overlay-image';

	/**
	 * Filters the video popup markup template.
	 */
	$template = apply_filters( 'techguide_video_popup_markup_template', $template );

	return sprintf( $template, $trigger_url, esc_attr( $type ), esc_attr( $overlay_class ), $overlay_image, $popup_content );
}

/**
 * Get a featured audio HTML.
 *
 * @param array $args
 *
 * @return string
 */
function techguide_get_post_format_audio( $args = array() ) {
	$default_args = array(
		'width'  => 600,
		'height' => 400,
		'echo'   => false,
	);

	$args = wp_parse_args( $args, $default_args );

	$source      = get_post_meta( get_the_ID(), 'techguide-post-audio-source-type', true );
	$embed_url   = get_post_meta( get_the_ID(), 'techguide-post-audio-embed-url', true );
	$wp_audio_id = get_post_meta( get_the_ID(), 'techguide-post-wp-audio', true );

	if ( empty( $source ) || 'embed' === $source ) {

		if ( empty( $embed_url ) ) {
			return false;
		}

		$embed = wp_oembed_get(
			esc_url( $embed_url ),
			array(
				'width'  => $args['width'],
				'height' => $args['height'],
			)
		);

		$html = sprintf( '<div class="embed-wrapper">%s</div>', $embed );

	} else {

		if ( empty( $wp_audio_id ) ) {
			return false;
		}

		$shortcode_attr = array(
			'src' => wp_get_attachment_url( $wp_audio_id ),
		);

		$html = wp_audio_shortcode( $shortcode_attr );
	}

	return techguide_utility()->utility->satellite->output_method( $html, $args['echo'] );
}

/**
 * Check if the post has a featured content.
 *
 * @return bool
 */
function techguide_has_post_formats_featured_content() {
	$has    = false;
	$format = get_post_format();

	$post_formats_meta = array(
		'gallery' => array( 'techguide-post-gallery' ),
		'video'   => array( 'techguide-post-video-embed-url', 'techguide-post-wp-video' ),
		'audio'   => array( 'techguide-post-audio-embed-url', 'techguide-post-wp-audio' ),
		'link'    => array( 'techguide-post-link' ),
		'quote'   => array( 'techguide-post-quote' ),
	);

	if ( in_array( $format, array_keys( $post_formats_meta ) ) ) {
		foreach ( $post_formats_meta[ $format ] as $key ) {

			$meta = get_post_meta( get_the_ID(), $key, true );

			if ( ! empty( $meta ) ) {
				$has = true;
			}
		}
	} elseif ( 'image' === $format ) {
		if ( has_post_thumbnail() ) {
			$has = true;
		} else {
			$first_post_image = techguide_theme()->post_formats_api->get_post_images();

			if ( $first_post_image && ! empty( $first_post_image ) && ! empty( $first_post_image[0] ) ) {
				$has = true;
			}
		}
	} else {
		if ( has_post_thumbnail() ) {
			$has = true;
		}
	}

	return $has;
}

/**
 * Get has/no featured class.
 *
 * @return string
 */
function techguide_get_post_formats_featured_class() {
	$featured_class = 'no-post-featured';

	if ( techguide_has_post_formats_featured_content() ) {
		$featured_class = 'has-featured';
	}

	return $featured_class;
}
