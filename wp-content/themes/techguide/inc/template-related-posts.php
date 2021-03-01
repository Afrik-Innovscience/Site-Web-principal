<?php
/**
 * Related Posts Template Functions.
 *
 * @package Techguide
 */

if ( ! class_exists( 'Techguide_Related_Posts' ) ) {

	class Techguide_Related_Posts {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Settings properties.
		 *
		 * @var array
		 */
		public $settings = array();

		/**
		 * Constructor for the class.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			if ( ! is_singular( 'post' ) ) {
				return;
			}

			$this->set_settings();

			if ( ! $this->get_setting( 'visible' ) ) {
				return;
			}

			$this->build_html();
		}

		/**
		 * Set settings from customize options.
		 */
		public function set_settings() {

			$settings = apply_filters( 'techguide_related_post_settings_map', array(
				'visible'        => 'related_posts_visible',
				'block_title'    => 'related_posts_block_title',
				'query_type'     => 'related_posts_query_type',
				'posts_count'    => 'related_posts_count',
				'layout_columns' => 'related_posts_grid',
				'title_length'   => 'related_posts_title_length',
				'content_type'   => 'related_posts_content',
				'content_length' => 'related_posts_content_length',
				'author_visible' => 'related_posts_author',
				'date_visible'   => 'related_posts_publish_date',
				'comment_count'  => 'related_posts_comment_count',
			) );

			foreach ( $settings as $setting_key => $setting_value ) {
				$this->settings[ $setting_key ] = techguide_get_mod( $setting_value );
			}
		}

		/**
		 * Get setting value.
		 *
		 * @param string $setting Setting name.
		 *
		 * @return mixed
		 */
		public function get_setting( $setting = null ) {

			if ( ! isset( $this->settings[ $setting ] ) ) {
				return null;
			}

			return $this->settings[ $setting ];
		}

		/**
		 * Build the related posts html.
		 */
		public function build_html() {
			$wrapper_view_dir = techguide_get_locate_template( 'template-parts/related-posts/wrapper.php' );

			if ( ! $wrapper_view_dir ) {
				return;
			}

			$block_title_format = apply_filters( 'techguide_related_posts_block_title_format', '<h4 class="related-posts__title">%s</h4>' );
			$block_title        = ( $this->get_setting( 'block_title' ) ) ? sprintf( $block_title_format, $this->get_setting( 'block_title' ) ) : '';

			global $post;

			$post_obj   = get_post( $post );
			$query_type = $this->get_setting( 'query_type' );
			$terms      = get_the_terms( $post_obj, $query_type );

			// Get related posts html
			$related_posts = '';

			if ( $terms ) {
				$related_post_terms = wp_list_pluck( $terms, 'term_id' );
				$related_sort_key   = ( 'category' === $query_type ) ? 'category__in' : 'tag__in';

				$related_posts = $this->get_query_items( array( $related_sort_key => $related_post_terms ), 'related-query' );
			}

			// Get author posts html
			$author_posts = $this->get_query_items( array( 'author' => $post->post_author ), 'author-query' );

			if ( ! $related_posts && ! $author_posts ) {
				return;
			}

			$start_tab = $related_posts ? 'related-query' : 'author-query';

			if ( ! $related_posts ) {
				$related_posts = sprintf( '<p class="no-posts col-xs-12">%1$s</p>', esc_html__( 'No related posts.', 'techguide' ) );
			}

			if ( ! $author_posts ) {
				$author_posts = sprintf( '<p class="no-posts col-xs-12">%1$s</p>', esc_html__( 'No more post this author.', 'techguide' ) );
			}

			include $wrapper_view_dir;
		}

		/**
		 * Get query items.
		 *
		 * @param array $query_args  Query arguments.
		 * @param null  $extra_class Extra css class.
		 *
		 * @return bool|string
		 */
		public function get_query_items( $query_args = array(), $extra_class = null ) {

			global $post;

			$default_query_args = array(
				'post_type'    => 'post',
				'numberposts'  => (int) $this->get_setting( 'posts_count' ),
				'post__not_in' => array( $post->ID ),
			);

			$query_args = wp_parse_args( $query_args, $default_query_args );

			$posts = get_posts( $query_args );

			if ( ! $posts ) {
				return false;
			}

			$item_view_dir = techguide_get_locate_template( 'template-parts/related-posts/item.php' );

			if ( ! $item_view_dir ) {
				return false;
			}

			$utility = techguide_utility()->utility;

			$content_visible = ( 0 === $this->get_setting( 'content_length' ) || 'hide' === $this->get_setting( 'content_type' ) ) ? false : true;
			$grid_columns    = (int) 12 / $this->get_setting( 'layout_columns' );

			ob_start();

			techguide_remove_elementor_content_filter();

			foreach ( $posts as $post ) {
				setup_postdata( $post );

				$related_classes = array( 'related-post', 'col-xs-12', 'col-md-6' );
				$related_classes[] = 'col-xl-' . $grid_columns;

				if ( $extra_class ) {
					$related_classes[] = $extra_class;
				}

				$related_classes[] = has_post_thumbnail() ? 'has-thumb' : 'no-thumb';

				$related_classes = join( ' ', $related_classes );

				$image = $utility->media->get_image( apply_filters( 'techguide_related_post_image_settings', array(
					'class'       => 'post-thumbnail__img',
					'html'        => '<a href="%1$s" class="post-thumbnail__link"><img src="%3$s" alt="%4$s" %2$s %5$s></a>',
					'size'        => 'post-thumbnail',
					'mobile_size' => 'post-thumbnail',
					'placeholder' => false,
				) ) );

				$title = $utility->attributes->get_title( apply_filters( 'techguide_related_post_title_settings', array(
					'length' => $this->get_setting( 'title_length' ),
					'class'  => 'entry-title',
					'html'   => '<h6 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h6>',
				) ) );

				$author = $utility->meta_data->get_author( apply_filters( 'techguide_related_post_author_settings', array(
					'visible' => $this->get_setting( 'author_visible' ),
					'class'   => 'posted-by__author fn',
					'icon'    => '<i class="mdi mdi-account"></i>',
					'html'    => '<span class="posted-by vcard">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></span>',
				) ) );

				$human_time        = apply_filters( 'techguide_related_post_date_human_time', true );
				$human_time_suffix = $human_time ? esc_html__( ' ago', 'techguide' ) : '';

				$date = $utility->meta_data->get_date( apply_filters( 'techguide_related_post_date_settings', array(
					'visible'    => $this->get_setting( 'date_visible' ),
					'icon'       => '<i class="mdi mdi-calendar-clock"></i>',
					'human_time' => $human_time,
					'html'       => '<span class="post__date">%1$s<a href="%2$s" %3$s %4$s ><time datetime="%5$s">%6$s%7$s' . $human_time_suffix . '</time></a></span>',
					'class'      => 'post__date-link',
				) ) );

				$comment_count = $utility->meta_data->get_comment_count( apply_filters( 'techguide_related_post_comment_count_settings', array(
					'visible' => $this->get_setting( 'comment_count' ),
					'icon'    => '<i class="mdi mdi-comment"></i>',
					'html'    => '<span class="post__comments">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></span>',
					'class'   => 'post__comments-link',
				) ) );

				$excerpt = $utility->attributes->get_content( apply_filters( 'techguide_related_post_excerpt_settings', array(
					'visible'      => $content_visible,
					'length'       => $this->get_setting( 'content_length' ),
					'content_type' => $this->get_setting( 'content_type' ),
				) ) );

				include $item_view_dir;

			} // End foreach().

			wp_reset_postdata();

			techguide_add_elementor_content_filter();

			return ob_get_clean();
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
} // End if().

/**
 * Returns instance of Techguide_Related_Posts class.
 *
 * @since  1.0.0
 * @return object
 */
function techguide_related_posts() {
	return Techguide_Related_Posts::get_instance();
}
