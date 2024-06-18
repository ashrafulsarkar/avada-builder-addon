<?php
/**
 * Plugin Name: Avada Builder Addon
 * Plugin URI: https://github.com/Theme-Fusion/Fusion-Builder-Sample-Add-On
 * Description: Adds simple hello world example of front-end API.
 * Version: 1.0.0
 * Author: Ashraful Sarkar Naiem
 * Author URI: https://github.com/ashrafulsarkar/
 *
 * @package Sample Addon for Fusion Builder
 */

// Plugin Folder Path.
if ( ! defined( 'SAMPLE_ADDON_PLUGIN_DIR' ) ) {
	define( 'SAMPLE_ADDON_PLUGIN_DIR', wp_normalize_path( plugin_dir_path( __FILE__ ) ) );
}

// Plugin Folder URL.
if ( ! defined( 'SAMPLE_ADDON_PLUGIN_URL' ) ) {
	define( 'SAMPLE_ADDON_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! class_exists( 'Sample_Addon_FB' ) ) {

	// Init the elements.
	function my_init_elements() {
		include_once wp_normalize_path( SAMPLE_ADDON_PLUGIN_DIR . '/elements/custom-card.php' );
	}
	add_action( 'fusion_builder_shortcodes_init', 'my_init_elements', 10 );

}
