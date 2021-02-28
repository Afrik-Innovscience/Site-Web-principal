<?php
/**
 * Thumbnails configuration.
 *
 * @package Techguide
 */

add_action( 'after_setup_theme', 'techguide_register_image_sizes', 5 );
/**
 * Register image sizes.
 */
function techguide_register_image_sizes() {
	set_post_thumbnail_size( 370, 260, true );

	// Registers a new image sizes.
	add_image_size( 'techguide-thumb-s', 275, 195, true );    // default small-img, timeline listing
	add_image_size( 'techguide-thumb-m', 550, 385, true );    // default small-img, timeline listing // mobile
	add_image_size( 'techguide-thumb-l', 770, 540, true );    // default listing
	add_image_size( 'techguide-thumb-l-2', 770, 260, true );  // justify listing
	add_image_size( 'techguide-thumb-xl', 1170, 540, true );  // default listing + full-width
	add_image_size( 'techguide-thumb-xxl', 1920, 550, true ); // single full-width

	add_image_size( 'techguide-thumb-masonry', 370, 9999 );           // masonry listing
	add_image_size( 'techguide-author-avatar', 512, 512, true ); // Widget Author bio

	add_image_size( 'techguide-thumb-110-78', 110, 78, true );   // Jet-Blog
	add_image_size( 'techguide-thumb-216-152', 216, 152, true ); // Jet-Blog
	add_image_size( 'techguide-thumb-240-170', 240, 170, true ); // Jet-Blog
	add_image_size( 'techguide-thumb-310-310', 310, 310, true ); // Jet-Blog
	add_image_size( 'techguide-thumb-340-240', 340, 240, true ); // Jet-Blog
	add_image_size( 'techguide-thumb-340-372', 340, 372, true ); // Jet-Blog
	add_image_size( 'techguide-thumb-710-325', 710, 325, true ); // Jet-Blog


	add_image_size( 'techguide-thumb-wishlist', 230, 230, true );
	add_image_size( 'techguide-thumb-370-340', 370, 340, true );
	add_image_size( 'techguide-thumb-listing-line-product', 360, 360, true );
}
