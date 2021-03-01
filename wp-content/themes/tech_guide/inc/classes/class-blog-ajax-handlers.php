<?php
/**
 * Blog Ajax Handlers.
 *
 * @package Techguide
 */

if ( ! class_exists( 'Techguide_Blog_Ajax_Handlers' ) ) {

	/**
	 * Class Techguide_Blog_Ajax_Handlers.
	 */
	class Techguide_Blog_Ajax_Handlers {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Button texts.
		 *
		 * @since 1.0.0
		 * @var array
		 */
		public $button_texts = array();

		/**
		 * Count of the loaded post.
		 *
		 * @since 1.0.0
		 * @var int
		 */
		private $post_count = 0;

		/**
		 * Constructor for the class.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->button_texts = apply_filters( 'techguide_load_more_button_labels', array(
				'default' => esc_html__( 'Load More', 'techguide' ),
				'loading' => esc_html__( 'Loading...', 'techguide' ),
				'none'    => esc_html__( 'No More Posts', 'techguide' ),
			) );

			add_filter( 'techguide_theme_script_variables', array( $this, 'add_ajax_vars' ) );
			add_filter( 'techguide_queried_object_id',      array( $this, 'maybe_set_queried_object' ) );
			add_filter( 'post_class',                      array( $this, 'post_ajax_load_classes' ) );

			$this->ld_switcher_theme_mods_filters();
			$this->add_theme_mods_filters();

			add_action( 'wp_ajax_techguide_get_blog_listing_posts',        array( $this, 'get_blog_listing_posts' ) );
			add_action( 'wp_ajax_nopriv_techguide_get_blog_listing_posts', array( $this, 'get_blog_listing_posts' ) );
		}

		/**
		 * Add new localize variables.
		 *
		 * @since 1.0.0
		 *
		 * @param array $vars Theme localize variables.
		 *
		 * @return array
		 */
		public function add_ajax_vars( $vars = array() ) {

			global $wp_query;

			$vars['load_more_args'] = array(
				'query_vars'           => json_encode( $wp_query->query_vars ),
				'current_page'         => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
				'max_page'             => intval( $wp_query->max_num_pages ),
				'blog_ajax_nonce'      => wp_create_nonce( 'techguide-blog-listing-ajax-load' ),
				'button_texts'         => $this->button_texts,
				'queried_object_id'    => get_queried_object_id(),
				'ld_switcher_settings' => $this->get_ld_switcher_overwrite_mods(),
				'is_category_or_tag'   => is_category() || is_tag(),
			);

			return $vars;
		}

		/**
		 * Try to set appropriate queried object ID.
		 *
		 * @since 1.0.0
		 *
		 * @param mixed $id Current object ID
		 *
		 * @return mixed
		 */
		public function maybe_set_queried_object( $id ) {
			if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
				return $id;
			}

			if ( ! isset( $_REQUEST['techguideQueryObjId'] ) ) {
				return $id;
			}

			return (int) $_REQUEST['techguideQueryObjId'];
		}

		/**
		 * Get query args.
		 *
		 * @since 1.0.0
		 * @return array
		 */
		public function get_query_args() {
			$args = array(
				'post_status' => 'publish',
			);

			if ( isset( $_REQUEST['techguideQueryVars'] ) ) {
				$args = array_merge( $args, json_decode( stripslashes( $_REQUEST['techguideQueryVars'] ), true ) );
			}

			if ( isset( $_REQUEST['techguidePage'] ) ) {
				$args['paged'] = $_REQUEST['techguidePage'] + 1;
			}

			if ( isset( $_REQUEST['techguidePerPage'] ) ) {
				$args['posts_per_page'] = $_REQUEST['techguidePerPage'];
			}

			return $args;
		}

		/**
		 * Get blog listing posts.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function get_blog_listing_posts() {
			if ( ! isset( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'techguide-blog-listing-ajax-load' ) ) {
				exit();
			}

			$args = $this->get_query_args();

			$posts_query = new WP_Query( $args );

			$has_gallery_post = false;
			$has_image_post   = false;

			ob_start();

			techguide_remove_elementor_content_filter();

			while ( $posts_query->have_posts() ) : $posts_query->the_post();

				$this->post_count ++;

				$template_slugs = array(
					'template-parts/post/' . techguide_get_mod( 'blog_layout_type' ) . '/content',
					'template-parts/post/content',
				);

				techguide_get_template_part( $template_slugs, get_post_format() );

				if ( 'gallery' === get_post_format() && ! $has_gallery_post ) {
					$has_gallery_post = true;
				}

				if ( 'image' === get_post_format() && ! $has_image_post ) {
					$has_image_post = true;
				}

			endwhile;

			techguide_add_elementor_content_filter();

			$this->post_count = 0;

			$this->print_dynamic_css_collector_style();

			wp_reset_postdata();

			$posts = ob_get_clean();

			wp_send_json_success( array(
				'posts'            => $posts,
				'has_media'        => $this->check_posts_has_media( $posts ),
				'has_gallery_post' => $has_gallery_post,
				'has_image_post'   => $has_image_post,
			) );
		}

		/**
		 * Enqueue media assets.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function enqueue_media_assets() {
			// for video, audio post formats
			wp_enqueue_style( 'wp-mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement-vimeo' );

			// for gallery, image post formats
			$post_formats_args = techguide_theme()->get_core()->modules['cherry-post-formats-api']->args;

			$post_formats_handles = array();

			$post_formats_handles[] = $post_formats_args['gallery_args']['slider_handle'];
			$post_formats_handles[] = $post_formats_args['gallery_args']['popup_handle'];
			$post_formats_handles[] = $post_formats_args['image_args']['popup_handle'];

			$handles = array_unique( $post_formats_handles );

			foreach ( $handles as $handle ) {
				wp_enqueue_script( $handle );
			}
		}

		/**
		 * Check content has media.
		 *
		 * @since 1.0.0
		 *
		 * @param $content
		 *
		 * @return bool
		 */
		public function check_posts_has_media( $content ) {
			$has_media = false;

			if ( false !== strpos( $content, '<video' ) || false !== strpos( $content, '<audio' ) ) {
				$has_media = true;
			}

			return $has_media;
		}

		/**
		 * Print dynamic css after ajax loading.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function print_dynamic_css_collector_style() {
			$dynamic_css = techguide_theme()->dynamic_css;

			add_filter( 'cherry_dynamic_css_collector_localize_object', array( $this, 'fix_preview_css' ) );
			$dynamic_css::$collector->print_style();
			remove_filter( 'cherry_dynamic_css_collector_localize_object', array( $this, 'fix_preview_css' ) );
		}

		/**
		 * Fix preview dynamic styles.
		 *
		 * @since 1.0.0
		 *
		 * @param array $data
		 *
		 * @return array
		 */
		public function fix_preview_css( $data = array() ) {

			if ( ! empty( $data['css'] ) ) {
				printf( '<style>%s</style>', html_entity_decode( $data['css'] ) );
			}

			return $data;
		}

		/**
		 * Post ajax load class.
		 *
		 * @since 1.0.0
		 *
		 * @param array $classes Post classes.
		 *
		 * @return array
		 */
		public function post_ajax_load_classes( $classes = array() ) {
			if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
				return $classes;
			}

			if ( ! isset( $_REQUEST['action'] ) || 'techguide_get_blog_listing_posts' !== $_REQUEST['action'] ) {
				return $classes;
			}

			$classes[] = 'is-loaded';
			$classes[] = 'post-loaded-' . $this->post_count;

			return $classes;
		}

		/**
		 * Add theme mods filters.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function add_theme_mods_filters() {
			if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
				return;
			}

			if ( ! isset( $_REQUEST['techguideWidgetSettings'] ) ) {
				return;
			}

			$settings = array_keys( $_REQUEST['techguideWidgetSettings'] );

			foreach ( $settings as $setting ) {
				if ( 'featured_image_size' === $setting ) {
					add_filter( 'techguide_post_thumbnail_size', array( $this, 'modify_post_thumbnail_size' ) );
				} else {
					add_filter( "theme_mod_{$setting}", array( $this, 'modify_theme_mod_cb' ) );
				}
			}
		}

		/**
		 * Modify theme mod callback.
		 *
		 * @since 1.0.0
		 *
		 * @param mixed $value Current theme mod value.
		 *
		 * @return mixed
		 */
		public function modify_theme_mod_cb( $value ) {
			$export_settings = $_REQUEST['techguideWidgetSettings'];
			$key             = str_replace( 'theme_mod_', '', current_filter() );

			return $this->prepare_theme_mod( $export_settings[ $key ] );
		}

		/**
		 * Modify post thumbnail size.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Thumbnail arguments.
		 *
		 * @return array
		 */
		public function modify_post_thumbnail_size( $args = array() ) {
			$args['size'] = $_REQUEST['techguideWidgetSettings']['featured_image_size'];

			return $args;
		}

		/**
		 * Prepare theme mod.
		 *
		 * @since 1.0.0
		 *
		 * @param mixed $value
		 *
		 * @return bool
		 */
		public function prepare_theme_mod( $value ) {

			if ( in_array( $value, array( 'yes', 'true', '1' ) ) ) {
				return true;
			}

			if ( in_array( $value, array( '', 'false', '0' ) ) ) {
				return false;
			}

			return $value;
		}

		/**
		 * Get ld switcher overwrite theme mods.
		 *
		 * @since 1.0.0
		 *
		 * @return array
		 */
		function get_ld_switcher_overwrite_mods() {
			$settings = array();

			$available_settings = array(
				'blog_layout_type',
				'blog_layout_columns',
				'blog_pagination_type',
				'blog_posts_content',
				'blog_posts_content_length',
				'blog_read_more_btn',
				'blog_read_more_text',
				'blog_post_author',
				'blog_post_publish_date',
				'blog_post_categories',
				'blog_post_tags',
				'blog_post_comments',
				'blog_post_trend_views',
				'blog_post_trend_rating',
				'blog_post_share_buttons',
				'sidebar_position',
			);

			if ( ! class_exists( 'Cherry_LD_Switcher' ) ) {
				return $settings;
			}

			if ( ! isset( $_GET['ld'] ) ) {
				return $settings;
			}

			foreach ( $_GET as $key => $value ) {

				if ( 'ld' === $key ) {
					continue;
				}

				if ( in_array( $key, $available_settings ) ) {
					$settings[ $key ] = $value;
				}
			}

			return $settings;
		}

		/**
		 * Add ld switcher theme mods filters.

		 * @since 1.0.0
		 */
		public function ld_switcher_theme_mods_filters() {
			if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
				return;
			}

			if ( ! isset( $_REQUEST['techguideLdSettings'] ) || ! $_REQUEST['techguideLdSettings'] ) {
				return;
			}

			$settings = array_keys( $_REQUEST['techguideLdSettings'] );

			foreach ( $settings as $setting ) {
				add_filter( "theme_mod_{$setting}", array( $this, 'ld_switch_mod_cb' ) );
			}
		}

		/**
		 * Universal switch callback for get theme mod hook.
		 *
		 * @param mixed $current Current theme mod value.
		 *
		 * @return mixed
		 */
		function ld_switch_mod_cb ( $current ) {
			$settings = $_REQUEST['techguideLdSettings'];
			$key      = str_replace( 'theme_mod_', '', current_filter() );

			return $this->prepare_theme_mod( $settings[ $key ] );

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
 * Returns instance of Techguide_Blog_Ajax_Handlers class.
 *
 * @since  1.0.0
 * @return object
 */
function techguide_blog_ajax_handlers() {
	return Techguide_Blog_Ajax_Handlers::get_instance();
}

techguide_blog_ajax_handlers();
