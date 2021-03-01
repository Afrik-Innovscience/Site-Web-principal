<?php
/**
 * Template part for displaying post video.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

$utility    = techguide_utility()->utility;
$size       = techguide_post_thumbnail_size();
$size_array = $utility->satellite->get_thumbnail_size_array( $size['size'] );

techguide_get_post_format_video( array(
	'width'  => $size_array['width'],
	'height' => $size_array['height'],
	'echo'   => true,
) );
