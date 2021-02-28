<?php
/**
 * Template part for displaying post respond button.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

if ( ! comments_open() ) {
	return;
}

$utility = techguide_utility()->utility;

$utility->attributes->get_button( array(
	'visible' => techguide_get_mod( 'single_respond_button' ),
	'class'   => 'post-respond-button btn btn-primary',
	'text'    => esc_html__( 'Leave a comment', 'techguide' ),
	'html'    => '<a href="#respond" %3$s><span class="btn__text">%4$s</span>%5$s</a>',
	'echo'    => true,
) );
