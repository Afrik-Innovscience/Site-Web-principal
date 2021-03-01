<?php
/**
 * Template part for displaying post rating.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

if ( 'post' === get_post_type() ) :

	$rating_visible = ( is_single() ) ? techguide_is_meta_visible( 'single_post_trend_rating', 'single' ) : techguide_is_meta_visible( 'blog_post_trend_rating', 'loop' );

	if ( $rating_visible ) :

		do_action( 'cherry_trend_posts_display_rating' );

	endif;

endif;
