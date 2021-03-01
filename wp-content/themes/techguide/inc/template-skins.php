<?php
/**
 * Skins Template Functions.
 *
 * @package Techguide
 */

/**
 * Load a template part into a template
 *
 * @since 1.0.0
 *
 * @param array|string $slugs The slug(s) name for the generic template.
 * @param string $name The name of the specialised template.
 */
function techguide_get_template_part( $slugs, $name = null ) {

	$templates = array();
	$name      = (string) $name;
	$skin_path = '';

	if ( function_exists( 'techguide_skins' ) ) {
		$skin_path = trailingslashit( techguide_skins()->get_current_skin_path() );
	}

	foreach ( (array) $slugs as $slug ) {

		// Skins templates
		if ( function_exists( 'techguide_skins' ) ) {

			$skin_slug = $skin_path . $slug;

			if ( '' !== $name ) {
				$templates[] = "{$skin_slug}-{$name}.php";
			}

			$templates[] = "{$skin_slug}.php";
		}

		if ( '' !== $name ) {
			$templates[] = "{$slug}-{$name}.php";
		}

		$templates[] = "{$slug}.php";
	}

	// Allow template parts to be filtered
	$templates = apply_filters( 'techguide_get_template_part', $templates, $slugs, $name );

	locate_template( $templates, true, false );
}

/**
 * Retrieve the name of the highest priority template file that exists.
 *
 * @since 1.0.0
 *
 * @param string $template_name Template file to search for, in order.
 *
 * @return string The template filename if one is located.
 */
function techguide_get_locate_template( $template_name ) {

	if ( ! function_exists( 'techguide_skins' ) ) {
		return locate_template( $template_name, false, false );
	}

	$skin_path = trailingslashit( techguide_skins()->get_current_skin_path() );

	$template_names   = array();
	$template_names[] = $skin_path . $template_name;
	$template_names[] = $template_name;

	return locate_template( $template_names, false, false );
}
