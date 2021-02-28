<?php
/**
 * Template part for displaying post author.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

$utility = techguide_utility()->utility;

if ( 'post' === get_post_type() ) :
	if ( is_single() ) {
		switch ( get_page_template_slug() ) :
			case 'post-templates/single-layout-3.php' :
			case 'post-templates/single-layout-4.php' :
			case 'post-templates/single-layout-5.php' :
				$avatar_size = 50;
				break;

			case 'post-templates/single-layout-8.php' :
			case 'post-templates/single-layout-9.php' :
				$avatar_size = 140;
				break;

			case 'post-templates/single-layout-10.php' :
				$avatar_size = 110;
				break;

			default:
				$avatar_size = 30;

		endswitch;
	} else {
		$avatar_size = 30;
	}

	$author_visible = ( is_single() ) ? techguide_is_meta_visible( 'single_post_author', 'single' ) : techguide_is_meta_visible( 'blog_post_author', 'loop' );
	$avatar         = get_avatar( get_the_author_meta( 'user_email' ), $avatar_size, '', esc_attr( get_the_author_meta( 'nickname' ) ) );
	$prefix         = '';

	$html = '<div class="posted-by vcard posted-by--avatar">
					<div class="posted-by__avatar">' . $avatar . '</div>
					<div class="posted-by__content">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></div>
				</div>';

	$prefix_available_post_templates = array(
		'post-templates/single-layout-3.php',
		'post-templates/single-layout-5.php',
		'post-templates/single-layout-8.php',
		'post-templates/single-layout-9.php',
		'post-templates/single-layout-10.php',
	);

	if ( is_single() && in_array( get_page_template_slug(), $prefix_available_post_templates ) ) {
		$prefix = esc_html__( 'By ', 'techguide' );
	}

	$utility->meta_data->get_author( array(
		'visible' => $author_visible,
		'class'   => 'posted-by__author fn',
		'icon'    => '',
		'prefix'  => $prefix,
		'html'    => $html,
		'echo'    => true,
	) );

endif;
