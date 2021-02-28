<?php
/**
 * The template for displaying wrapper for related posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Techguide
 * @subpackage single-post
 */
?>
<div class="related-posts">
	<div class="related-posts__header">
		<?php echo wp_kses_post( $block_title ); ?>
		<ul class="related-posts__nav">
			<li class="related-posts__nav-item<?php echo ( 'related-query' === $start_tab ) ? ' active' : ''; ?>" data-tab="related-query">
				<?php esc_html_e( 'Related Articles', 'techguide' ); ?>
			</li>
			<li class="related-posts__nav-item<?php echo ( 'author-query' === $start_tab ) ? ' active' : ''; ?>" data-tab="author-query">
				<?php esc_html_e( 'More from Author', 'techguide' ); ?>
			</li>
		</ul>
	</div>
	<div class="related-posts__content">
		<div class="related-posts__tab<?php echo ( 'related-query' === $start_tab ) ? ' active' : ''; ?>" data-tab="related-query">
			<div class="row">
				<?php echo wp_kses_post( $related_posts ); ?>
			</div>
		</div>
		<div class="related-posts__tab<?php echo ( 'author-query' === $start_tab ) ? ' active' : ''; ?>" data-tab="author-query">
			<div class="row">
				<?php echo wp_kses_post( $author_posts ); ?>
			</div>
		</div>
	</div>
</div><!--.related-posts-->
