<?php
namespace Klaive;

use Klaive\Admin\Settings;
use Klaive\Includes\Actions;
use Klaive\Admin\Filters;
use Appsero\Client;

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
		register_activation_hook( KLAIVE_PLUGIN_FILE, [ $this, 'activate' ] );
		register_deactivation_hook( KLAIVE_PLUGIN_FILE, [ $this, 'deactivate' ] );

		// Register services used throughout the plugin.
		add_action( 'plugins_loaded', [ $this, 'register_services' ] );

		// Load text domain.
		add_action( 'init', [ $this, 'init' ] );
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

		// Register Admin Actions.
		new \Klaive\Admin\Actions();

		// Register Admin Settings.
		new Settings();

		// Register Frontend Actions.
		new Actions();

		// Register Frontend Filters
		new Filters();
	}

	/**
	 * Load on Init Hook.
	 *
	 * @since  1.0.1
	 * @access public
	 *
	 * @return void
	 */
	public function init() {
		$this->load_appsero();
		$this->load_plugin_textdomain();
	}

	/**
	 * Load Appsero.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function load_appsero() {
		$client = new Client( 'fae452e4-5511-4b37-a828-ebfba78f7062', 'Klaive - Integrates Klaviyo with Give', KLAIVE_PLUGIN_FILE );

		// Active insights.
		$client->insights()->notice( 'Help us improve <strong>Klaive</strong> by allowing us to collect non-sensitive diagnostic data and usage informaiton.' )->init();
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
			'klaive',
			false,
			dirname( plugin_basename( KLAIVE_PLUGIN_FILE ) ) . '/languages/'
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
