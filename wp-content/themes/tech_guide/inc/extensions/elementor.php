<?php
/**
 * Elementor compatibility.
 *
 * @package Techguide
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Techguide_Elementor' ) ) {

	/**
	 * Define Techguide_Elementor class
	 */
	class Techguide_Elementor {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Elementor addons directory inside theme
		 *
		 * @var string
		 */
		public $addons_dir = '/elementor-addons';

		/**
		 * Constructor for the class
		 */
		public function __construct() {

			if ( ! $this->has_elementor() ) {
				return;
			}

			add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'edit_scripts' ) );
			add_filter( 'cherry_ui_add_data_to_element',          array( $this, 'is_elementor_widget' ) );

			$addons = $this->get_theme_addons();

			if ( ! empty( $addons ) ) {
				add_action( 'elementor/init',                           array( $this, 'register_theme_category' ) );
				add_action( 'elementor/widgets/widgets_registered',     array( $this, 'register_theme_addons' ), 10 );
				add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'frontend_scripts' ) );
			}

			add_action( 'init', array( $this, 'add_compatibility_image_gallery_widget' ) );

			add_action( 'init', array( $this, 'add_compatibility_elementor_page_templates' ) );
		}

		/**
		 * Check if elementor installed
		 *
		 * @return boolean
		 */
		public function has_elementor() {
			return defined( 'ELEMENTOR_VERSION' );
		}

		/**
		 * Register category for theme addons
		 *
		 * @return void
		 */
		public function register_theme_category() {

			$template         = get_template();
			$theme_obj        = wp_get_theme( $template );
			$elements_manager = Elementor\Plugin::instance()->elements_manager;
			$cat_slug         = $theme_obj->get( 'TextDomain' );
			$cat_name         = $theme_obj->get( 'Name' );

			$elements_manager->add_category(
				$cat_slug,
				array(
					'title' => $cat_name,
					'icon'  => 'font',
				),
				1
			);

		}

		/**
		 * Register plugin addons
		 *
		 * @param  object $widgets_manager Elementor widgets manager instance.
		 * @return void
		 */
		public function register_theme_addons( $widgets_manager ) {

			$addons = $this->get_theme_addons();

			foreach ( $addons as $file ) {
				$this->register_addon( $file, $widgets_manager );
			}

		}

		/**
		 * Register addon by file name
		 *
		 * @param  string $file            File name.
		 * @param  object $widgets_manager Widgets manager instance.
		 * @return void
		 */
		public function register_addon( $file, $widgets_manager ) {

			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( 'Elementor\Techguide_%s', $class );

			require $file;

			if ( class_exists( $class ) ) {
				$widgets_manager->register_widget_type( new $class );
			}
		}

		/**
		 * Returns theme addons list
		 *
		 * @return array
		 */
		public function get_theme_addons() {
			return glob( get_template_directory() . $this->addons_dir . '/*.php' );
		}

		/**
		 * Enqueue theme scripts only with elementor scripts.
		 *
		 * @return void
		 */
		public function frontend_scripts() {
			wp_enqueue_script(
				'techguide-elementor-frontend',
				get_parent_theme_file_uri( 'assets/js/elementor-frontend.js' ),
				array( 'jquery', 'elementor-frontend' ),
				TECHGUIDE_THEME_VERSION,
				true
			);
		}

		/**
		 * Set $add_js_to_response into true if is elementor widget request.
		 *
		 * @param  boolean $add_js_to_response
		 * @return boolean
		 */
		public function is_elementor_widget( $add_js_to_response ) {

			if ( isset( $_REQUEST['action'] ) && 'elementor_editor_get_wp_widget_form' === $_REQUEST['action'] ) {
				return true;
			} else {
				return $add_js_to_response;
			}

		}

		/**
		 * Register widgets assets in editor
		 *
		 * @return void
		 */
		public function edit_scripts() {

			$js_core = techguide_theme()->get_core()->modules['cherry-js-core'];
			$ui      = techguide_theme()->get_core()->init_module( 'cherry-ui-elements' );
			$builder = techguide_theme()->get_core()->init_module( 'cherry-interface-builder' );

			wp_enqueue_media();

			$js_core->enqueue_cherry_scripts();
			$ui->enqueue_admin_assets();
			$builder->enqueue_assets();

			wp_enqueue_script(
				'techguide-edit',
				get_template_directory_uri() . '/assets/js/elementor-edit.js',
				array( 'elementor-editor' ),
				'1.0.0',
				true
			);

			wp_localize_script( 'techguide-edit', 'techguideEditData', $this->get_data() );

			wp_enqueue_style(
				'techguide-edit',
				get_template_directory_uri() . '/assets/css/elementor-edit.css',
				array(),
				'1.0.0'
			);
		}

		/**
		 * Returns JS for elementor-edit.js data
		 *
		 * @return array
		 */
		public function get_data() {

			return array(
				'widgets' => $this->get_widgets(),
			);

		}

		/**
		 * Save widgets list into js variable
		 */
		public function get_widgets() {

			global $wp_widget_factory;

			if ( empty( $wp_widget_factory->widgets ) ) {
				return array();
			}

			$result = array();

			foreach ( $wp_widget_factory->widgets as $widget ) {

				if ( ! isset( $widget->widget_id ) ) {
					continue;
				}

				if ( false === strpos( $widget->widget_id, 'techguide' ) ) {
					continue;
				}

				$result[] = $widget->widget_id;
			}

			return $result;
		}

		/**
		 * Add compatibility elementor image-gallery widget and cherry gallery.
		 */
		public function add_compatibility_image_gallery_widget() {

			if ( true === techguide_theme()->post_formats_api->args['rewrite_default_gallery'] ) {
				add_action( 'elementor/widget/before_render_content', array( $this,'remove_cherry_rewrite_gallery' ) );
				add_filter( 'elementor/widget/render_content', array( $this,'add_cherry_rewrite_gallery' ), 10, 2 );
			}
		}

		/**
		 * Remove cherry rewrite gallery filter.
		 *
		 * @param object $widget Widget instance.
		 */
		public function remove_cherry_rewrite_gallery( $widget ) {

			if ( 'image-gallery' === $widget->get_name() ) {
				$post_formats_api = techguide_theme()->post_formats_api;
				remove_filter( 'post_gallery', array( $post_formats_api, 'gallery_shortcode' ), 10 );
			}
		}

		/**
		 * Add cherry rewrite gallery filter.
		 *
		 * @param string $content Widget html.
		 * @param object $widget  Widget instance.
		 *
		 * @return string
		 */
		public function add_cherry_rewrite_gallery( $content, $widget ) {

			if ( 'image-gallery' === $widget->get_name() ) {
				$post_formats_api = techguide_theme()->post_formats_api;
				add_filter( 'post_gallery', array( $post_formats_api, 'gallery_shortcode' ), 10, 3 );
			}

			return $content;
		}

		/**
		 * Remove elementor content filter.
		 */
		public function remove_elementor_content_filter() {
			Elementor\Plugin::instance()->frontend->remove_content_filter();
		}

		/**
		 * Add elementor content filter.
		 */
		public function add_elementor_content_filter() {
			Elementor\Plugin::instance()->frontend->add_content_filter();
		}

		/**
		 * ADD compatibility elementor page templates from theme.
		 *
		 * @return void
		 */
		public function add_compatibility_elementor_page_templates() {
			$page_templates_module = Elementor\Plugin::$instance->modules_manager->get_modules( 'page-templates' );

			add_filter( 'template_include', array( $page_templates_module, 'template_include' ), 100 );
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

}

/**
 * Returns instance of Techguide_Elementor
 *
 * @return object
 */
function techguide_elementor() {
	return Techguide_Elementor::get_instance();
}

techguide_elementor();
