<?php
/**
 * Template part to display sharing button.
 *
 * @package Cherry_Socialize
 */

if ( function_exists( 'techguide_is_available_sharing_network_item' ) && ! techguide_is_available_sharing_network_item( $id ) ) {
	return;
}
?>

<li class="<?php echo esc_attr( $config['base_class'] ); ?>__item">
	<a class="<?php echo esc_attr( $config['base_class'] ); ?>__link" href="<?php echo htmlentities( $share_url ); ?>" target="_blank" rel="nofollow" title="<?php printf( esc_html__( 'Share on %s', 'techguide' ), esc_attr( $network['name'] ) ); ?>">
		<span class="<?php echo esc_attr( $config['base_class'] ); ?>__link-text"><?php echo wp_kses_post( $network['name'] ); ?></span>
	</a>
</li>
