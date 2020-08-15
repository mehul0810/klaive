<?php
// Bailout, if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin version in SemVer format.
if ( ! defined( 'KLAIVE_VERSION' ) ) {
	define( 'KLAIVE_VERSION', '1.0.1' );
}

// Define plugin root File.
if ( ! defined( 'KLAIVE_PLUGIN_FILE' ) ) {
	define( 'KLAIVE_PLUGIN_FILE', dirname( dirname( __FILE__ ) ) . '/klaive.php' );
}

// Define plugin directory Path.
if ( ! defined( 'KLAIVE_PLUGIN_DIR' ) ) {
	define( 'KLAIVE_PLUGIN_DIR', plugin_dir_path( KLAIVE_PLUGIN_FILE ) );
}

// Define plugin directory URL.
if ( ! defined( 'KLAIVE_PLUGIN_URL' ) ) {
	define( 'KLAIVE_PLUGIN_URL', plugin_dir_url( KLAIVE_PLUGIN_FILE ) );
}
