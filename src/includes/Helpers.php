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

		$display_globally = give_is_setting_enabled( give_get_option( 'klaviyo_for_give_enable_globally', 'enabled' ) );
		$display_per_form = $form_id > 0 ?
			give_is_setting_enabled( give_get_meta( $form_id, 'klaviyo_for_give_enable_per_form', true ) ) :
			false;

		return $display_per_form ? $display_per_form : $display_globally;
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

		$is_checked_globally = give_is_setting_enabled( give_get_option( 'klaviyo_for_give_is_checkbox_checked_globally', 'enabled' ) );
		$is_checked_per_form = $form_id > 0 ?
			give_is_setting_enabled( give_get_meta( $form_id, 'klaviyo_for_give_is_checkbox_checked_per_form', true ) ) :
			false;

		return $is_checked_per_form ? $is_checked_per_form : $is_checked_globally;
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
		$text_globally = give_get_option( 'klaviyo_for_give_checkbox_text_globally', $default_text );
		$text_per_form = $form_id > 0 ?
			give_get_meta( $form_id, 'klaviyo_for_give_checkbox_text_per_form', true ) :
			false;

		return $text_per_form ? $text_per_form : $text_globally;
	}
}