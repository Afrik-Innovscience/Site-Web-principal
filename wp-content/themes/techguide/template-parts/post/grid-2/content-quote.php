<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card invert' ); ?>>
	<div class="posts-list__item-inner">
		<div class="posts-list__item-media">
			<figure class="post-thumbnail"><?php
				techguide_get_template_part( 'template-parts/post/post-components/post-image' );
			?></figure><!-- .post-thumbnail -->
		</div><!-- .posts-list__item-media -->

		<div class="posts-list__item-content">

			<div class="post-featured-content"><?php
				techguide_get_post_format_quote( array(
					'echo' => true,
				) );
			?></div><!-- .post-featured-content -->

			<div class="entry-meta entry-meta-top"><?php
				techguide_get_template_part( 'template-parts/post/post-meta/meta-categories' );
				techguide_get_template_part( 'template-parts/post/post-meta/meta-date' );
				techguide_get_template_part( 'template-parts/post/post-meta/meta-comments' );
				techguide_get_template_part( 'template-parts/post/post-meta/meta-rating' );
				techguide_get_template_part( 'template-parts/post/post-meta/meta-view' );
			?></div><!-- .entry-meta -->

			<header class="entry-header"><?php
				techguide_get_template_part( 'template-parts/post/post-components/post-title' );
			?></header><!-- .entry-header -->

			<div class="entry-meta entry-meta-main"><?php
				techguide_get_template_part( 'template-parts/post/post-components/post-share-buttons' );
				techguide_get_template_part( 'template-parts/post/post-meta/meta-author' );
			?></div><!-- .entry-meta -->

			<div class="entry-content"><?php
				techguide_get_template_part( 'template-parts/post/post-components/post-content' );
			?></div><!-- .entry-content -->

			<div class="entry-meta entry-meta-bottom"><?php
				techguide_get_template_part( 'template-parts/post/post-meta/meta-tags' );
			?></div><!-- .entry-meta -->

			<footer class="entry-footer">
				<div class="entry-footer-container"><?php
					techguide_get_template_part( 'template-parts/post/post-components/post-button' );
				?></div>
			</footer><!-- .entry-footer -->
		</div><!-- .posts-list__item-content -->
	</div><!-- .posts-list__item-inner -->
</article><!-- #post-## -->
