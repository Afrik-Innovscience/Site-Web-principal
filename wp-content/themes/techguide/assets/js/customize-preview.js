/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-logo--text .site-logo__link' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Sticky icon
	wp.customize( 'blog_sticky_icon', function( value ) {
		value.bind( function( to ) {
			$( '.sticky__label i' ).attr( 'class', 'fa ' + to );
		});
	} );

	// Sticky label
	wp.customize( 'blog_sticky_label', function( value ) {
		value.bind( function( to ) {
			$( '.sticky__label-text' ).text( to );
		});
	} );

	// Blog read more text
	wp.customize( 'blog_read_more_text', function( value ) {
		value.bind( function( to ) {
			$( '.post__button .btn__text' ).text( to );
		});
	} );

	// Related posts block title
	wp.customize( 'related_posts_block_title', function( value ) {
		value.bind( function( to ) {
			$( '.related-posts__title' ).text( to );
		});
	} );

} )( jQuery );
