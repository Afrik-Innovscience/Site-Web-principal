<?php
/**
 * Template part for displaying post via.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

if ( 'post' === get_post_type() ) :

	techguide_get_post_via( array(
		'visible' => techguide_get_mod( 'single_post_via' ),
		'prefix'  => '<span class="meta-title">' . esc_html__( 'Via', 'techguide' ) . '</span> ',
		'echo'    => true,
	) );

endif;
