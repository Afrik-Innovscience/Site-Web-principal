<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Techguide
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php techguide_get_page_preloader(); ?>
<div id="page" <?php techguide_site_class(); ?>>
	<div class="site-inner">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'techguide' ); ?></a>
		<header id="masthead" class="site-header" role="banner">
			<?php techguide_ads_header(); ?>

			<?php
			if ( ! function_exists( 'jet_theme_core' ) || ! method_exists( jet_theme_core()->locations, 'do_location' ) || ! jet_theme_core()->locations->do_location( 'header' ) ) {
				techguide_get_template_part( 'template-parts/header' );
			}
			?>
		</header><!-- #masthead -->

		<div id="content" <?php techguide_content_class(); ?>>
