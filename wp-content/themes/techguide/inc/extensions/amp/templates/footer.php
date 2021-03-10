<?php
/**
 * Footer template part.
 *
 * @package Techguide
 */

/**
 * Context.
 *
 * @var AMP_Post_Template $this
 */
?>
<footer class="amp-wp-footer">
	<div>
		<?php techguide_get_default_footer_copyright(); ?>
		<a href="#top" class="back-to-top"><?php esc_html_e( 'Back to top', 'techguide' ); ?></a>
	</div>
</footer>
