<?php
/**
 * Template part for default header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

?>
<div <?php techguide_header_container_class(); ?>>
	<div class="container">
		<div class="header-container__flex">
			<div class="site-branding">
				<?php techguide_header_logo() ?>
				<?php techguide_site_description(); ?>
			</div>

			<?php techguide_main_menu(); ?>
		</div>
	</div>
</div><!-- .header-container -->
