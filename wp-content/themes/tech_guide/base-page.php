<?php
/**
 * The base template for displaying all pages.
 *
 * @package Techguide
 */

get_header( techguide_template_base() ); ?>

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
