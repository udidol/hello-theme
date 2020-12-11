<?php
/**
 * Hello Elementor functions.
 *
 * @package HelloElementor
 */

use Elementor\Plugin;

/**
 * Register Site Settings Controls.
 */
add_action(
	'elementor/element/kit/section_settings-layout/before_section_start',
	function( $element, $args ) {
		
		$element->start_controls_section(
			'header_section',
			[
				'tab' => 'settings-layout',
				'label' => __( 'Header', 'plugin-name' ),
			]
		);
		
		$element->add_control(
			'site_logo_setting',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Site Logo', 'plugin-name' ),
				'default'=> 'yes',
			]
		);
		
		$element->add_control(
			'tagline',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Tagline', 'plugin-name' ),
				'default'=> 'yes',
			]
		);
		
		$element->add_control(
			'header_layout',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __( 'Layout', 'plugin-name' ),
				'options' => [
					'default' => 'Default',
					'invert' => 'Invert',
					'centered' => 'Centered',
				],
				'default'=> 'default',
			]
		);
		
		$element->end_controls_section();
		
		$element->start_controls_section(
			'site_logo_section',
			[
				'tab' => 'settings-layout',
				'label' => __( 'Site Logo', 'plugin-name' ),
				'condition'   => [
                    'site_logo_setting' => 'yes',
                ],
			]
		);
		
		$element->add_control(
			'site_logo_width',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => __( 'Logo Width', 'plugin-name' ),
			]
		);
		
		$element->end_controls_section();
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
	
	if ( ! is_array( $hello_elementor_settings ) ) $hello_elementor_settings = [];
	
	if ( ! isset( $hello_elementor_settings['active_kit'] ) ){
		
		$kit = Plugin::$instance->documents->get( Plugin::$instance->kits_manager->get_active_id(), false );
		$hello_elementor_settings['kit_settings'] = $kit->get_settings();
	}
	
	$return = NULL;
	
	if ( isset( $hello_elementor_settings['kit_settings'][$setting_id] ) ){
		
		$return = $hello_elementor_settings['kit_settings'][$setting_id];
	}
	
	return $return;
}

/**
 * Helper function to translate the header layout setting into a class name.
 *
 * @return string
 */
function get_header_layout_class(){
	
	$header_layout = hello_elementor_get_setting( 'header_layout' );
	
	$return = '';
	
	if ( 'invert' == $header_layout ){
		$return = 'header-inverted';
	}
	elseif ( 'centered' == $header_layout ){
		$return = 'header-stacked';
	}
	
	return $return;
}
