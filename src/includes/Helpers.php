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
function klaviyo_for_give_get_api_key() {
	return give_get_option( 'klaviyo_for_give_api_key', false );
}