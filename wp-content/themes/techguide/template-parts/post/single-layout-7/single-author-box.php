<?php
/**
 * Template part for displaying author box the single posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */
?>
<div class="single-author-box card-wrapper">
	<div class="single-author-box__avatar"><?php
		echo get_avatar( get_the_author_meta( 'user_email' ), 170, '', esc_attr( get_the_author_meta( 'nickname' ) ) );
	?></div>
	<h5 class="single-author-box__title"><?php the_author_posts_link(); ?></h5>
	<div class="single-author-box__bio"><?php the_author_meta( 'description' ); ?></div>
</div><!-- .single-author-box -->
