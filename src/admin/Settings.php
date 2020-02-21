<?php
namespace KlaviyoForGive\Admin;

class Settings {

	public function __construct() {
		add_filter( 'give_get_sections_addons', array( $this, 'register_sections' ) );
		add_filter( 'give_get_settings_addons', array( $this, 'register_settings' ) );
	}


	/**
	 * Register sections.
	 *
	 * @since  1.0.3
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
	 * @param $settings
	 *
	 * @return array
	 */
	public function register_settings( $settings ) {

		$get_data = give_clean( $_GET );

		if (
			'addons' == $get_data['tab'] &&
			'klaviyo' == $get_data['section']
		) {
			$settings = array(
				array(
				'id'   => 'give_title_klaviyo',
					'type' => 'title',
				),
				array(
					'name' => __( 'Klaviyo Settings', 'give-convertkit' ),
					'desc' => '<hr>',
					'id'   => 'give_title_',
					'type' => 'give_title',
				),
				array(
					'id'   => 'give_klaviyo_api_key',
					'name' => __( 'ConvertKit API Key', 'give-convertkit' ),
					'desc' => sprintf( __( 'Enter your ConvertKit API key. You may retrieve your ConvertKit API key from your <a href="%s" target="_blank" title="Will open new window">account settings</a>.', 'give-convertkit' ), 'https://app.convertkit.com/account/edit' ),
					'type' => 'text',
					'size' => 'regular',
				),
				array(
					'id'      => 'give_klaviyo_show_subscribe_checkbox',
					'name'    => __( 'Enable Globally', 'give-convertkit' ),
					'desc'    => __( 'Allow donors to sign up for the forms selected below on all donation forms? Note: the forms(s) can be customized per form.', 'give-convertkit' ),
					'type'    => 'radio_inline',
					'default' => 'enabled',
					'options' => array(
						'enabled'  => __( 'Enabled', 'give-convertkit' ),
						'disabled' => __( 'Disabled', 'give-convertkit' ),
					),
				),
				array(
					'id'   => 'give_klaviyo_list',
					'name' => __( 'Choose a Form', 'give-convertkit' ),
					'desc' => __( 'Select the form you wish to subscribe donors to by default.', 'give-convertkit' ),
					'type' => 'convertkit_list_select',
				),
				array(
					'id'   => '_give_klaviyo_tags',
					'name' => __( 'Choose Tags', 'give-convertkit' ),
					'desc' => __( 'Select the tags you wish to subscribe donors to by default.', 'give-convertkit' ),
					'type' => 'convertkit_tag_list',
				),
				array(
					'id'      => 'give_klaviyo_checked_default',
					'name'    => __( 'Opt-in Default', 'give-convertkit' ),
					'desc'    => __( 'Would you like the newsletter opt-in checkbox checked by default? This option can be customized per form.', 'give-convertkit' ),
					'options' => array(
						'enabled'  => __( 'Checked', 'give-convertkit' ),
						'disabled' => __( 'Unchecked', 'give-convertkit' ),
					),
					'default' => 'enabled',
					'type'    => 'radio_inline',
				),
				array(
					'id'         => 'give_klaviyo_label',
					'name'       => __( 'Default Label', 'give-convertkit' ),
					'desc'       => __( 'This is the text shown next to the signup option. This can also be customized per form.', 'give-convertkit' ),
					'type'       => 'text',
					'size'       => 'regular',
					'attributes' => array(
						'placeholder' => __( 'Subscribe to our newsletter', 'give-convertkit' ),
					),
				),
				array(
					'id'   => 'give_title_klaviyo',
					'type' => 'sectionend',
				),
			);
		}

//		switch ( give_get_current_setting_section() ) {
//
//			case 'klaviyo':
//				$settings = array(
//					array(
//						'id'   => 'give_title_klaviyo',
//						'type' => 'title',
//					),
//					array(
//						'name' => __( 'Klaviyo Settings', 'give-convertkit' ),
//						'desc' => '<hr>',
//						'id'   => 'give_title_',
//						'type' => 'give_title',
//					),
//					array(
//						'id'   => 'give_klaviyo_api_key',
//						'name' => __( 'ConvertKit API Key', 'give-convertkit' ),
//						'desc' => sprintf( __( 'Enter your ConvertKit API key. You may retrieve your ConvertKit API key from your <a href="%s" target="_blank" title="Will open new window">account settings</a>.', 'give-convertkit' ), 'https://app.convertkit.com/account/edit' ),
//						'type' => 'text',
//						'size' => 'regular',
//					),
//					array(
//						'id'      => 'give_klaviyo_show_subscribe_checkbox',
//						'name'    => __( 'Enable Globally', 'give-convertkit' ),
//						'desc'    => __( 'Allow donors to sign up for the forms selected below on all donation forms? Note: the forms(s) can be customized per form.', 'give-convertkit' ),
//						'type'    => 'radio_inline',
//						'default' => 'enabled',
//						'options' => array(
//							'enabled'  => __( 'Enabled', 'give-convertkit' ),
//							'disabled' => __( 'Disabled', 'give-convertkit' ),
//						),
//					),
//					array(
//						'id'   => 'give_klaviyo_list',
//						'name' => __( 'Choose a Form', 'give-convertkit' ),
//						'desc' => __( 'Select the form you wish to subscribe donors to by default.', 'give-convertkit' ),
//						'type' => 'convertkit_list_select',
//					),
//					array(
//						'id'   => '_give_klaviyo_tags',
//						'name' => __( 'Choose Tags', 'give-convertkit' ),
//						'desc' => __( 'Select the tags you wish to subscribe donors to by default.', 'give-convertkit' ),
//						'type' => 'convertkit_tag_list',
//					),
//					array(
//						'id'      => 'give_klaviyo_checked_default',
//						'name'    => __( 'Opt-in Default', 'give-convertkit' ),
//						'desc'    => __( 'Would you like the newsletter opt-in checkbox checked by default? This option can be customized per form.', 'give-convertkit' ),
//						'options' => array(
//							'enabled'  => __( 'Checked', 'give-convertkit' ),
//							'disabled' => __( 'Unchecked', 'give-convertkit' ),
//						),
//						'default' => 'enabled',
//						'type'    => 'radio_inline',
//					),
//					array(
//						'id'         => 'give_klaviyo_label',
//						'name'       => __( 'Default Label', 'give-convertkit' ),
//						'desc'       => __( 'This is the text shown next to the signup option. This can also be customized per form.', 'give-convertkit' ),
//						'type'       => 'text',
//						'size'       => 'regular',
//						'attributes' => array(
//							'placeholder' => __( 'Subscribe to our newsletter', 'give-convertkit' ),
//						),
//					),
//					array(
//						'id'   => 'give_title_klaviyo',
//						'type' => 'sectionend',
//					),
//				);
//				break;
//		}

		return $settings;
	}
}
