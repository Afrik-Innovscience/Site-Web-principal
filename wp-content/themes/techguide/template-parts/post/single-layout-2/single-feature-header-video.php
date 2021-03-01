<?php
/**
 * Template part for displaying featured-header the single posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

while ( have_posts() ) : the_post(); ?>

	<div class="single-featured-header">

		<div class="post-featured-content"><?php
			techguide_get_post_format_video( array(
				'width'            => 800,
				'height'           => 500,
				'popup'            => true,
				'overlay_img_size' => 'techguide-thumb-xxl',
				'echo'             => true,
			) );
		?></div><!-- .post-featured-content -->

		<div <?php echo techguide_get_container_classes( array( 'single-featured-header__container' ), 'content' ) ?>>
			<div class="single-featured-header__meta-box invert">
				<div class="entry-meta entry-meta-top"><?php
					techguide_get_template_part( 'template-parts/post/post-meta/meta-categories' );
					techguide_get_template_part( 'template-parts/post/post-meta/meta-rating' );
					techguide_get_template_part( 'template-parts/post/post-meta/meta-reading-time' );
				?></div><!-- .entry-meta -->

				<header class="entry-header">
					<?php techguide_get_template_part( 'template-parts/post/post-components/post-title' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-meta entry-meta-main"><?php
					techguide_get_template_part( 'template-parts/post/post-meta/meta-author' );
					techguide_get_template_part( 'template-parts/post/post-meta/meta-date' );
					techguide_get_template_part( 'template-parts/post/post-meta/meta-view' );
					techguide_get_template_part( 'template-parts/post/post-meta/meta-comments' );
				?></div><!-- .entry-meta -->
			</div>
		</div>

	</div><!-- .single-featured-header -->

<?php endwhile;
