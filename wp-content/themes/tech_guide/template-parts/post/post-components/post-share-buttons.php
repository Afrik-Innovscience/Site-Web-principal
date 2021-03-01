<?php
/**
 * Template part for displaying share buttons.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

if ( 'post' === get_post_type() ) :

	$share_visible = ( is_single() ) ? techguide_is_meta_visible( 'single_post_share_buttons', 'single' ) : techguide_is_meta_visible( 'blog_post_share_buttons', 'loop' );
	$custom_class  = ( is_single() ) ? 'cs-share--single cs-share--rounded' : 'cs-share--loop';

	if ( $share_visible ) :

		do_action( 'cherry_socialize_display_sharing',
			true,
			array(
				'custom_class' => $custom_class,
				'before-html'  => '',
			),
			array()
		);

	endif;

endif;
