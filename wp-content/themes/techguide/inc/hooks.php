<?php
/**
 * Theme hooks.
 *
 * @package Techguide
 */

// Sidebars classes.
add_filter( 'techguide_widget_area_classes', 'techguide_set_sidebar_classes', 10, 2 );

// Adapt default image post format classes to current theme.
add_filter( 'cherry_post_formats_image_css_model', 'techguide_add_image_format_classes', 10, 2 );

// Enqueue misc js script.
add_filter( 'techguide_theme_script_depends', 'techguide_enqueue_misc' );

// Add has/no thumbnail classes for posts.
add_filter( 'post_class', 'techguide_post_thumb_classes' );

// Modify a comment form.
add_filter( 'comment_form_defaults', 'techguide_modify_comment_form' );

// Additional body classes.
add_filter( 'body_class', 'techguide_extra_body_classes' );

// Render macros in text widgets.
add_filter( 'widget_text', 'techguide_render_widget_macros', 10, 3 );

// Adds the meta viewport to the header.
add_action( 'wp_head', 'techguide_meta_viewport', 0 );

// Adds the meta theme-color to the header.
add_action( 'wp_head', 'techguide_meta_theme_color', 0 );

// Customization for `Tag Cloud` widget.
add_filter( 'widget_tag_cloud_args', 'techguide_customize_tag_cloud' );

// Changed excerpt more string.
add_filter( 'excerpt_more', 'techguide_excerpt_more' );

// Creating wrappers for audio shortcode.
add_filter( 'wp_audio_shortcode', 'techguide_audio_shortcode', 10, 5 );
add_filter( 'cherry_get_the_post_audio', 'techguide_cherry_get_the_post_audio' );

// Set specific customizer settings.
add_filter( 'theme_mod_sidebar_position', 'techguide_specific_sidebar_position' );

// Change gallery image size into single post and non-sidebar layout.
add_filter( 'cherry_get_the_post_gallery_defaults', 'techguide_post_gallery_img_size', 10, 3 );

// Add dynamic css function.
add_filter( 'cherry_css_func_list', 'techguide_add_dynamic_css_function' );

// Check for theme updates.
add_filter( 'http_request_args', 'techguide_disable_wporg_request', 5, 2 );

// Add dynamic css variables.
add_filter( 'cherry_css_variables', 'techguide_dynamic_css_variables', 10, 2 );

// FIX custom cherry-gallery atts.
add_filter( 'shortcode_atts_gallery', 'techguide_fix_custom_cherry_gallery_atts' );

// Modify post category links.
add_filter( 'term_links-category', 'techguide_modify_category_links' );

// Add support user social links.
add_filter( 'cherry_socialize_support_user_social_links', '__return_true' );

// Modify wsl provider name to comment form.
add_action( 'comment_form_before', 'techguide_add_wsl_provider_name_filter' );
add_action( 'comment_form_after', 'techguide_remove_wsl_provider_name_filter' );

// Add reading progress bar html to footer.
add_action( 'wp_footer', 'techguide_add_reading_progress_bar_html' );

// Modify content classes on single post.
add_filter( 'techguide_content_classes', 'techguide_modify_content_classes' );

// Modify `Better Recent Comments` widget.
add_filter( 'recent_comments_lang_widget_avatar_size', 'techguide_modify_recent_comments_avatar_size' );
add_filter( 'better_recent_comments_list', 'techguide_modify_better_recent_comments_list' );

// Modify breadcrumbs wrapper classes.
add_filter( 'cherry_breadcrumbs_wrapper_classes', 'techguide_cherry_breadcrumbs_wrapper_classes' );

// ADD `Archivo` google font to font select.
add_filter( 'cherry_customizer_get_fonts_data', 'techguide_register_archivo_font', 11, 2 );
add_filter( 'option_cherry_customiser_fonts_google', 'techguide_add_archivo_font', 11, 2 );

