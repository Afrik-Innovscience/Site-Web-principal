<?php
/**
 * Represents the view for the `Cherry Trending Posts` widget.
 *
 * @package   Cherry_Trending_Posts
 * @author    Template Monster
 * @license   GPL-3.0+
 * @copyright 2012 - 2016, Template Monster
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} ?>

<?php
$allowed_rating_html = array(
	'div' => array(
		'data-post'   => true,
		'data-format' => true,
	),
	'span' => array(
		'data-rate' => true,
	),
);
$allowed_view_html = array(
	'span' => array(
		'data-id' => true,
	),
);
$allowed_date_html = array(
	'time' => array(
		'datetime' => true,
	),
);
?>

<?php techguide_remove_elementor_content_filter(); ?>

<div class="cherry-trend-widget-list__item cherry-trend-post">
	<?php echo wp_kses_post( $image ); ?>

	<div class="cherry-trend-post__content-wrapper">
		<div class="cherry-trend-post__meta entry-meta entry-meta-top"><?php
			echo wp_kses_post( $category );
			echo wp_kses( $rating, techguide_kses_post_allowed_html( $allowed_rating_html ) );
			echo wp_kses( $view, techguide_kses_post_allowed_html( $allowed_view_html ) );
		?></div>

		<div class="cherry-trend-post__header">
			<?php echo '<h6 class="cherry-trend-post__title">' . $title . '</h6>'; ?>
		</div>

		<div class="cherry-trend-post__meta entry-meta entry-meta-main"><?php
			echo wp_kses_post( $author );
			echo wp_kses( $date, techguide_kses_post_allowed_html( $allowed_date_html ) );
			echo wp_kses_post( $comments );
		?></div>

		<div class="cherry-trend-post__content">
			<?php echo wp_kses_post( $this->utility->attributes->get_content( $excerpt_args ) ); ?>
		</div>

		<?php echo wp_kses_post( $tag ); ?>
		<?php echo wp_kses_post( $button ); ?>
	</div>
</div>

<?php techguide_add_elementor_content_filter(); ?>
