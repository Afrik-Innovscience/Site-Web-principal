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
					<div class="entry-meta entry-meta-top"><?php
						techguide_get_template_part( 'template-parts/post/post-meta/meta-categories' );
						techguide_get_template_part( 'template-parts/post/post-meta/meta-rating' );
						techguide_get_template_part( 'template-parts/post/post-meta/meta-reading-time' );
					?></div><!-- .entry-meta -->

					<header class="entry-header">
						<?php techguide_get_template_part( 'template-parts/post/post-components/post-title' ); ?>
					</header><!-- .entry-header -->

					<?php techguide_get_template_part( 'template-parts/post/post-meta/meta-author' ); ?>

					<div class="entry-meta entry-meta-main"><?php
						techguide_get_template_part( 'template-parts/post/post-meta/meta-date' );
						techguide_get_template_part( 'template-parts/post/post-meta/meta-view' );
						techguide_get_template_part( 'template-parts/post/post-meta/meta-comments' );
					?></div><!-- .entry-meta -->
				</div>
			</div>
		</div>

		<figure class="post-thumbnail"><?php
			techguide_utility()->utility->media->get_image( array(
				'size'        => 'techguide-thumb-xxl',
				'mobile_size' => 'techguide-thumb-xxl',
				'html'        => '<img class="post-thumbnail__img wp-post-image" src="%3$s" alt="%4$s" %5$s>',
				'placeholder' => false,
				'echo'        => true,
			) );
		?></figure><!-- .post-thumbnail -->

	</div><!-- .single-featured-header -->

<?php endwhile;