/**
 * Set layout classes for sidebars.
 *
 * @since  1.0.0
 * @uses   techguide_get_layout_classes.
 *
 * @param  array $classes Additional classes.
 * @param  string $area_id Sidebar ID.
 *
 * @return array
 */
function techguide_set_sidebar_classes( $classes, $area_id ) {

	if ( in_array( $area_id, array( 'sidebar', 'shop-sidebar' ) ) ) {

		if ( $area_id === 'shop-sidebar' ) {
			$classes[] = 'sidebar';
		}

		return techguide_get_layout_classes( 'sidebar', $classes );
	}

	return $classes;
}

/**
 * Filter image CSS model
 *
 * @param  array $css_model Default CSS model.
 * @param  array $args Post formats module arguments.
 *
 * @return array
 */
function techguide_add_image_format_classes( $css_model, $args ) {
	$blog_layout = techguide_get_mod( 'blog_layout_type' );
	$suffix      = ( ! in_array( $blog_layout, array( 'default-small-img', 'timeline' ) ) ) ? 'fullwidth' : 'small';

	$css_model['link'] .= ' post-thumbnail--' . $suffix;

	return $css_model;
}

/**
 * Enqueue misc js script.
 *
 * @param  array $depends Default dependencies.
 * @return array
 */
function techguide_enqueue_misc( $depends ) {
	global $is_IE;

	if ( $is_IE ) {
		$depends[] = 'object-fit-images';
	}

	$totop_visibility = techguide_get_mod( 'totop_visibility' );

	if ( $totop_visibility ) {
		$depends[] = 'jquery-ui-totop';
	}

	if ( ( techguide_get_mod( 'sidebar_sticky' ) && 'fullwidth' !== techguide_get_mod( 'sidebar_position' ) )
		|| ( 'post-templates/single-layout-7.php' === get_page_template_slug() && 'fullwidth' === techguide_get_mod( 'sidebar_position' ) )
	) {
		$depends[] = 'theia-sticky-sidebar';
	}

	return $depends;
}

/**
 * Add has/no thumbnail classes for posts
 *
 * @param  array $classes Existing classes.
 *
 * @return array
 */
function techguide_post_thumb_classes( $classes ) {
	$thumb = 'no-thumb';

	if ( has_post_thumbnail() ) {
		$thumb = 'has-thumb';
	}

	$classes[] = $thumb;

	if ( 'post' === get_post_type() ) {
		$classes[] = techguide_get_post_formats_featured_class();
	}

	return $classes;
}

/**
 * Add placeholder attributes for comment form fields.
 *
 * @param  array $args Arguments for comment form.
 *
 * @return array
 */
