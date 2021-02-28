<?php
/**
 * The base template.
 *
 * @package Techguide
 */

get_header( techguide_template_base() ); ?>

	<div <?php techguide_content_wrap_class(); ?>>

		<div class="row">

			<div id="primary" <?php techguide_primary_content_class(); ?>>

				<main id="main" class="site-main card-wrapper" role="main">
					
					<?php techguide_site_breadcrumbs(); ?>

					<?php include techguide_template_path(); ?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_sidebar(); // Loads the sidebar.php. ?>

		</div><!-- .row -->

	</div><!-- .site-content__wrap -->

<?php get_footer( techguide_template_base() );
