<?php
/**
 * Template part for displaying single posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php techguide_ads_post_before_content() ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links__title">' . esc_html__( 'Pages:', 'techguide' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span class="page-links__item">',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'techguide' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
		<?php techguide_get_template_part( 'template-parts/post/post-components/post-respond-button' ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer"><?php
		techguide_get_template_part( 'template-parts/post/post-meta/meta-tags' );
		techguide_get_template_part( 'template-parts/post/post-meta/meta-via' );
		techguide_get_template_part( 'template-parts/post/post-meta/meta-sources' );
		techguide_get_template_part( 'template-parts/post/post-components/post-share-buttons' );
	?></footer><!-- .entry-footer -->

</article><!-- #post-## -->