function techguide_modify_comment_form( $args ) {
	$args = wp_parse_args( $args );

	if ( ! isset( $args['format'] ) ) {
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	}

	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = 'html5' === $args['format'];
	$commenter = wp_get_current_commenter();

	$args['label_submit'] = esc_html__( 'Send', 'techguide' );

	$args['fields']['author'] = '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'techguide' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="author" class="comment-form__field" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'E-mail', 'techguide' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="email" class="comment-form__field" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['url'] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'techguide' ) . '</label><input id="url" class="comment-form__field" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	$args['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'techguide' ) . '</label><textarea id="comment" class="comment-form__field" name="comment" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';

	$args['title_reply_before'] = '<h4 id="reply-title" class="comment-reply-title">';

	$args['title_reply_after'] = '</h4>';

	$args['title_reply'] = esc_html__( 'Send a Comment', 'techguide' );

	$args['class_submit'] = 'submit btn btn-primary btn-lg';

	return $args;
}

/**
 * Add extra body classes
 *
 * @param  array $classes Existing classes.
 *
 * @return array
 */
function techguide_extra_body_classes( $classes ) {
	global $is_IE;

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of ie to browsers IE.
	if ( $is_IE ) {
		$classes[] = 'ie';
	}

	// Adds a options-based classes.
	$page_layout = techguide_get_mod( 'page_layout_style' );
	$blog_layout = techguide_get_mod( 'blog_layout_type' );
	$sb_position = techguide_get_mod( 'sidebar_position' );
	$sidebar     = techguide_get_mod( 'sidebar_width' );
	$word_wrap   = ( techguide_get_mod( 'word_wrap' ) ) ? 'wordwrap' : '';

	$content_separate_style = apply_filters( 'techguide_is_support_content_separate_style', true );

	if ( $content_separate_style && 'fullwidth' === $page_layout ) {
		$classes[] = 'content-separate-style';
	}

	return array_merge( $classes, array(
		'page-layout-' . $page_layout,
		'blog-' . $blog_layout,
		'position-' . $sb_position,
		'sidebar-' . str_replace( '/', '-', $sidebar ),
		$word_wrap,
	) );
}

/**
 * Replace macroses in text widget.
 *
 * @param  string         $widget_text The widget content.
 * @param  array          $instance    Array of settings for the current widget.
 * @param  WP_Widget_Text $widget      Current Text widget instance.
 * @return string
 */
function techguide_render_widget_macros( $widget_text = null, $instance = array(), $widget = null ) {

	$uploads = wp_upload_dir();

	$data = array(
		'/%%uploads_url%%/' => $uploads['baseurl'],
		'/%%home_url%%/'    => esc_url( home_url( '/' ) ),
		'/%%theme_url%%/'   => get_template_directory_uri(),
	);

	return preg_replace( array_keys( $data ), array_values( $data ), $widget_text );
}

/**
 * Adds the meta viewport to the header.
 *
 * @since  1.0.0
 */
function techguide_meta_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1" />' . "\n";
}

/**
 * Adds the meta theme-color to the header.
 *
 * @since  1.0.0
 */
function techguide_meta_theme_color() {
	$theme_color = techguide_get_mod( 'regular_accent_color_1' );

	echo '<meta name="theme-color" content="' . $theme_color . '"/>' . "\n";
}

/**
 * Customization for `Tag Cloud` widget.
 *
 * @since  1.0.0
 *
 * @param  array $args Widget arguments.
 *
 * @return array
 */
function techguide_customize_tag_cloud( $args ) {
	$args['smallest'] = 13;
	$args['largest']  = 13;
	$args['unit']     = 'px';

	return $args;
}

/**
 * Replaces `[...]` (appended to automatically generated excerpts) with `...`.
 *
 * @since  1.0.0
 *
 * @param  string $more The string shown within the more link.
 *
 * @return string
 */
function techguide_excerpt_more( $more ) {

	if ( is_admin() ) {
		return $more;
	}

	return ' &hellip;';
}

/**
 * Creating wrappers for audio shortcode.
 */
function techguide_audio_shortcode( $html, $atts, $audio, $post_id, $library ) {

	$html = sprintf( '<div class="mejs-audio-container-wrapper">%s</div>', $html );

	return $html;
}

/**
 * Creating wrappers for audio post featured content.
 */
function techguide_cherry_get_the_post_audio( $result ) {

	$result = sprintf( '<div class="post-format-audio">%s</div>', $result );

	return $result;
}

/**
 * Set specific sidebar position.
 */
function techguide_specific_sidebar_position( $value ) {

	if ( is_404() ) {
		return 'fullwidth';
	}

	if ( is_singular( 'post' ) ) {
		return techguide_get_mod( 'sidebar_position_post' );
	}

	if ( is_singular( 'product' ) ) {
		return techguide_get_mod( 'sidebar_position_product' );
	}

	return $value;
}

/**
 * Change gallery image size into single post and non-sidebar layout.
 *
 * @param $args
 * @param $post_id
 * @param $post_type
 *
 * @return mixed
 */
function techguide_post_gallery_img_size( $args, $post_id, $post_type ) {
	$sidebar_position = techguide_get_mod( 'sidebar_position' );

	if ( 'fullwidth' == $sidebar_position && is_singular() ) {
		$args['size'] = 'techguide-thumb-xl';
	}

	return $args;
}

