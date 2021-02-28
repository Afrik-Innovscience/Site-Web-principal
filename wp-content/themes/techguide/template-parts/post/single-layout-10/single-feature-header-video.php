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
		<div <?php echo techguide_get_container_classes( array( 'single-featured-header__container' ), 'content' ) ?>>
			<div class="row">
				<div class="col-xs-12 col-xl-10 col-xl-push-1">
					<header class="entry-header">
						<?php techguide_get_template_part( 'template-parts/post/post-components/post-title' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-meta entry-meta-top"><?php
						techguide_get_template_part( 'template-parts/post/post-meta/meta-categories' );
						techguide_get_template_part( 'template-parts/post/post-meta/meta-rating' );
						techguide_get_template_part( 'template-parts/post/post-meta/meta-reading-time' );
					?></div><!-- .entry-meta -->
				</div>
			</div>
		</div>

		<div class="post-featured-content"><?php
			techguide_get_post_format_video( array(
				'width'            => 800,
				'height'           => 500,
				'popup'            => true,
				'overlay_img_size' => 'techguide-thumb-xxl',
				'echo'             => true,
			) );
		?></div><!-- .post-featured-content -->
	</div><!-- .single-featured-header -->

<?php endwhile;
