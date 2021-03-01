<?php
/**
 * Template part for displaying post publish date.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

$utility = techguide_utility()->utility;

if ( 'post' === get_post_type() ) :

	$date_visible = ( is_single() ) ? techguide_is_meta_visible( 'single_post_publish_date', 'single' ) : techguide_is_meta_visible( 'blog_post_publish_date', 'loop' );

	$human_time        = ( is_single() ) ? false : true;
	$human_time_suffix = esc_html__( ' ago', 'techguide' );

	$date_format = ( is_single() ) ? sprintf( '%1$s %2$s %3$s', get_option( 'date_format' ), esc_html__( '\a\t', 'techguide' ), get_option( 'time_format' ) ) : get_option( 'date_format' );

	if ( $human_time ) {
		$html = '<span class="post__date">%1$s<a href="%2$s" %3$s %4$s><time datetime="%5$s">%6$s%7$s' . $human_time_suffix . '</time></a></span>';
	} else {
		$html = '<span class="post__date">%1$s<a href="%2$s" %3$s %4$s><time datetime="%5$s">%6$s%7$s</time></a></span>';
	}

	$utility->meta_data->get_date( array(
		'visible'     => $date_visible,
		'icon'        => '<i class="mdi mdi-calendar-clock"></i>',
		'html'        => $html,
		'class'       => 'post__date-link',
		'date_format' => $date_format,
		'human_time'  => $human_time,
		'echo'        => true,
	) );

endif;
