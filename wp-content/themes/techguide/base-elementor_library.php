<?php
/**
 * The base template for Full Width Page Template.
 *
 * @package Techguide
 */

get_header( techguide_template_base() ); ?>

	<?php techguide_site_breadcrumbs(); ?>

	<div class="site-content__wrap">

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
