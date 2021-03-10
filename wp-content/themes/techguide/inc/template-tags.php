<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Techguide
 */

/**
 * Show footer copyright text.
 *
 * @since  1.0.0
 * @return void
 */
function techguide_footer_copyright() {
	$copyright = techguide_get_mod( 'footer_copyright' );
	$format    = '<div class="footer-copyright">%s</div>';

	if ( empty( $copyright ) ) {
		return;
	}

	echo $format;

	printf( $format, wp_kses( techguide_render_macros( wp_unslash( $copyright ) ), wp_kses_allowed_html( 'post' ) ) );
}

/**
 * Show sticky menu label grabbed from options.
 *
 * @param bool $echo Print or return sticky label html.
 *
 * @since  1.0.0
 * @return string|void
 */
function techguide_sticky_label( $echo = true ) {

	if ( ! is_sticky() || ! is_home() || is_paged() ) {
		return;
	}

	$sticky_type = techguide_get_mod( 'blog_sticky_type' );

	$content = '';
	$icon    = techguide_get_mod( 'blog_sticky_icon' );
	$label   = techguide_get_mod( 'blog_sticky_label' );

	$icon_format = apply_filters( 'techguide_sticky_icon_format', '<i class="fa %1$s"></i>' );
	$icon_html   = sprintf( $icon_format, $icon );

	$label_format = apply_filters( 'techguide_sticky_label_text_format', '<span class="sticky__label-text">%s</span>' );
	$label_html   = sprintf( $label_format, techguide_render_icons( $label ) );

	switch ( $sticky_type ) {

		case 'icon':
			$content = $icon_html;
			break;

		case 'label':
			$content = $label_html;
			break;

		case 'both':
			$content = $icon_html . $label_html;
			break;
	}

	if ( empty( $content ) ) {
		return;
	}

	$sticky_format = apply_filters( 'techguide_sticky_label_format', '<span class="sticky__label type-%2$s">%1$s</span>' );

	if ( ! wp_validate_boolean( $echo ) ) {
		return sprintf( $sticky_format, $content, $sticky_type );
	} else {
		printf( $sticky_format, $content, $sticky_type );
	}
}

/**
 * Display the header logo.
 *
 * @since  1.0.0
 * @return void
 */
function techguide_header_logo() {

	if ( has_custom_logo() ) {
		$logo = get_custom_logo();
		$type = 'image';
	} else {
		$logo = sprintf( '<a class="site-logo__link" href="%1$s" rel="home">%2$s</a>', esc_url( home_url( '/' ) ), get_bloginfo( 'name' ) );
		$type = 'text';
	}

	if ( is_front_page() && is_home() ) {
		$tag = 'h1';
	} else {
		$tag = 'div';
	}

	$format = apply_filters(
		'techguide_header_logo_format',
		'<%1$s class="site-logo site-logo--%3$s">%2$s</%1$s>'
	);

	printf( $format, $tag, $logo, $type );
}

/**
 * Display preloader with logo
 *
 * @since  1.0.0
 * @return void
 */
function techguide_preloader_logo() {

	$preloader_url = techguide_get_mod( 'page_preloader_url' );

	if ( ! $preloader_url ) {
		return;
	}

	$alt           = esc_attr( get_bloginfo( 'name' ) );
	$preloader_url = esc_url( techguide_render_theme_url( $preloader_url ) );
	$preloader_id  = techguide_get_image_id_by_url( techguide_render_theme_url( $preloader_url ) );
	$preloader_src = wp_get_attachment_image_src( $preloader_id, 'full' );

	if ( $preloader_id && $preloader_src ) {
		$atts = ' width="' . esc_attr( $preloader_src[1] ) . '" height="' . esc_attr( $preloader_src[2] ) . '"';
	} else {
		$atts = '';
	}

	$retina_url = techguide_get_mod( 'page_preloader_url_retina' );

	if ( $retina_url ) {
		$atts .= sprintf( ' srcset="%s 2x"', esc_url( techguide_render_theme_url( $retina_url ) ) );
	}

	$preloader_format = apply_filters(
		'techguide_preloader_logo_format',
		'<div class="preloader-image-wrap"><img src="%1$s" alt="%2$s" class="preloader-image" %3$s></div>'
	);

	printf( $preloader_format, $preloader_url, $alt, $atts );
}

/**
 * Display the site description.
 *
 * @since  1.0.0
 * @return void
 */
function techguide_site_description() {
	$show_desc = techguide_get_mod( 'show_tagline' );

	if ( ! $show_desc ) {
		return;
	}

	$description = get_bloginfo( 'description', 'display' );

	if ( ! ( $description || is_customize_preview() ) ) {
		return;
	}

	$format = apply_filters( 'techguide_site_description_format', '<div class="site-description">%s</div>' );

	printf( $format, $description );
}

/**
 * Display box with information about author.
 *
 * @since  1.0.0
 * @return void
 */
