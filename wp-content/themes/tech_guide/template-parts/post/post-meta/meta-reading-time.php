<?php
/**
 * Template part for displaying post reading time.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

if ( 'post' === get_post_type() ) :

	techguide_get_post_reading_time(
		array(
			'visible' => techguide_get_mod( 'single_post_reading_time' ),
			'echo'    => true,
		)
	);

endif;
