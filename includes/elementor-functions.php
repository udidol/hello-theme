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

require 'controls/settings-header.php';
require 'controls/settings-footer.php';

add_action(
	'elementor/element/kit/section_settings-layout/before_section_start',
	function( $kit, $args ) {
		
		// TODO: waiting for a way to register new tabs in Elementor.
		// This method goes as far as registering the new tab so is
		// ready for Elementor to render the tab. Not sure if this is
		// intended that we go as far as extending the Elementor\Core\Kits\Documents\Tabs
		// or if we should extend a new local Hello_Elementor\Tabs class.
		
		$tabs = [
			'settings-header' => new Tabs\Settings_Header( $kit ),
			'settings-footer' => new Tabs\Settings_Footer( $kit ),
		];
		
		foreach ( $tabs as $tab ) {
			$tab->register_controls();
		}
	},
	10,
	2
);
	
/**
 * Helper function to return a setting.
 *
 * Saves 2 lines to get kit, then get setting. Also caches the kit and setting.
 *
 * @param  string $setting_id
 * @return string|array same as the Elementor internal function does.
 */
function hello_elementor_get_setting( $setting_id ){
	
	global $hello_elementor_settings;
	
	if ( ! isset( $hello_elementor_settings['active_kit'] ) ){
		
		$kit = Plugin::$instance->documents->get( Plugin::$instance->kits_manager->get_active_id(), false );
		$hello_elementor_settings['kit_settings'] = $kit->get_settings();
	}
	
	$return = NULL;
	
	if ( isset( $hello_elementor_settings['kit_settings'][$setting_id] ) ){
		
		$return = $hello_elementor_settings['kit_settings'][$setting_id];
	}
	
	return apply_filters( 'hello_elementor_' . $setting_id, $return );
}

/**
 * Helper function to translate the header layout setting into a class name.
 *
 * @return string
 */
function hello_get_header_layout_class(){
	
	$header_layout = hello_elementor_get_setting( 'header_layout' );
	
	$return = '';
	
	if ( 'inverted' == $header_layout ){
		$return = 'header-inverted';
	}
	elseif ( 'stacked' == $header_layout ){
		$return = 'header-stacked';
	}
	
	return $return;
}

/**
 * Helper function to translate the footer layout setting into a class name.
 *
 * @return string
 */
function hello_get_footer_layout_class(){
	
	$header_layout = hello_elementor_get_setting( 'footer_layout' );
	
	$return = '';
	
	if ( 'inverted' == $header_layout ){
		$return = 'footer-inverted';
	}
	elseif ( 'centered' == $header_layout ){
		$return = 'footer-stacked';
	}
	
	return $return;
}