/**
 * Add dynamic css function.
 *
 * @param array $func_list Function list.
 *
 * @return array
 */
function techguide_add_dynamic_css_function( $func_list = array() ) {

	$func_list['background_position'] = 'techguide_dynamic_css_background_position';

	return $func_list;
}

/**
 * Callback function for dynamic css function `background_position`.
 *
 * @param string $position Background position.
 *
 * @return bool|string
 */
function techguide_dynamic_css_background_position( $position = '' ) {

	if ( empty( $position ) ) {
		return;
	}

	$result = 'background-position: ' . str_replace( '-', ' ', $position );

	return $result;
}

/**
 * Disable requests to wp.org repository for this theme.
 *
 * @link  https://wptheming.com/2014/06/disable-theme-update-checks/
 * @since 1.0.0
 *
 * @param  array  $r An array of HTTP request arguments.
 * @param  string $url     The request URL.
 *
 * @return array
 */
function techguide_disable_wporg_request( $r, $url ) {

	// If it's not a theme update request, bail.
	if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
		return $r;
	}

	// Decode the JSON response.
	$themes = json_decode( $r['body']['themes'] );

	// Remove the active parent and child themes from the check.
	$parent = get_option( 'template' );
	$child  = get_option( 'stylesheet' );

	unset( $themes->themes->$parent );
	unset( $themes->themes->$child );

	// Encode the updated JSON response.
	$r['body']['themes'] = json_encode( $themes );

	return $r;
}

/**
 * Add dynamic css variables.
 *
 * @param array $variables CSS variables.
 * @param array $args      Module arguments.
 *
 * @return array
 */
function techguide_dynamic_css_variables( $variables = array(), $args = array() ) {

	$mobile_max_heading_size = array(
		'h1' => 36,
		'h2' => 32,
		'h3' => 30,
	);

	foreach ( $mobile_max_heading_size as $heading => $max_heading_size ) {
		$heading_size = (int) techguide_get_mod( $heading . '_font_size' );

		$variables[ $heading . '_mobile_multiple' ] = ( $heading_size > $max_heading_size ) ? (string) ( $max_heading_size / $heading_size ) : '1';
	}

	return $variables;
}

/**
 * FIX custom cherry-gallery atts.
 */
function techguide_fix_custom_cherry_gallery_atts( $out ) {

	$module_args = techguide_theme()->get_core()->modules['cherry-post-formats-api']->args;

	if ( $module_args['rewrite_default_gallery'] ) {
		$out['link'] = $module_args['gallery_args']['link'];
	}

	return $out;
}

/**
 * Modify post category links.
 *
 * @param array $links Links array.
 *
 * @return array
 */
function techguide_modify_category_links( $links = array() ) {
	$_links = array();

	foreach ( (array) $links as $link ) {
		preg_match( '/\>(.*)<\/a>/', $link, $matches );

		if ( ! isset( $matches[1] ) || empty( $matches[1] ) ) {
			continue;
		}

		$term_obj = get_term_by( 'name', $matches[1], 'category' );

		if ( ! $term_obj ) {
			continue;
		}

		$category_class = esc_attr( sprintf( 'link-category-%s', $term_obj->slug ) );

		$_links[] = str_replace( '<a', '<a class="' . $category_class . '"', $link );

		$bg_color = get_term_meta( $term_obj->term_id, 'cherry_terms_bg', true );

		if ( $bg_color ) {
			$selector = 'a.' . $category_class;

			techguide_theme()->dynamic_css->add_style(
				$selector,
				array(
					'background-color' => $bg_color,
				)
			);

			$bg_color_hover = techguide_theme()->get_dynamic_utilities_func(
				'darken',
				array(
					$bg_color,
					15,
				)
			);

			techguide_theme()->dynamic_css->add_style(
				$selector . ':hover',
				array(
					'background-color' => $bg_color_hover,
				)
			);
		}
	}

	return $_links;
}

