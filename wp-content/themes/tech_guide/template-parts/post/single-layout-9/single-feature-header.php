<?php
/**
 * Template part for displaying featured-header the single posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

$additional_class = techguide_get_mod( 'single_post_author' ) ? ' author-meta-visible' : '';

while ( have_posts() ) : the_post(); ?>

	<div class="single-featured-header<?php echo esc_attr( $additional_class ); ?>">
		<div class="single-featured-header__inner-wrap invert">
			<div <?php echo techguide_get_container_classes( array( 'single-featured-header__container' ), 'content' ) ?>>
				<div class="row">
					<div class="col-xs-12 col-xl-10 col-xl-push-1">
						<?php techguide_get_template_part( 'template-parts/post/post-meta/meta-author' ); ?>

						<div class="entry-meta entry-meta-top"><?php
							techguide_get_template_part( 'template-parts/post/post-meta/meta-categories' );
							techguide_get_template_part( 'template-parts/post/post-meta/meta-rating' );
							techguide_get_template_part( 'template-parts/post/post-meta/meta-reading-time' );
						?></div><!-- .entry-meta -->

						<header class="entry-header">
							<?php techguide_get_template_part( 'template-parts/post/post-components/post-title' ); ?>
						</header><!-- .entry-header -->

						<div class="entry-meta entry-meta-main"><?php
							techguide_get_template_part( 'template-parts/post/post-meta/meta-date' );
							techguide_get_template_part( 'template-parts/post/post-meta/meta-view' );
							techguide_get_template_part( 'template-parts/post/post-meta/meta-comments' );
						?></div><!-- .entry-meta -->
					</div>
				</div>
			</div>
		</div>
	</div><!-- .single-featured-header -->

<?php endwhile;
