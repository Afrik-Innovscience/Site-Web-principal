<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Techguide
 */
?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo"><?php
			if ( ! function_exists( 'jet_theme_core' ) || ! method_exists( jet_theme_core()->locations, 'do_location' ) || ! jet_theme_core()->locations->do_location( 'footer' ) ) {
				techguide_get_template_part( 'template-parts/footer' );
			}
		?></footer><!-- #colophon -->
	</div><!-- .site-inner -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
