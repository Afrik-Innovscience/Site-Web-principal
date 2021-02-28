<?php
/**
 * Template part for displaying post comments.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */
$utility = techguide_utility()->utility;

if ( 'post' === get_post_type() ) :

	$comment_visible = ( is_single() ) ? techguide_is_meta_visible( 'single_post_comments', 'single' ) : techguide_is_meta_visible( 'blog_post_comments', 'loop' );

	$post_object   = get_post();
	$comment_count = intval( $post_object->comment_count );

	$html = ( $comment_count > 0 ) ? '<span class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></span>' : '<span class="post__comments">%1$s%5$s%6$s</span>';

	$utility->meta_data->get_comment_count( array(
		'visible' => $comment_visible,
		'icon'    => '<i class="mdi mdi-comment-text"></i>',
		'html'    => $html,
		'class'   => 'post__comments-link',
		'echo'    => true,
	) );

endif;
