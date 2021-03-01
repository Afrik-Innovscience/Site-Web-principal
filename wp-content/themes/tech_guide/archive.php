<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

if ( have_posts() ) : ?>

	<header class="page-header"><?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="taxonomy-description">', '</div>' );

		if ( is_author() ) :
			do_action( 'cherry_socialize_display_user_social_links' );
		endif;

	?></header><!-- .page-header -->

	<div <?php techguide_posts_list_class(); ?>>

		<?php techguide_remove_elementor_content_filter(); ?>

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */

			$template_slugs = array(
				'template-parts/post/' . techguide_get_mod( 'blog_layout_type' ) . '/content',
				'template-parts/post/content',
			);

			techguide_get_template_part( $template_slugs, get_post_format() );

		endwhile; ?>

		<?php techguide_add_elementor_content_filter(); ?>

	</div><!-- .posts-list -->

	<?php techguide_get_template_part( 'template-parts/content-pagination', techguide_get_mod( 'blog_pagination_type' ) );

else :

	techguide_get_template_part( 'template-parts/content', 'none' );

endif;
