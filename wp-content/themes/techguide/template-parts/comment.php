<?php
/**
 * The template for displaying comments.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy
 *
 * @package Techguide
 */
?>
<div class="comment-author vcard">
	<?php echo techguide_comment_author_avatar(); ?>
</div>
<div class="comment-content-wrap">
	<footer class="comment-meta">
		<?php echo techguide_get_comment_author_link(); ?>
		<?php echo techguide_get_comment_date( array(
			'human_time' => true,
		) ); ?>
	</footer>
	<div class="comment-content">
		<?php echo techguide_get_comment_text(); ?>
	</div>
	<div class="reply"><?php
		echo techguide_get_comment_reply_link( array(
			'reply_text' => '<i class="mdi mdi-reply"></i>' . esc_html__( 'Reply', 'techguide' ),
		) );
	?></div>
</div>
