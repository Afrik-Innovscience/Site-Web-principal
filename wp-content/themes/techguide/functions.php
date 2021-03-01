<?php
/**
 * Techguide functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Techguide
 */
if ( ! class_exists( 'Techguide_Theme_Setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 1.0.0
	 */
	class Techguide_Theme_Setup {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * A reference to an instance of cherry framework core class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private $core = null;

		/**
		 * Holder for CSS layout scheme.
		 *
		 * @since 1.0.0
		 * @var   array
		 */
		public $layout = array();

		/**
		 * Holder for current customizer module instance.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		public $customizer = null;

		/**
		 * Holder for current dynamic_css module instance.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		public $dynamic_css = null;

		/**
		 * Holder for current post_formats_api module instance.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		public $post_formats_api = null;

		/**
		 * Sets up needed actions/filters for the theme to initialize.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Set the constants needed by the theme.
			add_action( 'after_setup_theme', array( $this, 'constants' ), -1 );

			// Load the installer core.
			add_action( 'after_setup_theme', require( get_parent_theme_file_path( 'cherry-framework/setup-theme.php' ) ), 0 );

			// Load the core functions/classes required by the rest of the theme.
			add_action( 'after_setup_theme', array( $this, 'get_core' ), 1 );

			// Language functions and translations setup.
			add_action( 'after_setup_theme', array( $this, 'l10n' ), 2 );

			// Handle theme supported features.
			add_action( 'after_setup_theme', array( $this, 'theme_support' ), 3 );

			// Load the theme includes.
			add_action( 'after_setup_theme', array( $this, 'includes' ), 4 );

			// Initialization of modules.
			add_action( 'after_setup_theme', array( $this, 'init' ), 10 );

			// Load the theme includes.
			add_action( 'after_setup_theme', array( $this, 'includes_after_init' ), 11 );

			// Set holders for modules instance.
			add_action( 'init', array( $this, 'set_holders_module_instance' ) );

			// Register plugins config for Jet Plugins Wizard.
			add_action( 'init', array( $this, 'register_plugins_wizard_config' ), 5 );

			// Register import config for Jet Data Importer.
			add_action( 'init', array( $this, 'register_data_importer_config' ), 5 );

			// Register config for Jet Theme Core.
			add_action( 'jet-theme-core/register-config', array( $this, 'register_theme_core_config' ) );

			// Load admin files.
			add_action( 'wp_loaded', array( $this, 'admin' ), 1 );

			// Enqueue admin assets.
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

			// Register public assets.
			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ), 9 );

			// Enqueue public assets.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ), 20 );

			// Denqueue duplicate assets.
			add_action( 'wp_enqueue_scripts', array( $this, 'denqueue_assets' ), 30 );

			// Overrides the load textdomain function for the 'cherry-framework' domain.
			add_filter( 'override_load_textdomain', array( $this, 'override_load_textdomain' ), 5, 3 );

		}

		/**
		 * Defines the constant paths for use within the core and theme.
		 *
		 * @since 1.0.0
		 */
		public function constants() {
			global $content_width;

			/**
			 * Fires before definitions the constants.
			 *
			 * @since 1.0.0
			 */
			do_action( 'techguide_constants_before' );

			$template  = get_template();
			$theme_obj = wp_get_theme( $template );

			/** Sets the theme version number. */
			define( 'TECHGUIDE_THEME_VERSION', $theme_obj->get( 'Version' ) );

			/** Sets the path to the core framework directory. */
			defined( 'CHERRY_DIR' ) or define( 'CHERRY_DIR', get_parent_theme_file_path( 'cherry-framework' ) );

			/** Sets the path to the core framework directory URI. */
			defined( 'CHERRY_URI' ) or define( 'CHERRY_URI', get_parent_theme_file_uri( 'cherry-framework' ) );

			// Sets the content width in pixels, based on the theme's design and stylesheet.
			if ( ! isset( $content_width ) ) {
				$content_width = 1170;
			}
		}

		/**
		 * Loads the core functions. These files are needed before loading anything else in the
		 * theme because they have required functions for use.
		 *
		 * @since  1.0.0
		 */
		public function get_core() {
			/**
			 * Fires before loads the core theme functions.
			 *
			 * @since 1.0.0
			 */
			do_action( 'techguide_core_before' );

			global $chery_core_version;

			if ( null !== $this->core ) {
				return $this->core;
			}

			if ( 0 < sizeof( $chery_core_version ) ) {
				$core_paths = array_values( $chery_core_version );

				require_once( $core_paths[0] );
			} else {
				die( 'Class Cherry_Core not found' );
			}

			$this->core = new Cherry_Core( array(
				'base_dir' => CHERRY_DIR,
				'base_url' => CHERRY_URI,
				'modules'  => array(
					'cherry-js-core' => array(
						'autoload' => true,
					),
					'cherry-ui-elements' => array(
						'autoload' => false,
					),
					'cherry-interface-builder' => array(
						'autoload' => false,
					),
					'cherry-utility' => array(
						'autoload' => true,
						'args'     => array(
							'meta_key' => array(
								'term_thumb' => 'cherry_terms_thumbnails',
							),
						),
					),
					'cherry-widget-factory' => array(
						'autoload' => true,
					),
					'cherry-post-formats-api' => array(
						'autoload' => true,
						'args'     => array(
							'rewrite_default_gallery' => true,
							'gallery_args' => array(
								'size'          => 'techguide-thumb-l',
								'base_class'    => 'post-gallery',
								'container'     => '<div class="%2$s swiper-container" id="%4$s" %3$s><div class="swiper-wrapper">%1$s</div><div class="swiper-button-prev"></div><div class="swiper-button-next"></div><div class="swiper-pagination"></div></div>',
								'slide'         => '<figure class="%2$s swiper-slide">%1$s</figure>',
								'img_class'     => 'swiper-image',
								'slider_handle' => 'jquery-swiper',
								'slider'        => 'swiper',
								'slider_init'   => array(
									'loop'    => true,
									'buttons' => false,
									'arrows'  => true,
								),
								'popup'         => 'magnificPopup',
								'popup_handle'  => 'magnific-popup',
								'popup_init'    => array(
									'type' => 'image',
								),
							),
							'image_args' => array(
								'size'         => 'techguide-thumb-l',
								'popup'        => 'magnificPopup',
								'popup_handle' => 'magnific-popup',
								'popup_init'   => array(
									'type' => 'image',
								),
							),
						),
					),
					'cherry-customizer' => array(
						'autoload' => false,
					),
					'cherry-dynamic-css' => array(
						'autoload' => false,
					),
					'cherry-google-fonts-loader' => array(
						'autoload' => false,
					),
					'cherry-term-meta' => array(
						'autoload' => false,
					),
					'cherry-post-meta' => array(
						'autoload' => false,
					),
					'cherry-breadcrumbs' => array(
						'autoload' => false,
					),
				),
			) );

			return $this->core;
		}

		/**
		 * Loads the theme translation file.
		 *
		 * @since 1.0.0
		 */
		public function l10n() {
			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 */
			load_theme_textdomain( 'techguide', get_parent_theme_file_path( 'languages' ) );
		}

		/**
		 * Adds theme supported features.
		 *
		 * @since 1.0.0
		 */
		public function theme_support() {

			// Enable support for Post Thumbnails on posts and pages.
			add_theme_support( 'post-thumbnails' );

			// Enable HTML5 markup structure.
			add_theme_support( 'html5', array(
				'comment-list',
				'comment-form',
				'search-form',
				'gallery',
				'caption',
			) );

			// Enable default title tag.
			add_theme_support( 'title-tag' );

			// Enable post formats.
			add_theme_support( 'post-formats', array(
				'gallery',
				'image',
				'link',
				'quote',
				'video',
				'audio',
				'aside',
			) );

			// Enable custom background.
			add_theme_support( 'custom-background', array(
				'default-color' => 'f3f3f9',
			) );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			// Enable support Selective Refresh for widgets into customize.
			add_theme_support( 'customize-selective-refresh-widgets' );

			// Allow copy custom sidebars into child theme on activation
			add_theme_support( 'cherry_migrate_sidebars' );

			// Add theme support for Custom Logo.
			add_theme_support( 'custom-logo', array(
				'flex-width'  => true,
				'flex-height' => true,
			) );
		}

		/**
		 * Loads the theme files supported by themes and template-related functions/classes.
		 *
		 * @since 1.0.0
		 */
		public function includes() {
			/**
			 * Configurations.
			 */
			require_once get_parent_theme_file_path( 'config/layout.php' );
			require_once get_parent_theme_file_path( 'config/menus.php' );
			require_once get_parent_theme_file_path( 'config/sidebars.php' );
			require_once get_parent_theme_file_path( 'config/post-meta.php' );
			require_once get_parent_theme_file_path( 'config/term-meta.php' );
			require_if_theme_supports( 'post-thumbnails', get_parent_theme_file_path( 'config/thumbnails.php' ) );

			/**
			 * Functions.
			 */
			require_once get_parent_theme_file_path( 'inc/template-tags.php' );
			require_once get_parent_theme_file_path( 'inc/template-menu.php' );
			require_once get_parent_theme_file_path( 'inc/template-meta.php' );
			require_once get_parent_theme_file_path( 'inc/template-post-formats.php' );
			require_once get_parent_theme_file_path( 'inc/template-comment.php' );
			require_once get_parent_theme_file_path( 'inc/template-related-posts.php' );

			require_once get_parent_theme_file_path( 'inc/template-skins.php' );
			require_once get_parent_theme_file_path( 'inc/extras.php' );
			require_once get_parent_theme_file_path( 'inc/context.php' );
			require_once get_parent_theme_file_path( 'inc/customizer.php' );
			require_once get_parent_theme_file_path( 'inc/hooks.php' );
			require_once get_parent_theme_file_path( 'inc/register-plugins.php' );

			/**
			 * Third party plugins hooks.
			 */

			if ( class_exists( 'Cherry_Trending_Posts' ) ) {
				require_once get_parent_theme_file_path( 'inc/plugins-hooks/cherry-trending-posts.php' );
			}

			if ( class_exists( 'Cherry_Socialize' ) ) {
				require_once get_parent_theme_file_path( 'inc/plugins-hooks/cherry-socialize.php' );
			}

			if ( class_exists( 'Elementor\Plugin' ) ) {
				require_once get_parent_theme_file_path( 'inc/plugins-hooks/elementor.php' );
			}

			/**
			 * Widgets.
			 */
			require_once get_parent_theme_file_path( 'inc/widgets/about-author/class-about-author-widget.php' );

			if ( class_exists( 'Elementor\Plugin' ) ) {
				require_once get_parent_theme_file_path( 'inc/widgets/elementor-template/class-elementor-template-widget.php' );
			}

			/**
			 * Classes.
			 */
			if ( ! is_admin() ) {
				require_once get_parent_theme_file_path( 'inc/classes/class-wrapping.php' );
			}

			require_once get_parent_theme_file_path( 'inc/classes/class-widget-area.php' );
			require_once get_parent_theme_file_path( 'inc/classes/class-tgm-plugin-activation.php' );
			require_once get_parent_theme_file_path( 'inc/classes/class-term-meta.php' );

			/**
			 * Extensions.
			 */
			require_once get_parent_theme_file_path( 'inc/extensions/amp.php' );

			if ( class_exists( 'Elementor\Plugin' ) ) {
				require_once get_parent_theme_file_path( 'inc/extensions/elementor.php' );
			}
		}

		/**
		 * Run initialization of modules.
		 *
		 * @since 1.0.0
		 */
		public function init() {
			$this->customizer  = $this->get_core()->init_module( 'cherry-customizer', techguide_get_customizer_options() );
			$this->dynamic_css = $this->get_core()->init_module( 'cherry-dynamic-css', techguide_get_dynamic_css_options() );
			$this->get_core()->init_module( 'cherry-google-fonts-loader', techguide_get_fonts_options() );
			$this->get_core()->init_module( 'cherry-term-meta', array(
				'tax'      => 'category',
				'priority' => 10,
				'fields'   => array(
					'cherry_terms_bg' => array(
						'type'  => 'colorpicker',
						'value' => '',
						'label' => esc_html__( 'Category color', 'techguide' ),
					),
				),
			) );
		}

		/**
		 * Loads the theme files after initialization of modules.
		 *
		 * @since 1.0.0
		 */
		public function includes_after_init() {
			/**
			 * Classes.
			 */
			require_once get_parent_theme_file_path( 'inc/classes/class-blog-ajax-handlers.php' );
		}

		/**
		 * Set holders for modules instance.
		 *
		 * @since 1.0.0
		 */
		public function set_holders_module_instance() {
			$this->post_formats_api = $this->get_core()->modules['cherry-post-formats-api'];
		}

		/**
		 * Register plugins config for Jet Plugins Wizard.
		 *
		 * @since 1.0.0
		 */
		public function register_plugins_wizard_config() {
			if ( ! function_exists( 'jet_plugins_wizard_register_config' ) ) {
				return;
			}

			if ( ! is_admin() ) {
				return;
			}

			require_once get_parent_theme_file_path( 'config/plugins-wizard.php' );

			/**
			 * @var array $config Defined in config file.
			 */
			jet_plugins_wizard_register_config( $config );
		}

		/**
		 * Register import config for Jet Data Importer.
		 *
		 * @since 1.0.0
		 */
		public function register_data_importer_config() {
			if ( ! function_exists( 'jet_data_importer_register_config' ) ) {
				return;
			}

			require_once get_parent_theme_file_path( 'config/import.php' );

			/**
			 * @var array $config Defined in config file.
			 */
			jet_data_importer_register_config( $config );
		}

		/**
		 * Register config for Jet Theme Core.
		 *
		 * @param object $config_manager Theme Core Config instance.
		 */
		public function register_theme_core_config( $config_manager ) {

			require_once get_parent_theme_file_path( 'config/theme-core.php' );

			/**
			 * @var array $config Defined in config file.
			 */
			$config_manager->register_config( $config );
		}

		/**
		 * Load admin files for the theme.
		 *
		 * @since 1.0.0
		 */
		public function admin() {

			// Check if in the WordPress admin.
			if ( ! is_admin() ) {
				return;
			}
		}

		/**
		 * Enqueue admin-specific assets.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_admin_assets( $hook ) {
			wp_enqueue_style( 'techguide-admin-style', get_parent_theme_file_uri( 'assets/css/admin.min.css' ), array(), TECHGUIDE_THEME_VERSION );
		}

		/**
		 * Register assets.
		 *
		 * @since 1.0.0
		 */
		public function register_assets() {
			wp_register_script( 'jquery-swiper', get_parent_theme_file_uri( 'assets/js/min/swiper.jquery.min.js' ), array( 'jquery' ), '3.4.2', true );
			wp_register_script( 'magnific-popup', get_parent_theme_file_uri( 'assets/js/min/jquery.magnific-popup.min.js' ), array( 'jquery' ), '1.1.0', true );
			wp_register_script( 'resize-sensor', get_parent_theme_file_uri( 'assets/js/min/resize-sensor.min.js' ), array(), '1.0.1', true );
			wp_register_script( 'theia-sticky-sidebar', get_parent_theme_file_uri( 'assets/js/min/theia-sticky-sidebar.min.js' ), array( 'jquery', 'resize-sensor' ), '1.7.0', true );
			wp_register_script( 'object-fit-images', get_parent_theme_file_uri( 'assets/js/min/ofi.min.js' ), array(), '3.0.1', true );
			wp_register_script( 'jquery-ui-totop', get_parent_theme_file_uri( 'assets/js/min/jquery.ui.totop.min.js' ), array( 'jquery' ), '1.2.0', true );

			wp_register_style( 'jquery-swiper', get_parent_theme_file_uri( 'assets/css/swiper.min.css' ), array(), '3.4.2' );
			wp_register_style( 'magnific-popup', get_parent_theme_file_uri( 'assets/css/magnific-popup.min.css' ), array(), '1.1.0' );
			wp_register_style( 'font-awesome', get_parent_theme_file_uri( 'assets/css/font-awesome.min.css' ), array(), '4.7.0' );
			wp_register_style( 'material-design-icons', get_parent_theme_file_uri( 'assets/css/materialdesignicons.min.css' ), array(), '2.1.19' );
		}

		/**
		 * Enqueue assets.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_assets() {
			wp_enqueue_style( 'techguide-theme-style', get_stylesheet_uri(),
				array( 'font-awesome', 'magnific-popup', 'jquery-swiper', 'material-design-icons' ),
				TECHGUIDE_THEME_VERSION
			);

			/**
			 * Filter the depends on main theme script.
			 *
			 * @since 1.0.0
			 * @var   array
			 */
			$depends = apply_filters( 'techguide_theme_script_depends', array( 'cherry-js-core', 'jquery-swiper' ) );

			wp_enqueue_script( 'techguide-theme-script', get_parent_theme_file_uri( 'assets/js/theme-script.js' ), $depends, TECHGUIDE_THEME_VERSION, true );

			/**
			 * Filter the strings that send to scripts.
			 *
			 * @since 1.0.0
			 * @var   array
			 */
			$labels = apply_filters( 'techguide_theme_localize_labels', array(
				'totop_button' => '',
			) );

			wp_localize_script( 'techguide-theme-script', 'techguide', apply_filters(
				'techguide_theme_script_variables',
				array(
					'ajaxurl'        => esc_url( admin_url( 'admin-ajax.php' ) ),
					'labels'         => $labels,
					'sidebar_sticky' => techguide_get_mod( 'sidebar_sticky' ),
				) ) );

			// Threaded Comments.
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		/**
		 * Denqueue duplicate assets.
		 *
		 * @since 1.0.0
		 */
		public function denqueue_assets() {

			/**
			 * Filter the dequeue handles.
			 *
			 * @since 1.0.0
			 * @var   array
			 */
			$dequeue_handles = apply_filters( 'techguide_dequeue_handles', array(
				'style' => array(
					'highlight-and-share',
					'cherry-popups-font-awesome',
				),

				'script' => array(),
			) );

			foreach ( $dequeue_handles['style'] as $handle ) {
				wp_dequeue_style( $handle );
			}

			foreach ( $dequeue_handles['script'] as $handle ) {
				wp_dequeue_script( $handle );
			}

		}

		/**
		 * Get dynamic utilities function.
		 *
		 * @param string $func Dynamic utilities function name.
		 * @param array  $args Function arguments.
		 *
		 * @return mixed
		 */
		public function get_dynamic_utilities_func( $func = null, $args = array() ) {

			if ( ! $func ) {
				return false;
			}

			$dynamic_functions = $this->dynamic_css->get_css_functions();
			$function          = $dynamic_functions[ $func ];

			if ( ! is_callable( $function ) ) {
				return false;
			}

			return call_user_func_array( $function, $args );
		}

		/**
		 * Overrides the load textdomain functionality when 'cherry-framework' is the domain in use.
		 *
		 * @since  1.0.0
		 * @link   https://gist.github.com/justintadlock/7a605c29ae26c80878d0
		 *
		 * @param  bool   $override Override.
		 * @param  string $domain   Text domain.
		 * @param  string $mofile   Mofile.
		 *
		 * @return bool
		 */
		public function override_load_textdomain( $override, $domain, $mofile ) {

			// Check if the domain is our framework domain.
			if ( 'cherry-framework' === $domain ) {

				global $l10n;

				// If the theme's textdomain is loaded, assign the theme's translations
				// to the framework's textdomain.
				if ( isset( $l10n['techguide'] ) ) {
					$l10n[ $domain ] = $l10n['techguide'];
				}

				// Always override.  We only want the theme to handle translations.
				$override = true;
			}

			return $override;
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
 * Returns instance of main theme configuration class.
 *
 * @since  1.0.0
 * @return object
 */
function techguide_theme() {
	return Techguide_Theme_Setup::get_instance();
}

techguide_theme();