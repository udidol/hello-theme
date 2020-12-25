<?php
/**
 * Hello Elementor functions.
 *
 * @package HelloElementor
 */

use Elementor\Plugin;
use Elementor\Core\Kits\Documents\Tabs;

/**
 * Register Site Settings Controls.
 */

add_action( 'elementor/init', 'hello_elementor_settings_init' );

function hello_elementor_settings_init() {
	require 'controls/settings-header.php';
	require 'controls/settings-footer.php';
}

/**
 * Helper function to return a setting.
 *
 * Saves 2 lines to get kit, then get setting. Also caches the kit and setting.
 *
 * @param  string $setting_id
 * @return string|array same as the Elementor internal function does.
 */
function hello_elementor_get_setting( $setting_id ) {

	global $hello_elementor_settings;

	if ( ! isset( $hello_elementor_settings['active_kit'] ) ) {
		$kit = Plugin::$instance->documents->get( Plugin::$instance->kits_manager->get_active_id(), false );
		$hello_elementor_settings['kit_settings'] = $kit->get_settings();
	}

	if ( isset( $hello_elementor_settings['kit_settings'][ $setting_id ] ) ) {
		$return = $hello_elementor_settings['kit_settings'][ $setting_id ];
	}

	return apply_filters( 'hello_elementor_' . $setting_id, $return );
}

/**
 * Helper function to translate the header layout setting into a class name.
 *
 * @return string
 */
function hello_get_header_layout_class() {

	$header_layout = hello_elementor_get_setting( 'header_layout' );

	$return = '';

	if ( 'inverted' === $header_layout ) {
		$return = 'header-inverted';
	} elseif ( 'stacked' === $header_layout ) {
		$return = 'header-stacked';
	}

	return $return;
}

/**
 * Helper function to translate the footer layout setting into a class name.
 *
 * @return string
 */
function hello_get_footer_layout_class() {

	$header_layout = hello_elementor_get_setting( 'footer_layout' );

	$return = '';

	if ( 'inverted' === $header_layout ) {
		$return = 'footer-inverted';
	} elseif ( 'centered' === $header_layout ) {
		$return = 'footer-stacked';
	}

	return $return;
}

add_action( 'elementor/editor/after_enqueue_scripts', function() {
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script(
		'hello-theme-editor',
		get_template_directory_uri() . '/assets/js/hello-elementor' . $suffix . '.js',
		[ 'jquery', 'elementor-editor' ],
		'1.0.0',
		true
	);
} );
