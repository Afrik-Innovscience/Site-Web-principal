<?php
namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Techguide_Blog_Addon extends Widget_Base {

	public function get_name() {
		return 'techguide-blog';
	}

	public function get_title() {
		return esc_html__( 'Blog', 'techguide' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return array( 'techguide' );
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => esc_html__( 'General', 'techguide' ),
			)
		);

		$this->add_control(
			'blog_layout_type',
			array(
				'label'   => esc_html__( 'Layout', 'techguide' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => techguide_get_blog_layouts(),
			)
		);

		$this->add_control(
			'blog_layout_columns',
			array(
				'label'   => esc_html__( 'Columns', 'techguide' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2-cols',
				'options' => array(
					'2-cols' => esc_html__( '2 columns', 'techguide' ),
					'3-cols' => esc_html__( '3 columns', 'techguide' ),
					'4-cols' => esc_html__( '4 columns', 'techguide' ),
				),
				'condition' => array(
					'blog_layout_type' => array( 'grid', 'grid-2', 'masonry' ),
				),
			)
		);

		$this->add_control(
			'blog_per_page',
			array(
				'label'   => esc_html__( 'Posts Number', 'techguide' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4,
				'min'     => 1,
				'max'     => 30,
				'step'    => 1,
			)
		);

		$this->add_control(
			'blog_pagination_type',
			array(
				'label'   => esc_html__( 'Pagination Type', 'techguide' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'load-more',
				'options' => array(
					'default'   => esc_html__( 'Default', 'techguide' ),
					'load-more' => esc_html__( 'Load More', 'techguide' ),
					'none'      => esc_html__( 'None', 'techguide' ),
				),
			)
		);

		$this->add_control(
			'featured_image_size',
			array(
				'label'       => esc_html__( 'Featured Image Size', 'techguide' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT,
				'default'     => 'full',
				'options'     => $this->__get_image_sizes(),
			)
		);

		$this->add_control(
			'blog_posts_content',
			array(
				'label'   => esc_html__( 'Post content', 'techguide' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'excerpt',
				'options' => array(
					'excerpt' => esc_html__( 'Only excerpt', 'techguide' ),
					'full'    => esc_html__( 'Full content', 'techguide' ),
					'none'    => esc_html__( 'Hide', 'techguide' ),
				),
			)
		);

		$this->add_control(
			'blog_posts_content_length',
			array(
				'label'       => esc_html__( 'Number of words in the excerpt', 'techguide' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 30,
				'min'         => 1,
				'max'         => 100,
				'step'        => 1,
				'condition' => array(
					'blog_posts_content' => 'excerpt',
				),
			)
		);

		$this->add_control(
			'blog_read_more_btn',
			array(
				'label'        => esc_html__( 'Show Read More button', 'techguide' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'blog_read_more_text',
			array(
				'label'   => esc_html__( 'Read More button text', 'techguide' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Read more', 'techguide' ),
				'condition' => array(
					'blog_read_more_btn' => 'true',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_meta_settings',
			array(
				'label' => esc_html__( 'Meta Settings', 'techguide' ),
			)
		);

		$this->add_control(
			'blog_post_author',
			array(
				'label'        => esc_html__( 'Show post author', 'techguide' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'blog_post_publish_date',
			array(
				'label'        => esc_html__( 'Show publish date', 'techguide' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'blog_post_categories',
			array(
				'label'        => esc_html__( 'Show categories', 'techguide' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'blog_post_tags',
			array(
				'label'        => esc_html__( 'Show tags', 'techguide' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
			)
		);

		$this->add_control(
			'blog_post_comments',
			array(
				'label'        => esc_html__( 'Show comments', 'techguide' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
			)
		);

		if ( techguide_is_cherry_trending_posts_activated() ) {
			$this->add_control(
				'blog_post_trend_views',
				array(
					'label'        => esc_html__( 'Show views counter', 'techguide' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'return_value' => 'true',
				)
			);

			$this->add_control(
				'blog_post_trend_rating',
				array(
					'label'        => esc_html__( 'Show rating', 'techguide' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'return_value' => 'true',
				)
			);
		}

		if ( techguide_is_cherry_socialize_activated() ) {
			$this->add_control(
				'blog_post_share_buttons',
				array(
					'label'        => esc_html__( 'Show social sharing buttons', 'techguide' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'return_value' => 'true',
				)
			);
		}

		$this->end_controls_section();
	}

	public function __get_image_sizes() {

		global $_wp_additional_image_sizes;

		$sizes  = get_intermediate_image_sizes();
		$result = array();

		foreach ( $sizes as $size ) {
			if ( in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$result[ $size ] = ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) );
			} else {
				$result[ $size ] = sprintf(
					'%1$s (%2$sx%3$s)',
					ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) ),
					$_wp_additional_image_sizes[ $size ]['width'],
					$_wp_additional_image_sizes[ $size ]['height']
				);
			}
		}

		return array_merge( array( 'full' => esc_html__( 'Full', 'techguide' ), ), $result );
	}

	public function __get_export_settings( $json_format = false ) {
		$settings = $this->get_settings();

		$allowed_settings = apply_filters( 'techguide/elementor-blog-addon/export-settings', array(
			'blog_layout_type',
			'blog_layout_columns',
			'blog_pagination_type',
			'featured_image_size',
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
		) );

		$result = array();

		foreach ( $allowed_settings as $setting ) {
			$result[ $setting ] = isset( $settings[ $setting ] ) ? $settings[ $setting ] : false;
		}

		return ( true === $json_format ) ? json_encode( $result ) : $result;
	}

	public function __get_query_args() {
		$settings = $this->get_settings();

		$query_args = array(
			'post_type'   => 'post',
			'post_status' => 'publish',
		);

		if ( ! empty( $settings['blog_pagination_type'] ) ) {
			if ( 'load-more' === $settings['blog_pagination_type'] ) {
				$query_args['paged'] = 1;
			} else {
				if ( get_query_var( 'paged' ) ) {
					$query_args['paged'] = get_query_var( 'paged' );
				} elseif ( get_query_var( 'page' ) ) {
					$query_args['paged'] = get_query_var( 'page' );
				} else {
					$query_args['paged'] = 1;
				}
			}
		}

		if ( ! empty( $settings['blog_per_page'] ) ) {
			$query_args['posts_per_page'] = $settings['blog_per_page'];
		}

		return $query_args;
	}

	protected function render() {
		$settings   = $this->get_settings();
		$query_args = $this->__get_query_args();

		$posts_query = new \WP_Query( $query_args );
		$max_page    = intval( $posts_query->max_num_pages );

		if ( ! $posts_query->have_posts() ) {
			echo wp_kses_post( $this->__get_posts_not_found() );
			return;
		}

		if ( 'load-more' === $settings['blog_pagination_type'] ) {
			$this->add_render_attribute(
				'post-list-ajax-attr',
				array(
					'data-page'     => esc_attr( $query_args['paged'] ),
					'data-max-page' => esc_attr( $max_page ),
					'data-per-page' => esc_attr( $posts_query->query['posts_per_page'] ),
					'data-settings' => $this->__get_export_settings( true ),
				)
			);
		}

		// Main Query fix for pagination
		global $wp_query;

		$temp_query = $wp_query;
		$wp_query   = null;
		$wp_query   = $posts_query;

		$this->__add_theme_mods_filters();
		?>
		<div <?php techguide_posts_list_class(); ?> <?php echo $this->get_render_attribute_string( 'post-list-ajax-attr' ); ?>><?php

			techguide_remove_elementor_content_filter();

			while ( $posts_query->have_posts() ) : $posts_query->the_post();

				$template_slugs = array(
					'template-parts/post/' . techguide_get_mod( 'blog_layout_type' ) . '/content',
					'template-parts/post/content',
				);

				techguide_get_template_part( $template_slugs, get_post_format() );

			endwhile;

			techguide_add_elementor_content_filter();

			$this->__print_dynamic_css_collector_style();

		?></div><!-- .posts-list -->

		<?php

		if ( 'none' !== $settings['blog_pagination_type']  ) {
			techguide_get_template_part( 'template-parts/content-pagination', techguide_get_mod( 'blog_pagination_type' ) );
		}

		// Reset Query fix for pagination
		$wp_query = null;
		$wp_query = $temp_query;
		wp_reset_postdata();

		$this->__remove_theme_mods_filters();
	}

	public function __add_theme_mods_filters() {
		$settings = array_keys( $this->__get_export_settings() );

		foreach( $settings as $setting ) {
			if ( 'featured_image_size' === $setting ) {
				add_filter( 'techguide_post_thumbnail_size', array( $this, '__modify_post_thumbnail_size' ) );
			} else {
				add_filter( "theme_mod_{$setting}", array( $this, '__modify_theme_mod_cb' ) );
			}
		}
	}

	public function __remove_theme_mods_filters() {
		$settings = array_keys( $this->__get_export_settings() );

		foreach( $settings as $setting ) {
			if ( 'featured_image_size' === $setting ) {
				remove_filter( 'techguide_post_thumbnail_size', array( $this, '__modify_post_thumbnail_size' ) );
			} else {
				remove_filter( "theme_mod_{$setting}", array( $this, '__modify_theme_mod_cb' ) );
			}
		}
	}

	public function __modify_theme_mod_cb( $value ) {
		$export_settings = $this->__get_export_settings();
		$key             = str_replace( 'theme_mod_', '', current_filter() );

		return $this->__prepare_theme_mod( $export_settings[ $key ] );
	}

	public function __modify_post_thumbnail_size( $args = array() ) {
		$export_settings = $this->__get_export_settings();

		$args['size'] = $export_settings['featured_image_size'];

		return $args;
	}

	public function __prepare_theme_mod( $value ) {

		if ( in_array( $value, array( 'yes', 'true' ) ) ) {
			return true;
		}

		if ( in_array( $value, array( '', 'false' ) ) ) {
			return false;
		}

		return $value;
	}

	/**
	 * Print dynamic css in editor.
	 */
	public function __print_dynamic_css_collector_style() {
		if ( Plugin::instance()->editor->is_edit_mode() ) {
			$dynamic_css = techguide_theme()->dynamic_css;

			add_filter( 'cherry_dynamic_css_collector_localize_object', array( $this, '__fix_preview_css' ) );
			$dynamic_css::$collector->print_style();
			remove_filter( 'cherry_dynamic_css_collector_localize_object', array( $this, '__fix_preview_css' ) );
		}
	}

	/**
	 * Fix preview dynamic styles.
	 *
	 * @param array $data
	 *
	 * @return array
	 */
	public function __fix_preview_css( $data = array() ) {

		if ( ! empty( $data['css'] ) ) {
			printf( '<style>%s</style>', html_entity_decode( $data['css'] ) );
		}

		return $data;
	}

	/**
	 * Get posts not found notice.
	 *
	 * @return string
	 */
	public function __get_posts_not_found() {
		$not_found = '<h3>' . esc_html__( 'Posts not found', 'techguide' ) . '</h3>';

		return apply_filters( 'techguide/elementor-blog-addon/posts-not-found', $not_found );
	}
}
