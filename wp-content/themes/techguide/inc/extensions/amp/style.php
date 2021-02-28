<?php
/**
 * Additional AMP style
 *
 * @package Techguide
 */

/**
 * Vars
 */
$footer_bg    = techguide_get_mod( 'footer_bg' );
$footer_color = techguide_get_mod( 'footer_text_color' );
?>

/* Techguide Custom AMP Style */
.amp-site-title {
	font-size: 2em;
	font-weight: 700;
}

.amp-wp-header,
.amp-wp-article-featured-image {
	text-align: center;
}

.amp-wp-footer {
	font-size: 12px;
	background-color: <?php echo esc_attr( $footer_bg ); ?>;
	color: <?php echo esc_attr( $footer_color ); ?>;
}

.amp-wp-footer > div{
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	align-items: center;
}

.amp-wp-footer .footer-copyright{
	margin: 0 10px 0 0;
	padding: 0;
	max-width: inherit;
}

.back-to-top {
	position: static;
	font-family: inherit;
	font-size: inherit;
	line-height: inherit;
	text-transform: uppercase;
}

.back-to-top:hover,
.back-to-top:focus {
	color: <?php echo esc_attr( $footer_color ); ?>;
	text-decoration: underline;
}
