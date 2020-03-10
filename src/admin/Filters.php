<?php
/**
 * Klaive | Admin Filters
 *
 * @since 1.0.0
 */

namespace Klaive\Admin;

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Filters
 *
 * @since 1.0.0
 *
 * @package Klaive\Includes
 */
class Filters {

	/**
	 * Filters constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		add_filter( 'give_metabox_form_data_settings', [ $this, 'add_metabox_fields' ], 10, 2 );
		add_filter( 'plugin_action_links_' . plugin_basename( KLAIVE_PLUGIN_FILE ), [ $this, 'add_plugin_links' ] );
	}

	/**
	 * Add Metabox Fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array
	 */
	public function add_metabox_fields( $settings, $post_id ) {

		$is_enabled_per_form = give_get_meta( $post_id, 'klaive_enable_per_form', true );

		$settings['klaive_per_form_settings'] = [
			'id'        => 'klaive_per_form_settings',
			'title'     => __( 'Klaviyo Settings', 'klaive' ),
			'icon-html' => '<span class="dashicons dashicons-email-alt"></span>',
			'fields'    => [
				[
					'name'    => __( 'Account Options', 'klaive' ),
					'id'      => 'klaive_enable_per_form',
					'type'    => 'radio_inline',
					'default' => 'disabled',
					'options' => [
						'disabled' => __( 'Global Options', 'klaive' ),
						'enabled'  => __( 'Customize', 'klaive' ),
					],
				],
				[
					'name'          => __( 'Opt-in Default', 'klaive' ),
					'id'            => 'klaive_is_checkbox_checked_per_form',
					'type'          => 'radio_inline',
					'default'       => 'enabled',
					'options'       => [
						'enabled'  => __( 'Checked', 'klaive' ),
						'disabled' => __( 'Unchecked', 'klaive' ),
					],
					'wrapper_class' => $is_enabled_per_form ? 'klaive--wrapped-fields' : 'klaive--wrapped-fields give-hidden',
				],
				[
					'name'          => __( 'Checkbox Text', 'klaive' ),
					'id'            => 'klaive_checkbox_text_per_form',
					'desc'          => __( 'This is the text shown next to the Sign Up Newsletter checkbox. This can also be customized per form.', 'klaive' ),
					'type'          => 'text',
					'size'          => 'regular',
					'default'       => __( 'Subscribe to our newsletter', 'klaive' ),
					'attributes'    => array(
						'placeholder' => __( 'Subscribe to our newsletter', 'klaive' ),
					),
					'wrapper_class' => $is_enabled_per_form ? 'klaive--wrapped-fields' : 'klaive--wrapped-fields give-hidden',
				],
			],
		];

		return $settings;
	}

	/**
	 * This function is used to add settings page link on plugins page.
	 *
	 * @param array $links List of links on plugin page.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array
	 */
	public function add_plugin_links( $links ) {

		$links['settings'] = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url_raw( admin_url( 'edit.php?post_type=give_forms&page=give-settings&tab=addons&section=klaviyo' ) ),
			__( 'Settings', 'klaive' )
		);

		asort( $links );

		return $links;
	}
}
