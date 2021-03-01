<?php
/**
 * AMP compatibility.
 *
 * @package Techguide
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Techguide_Amp' ) ) {

	/**
	 * Define Techguide_Amp class
	 */
	class Techguide_Amp {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Amp templates directory inside theme.
		 *
		 * @var string
		 */
		public $templates_dir = 'inc/extensions/amp/templates/';

		/**
		 * Constructor for the class
		 */
		public function __construct() {

			if ( ! $this->is_amp_active() ) {
				return;
			}

			add_filter( 'amp_post_template_file', array( $this, 'template_file' ), 10, 3 );
			add_action( 'amp_post_template_css',  array( $this, 'add_style' ) );
			add_filter( 'amp_post_template_data', array( $this, 'modify_template_data' ), 10, 2 );
			add_action( 'customize_register',     array( $this, 'register_controls' ) );
		}

		/**
		 * Set custom template path.
		 *
		 * @param $file
		 * @param $template_type
		 * @param $post
		 *
		 * @return mixed
		 */
		public function template_file( $file, $template_type, $post ) {
			$overwrite_templates = $this->get_overwrite_templates();

			if ( in_array( $template_type, $overwrite_templates ) ) {
				$file = get_parent_theme_file_path( $this->templates_dir . $template_type . '.php' );
			}

			return $file;
		}

		/**
		 * Get overwrite templates.
		 *
		 * @return array
		 */
		public function get_overwrite_templates() {
			$result = array();

			$files = glob( get_parent_theme_file_path( $this->templates_dir . '*.php' ) );

			foreach ( $files as $file ) {
				$result[] = basename( str_replace( '.php', '', $file ) );
			}

			return $result;
		}

		/**
		 * Add additional style.
		 *
		 * @param object $amp_post_template
		 */
		public function add_style( $amp_post_template ) {
			$css_file = get_parent_theme_file_path( 'inc/extensions/amp/style.php' );

			include $css_file;
		}

		/**
		 * Modify template data.
		 *
		 * @param array $data
		 * @param object $post
		 *
		 * @return array
		 */
		public function modify_template_data( $data, $post ) {

			// delete Merriweather Google fonts
			unset( $data['font_urls']['merriweather'] );

			return $data;
		}

		/**
		 *  Register customize controls.
		 *
		 * @param object $wp_customize
		 */
		public function register_controls( $wp_customize ) {
			$wp_customize->add_setting( 'amp_custom_logo',
				array(
					'sanitize_callback' => array( techguide_theme()->customizer, 'sanitize_number' ),
				)
			);

			$amp_logo_args = apply_filters( 'techguide_amp_logo_args', array(
				'width'         => 400,
				'height'        => 100,
				'flex-width'    => true,
				'flex-height'   => true,
			) );

			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'amp_custom_logo', array(
				'label'         => esc_html__( 'AMP Logo', 'techguide' ),
				'section'       => 'amp_design',
				'priority'      => 5,
				'width'         => isset( $amp_logo_args['width'] ) ? esc_attr( $amp_logo_args['width'] ) : 400,
				'height'        => isset( $amp_logo_args['height'] ) ? esc_attr( $amp_logo_args['width'] ) : 100,
				'flex-width'    => isset( $amp_logo_args['flex-width'] ) ? $amp_logo_args['flex-width'] : true,
				'flex-height'   => isset( $amp_logo_args['flex-width'] ) ? $amp_logo_args['flex-height'] : true,
				'button_labels' => array(
					'select'       => esc_html__( 'Select logo', 'techguide' ),
					'change'       => esc_html__( 'Change logo', 'techguide' ),
					'remove'       => esc_html__( 'Remove', 'techguide' ),
					'default'      => esc_html__( 'Default', 'techguide' ),
					'placeholder'  => esc_html__( 'No logo selected', 'techguide' ),
					'frame_title'  => esc_html__( 'Select logo', 'techguide' ),
					'frame_button' => esc_html__( 'Choose logo', 'techguide' ),
				),
			) ) );
		}

		/**
		 * Check if Amp installed.
		 *
		 * @return boolean
		 */
		public function is_amp_active() {
			return function_exists( 'amp_init' );
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
 * Returns instance of the Techguide_Amp class.
 *
 * @return object
 */
function techguide_amp() {
	return Techguide_Amp::get_instance();
}

techguide_amp();
