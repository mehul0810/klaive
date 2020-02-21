<?php
// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin version in SemVer format.
if ( ! defined( 'KLAVIYO_FOR_GIVE_VERSION' ) ) {
	define( 'KLAVIYO_FOR_GIVE_VERSION', '1.0.0' );
}

// Define plugin root File.
if ( ! defined( 'KLAVIYO_FOR_GIVE_PLUGIN_FILE' ) ) {
	define( 'KLAVIYO_FOR_GIVE_PLUGIN_FILE', dirname( dirname( __FILE__ ) ) . '/klaviyo-for-give.php' );
}

// Define plugin directory Path.
if ( ! defined( 'KLAVIYO_FOR_GIVE_PLUGIN_DIR' ) ) {
	define( 'KLAVIYO_FOR_GIVE_PLUGIN_DIR', plugin_dir_path( KLAVIYO_FOR_GIVE_PLUGIN_FILE ) );
}

// Define plugin directory URL.
if ( ! defined( 'KLAVIYO_FOR_GIVE_PLUGIN_URL' ) ) {
	define( 'KLAVIYO_FOR_GIVE_PLUGIN_URL', plugin_dir_url( KLAVIYO_FOR_GIVE_PLUGIN_FILE ) );
}