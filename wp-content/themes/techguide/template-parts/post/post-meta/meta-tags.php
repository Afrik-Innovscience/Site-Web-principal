<?php
/**
 * Template part for displaying post tags.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

$utility = techguide_utility()->utility;

if ( 'post' === get_post_type() ) :

	$tags_visible = ( is_single() ) ? techguide_is_meta_visible( 'single_post_tags', 'single' ) : techguide_is_meta_visible( 'blog_post_tags', 'loop' );

	$utility->meta_data->get_terms( array(
		'visible'   => $tags_visible,
		'type'      => 'post_tag',
		'prefix'    => ( ! is_single() ) ? '' : '<span class="meta-title">' . esc_html__( 'Tags', 'techguide' ) . '</span> ',
		'delimiter' => ( ! is_single() ) ? ', ' : ' ',
		'before'    => '<div class="post__tags">',
		'after'     => '</div>',
		'echo'      => true,
	) );

endif;
