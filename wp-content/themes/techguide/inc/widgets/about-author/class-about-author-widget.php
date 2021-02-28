<?php
/*
Widget Name: About Author widget
Description: This widget is used to display information about selected user.
Settings:
 Title - Widget's text title
 Select user to show - You can choose a specific user
 Author avatar size - Choose the author avatar size
 Custom avatar image - Choose custom author avatar image
 Link text - Specify the read more button text
 Link - Specify the read more button link
*/

/**
 * @package Techguide
 */
if ( ! class_exists( 'Techguide_About_Author_Widget' ) ) {

	/**
	 * Class Techguide_About_Author_Widget.
	 */
	class Techguide_About_Author_Widget extends Cherry_Abstract_Widget {

		/**
		 * Constructor
		 */
		public function __construct() {

			$this->widget_cssclass    = 'widget-about-author';
			$this->widget_description = esc_html__( 'Display an information about selected user.', 'techguide' );
			$this->widget_id          = 'techguide_widget_about_author';
			$this->widget_name        = esc_html__( 'About Author', 'techguide' );
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'value' => esc_html__( 'About Author', 'techguide' ),
					'label' => esc_html__( 'Title', 'techguide' ),
				),
				'user_id' => array(
					'type'             => 'select',
					'size'             => 1,
					'value'            => '',
					'options_callback' => array( $this, 'get_users_list' ),
					'options'          => false,
					'label'            => esc_html__( 'Select user to show', 'techguide' ),
				),
				'avatar_size' => array(
					'type'       => 'slider',
					'max_value'  => 512,
					'min_value'  => 0,
					'value'      => 250,
					'step_value' => 1,
					'label'      => esc_html__( 'Author avatar size (set 0 to hide avatar, applied only for Gravatar)', 'techguide' ),
				),
				'avatar_img' => array(
					'type'               => 'media',
					'value'              => '',
					'multi_upload'       => false,
					'library_type'       => 'image',
					'upload_button_text' => esc_html__( 'Select image', 'techguide' ),
					'label'              => esc_html__( 'Custom avatar image (override default user avatar)', 'techguide' ),
				),
				'avatar_rounded' => array(
					'type'  => 'switcher',
					'value' => 'false',
					'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
					'label' => esc_html__( 'Avatar rounded', 'techguide' ),
				),
				'link' => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Link (leave empty to hide)', 'techguide' ),
				),
				'link_text' => array(
					'type'  => 'text',
					'value' => esc_html__( 'Read More', 'techguide' ),
					'label' => esc_html__( 'Link label', 'techguide' ),
				),
			);

			remove_filter( 'pre_user_description', 'wp_filter_kses' );
			add_filter( 'pre_user_description', 'wp_filter_post_kses' );

			parent::__construct();
		}

		/**
		 * Get blog user list array
		 *
		 * @return array
		 */
		public function get_users_list() {

			$users = get_users();

			$result = array( '0' => esc_html__( 'Select a user', 'techguide' ) );

			if ( empty( $users ) ) {
				return array();
			}

			foreach ( $users as $user ) {
				$result[ $user->data->ID ] = $user->data->user_nicename;
			}

			return $result;
		}

		/**
		 * Get author name.
		 *
		 * @return string
		 */
		public function get_author_name() {
			$user = get_userdata( intval( $this->instance['user_id'] ) );

			if ( ! $user ) {
				return;
			}

			return sprintf( '<h5 class="about-author_name">%s</h5>', $user->display_name );
		}

		/**
		 * Get author avatar.
		 *
		 * @return string
		 */
		public function get_author_avatar() {
			$format        = '<div class="about-author_avatar %2$s">%1$s</div>';
			$size          = intval( $this->instance['avatar_size'] );
			$rounded_class = ( 'true' === $this->instance['avatar_rounded'] ) ? 'rounded' : '';

			if ( ! empty( $this->instance['avatar_img'] ) ) {
				$avatar_src = wp_get_attachment_image_src( intval( $this->instance['avatar_img'] ), 'techguide-author-avatar' );
				$avatar     = sprintf( '<img class="about-author_img" src="%s" width="%d" height="%d" alt="avatar">', esc_url( $avatar_src[0] ), $size, $size );

				return sprintf( $format, $avatar, $rounded_class );
			}

			if ( empty( $this->instance['avatar_size'] ) || ( '0' === $this->instance['avatar_size'] ) ) {
				return;
			}

			$user_id = intval( $this->instance['user_id'] );
			$user    = get_userdata( $user_id );

			if ( ! $user ) {
				return;
			}

			$avatar = get_avatar( $user_id, $size, '', $user->display_name, array( 'class' => 'about-author_img' ) );

			return sprintf( $format, $avatar, $rounded_class );
		}

		/**
		 * Get current author description
		 *
		 * @return string
		 */
		public function get_author_description() {
			$user = get_userdata( intval( $this->instance['user_id'] ) );

			if ( ! $user ) {
				return;
			}

			return sprintf(
				'<div class="about-author_description">%s</div>',
				wp_filter_post_kses( $user->description )
			);
		}

		/**
		 * Get author button
		 *
		 * @return string
		 */
		public function get_author_button() {

			if ( empty( $this->instance['link'] ) ) {
				return;
			}

			$btn_class = 'btn btn-primary';
			$link_text = $this->use_wpml_translate( 'link_text' );
			$link      = $this->use_wpml_translate( 'link' );

			return sprintf(
				'<div class="about-author_btn_box"><a href="%2$s" class="about-author_btn %3$s">%1$s</a></div>',
				wp_kses( $link_text, wp_kses_allowed_html( 'post' ) ),
				esc_url( $link ),
				$btn_class
			);
		}

		/**
		 * Widget function.
		 *
		 * @see WP_Widget
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Instance.
		 */
		public function widget( $args, $instance ) {

			if ( empty( $instance['user_id'] ) || '0' == $instance['user_id'] ) {
				return;
			}

			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			$template = techguide_get_locate_template( 'inc/widgets/about-author/view/about-author.php' );

			if ( empty( $template ) ) {
				return;
			}

			ob_start();

			$this->setup_widget_data( $args, $instance );
			$this->widget_start( $args, $instance );

			include $template;

			$this->widget_end( $args );
			$this->reset_widget_data();

			wp_reset_postdata();

			echo wp_kses_post( $this->cache_widget( $args, ob_get_clean() ) );
		}
	}
}

add_action( 'widgets_init', 'techguide_register_about_author_widgets' );
/**
 * Register about-author widget.
 */
function techguide_register_about_author_widgets() {
	register_widget( 'Techguide_About_Author_Widget' );
}
