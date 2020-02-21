<?php
/**
 * Klaviyo for Give | Admin Settings
 *
 * @since 1.0.0
 */
namespace KlaviyoForGive\Admin;

/**
 * Class Settings.
 *
 * @since 1.0.0
 *
 * @package KlaviyoForGive\Admin
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
		$sections['klaviyo'] = __( 'Klaviyo', 'klaviyo-for-give' );

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

		switch ( give_get_current_setting_section() ) {

			case 'klaviyo':
				$settings = array(
					array(
						'id'   => 'give_title_klaviyo',
						'type' => 'title',
					),
					array(
						'name' => __( 'Klaviyo Settings', 'klaviyo-for-give' ),
						'desc' => '<hr>',
						'id'   => 'give_title_klaviyo',
						'type' => 'give_title',
					),
					array(
						'id'      => 'klaviyo_for_give_enable_globally',
						'name'    => __( 'Enable Globally', 'klaviyo-for-give' ),
						'desc'    => __( 'Allow donors to sign up for the forms selected below on all donation forms?', 'klaviyo-for-give' ),
						'type'    => 'radio_inline',
						'default' => 'enabled',
						'options' => array(
							'enabled'  => __( 'Enabled', 'klaviyo-for-give' ),
							'disabled' => __( 'Disabled', 'klaviyo-for-give' ),
						),
					),
					array(
						'id'   => 'klaviyo_for_give_api_key',
						'name' => __( 'API Key', 'klaviyo-for-give' ),
						'desc' => sprintf(
							__( 'Enter your Klaviyo API key. You may retrieve your Klaviyo API key from your <a href="%s" target="_blank">account settings</a>.', 'klaviyo-for-give' ),
							esc_url_raw( 'https://www.klaviyo.com/account#api-keys-tab' )
						),
						'type' => 'text',
						'size' => 'regular',
					),
					array(
						'id'   => 'klaviyo_for_give_selected_list',
						'name' => __( 'Select a List', 'klaviyo-for-give' ),
						'desc' => __( 'Select the list you wish to set as default for subscribe donors.', 'klaviyo-for-give' ),
						'type' => 'klaviyo_select_list',
					),
					array(
						'id'      => 'klaviyo_for_give_checked_default',
						'name'    => __( 'Opt-in Default', 'klaviyo-for-give' ),
						'desc'    => __( 'Would you like the newsletter opt-in checkbox checked by default?', 'klaviyo-for-give' ),
						'options' => array(
							'enabled'  => __( 'Checked', 'klaviyo-for-give' ),
							'disabled' => __( 'Unchecked', 'klaviyo-for-give' ),
						),
						'default' => 'enabled',
						'type'    => 'radio_inline',
					),
					array(
						'id'         => 'klaviyo_for_give_default_checkbox_text',
						'name'       => __( 'Default Text', 'klaviyo-for-give' ),
						'desc'       => __( 'This is the text shown next to the Sign Up Newsletter checkbox. This can also be customized per form.', 'klaviyo-for-give' ),
						'type'       => 'text',
						'size'       => 'regular',
						'attributes' => array(
							'placeholder' => __( 'Subscribe to our newsletter', 'klaviyo-for-give' ),
						),
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
