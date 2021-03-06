<?php
/**
 * Template part for displaying featured-header the single posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */
?>
<div class="single-featured-header card-wrapper">

	<div class="entry-meta entry-meta-top"><?php
		techguide_get_template_part( 'template-parts/post/post-meta/meta-categories' );
		techguide_get_template_part( 'template-parts/post/post-meta/meta-rating' );
		techguide_get_template_part( 'template-parts/post/post-meta/meta-reading-time' );
	?></div><!-- .entry-meta -->

	<header class="entry-header">
		<?php techguide_get_template_part( 'template-parts/post/post-components/post-title' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-meta entry-meta-main"><?php
		techguide_get_template_part( 'template-parts/post/post-meta/meta-date' );
		techguide_get_template_part( 'template-parts/post/post-meta/meta-view' );
		techguide_get_template_part( 'template-parts/post/post-meta/meta-comments' );
	?></div><!-- .entry-meta -->

	<?php $size = techguide_post_thumbnail_size();

		do_action( 'cherry_post_format_image', array(
			'size' => $size['size'],
		) );
	?><!-- .post-thumbnail -->

</div><!-- .single-featured-header -->
