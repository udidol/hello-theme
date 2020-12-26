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
 * Helper function to show/hide elements
 *
 * This works with switches, if the setting ID that has been passed is toggled on, we'll return show, otherwise we'll return hide
 *
 * @param  string $setting_id
 * @return string|array same as the Elementor internal function does.
 */
function hello_show_or_hide( $setting_id ) {
	return ( 'yes' === hello_elementor_get_setting( $setting_id ) ? 'show' : 'hide' );
}

/**
 * Helper function to translate the header layout setting into a class name.
 *
 * @return string
 */
function hello_get_header_layout_class() {

	$header_layout = hello_elementor_get_setting( 'hello_header_layout' );

	$layout_class = '';

	if ( 'inverted' === $header_layout ) {
		$layout_class = 'header-inverted';
	} elseif ( 'stacked' === $header_layout ) {
		$layout_class = 'header-stacked';
	}

	return $layout_class;
}

/**
 * Helper function to translate the footer layout setting into a class name.
 *
 * @return string
 */
function hello_get_footer_layout_class() {

	$footer_layout = hello_elementor_get_setting( 'hello_footer_layout' );

	$layout_class = '';

	if ( 'inverted' === $footer_layout ) {
		$layout_class = 'footer-inverted';
	} elseif ( 'centered' === $footer_layout ) {
		$layout_class = 'footer-stacked';
	}

	return $layout_class;
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
