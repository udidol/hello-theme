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
				'label' => __( 'Header', 'hello-elementor' ),
			]
		);
		
		$element->add_control(
			'header_logo_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Site Logo', 'hello-elementor' ),
				'default'=> 'yes',
			]
		);
		
		$element->add_control(
			'header_menu_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Menu', 'hello-elementor' ),
				'default'=> 'yes',
			]
		);
		
		$element->add_control(
			'header_tagline_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Tagline', 'hello-elementor' ),
				'default'=> 'yes',
			]
		);
		
		$element->add_control(
			'header_layout',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __( 'Layout', 'hello-elementor' ),
				'options' => [
					'default' => 'Default',
					'invert' => 'Invert',
					'centered' => 'Centered',
				],
				'default'=> 'default',
			]
		);

		$element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'header_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '.site-header',
			]
		);
		
		$element->end_controls_section();
		
		$element->start_controls_section(
			'header_logo_section',
			[
				'tab' => 'settings-layout',
				'label' => __( 'Header Branding', 'hello-elementor' ),
			]
		);
		
		$element->add_control(
			'header_logo_width',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => __( 'Logo Width', 'hello-elementor' ),
				'condition'   => [
                    'header_logo_display' => 'yes',
                ],
			]
		);

		$element->add_control(
			'header_logo_color',
			[
				'label' => __( 'Title Color', 'hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'dynamic' => [],
				'condition'   => [
                    'header_logo_display' => 'yes',
                ],
				'selectors' => [
					'.site-header h1.site-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$element->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'header_title_typography',
				'label' => __( 'Title Typography', 'hello-elementor' ),
				'condition'   => [
                    'header_logo_display' => 'yes',
                ],
				'selector' => '.site-header h1.site-title',
			]
		);

		$element->add_control(
			'header_tagline_color',
			[
				'label' => __( 'Tagline Color', 'hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'dynamic' => [],
				'condition'   => [
                    'header_tagline_display' => 'yes',
                ],
				'selectors' => [
					'.site-header .site-description' => 'color: {{VALUE}};',
				],
			]
		);

		$element->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'header_tagline_typography',
				'label' => __( 'Tagline Typography', 'hello-elementor' ),
				'condition'   => [
                    'header_tagline_display' => 'yes',
                ],
				'selector' => '.site-header .site-description',
			]
		);
		
		$element->end_controls_section();


		
		$element->start_controls_section(
			'footer_section',
			[
				'tab' => 'settings-layout',
				'label' => __( 'Footer', 'hello-elementor' ),
			]
		);
		
		$element->add_control(
			'footer_logo_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Site Logo', 'hello-elementor' ),
				'default'=> 'yes',
			]
		);		
		
		$element->add_control(
			'footer_menu_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Menu', 'hello-elementor' ),
				'default'=> 'yes',
			]
		);

		$element->add_control(
			'footer_tagline_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Tagline', 'hello-elementor' ),
				'default'=> 'yes',
			]
		);
		
		$element->add_control(
			'footer_copyright_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Copyright', 'hello-elementor' ),
				'default'=> 'yes',
			]
		);
		
		$element->add_control(
			'footer_layout',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __( 'Layout', 'hello-elementor' ),
				'options' => [
					'default' => 'Default',
					'invert' => 'Invert',
					'centered' => 'Centered',
				],
				'default'=> 'default',
			]
		);

		$element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'footer_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '.site-footer',
			]
		);
		
		$element->end_controls_section();
		
		$element->start_controls_section(
			'footer_logo_section',
			[
				'tab' => 'settings-layout',
				'label' => __( 'Footer Branding', 'hello-elementor' ),
			]
		);
		
		$element->add_control(
			'footer_logo_width',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => __( 'Logo Width', 'hello-elementor' ),
				'condition'   => [
                    'footer_logo_display' => 'yes',
                ],
			]
		);

		$element->add_control(
			'footer_logo_color',
			[
				'label' => __( 'Title Color', 'hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition'   => [
                    'footer_logo_display' => 'yes',
                ],
				'selectors' => [
					'.site-footer h4.site-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$element->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'footer_title_typography',
				'label' => __( 'Title Typography', 'hello-elementor'),
				'condition'   => [
                    'footer_logo_display' => 'yes',
                ],
				'selector' => '.site-footer  h4.site-title',
			]
		);

		$element->add_control(
			'footer_tagline_color',
			[
				'label' => __( 'Tagline Color', 'hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition'   => [
                    'footer_tagline_display' => 'yes',
                ],
				'selectors' => [
					'.site-footer .site-description' => 'color: {{VALUE}};',
				],
			]
		);

		$element->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'footer_tagline_typography',
				'label' => __( 'Tagline Typography', 'hello-elementor' ),
				'condition'   => [
                    'footer_tagline_display' => 'yes',
                ],
				'selector' => '.site-footer .site-description',
			]
		);

		$element->end_controls_section();
		
		$element->start_controls_section(
			'footer_copyright_section',
			[
				'tab' => 'settings-layout',
				'label' => __( 'Footer Copyright', 'hello-elementor' ),
				'condition'   => [
                    'footer_copyright_display' => 'yes',
                ],
			]
		);
		
		$element->add_control(
			'footer_copyright_text',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'All rights reserved',
			]
		);

		$element->add_control(
			'footer_copyright_color',
			[
				'label' => __( 'Copyright Color', 'hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition'   => [
                    'footer_copyright_display' => 'yes',
                ],
				'selectors' => [
					'.site-footer .copyright p' => 'color: {{VALUE}};',
				],
			]
		);

		$element->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'footer_copyright_typography',
				'label' => __( 'Copyright Typography', 'hello-elementor' ),
				'condition'   => [
                    'footer_copyright_display' => 'yes',
                ],
				'selector' => '.site-footer .copyright p',
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
	
	if ( 'invert' == $header_layout ){
		$return = 'header-inverted';
	}
	elseif ( 'centered' == $header_layout ){
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
	
	if ( 'invert' == $header_layout ){
		$return = 'footer-inverted';
	}
	elseif ( 'centered' == $header_layout ){
		$return = 'footer-stacked';
	}
	
	return $return;
}
