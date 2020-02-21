<?php
/**
 * Defines the core plugin class
 *
 * @link https://givewp.com
 *
 * @package GiveWP
 * @since 0.1.0
 */

namespace KlaviyoForGive;

use KlaviyoForGive\Admin\Settings;

// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Loads and registers plugin functionality through WordPress hooks.
 *
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Registers functionality with WordPress hooks.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		// Handle plugin activation and deactivation.
		register_activation_hook( GIVEWP_PLUGIN_FILE, array( $this, 'activate' ) );
		register_deactivation_hook( GIVEWP_PLUGIN_FILE, array( $this, 'deactivate' ) );

		// Register services used throughout the plugin.
		add_action( 'plugins_loaded', array( $this, 'register_services' ) );

		// Load text domain.
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
	}

	/**
	 * Registers the individual services of the plugin.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_services() {
		// Register Admin Settings.
		new Settings();
	}

	/**
	 * Loads the plugin's translated strings.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'klaviyo-for-give',
			false,
			dirname( plugin_basename( GIVEWP_PLUGIN_FILE ) ) . '/resources/languages/'
		);
	}

	/**
	 * Handles activation procedures during installation and updates.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param bool $network_wide Optional. Whether the plugin is being enabled on
	 *                           all network sites or a single site. Default false.
	 *
	 * @return void
	 */
	public function activate( $network_wide = false ) {}

	/**
	 * Handles deactivation procedures.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function deactivate() {}
}
