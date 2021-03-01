<?php
/**
 * Template Name: Techguide Full Width for Page Builders
 *
 * The template for displaying Page Builders pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

while ( have_posts() ) : the_post();

	techguide_get_template_part( 'template-parts/page/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) : ?>
		<div class="container">
			<?php comments_template(); ?>
		</div><?php
	endif;
endwhile; // End of the loop.
