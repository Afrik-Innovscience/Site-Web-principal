<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Techguide
 */
?>
<section class="error-404 not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( '404', 'techguide' ); ?></h1>
		<h2 class="page-sub-title"><?php esc_html_e( 'Page Not Found', 'techguide' ); ?></h2>
	</header><!-- .page-header -->

	<div class="page-content">
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'techguide' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .page-content -->
</section><!-- .error-404 -->
