<?php
/**
 * Template part for displaying post categories.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

$utility = techguide_utility()->utility;

if ( 'post' === get_post_type() ) :

	$cats_visible = ( is_single() ) ? techguide_is_meta_visible( 'single_post_categories', 'single' ) : techguide_is_meta_visible( 'blog_post_categories', 'loop' );

	$utility->meta_data->get_terms( array(
		'visible' => $cats_visible,
		'type'    => 'category',
		'before'  => '<div class="post__cats">',
		'after'   => '</div>',
		'echo'    => true,
	) );

endif;
