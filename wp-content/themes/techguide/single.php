<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Techguide
 */
while ( have_posts() ) : the_post(); ?>

	<div class="card-wrapper"><?php
		techguide_site_breadcrumbs();
		techguide_get_template_part( 'template-parts/post/single/content-single', get_post_format() );
		techguide_get_template_part( 'template-parts/content', 'post-navigation' );
	?></div>

	<?php
	techguide_post_author_bio();
	techguide_related_posts();

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.