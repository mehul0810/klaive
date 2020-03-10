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
		add_filter( 'give_get_sections_addons', array( $this, 'register_sections' ) );
		add_filter( 'give_get_settings_addons', array( $this, 'register_settings' ) );
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

		switch ( give_get_current_setting_section() ) {

			case 'klaviyo':
				$settings = array(
					array(
						'id'            => 'give_title_klaviyo',
						'type'          => 'title',
						'desc'          => sprintf(
							__( '<div class="%1$s">Don\'t have a Klaviyo account? <a target="_blank" rel="noopener" href="%2$s">Click here</a> to create your Klaviyo account now.</div>', 'klaive' ),
							'klaive-heading-description',
							esc_url_raw( 'https://www.klaviyo.com/partner/signup?utm_source=0013o00002RsCYO&utm_medium=partner' )
						),
					),
					array(
						'id'      => 'klaive_enable_globally',
						'name'    => __( 'Enable Globally', 'klaive' ),
						'desc'    => __( 'Allow donors to sign up for the forms selected below on all donation forms?', 'klaive' ),
						'type'    => 'radio_inline',
						'default' => 'enabled',
						'options' => array(
							'enabled'  => __( 'Enabled', 'klaive' ),
							'disabled' => __( 'Disabled', 'klaive' ),
						),
					),
					array(
						'id'            => 'klaive_api_key',
						'name'          => __( 'API Key', 'klaive' ),
						'desc'          => sprintf(
							__( 'Enter your Klaviyo API key. You may retrieve your Klaviyo API key from your <a href="%s" target="_blank">account settings</a>.', 'klaive' ),
							esc_url_raw( 'https://www.klaviyo.com/account#api-keys-tab' )
						),
						'type'          => 'text',
						'size'          => 'regular',
						'wrapper_class' => $is_enabled_globally ? 'klaive-wrapped-fields' : 'klaive-wrapped-fields give-hidden',
					),
					array(
						'id'            => 'klaive_selected_list_globally',
						'name'          => __( 'Select a List', 'klaive' ),
						'desc'          => __( 'Select the list you wish to set as default for subscribe donors.', 'klaive' ),
						'type'          => 'klaviyo_select_list',
						'wrapper_class' => $is_enabled_globally ? 'klaive-wrapped-fields' : 'klaive-wrapped-fields give-hidden',
					),
					array(
						'id'            => 'klaive_is_checkbox_checked_globally',
						'name'          => __( 'Opt-in Default', 'klaive' ),
						'desc'          => __( 'Would you like the newsletter opt-in checkbox checked by default?', 'klaive' ),
						'options'       => array(
							'enabled'  => __( 'Checked', 'klaive' ),
							'disabled' => __( 'Unchecked', 'klaive' ),
						),
						'default'       => 'enabled',
						'type'          => 'radio_inline',
						'wrapper_class' => $is_enabled_globally ? 'klaive-wrapped-fields' : 'klaive-wrapped-fields give-hidden',
					),
					array(
						'id'            => 'klaive_checkbox_text_globally',
						'name'          => __( 'Default Text', 'klaive' ),
						'desc'          => __( 'This is the text shown next to the Sign Up Newsletter checkbox. This can also be customized per form.', 'klaive' ),
						'type'          => 'text',
						'size'          => 'regular',
						'attributes'    => array(
							'placeholder' => __( 'Subscribe to our newsletter', 'klaive' ),
						),
						'wrapper_class' => $is_enabled_globally ? 'klaive-wrapped-fields' : 'klaive-wrapped-fields give-hidden',
					),
					array(
						'id'   => 'give_title_klaviyo',
						'type' => 'sectionend',
					),
				);
				break;
		}

		return $settings;
	}
}
