<?php
/**
 * Template part for displaying post featured image.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

$utility = techguide_utility()->utility;
$size    = techguide_post_thumbnail_size();

if ( is_single() ) :

	$html = '<img class="post-thumbnail__img wp-post-image" src="%3$s" alt="%4$s" %5$s>';

else:

	$html = '<a href="%1$s" %2$s><img class="post-thumbnail__img wp-post-image" src="%3$s" alt="%4$s" %5$s></a>';

endif;

$utility->media->get_image( array(
	'size'        => $size['size'],
	'mobile_size' => $size['size'],
	'class'       => 'post-thumbnail__link ' . $size['class'],
	'html'        => $html,
	'placeholder' => false,
	'echo'        => true,
) );
