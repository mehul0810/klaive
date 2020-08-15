<?php
/**
 * Klaive | Admin Settings
 *
 * @since 1.0.0
 */

namespace Klaive\Admin;

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Settings.
 *
 * @since 1.0.0
 *
 * @package Klaive\Admin
 */
class Settings {

	/**
	 * Settings constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		add_filter( 'give_get_sections_addons', [ $this, 'register_sections' ] );
		add_filter( 'give_get_settings_addons', [ $this, 'register_settings' ] );
	}

	/**
	 * Register sections.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param array $sections List of sections.
	 *
	 * @return mixed
	 */
	public function register_sections( $sections ) {
		$sections['klaviyo'] = __( 'Klaviyo', 'klaive' );

		return $sections;
	}

	/**
	 * Registers the plugin's settings.
	 *
	 * @param array $settings List of settings.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array
	 */
	public function register_settings( $settings ) {

		$is_enabled_globally = give_is_setting_enabled( give_get_option( 'klaive_enable_globally', 'disabled' ) );
		$api_key             = give_get_option( 'klaive_api_key' );

		switch ( give_get_current_setting_section() ) {

			case 'klaviyo':
				$settings = [
					[
						'id'   => 'give_title_klaviyo',
						'type' => 'title',
						'desc' => sprintf(
							__( '<div class="%1$s"><span class="%2$s">Don\'t have a Klaviyo account? <a target="_blank" rel="noopener" href="%3$s">Click here</a> to create your Klaviyo account now.</span></div>', 'klaive' ),
							'klaive-heading-description-wrap',
							'klaive-heading-description',
							esc_url_raw( 'https://www.klaviyo.com/' )
						),
					],
					[
						'id'      => 'klaive_enable_globally',
						'name'    => __( 'Enable Globally', 'klaive' ),
						'desc'    => __( 'Allow donors to sign up for the forms selected below on all donation forms?', 'klaive' ),
						'type'    => 'radio_inline',
						'default' => 'enabled',
						'options' => [
							'enabled'  => __( 'Enabled', 'klaive' ),
							'disabled' => __( 'Disabled', 'klaive' ),
						],
					],
					[
						'id'            => 'klaive_api_key',
						'name'          => __( 'API Key', 'klaive' ),
						'desc'          => sprintf(
							__( 'Enter your Klaviyo API key. You may retrieve your Klaviyo API key from your <a href="%s" target="_blank">account settings</a>.', 'klaive' ),
							esc_url_raw( 'https://www.klaviyo.com/account#api-keys-tab' )
						),
						'type'          => 'text',
						'size'          => 'regular',
						'wrapper_class' => $is_enabled_globally ? 'klaive-wrapped-fields' : 'klaive-wrapped-fields give-hidden',
					],
					[
						'id'            => 'klaive_selected_list_globally',
						'name'          => __( 'Select a List', 'klaive' ),
						'desc'          => __( 'Select the list you wish to set as default for subscribe donors.', 'klaive' ),
						'type'          => 'klaviyo_select_list',
						'wrapper_class' => ! empty( $api_key ) ? 'klaive-wrapped-fields' : 'klaive-wrapped-fields give-hidden',
					],
					[
						'id'            => 'klaive_is_checkbox_checked_globally',
						'name'          => __( 'Opt-in Default', 'klaive' ),
						'desc'          => __( 'Would you like the newsletter opt-in checkbox checked by default?', 'klaive' ),
						'options'       => [
							'enabled'  => __( 'Checked', 'klaive' ),
							'disabled' => __( 'Unchecked', 'klaive' ),
						],
						'default'       => 'enabled',
						'type'          => 'radio_inline',
						'wrapper_class' => $is_enabled_globally ? 'klaive-wrapped-fields' : 'klaive-wrapped-fields give-hidden',
					],
					[
						'id'            => 'klaive_checkbox_text_globally',
						'name'          => __( 'Default Text', 'klaive' ),
						'desc'          => __( 'This is the text shown next to the Sign Up Newsletter checkbox.', 'klaive' ),
						'type'          => 'text',
						'size'          => 'regular',
						'attributes'    => [
							'placeholder' => __( 'Subscribe to our newsletter', 'klaive' ),
						],
						'wrapper_class' => $is_enabled_globally ? 'klaive-wrapped-fields' : 'klaive-wrapped-fields give-hidden',
					],
					[
						'id'   => 'give_title_klaviyo',
						'type' => 'sectionend',
					],
				];
				break;
		}

		return $settings;
	}
}
