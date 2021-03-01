<?php
/**
 * Template part for displaying post read more button.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

$utility     = techguide_utility()->utility;
$btn_visible = techguide_get_mod( 'blog_read_more_btn' );
$btn_text    = techguide_get_mod( 'blog_read_more_text' );

$utility->attributes->get_button( array(
	'visible' => $btn_visible,
	'class'   => 'post__button btn btn-primary',
	'text'    => $btn_text,
	'html'    => '<div class="post__button-wrap"><a href="%1$s" %3$s><span class="btn__text">%4$s</span>%5$s</a></div>',
	'echo'    => true,
) );
