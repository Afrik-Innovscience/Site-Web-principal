<?php
/**
 * Template part to display about author widget content.
 *
 * @package Techguide
 * @subpackage widgets
 */
?>
<div class="about-author"><?php
	echo wp_kses_post( $this->get_author_avatar() );
	?><div class="about-author_content"><?php
		echo wp_kses_post( $this->get_author_name() );
		echo wp_kses_post( $this->get_author_description() );
		echo wp_kses_post( $this->get_author_button() );
	?></div>
</div>
