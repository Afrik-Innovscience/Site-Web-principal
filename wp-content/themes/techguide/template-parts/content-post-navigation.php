<?php
/**
 * Template part for single post navigation.
 *
 * @package Techguide
 */

if ( ! techguide_get_mod( 'single_post_navigation' ) ) {
	return;
}

the_post_navigation( array(
	'prev_text' => sprintf( '<span class="nav-text"><i class="mdi mdi-chevron-double-left"></i>%1$s</span><span class="nav-post-title">%2$s</span>', esc_html__( 'Previous article', 'techguide' ), '%title' ),
	'next_text' => sprintf( '<span class="nav-text">%1$s<i class="mdi mdi-chevron-double-right"></i></span><span class="nav-post-title">%2$s</span>', esc_html__( 'Next article', 'techguide' ), '%title' ),
) );
