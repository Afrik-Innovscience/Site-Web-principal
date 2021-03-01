<?php
/**
 * Template part for displaying post title.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

$utility          = techguide_utility()->utility;
$sticky           = techguide_sticky_label( false );
$blog_layout_type = techguide_get_mod( 'blog_layout_type' );
$classes          = array( 'entry-title' );

if ( is_single() ) :

	$title_html = '<h1 %1$s>%4$s</h1>';

elseif ( 'default' === $blog_layout_type ) :

	$title_html = '<h4 %1$s>' . $sticky . '<a href="%2$s" rel="bookmark">%4$s</a></h4>';

else :

	$title_html = '<h5 %1$s>' . $sticky . '<a href="%2$s" rel="bookmark">%4$s</a></h5>';

endif;

$utility->attributes->get_title( array(
	'class' => join( ' ', $classes ),
	'html'  => $title_html,
	'echo'  => true,
) );
