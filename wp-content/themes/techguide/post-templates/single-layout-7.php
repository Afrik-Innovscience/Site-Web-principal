<?php
/**
 * Template Name: Post Layout 07
 * Template Post Type: post
 *
 * The template for displaying layout 7 single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Techguide
 */

$layout_classes = array(
	'content'    => ( 'fullwidth' === techguide_get_mod( 'sidebar_position' ) ) ? array( 'col-xs-12', 'col-lg-8' ) : array( 'col-xs-12' ),
	'author-box' => ( 'fullwidth' === techguide_get_mod( 'sidebar_position' ) ) ? array( 'col-xs-12', 'col-lg-4' ) : array( 'col-xs-12' ),
);

while ( have_posts() ) : the_post(); ?>
	<div class="row">
		<div class="single-author-box-wrapper <?php echo join( ' ', $layout_classes['author-box'] ); ?>"><?php
			techguide_get_template_part( 'template-parts/post/single-layout-7/single-author-box', get_post_format() );
		?></div>

		<div class="single-post-wrapper <?php echo join( ' ', $layout_classes['content'] ); ?>">
			<?php techguide_get_template_part( 'template-parts/post/single-layout-7/single-feature-header', get_post_format() ); ?>

			<div class="card-wrapper"><?php
				techguide_get_template_part( 'template-parts/post/single-layout-7/content-single', get_post_format() );
				techguide_get_template_part( 'template-parts/content', 'post-navigation' );
			?></div>

			<?php
			techguide_post_author_bio();
			techguide_related_posts();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; ?>
		</div>
	</div>
<?php endwhile; // End of the loop.
