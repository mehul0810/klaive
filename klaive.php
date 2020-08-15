<?php
/**
 * Klaive WordPress Plugin
 *
 * @package           Klaive
 * @author            Mehul Gohil
 * @copyright         2020 Mehul Gohil <hello@mehulgohil.com>
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 *
 * Plugin Name:       Klaive - Integrate Klaviyo with GiveWP
 * Plugin URI:        https://mehulgohil.com/plugins/klaive/
 * Description:       Integrate Klaviyo with GiveWP for better email marketing campaigns.
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            Mehul Gohil
 * Author URI:        https://mehulgohil.com
 * Text Domain:       klaive
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace Klaive;

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
