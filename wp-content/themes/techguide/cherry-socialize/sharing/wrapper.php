<?php
/**
 * Template part to display wrapper for sharing buttons.
 *
 * @package Cherry_Socialize
 */
?>
<div class="<?php echo esc_attr( join( ' ', $classes ) ); ?>">
	<?php
		if ( isset( $config['before-html'] ) ) :
			echo wp_kses_post( $config['before-html'] );
		endif;
	?>
	<ul class="<?php echo esc_attr( $config['base_class'] ); ?>__list"><?php echo wp_kses_post( $share_buttons ); ?></ul>
</div>
