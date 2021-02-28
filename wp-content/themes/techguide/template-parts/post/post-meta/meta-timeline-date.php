<?php
/**
 * Template part for displaying post publish date.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Techguide
 */

if ( 'timeline' !== techguide_get_mod( 'blog_layout_type' ) ) {
	return;
}

if ( 'post' === get_post_type() ) :
	$utility = techguide_utility()->utility;

	$next_post = get_next_post();

	if ( ! $next_post || get_the_date( 'm Y', $next_post->ID ) !== get_the_date( 'm Y' ) ) {
		printf( '<h4 class="posts-list__new-date"><time datetime="%1$s">%2$s</time></h4>', get_the_date( 'Y-m' ), get_the_date( 'F, Y' ) );
	}

	$day   = get_the_date( 'd' );
	$month = get_the_date( 'M' );
	$time  = get_the_time( 'g:i a' );

	$html = '<div class="post-timeline-date">
				<a href="%2$s" %3$s %4$s>
					<time datetime="%5$s">
						<span class="post-timeline-date__date"><span class="post-timeline-date__day">' . $day . '</span>' . $month . '</span>
						<span class="post-timeline-date__time">' . $time . '</span>
					</time>
				</a>
			</div><!-- .post-timeline-date -->';

	$utility->meta_data->get_date( array(
		'visible' => true,
		'html'    => $html,
		'class'   => 'post-timeline-date__link',
		'echo'    => true,
	) );

endif;
