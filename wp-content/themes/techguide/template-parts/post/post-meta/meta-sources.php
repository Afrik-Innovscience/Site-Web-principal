<?php
/**
 * Template part for displaying post sources.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

if ( 'post' === get_post_type() ) :

	techguide_get_post_sources( array(
		'visible' => techguide_get_mod( 'single_post_sources' ),
		'prefix'  => '<span class="meta-title">' . esc_html__( 'Source', 'techguide' ) . '</span> ',
		'echo'    => true,
	) );

endif;
