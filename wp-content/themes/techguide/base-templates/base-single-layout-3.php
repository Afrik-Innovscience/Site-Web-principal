<?php
/**
 * The base template for displaying layout-3 single posts.
 *
 * @package Techguide
 */

get_header( techguide_template_base() ); ?>

	<?php techguide_site_breadcrumbs(); ?>
	<?php techguide_get_template_part( 'template-parts/post/single-layout-3/single-feature-header', get_post_format() ) ?>

	<div <?php techguide_content_wrap_class(); ?>>

		<div class="row">

			<div id="primary" <?php techguide_primary_content_class(); ?>>

				<main id="main" class="site-main" role="main">

					<?php include techguide_template_path(); ?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_sidebar(); // Loads the sidebar.php. ?>

		</div><!-- .row -->

	</div><!-- .site-content__wrap -->

<?php get_footer( techguide_template_base() );
