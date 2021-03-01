<?php
/**
 * Header bar template part.
 *
 * @package Techguide
 */

?>
<header id="top" class="amp-wp-header">
	<div>
		<a href="<?php echo esc_url( $this->get( 'home_url' ) ); ?>">
			<?php $amp_logo = get_theme_mod( 'amp_custom_logo' ); ?>
			<?php if ( $amp_logo ) : ?>
					<?php $logo_src = wp_get_attachment_image_src( $amp_logo, 'full' ); ?>
					<amp-img src="<?php echo esc_url( $logo_src[0] ); ?>" width="<?php echo esc_attr( $logo_src[1] ); ?>" height="<?php echo esc_attr( $logo_src[2] ); ?>" class="amp-site-logo"></amp-img>
				<?php else : ?>
					<span class="amp-site-title">
						<?php echo esc_html( wptexturize( $this->get( 'blog_name' ) ) ); ?>
					</span>
			<?php endif; ?>
		</a>
	</div>
</header>