function techguide_post_author_bio() {
	$is_enabled = techguide_get_mod( 'single_author_block' );

	if ( ! $is_enabled ) {
		return;
	}

	if ( ! is_singular( 'post' ) ) {
		return;
	}

	techguide_get_template_part( 'template-parts/content', 'author-bio' );
}

/**
 * Display the breadcrumbs.
 *
 * @since  1.0.0
 * @return void
 */
function techguide_site_breadcrumbs() {
	$breadcrumbs_visibillity       = techguide_get_mod( 'breadcrumbs_visibillity' );
	$breadcrumbs_page_title        = techguide_get_mod( 'breadcrumbs_page_title' );
	$breadcrumbs_path_type         = techguide_get_mod( 'breadcrumbs_path_type' );
	$breadcrumbs_front_visibillity = techguide_get_mod( 'breadcrumbs_front_visibillity' );

	$breadcrumbs_settings = apply_filters( 'techguide_breadcrumbs_settings', array(
		'wrapper_format'    => '<div class="breadcrumbs__inner">%1$s<div class="breadcrumbs__items">%2$s</div></div>',
		'page_title_format' => '<div class="breadcrumbs__title"><h5 class="page-title">%s</h5></div>',
		'separator'         => '<i class="mdi mdi-chevron-right"></i>',
		'show_title'        => $breadcrumbs_page_title,
		'path_type'         => $breadcrumbs_path_type,
		'show_on_front'     => $breadcrumbs_front_visibillity,
		'labels'            => array(
			'browse'         => '',
			'error_404'      => esc_html__( '404 Not Found', 'techguide' ),
			'archives'       => esc_html__( 'Archives', 'techguide' ),
			/* Translators: %s is the search query. The HTML entities are opening and closing curly quotes. */
			'search'         => esc_html__( 'Search results for &#8220;%s&#8221;', 'techguide' ),
			/* Translators: %s is the page number. */
			'paged'          => esc_html__( 'Page %s', 'techguide' ),
			/* Translators: Minute archive title. %s is the minute time format. */
			'archive_minute' => esc_html__( 'Minute %s', 'techguide' ),
			/* Translators: Weekly archive title. %s is the week date format. */
			'archive_week'   => esc_html__( 'Week %s', 'techguide' ),
		),
		'date_labels' => array(
			'archive_minute_hour' => esc_html_x( 'g:i a', 'minute and hour archives time format', 'techguide' ),
			'archive_minute'      => esc_html_x( 'i', 'minute archives time format', 'techguide' ),
			'archive_hour'        => esc_html_x( 'g a', 'hour archives time format', 'techguide' ),
			'archive_year'        => esc_html_x( 'Y', 'yearly archives date format', 'techguide' ),
			'archive_month'       => esc_html_x( 'F', 'monthly archives date format', 'techguide' ),
			'archive_day'         => esc_html_x( 'j', 'daily archives date format', 'techguide' ),
			'archive_week'        => esc_html_x( 'W', 'weekly archives date format', 'techguide' ),
		),
		'css_namespace' => array(
			'module'    => 'breadcrumbs',
			'content'   => 'breadcrumbs__content',
			'wrap'      => 'breadcrumbs__wrap',
			'browse'    => 'breadcrumbs__browse',
			'item'      => 'breadcrumbs__item',
			'separator' => 'breadcrumbs__item-sep',
			'link'      => 'breadcrumbs__item-link',
			'target'    => 'breadcrumbs__item-target',
		),
	) );

	if ( $breadcrumbs_visibillity ) {
		techguide_theme()->get_core()->init_module( 'cherry-breadcrumbs', $breadcrumbs_settings );
		do_action( 'cherry_breadcrumbs_render' );
	}
}

/**
 * Display the page preloader.
 *
 * @since  1.0.0
 * @return void
 */
function techguide_get_page_preloader() {
	$page_preloader = techguide_get_mod( 'page_preloader' );

	if ( $page_preloader ) {
		techguide_get_template_part( 'template-parts/page-preloader' );
	}
}

/**
 * Display the ads.
 *
 * @since  1.0.0
 * @param  string $location location of ads in theme.
 * @return void
 */
function techguide_ads( $location ) {
	$ads    = trim( techguide_get_mod( 'ads_' . $location ) );
	$format = '<div class="' . $location . '-ads">%s</div>';

	if ( empty( $ads ) ) {
		return;
	}

	printf( $format, wp_specialchars_decode( $ads, ENT_QUOTES ) );
}

/**
 * Display the header ads.
 */
function techguide_ads_header() {
	techguide_ads( 'header' );
}

/**
 * Display ads for before loop location.
 */
function techguide_ads_home_before_loop() {
	techguide_ads( 'home_before_loop' );
}

/**
 * Display ads for before loop content.
 */
function techguide_ads_post_before_content() {
	techguide_ads( 'post_before_content' );
}

/**
 * Display ads for before comments.
 */
function techguide_ads_post_before_comments() {
	techguide_ads( 'post_before_comments' );
}
