<?php
/**
 * Template part for posts pagination.
 *
 * @package Techguide
 */

// Enqueue media assets needed for posts loading with ajax.
techguide_blog_ajax_handlers()->enqueue_media_assets();

$btn_texts = techguide_blog_ajax_handlers()->button_texts;

global $wp_query;

$current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$max_page     = intval( $wp_query->max_num_pages );

$btn_text     = ( $current_page !== $max_page ) ? $btn_texts['default'] : $btn_texts['none'];
$btn_disabled = ( $current_page !== $max_page ) ? '' : ' disabled';

?>
<nav class="posts-load-more-nav">
	<button class="posts-load-more-btn"<?php echo esc_attr( $btn_disabled ); ?>>
		<i class="posts-load-more-btn__icon mdi mdi-refresh"></i>
		<span class="posts-load-more-btn__text"><?php echo wp_kses_post( $btn_text ); ?></span>
	</button>
</nav>
