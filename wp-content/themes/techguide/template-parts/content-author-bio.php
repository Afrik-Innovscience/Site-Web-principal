<?php
/**
 * The template for displaying author bio.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Techguide
 */

if ( ! get_the_author_meta( 'description' ) ) {
	return;
}
?>
<div class="post-author-bio">
	<h4 class="post-author-bio__title"><?php esc_html_e( 'Author', 'techguide' ); ?></h4>
	<div class="post-author__holder clear">
		<div class="post-author__avatar"><?php
			echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'techguide_author_bio_avatar_size', 140 ), '', esc_attr( get_the_author_meta( 'nickname' ) ) );
		?></div>
		<div class="post-author__content">
			<h5 class="post-author__title"><?php the_author_posts_link(); ?></h5>
			<div class="post-author__description"><?php
				echo get_the_author_meta( 'description' );
			?></div>
			<?php do_action( 'cherry_socialize_display_user_social_links' ); ?>
		</div>
	</div>
</div><!--.post-author-bio-->
