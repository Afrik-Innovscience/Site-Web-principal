<?php
/**
 * The template part for displaying results in search pages.
 *
 * @package Techguide
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card' ); ?>>

	<?php $utility = techguide_utility()->utility; ?>

	<div class="post-list__item-content">

		<header class="entry-header"><?php
			$utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => '<h4 %1$s><a href="%2$s" rel="bookmark">%4$s</a></h4>',
				'echo'  => true,
			) );
		?></header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

	</div><!-- .post-list__item-content -->

	<footer class="entry-footer"><?php
		$utility->attributes->get_button( array(
			'class' => 'btn btn-primary',
			'text'  => esc_html__( 'Read more', 'techguide' ),
			'html'  => '<a href="%1$s" %3$s><span class="btn__text">%4$s</span>%5$s</a>',
			'echo'  => true,
		) );
	?></footer><!-- .entry-footer -->

</article><!-- #post-## -->
