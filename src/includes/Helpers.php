<?php
/**
 * Klaviyo for Give | Admin Settings
 *
 * @since 1.0.0
 */
namespace KlaviyoForGive\Includes\Helpers;

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This helper function is used to get API key.
 *
 * @since 1.0.0
 *
 * @return string
 */
function get_api_key() {
	return give_get_option( 'klaviyo_for_give_api_key', false );
}

/**
 * This helper function will determine whether to show subscribe checkbox or not.
 *
 * @param int $form_id Donation Form ID.
 *
 * @since 1.0.0
 *
 * @return bool
 */
function show_subscribe_checkbox( $form_id ) {

	$display = give_is_setting_enabled( give_get_option( 'klaviyo_for_give_enable_globally', 'enabled' ) );

	if ( $form_id > 0 ) {
		$display = give_is_setting_enabled( give_get_meta( $form_id, 'klaviyo_for_give_enable_per_form', true ) );
	}

	return $display;
}

/**
 * This helper function will determine whether the subscribe checkbox is checked or not.
 *
 * @param int $form_id Donation Form ID.
 *
 * @since 1.0.0
 *
 * @return bool
 */
function is_subscribe_checkbox_checked( $form_id ) {

	$display = give_is_setting_enabled( give_get_option( 'klaviyo_for_give_is_checkbox_checked_globally', 'enabled' ) );

	if ( $form_id > 0 ) {
		$display = give_is_setting_enabled( give_get_meta( $form_id, 'klaviyo_for_give_is_checkbox_checked_per_form', true ) );
	}

	return $display;
}