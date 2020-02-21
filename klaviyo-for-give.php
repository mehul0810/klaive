<?php
/**
 * Klaviyo for GiveWP
 *
 * @package           KlaviyoForGive
 * @author            Mehul Gohil
 * @copyright         2020 Mehul Gohil <hello@mehulgohil.com>
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Klaviyo for GiveWP
 * Plugin URI:        https://mehulgohil.com/plugins/klaviyo-for-givewp/
 * Description:       Integrates Klaviyo with GiveWP.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            Mehul Gohil
 * Author URI:        https://mehulgohil.com
 * Text Domain:       klaviyo-for-give
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace KlaviyoForGive;

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/config/constants.php';

// Automatically loads files used throughout the plugin.
require_once 'vendor/autoload.php';

// Initialize the plugin.
$plugin = new Plugin();
$plugin->register();
