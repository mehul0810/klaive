<?php
/**
 * Klaviyo for Give | Admin Settings
 *
 * @since 1.0.0
 */
namespace KlaviyoForGive\Includes;

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Trait Helpers
 *
 * @since 1.0.0
 *
 * @package KlaviyoForGive\Includes
 */
trait Helpers {

	/**
	 * This helper function is used to get API key.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public static function get_api_key() {
		return give_get_option( 'klaviyo_for_give_api_key', false );
	}

	/**
	 * This helper function will determine whether to show subscribe checkbox or not.
	 *
	 * @param int $form_id Donation Form ID.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public static function show_subscribe_checkbox( $form_id ) {

		$show_checkbox = give_is_setting_enabled( give_get_option( 'klaviyo_for_give_enable_globally', 'enabled' ) );
		$show_per_form = give_is_setting_enabled( give_get_meta( $form_id, 'klaviyo_for_give_enable_per_form', true ) );

		if ( $show_per_form && $form_id > 0 ) {
			$show_checkbox = $show_per_form;
		}

		return $show_checkbox;
	}

	/**
	 * This helper function will determine whether the subscribe checkbox is checked or not.
	 *
	 * @param int $form_id Donation Form ID.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public static function is_subscribe_checkbox_checked( $form_id ) {

		$is_checked    = give_is_setting_enabled( give_get_option( 'klaviyo_for_give_is_checkbox_checked_globally', 'enabled' ) );
		$show_per_form = give_is_setting_enabled( give_get_meta( $form_id, 'klaviyo_for_give_enable_per_form', true ) );

		if ( $show_per_form && $form_id > 0 ) {
			$is_checked = give_is_setting_enabled( give_get_meta( $form_id, 'klaviyo_for_give_is_checkbox_checked_per_form', true ) );
		}

		return $is_checked;
	}

	/**
	 * This helper function is used to get the text of the subscribe checkbox.
	 *
	 * @param int $form_id Donation Form ID.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public static function get_subscribe_checkbox_text( $form_id ) {

		$default_text  = __( 'Subscribe to our newsletter', 'klaviyo-for-give' );
		$checkbox_text = give_get_option( 'klaviyo_for_give_checkbox_text_globally', $default_text );
		$show_per_form = give_is_setting_enabled( give_get_meta( $form_id, 'klaviyo_for_give_enable_per_form', true ) );

		if ( $show_per_form && $form_id > 0 ) {
			$checkbox_text = give_get_meta( $form_id, 'klaviyo_for_give_checkbox_text_per_form', true );
		}

		return $checkbox_text;
	}

	/**
	 * This helper function is used to get API endpoint.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public static function get_api_endpoint() {
		return 'https://a.klaviyo.com';
	}

	/**
	 * This helper function is used to return all the lists.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array
	 */
	public static function get_all_lists() {

		$endpoint = self::get_api_endpoint() . '/api/v2/lists';
		$api_key  = self::get_api_key();

		$lists = wp_remote_retrieve_body( wp_safe_remote_get( $endpoint, [
			'body' => [
				'api_key' => $api_key,
			],
		] ) );

		return json_decode( $lists );
	}
}