/**
 * Add wsl provider name filter.
 */
function techguide_add_wsl_provider_name_filter() {
	add_filter( 'wsl_render_auth_widget_alter_provider_name', 'techguide_modify_wsl_provider_name' );
}

/**
 * Remove wsl provider name filter.
 */
function techguide_remove_wsl_provider_name_filter() {
	remove_filter( 'wsl_render_auth_widget_alter_provider_name', 'techguide_modify_wsl_provider_name' );
}

/**
 * Modify wsl provider name to comment form.
 *
 * @param string $provider_name Provider name.
 *
 * @return string
 */
function techguide_modify_wsl_provider_name( $provider_name = null ) {

	$provider_name = esc_html__( 'Login With ', 'techguide' ) . $provider_name;

	return $provider_name;
}

/**
 * Add reading progress bar html to footer.
 */
function techguide_add_reading_progress_bar_html() {

	if ( ! is_singular( 'post' ) || ! techguide_get_mod( 'single_post_reading_progress' ) ) {
		return;
	}

	echo '<div class="reading-progress-bar"><div class="progress-bar"></div></div><!-- .reading-progress-bar -->';
}

/**
 * Modify content classes on single post.
 *
 * @param array $classes Content layout classes.
 *
 * @return array
 */
function techguide_modify_content_classes( $classes = array() ) {

	if ( 'post-templates/single-layout-7.php' === get_page_template_slug() ) {
		return $classes;
	}

	if ( is_singular( 'post' ) && 'fullwidth' === techguide_get_mod( 'sidebar_position' ) ) {
		$classes[] = 'col-xl-8 col-xl-push-2';
	}

	return $classes;
}

/**
 * Modify avatar size in `Better Recent Comments` widget.
 *
 * @param int $size Avatar Size.
 *
 * @return int
 */
function techguide_modify_recent_comments_avatar_size( $size ) {
	return 56;
}

/**
 * Modify html markup in `Better Recent Comments` widget..
 *
 * @param string $html Comment list html markup.
 *
 * @return string
 */
function techguide_modify_better_recent_comments_list( $html ) {

	$html = str_replace( ': &ldquo;', '', $html );
	$html = str_replace( '&rdquo;', '', $html );

	return $html;
}

/**
 * Modify breadcrumbs wrapper classes.
 *
 * @param array $classes Classes array.
 *
 * @return array
 */
function techguide_cherry_breadcrumbs_wrapper_classes( $classes = array() ) {

	$classes[] = 'container';

	return $classes;
}

/**
 * Register `Archivo` google font.
 *
 * @param $fonts
 * @param $customizer
 *
 * @return array
 */
function techguide_register_archivo_font( $fonts, $customizer ) {

	return array_merge( array( 'archivo' => get_parent_theme_file_path( 'assets/fonts/archivo.json' ) ), $fonts );
}

/**
 * Add `Archivo` google font.
 *
 * @param $value
 * @param $option
 *
 * @return array
 */
function techguide_add_archivo_font( $value, $option ) {

	$archivo = get_option( 'cherry_customiser_fonts_archivo' );

	if ( ! empty( $archivo ) && is_array( $archivo ) ) {

		$value = wp_parse_args( $value, $archivo );

	}

	return $value;
}

// Disable support content separate style.
add_filter( 'techguide_is_support_content_separate_style', '__return_false' );

// Customization for `Tag Cloud` widget.
add_filter( 'widget_tag_cloud_args', 'techguide_tech_skin_customize_tag_cloud' );

/**
 * Customization for `Tag Cloud` widget.
 *
 * @since  1.0.0
 *
 * @param  array $args Widget arguments.
 *
 * @return array
 */
function techguide_tech_skin_customize_tag_cloud( $args ) {
	$args['smallest'] = 20;
	$args['largest']  = 20;
	$args['unit']     = 'px';

	return $args;
}
