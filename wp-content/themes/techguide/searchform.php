<?php
/**
 * The template for displaying search form.
 *
 * @package Techguide
 */

$btn_classes = apply_filters( 'techguide_search_form_btn_classes', 'btn btn-primary btn-lg' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-form__inner">
		<div class="search-form__input-wrap">
			<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'techguide' ) ?></span>
			<input type="search" class="search-form__field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'techguide' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'techguide' ) ?>" />
		</div>
		<button type="submit" class="search-form__submit <?php echo esc_attr( $btn_classes ); ?>"><?php esc_html_e( 'Search', 'techguide' ); ?></button>
	</div>
</form>
