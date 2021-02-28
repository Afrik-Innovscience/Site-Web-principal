<?php
/**
 * The template for displaying related post.
 *
 * @link       https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package    Techguide
 * @subpackage single-post
 */
?>
<article class="<?php echo esc_attr( $related_classes ); ?>">
	<div class="related-post__inner">
		<figure class="related-post__thumb post-thumbnail"><?php
			echo wp_kses_post( $image );
		?></figure>
		<div class="related-post__content">
			<header class="entry-header"><?php
				echo wp_kses_post( $title );
			?></header>
			<div class="entry-meta"><?php
				echo wp_kses_post( $author );
				echo wp_kses_post( $date );
				echo wp_kses_post( $comment_count );
			?></div>
			<div class="entry-content"><?php
				echo wp_kses_post( $excerpt );
			?></div>
		</div>
	</div>
</article><!--.related-post-->
