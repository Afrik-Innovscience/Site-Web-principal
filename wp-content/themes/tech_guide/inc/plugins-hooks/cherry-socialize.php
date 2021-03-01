<?php
/**
 * Cherry Socialize hooks.
 *
 * @package Techguide
 */
add_filter( 'techguide_get_customizer_options', 'techguide_add_sharing_btns_options' );

/**
 * Add sharing buttons options to customizer.
 *
 * @param array $args Customize Options.
 *
 * @return array
 */
function techguide_add_sharing_btns_options( $args = array() ) {

	$sharing_btns_options = array(
		/** `Sharing Buttons` panel */
		'sharing_btns_settings' => array(
			'title'    => esc_html__( 'Social Sharing Buttons', 'techguide' ),
			'priority' => 120,
			'type'     => 'panel',
		),

		/** `Sharing Buttons on Posts Listing` section */
		'sharing_btns_loop' => array(
			'title'    => esc_html__( 'Visibility on Posts Listing', 'techguide' ),
			'panel'    => 'sharing_btns_settings',
			'priority' => 10,
			'type'     => 'section',
		),
	);

	// Loop Sharing Buttons
	$sharing_btns_options = array_merge( $sharing_btns_options, techguide_get_share_btns_networks_options( 'loop' ) );

	$sharing_btns_options = array_merge( $sharing_btns_options, array(
		/** `Sharing Buttons on Single Post` section */
		'sharing_btns_single' => array(
			'title'    => esc_html__( 'Visibility on Single Post', 'techguide' ),
			'panel'    => 'sharing_btns_settings',
			'priority' => 20,
			'type'     => 'section',
		),
	) );

	// Single Sharing Buttons
	$sharing_btns_options = array_merge( $sharing_btns_options, techguide_get_share_btns_networks_options( 'single' ) );

	$args['options'] = array_merge( $args['options'], $sharing_btns_options );

	return $args;
}

/**
 * Ger sharing buttons networks options.
 *
 * @param string $context
 *
 * @return array
 */
function techguide_get_share_btns_networks_options( $context = 'loop' ) {
	$result = array();

	foreach ( Cherry_Socialize_Sharing::get_instance()->get_networks() as $id => $network ) {

		$option_id = sprintf( 'sharing_btn_%1$s_%2$s', $context, $id );

		$result[ $option_id ] = array(
			'title'   => $network['name'],
			'section' => 'sharing_btns_' . $context,
			'default' => true,
			'field'   => 'checkbox',
			'type'    => 'control',
		);
	};

	return $result;
}

/**
 * Get available sharing buttons.
 *
 * @param string $context
 *
 * @return array
 */
function techguide_get_available_sharing_btns( $context = 'loop' ) {
	$result = array();

	foreach ( Cherry_Socialize_Sharing::get_instance()->get_networks() as $id => $network ) {
		$option = sprintf( 'sharing_btn_%1$s_%2$s', $context, $id );

		if ( techguide_get_mod( $option ) ) {
			$result[] = $id;
		}
	}

	return $result;
}

/**
 * Check available sharing network item.
 *
 * @param string $id
 *
 * @return bool
 */
function techguide_is_available_sharing_network_item( $id = '' ) {
	if ( ! is_single() ) {
		static $loop_available_sharing_btns;

		if ( ! $loop_available_sharing_btns ) {
			$loop_available_sharing_btns = techguide_get_available_sharing_btns( 'loop' );
		}

		if ( in_array( $id, $loop_available_sharing_btns ) ) {
			return true;
		}

	} else {
		static $single_available_sharing_btns;

		if ( ! $single_available_sharing_btns ) {
			$single_available_sharing_btns = techguide_get_available_sharing_btns( 'single' );
		}

		if ( in_array( $id, $single_available_sharing_btns ) ) {
			return true;
		}
	}

	return false;
}
