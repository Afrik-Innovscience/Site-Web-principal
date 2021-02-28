<?php
/**
 * Term meta.
 *
 * @package    Techguide
 * @subpackage Class
 */

if ( ! class_exists( 'Techguide_Term_Meta' ) ) {

	/**
	 * Class Techguide_Term_Meta.
	 *
	 * @since 1.0.0
	 */
	class Techguide_Term_Meta {

		/**
		 * Class arguments
		 *
		 * @var array
		 */
		public $args = array();

		/**
		 * Interface builder instance.
		 *
		 * @var object
		 */
		public $builder = null;

		/**
		 * Constructor for the class.
		 *
		 * @param array $args Class Arguments.
		 *
		 * @since 1.0.0
		 */
		public function __construct( $args = array() ) {

			if ( ! is_admin() ) {
				return;
			}

			$this->args = wp_parse_args( $args, array(
				'tax'      => 'category',
				'priority' => 10,
				'fields'   => array(),
			) );

			if ( empty( $this->args['fields'] ) ) {
				return;
			}

			$this->builder = techguide_theme()->get_core()->init_module( 'cherry-interface-builder', array() );

			if ( ! $this->builder ) {
				return;
			}

			$priority = intval( $this->args['priority'] );
			$tax      = esc_attr( $this->args['tax'] );

			add_action( "{$tax}_edit_form_fields", array( $this, 'render_edit_fields' ), $priority, 2 );
			add_action( "edited_{$tax}",           array( $this, 'save_meta' ) );
		}

		/**
		 * Render edit term form fields
		 *
		 * @since  1.0.0
		 * @param  object $term     Current term object.
		 * @param  string $taxonomy Taxonomy name.
		 * @return void
		 */
		public function render_edit_fields( $term, $taxonomy ) {
			$format = '<tr class="form-field cherry-term-meta-wrap"><td colspan="2">%s</td></tr>';

			echo $this->get_fields( $term, $taxonomy, $format );
		}

		/**
		 * Get registered control fields
		 *
		 * @since  1.0.0
		 * @param  object $term     Current term object.
		 * @param  string $taxonomy Taxonomy name.
		 * @param  string $format   Html markup format.
		 * @return string
		 */
		public function get_fields( $term, $taxonomy, $format = '%s' ) {

			$term_meta = array();

			if ( isset( $this->args['meta_key'] ) && ! empty( $this->args['meta_key'] ) ) {
				$term_meta = get_term_meta( $term->term_id, $this->args['meta_key'], true );
				$term_meta = ! empty( $term_meta ) ? $term_meta : array();
			}

			foreach ( $this->args['fields'] as $key => $field ) {
				if ( false !== $term ) {

					if ( isset( $this->args['meta_key'] ) && ! empty( $this->args['meta_key'] ) ) {
						$value = isset( $term_meta[ $key ] ) ? $term_meta[ $key ] : '';
					} else {
						$value = get_term_meta( $term->term_id, $key, true );
					}

				} else {
					$value = '';
				}

				$value = ! empty( $value ) ? $value : Cherry_Toolkit::get_arg( $field, 'value', '' );

				if ( isset( $field['options_callback'] ) ) {
					$field['options'] = call_user_func( $field['options_callback'] );
				}

				$element        = Cherry_Toolkit::get_arg( $field, 'element', 'control' );
				$field['id']    = Cherry_Toolkit::get_arg( $field, 'id', $key );
				$field['name']  = Cherry_Toolkit::get_arg( $field, 'name', $key );
				$field['type']  = Cherry_Toolkit::get_arg( $field, 'type', '' );
				$field['value'] = $value;

				$register_callback = 'register_' . $element;

				if ( method_exists( $this->builder, $register_callback ) ) {
					call_user_func( array( $this->builder, $register_callback ), $field );
				}
			}

			return sprintf( $format, $this->builder->render( false ) );
		}

		/**
		 * Save additional taxonomy meta on edit or create tax
		 *
		 * @since  1.0.0
		 * @param  int $term_id Term ID.
		 * @return bool
		 */
		public function save_meta( $term_id ) {

			if ( ! current_user_can( 'edit_posts' ) ) {
				return false;
			}

			if ( isset( $this->args['meta_key'] ) && ! empty( $this->args['meta_key'] ) ) {

				$value = get_term_meta( $term_id, $this->args['meta_key'], true );
				$value = ! empty( $value ) ? $value : array();

				foreach ( $this->args['fields'] as $key => $field ) {

					if ( isset( $field['element'] ) && 'control' !== $field['element'] ) {
						continue;
					}

					if ( ! isset( $_POST[ $key ] ) ) {
						continue;
					}

					if ( is_array( $_POST[ $key ] ) ) {
						$value[ $key ] = array_filter( $_POST[ $key ] );
					} else {
						$value[ $key ] = esc_attr( $_POST[ $key ] );
					}
				}

				update_term_meta( $term_id, $this->args['meta_key'], $value );

			} else {

				foreach ( $this->args['fields'] as $key => $field ) {

					if ( isset( $field['element'] ) && 'control' !== $field['element'] ) {
						continue;
					}

					if ( ! isset( $_POST[ $key ] ) ) {
						continue;
					}

					if ( is_array( $_POST[ $key ] ) ) {
						$new_val = array_filter( $_POST[ $key ] );
					} else {
						$new_val = esc_attr( $_POST[ $key ] );
					}

					update_term_meta( $term_id, $key, $new_val );
				}
			}

			return true;
		}
	}
}
