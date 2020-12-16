<?php

namespace Elementor\Core\Kits\Documents\Tabs;

use Elementor\Plugin;
use Elementor\Core\Kits\Documents\Tabs;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Responsive\Responsive;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
class Settings_Header extends Tab_Base {

	public function get_id() {
		return 'settings-header';
	}

	public function get_title() {
		return __( 'Header', 'hello-elementor' );
	}

	protected function register_tab_controls() {
		
		$this->start_controls_section(
			'header_section',
			[
				'tab' => 'settings-layout',
				'label' => __( 'Header', 'hello-elementor' ),
			]
		);

		$this->add_control(
			'header_logo_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Site Logo', 'hello-elementor' ),
				'default'=> 'yes',
			]
		);

		$this->add_control(
			'header_menu_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Menu', 'hello-elementor' ),
				'default'=> 'yes',
			]
		);

		$this->add_control(
			'header_tagline_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Tagline', 'hello-elementor' ),
				'default'=> 'yes',
			]
		);

		$this->add_control(
			'header_layout',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __( 'Layout', 'hello-elementor' ),
				'options' => [
					'default' => 'Default',
					'inverted' => 'Invert',
					'stacked' => 'Centered',
				],
				'prefix_class' => 'header-',
				'selector' => '.site-header',
				'default'=> 'default',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'header_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '.site-header',
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'header_logo_section',
			[
				'tab' => 'settings-layout',
				'label' => __( 'Header Branding', 'hello-elementor' ),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'header_logo_display',
							'operator' => '=',
							'value' => 'yes',
						],
						[
							'name' => 'header_tagline_display',
							'operator' => '=',
							'value' => 'yes',
						],
					],
				]
			],
		);

		$this->add_control(
			'header_logo_width',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => __( 'Logo Width', 'hello-elementor' ),
				'description' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage you site\'s logo', 'hello-elementor' ), '#' ),
				'size_units' => [ '%', 'px', 'vh' ],
				[
					'unit' => 'px',
					'size' => '',
				],
				'condition'   => [
					'header_logo_display' => 'yes',
				],
			]
		);

		$this->add_control(
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

		$this->add_group_control(
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

		$this->add_control(
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

		$this->add_group_control(
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

		$this->end_controls_section();
		

		$this->start_controls_section(
			'header_menu',
			[
				'tab' => 'settings-layout',
				'label' => __( 'Header Menu', 'hello-elementor' ),
				'condition'   => [
		            'header_menu_display' => 'yes',
		        ],
			]
		);

		$available_menus = wp_get_nav_menus();

		foreach ( $available_menus as $available_menu ) {
			$menus[ $available_menu->slug ] = $available_menu->name;
		}

		if ( empty( $menus ) ) {
			
			$this->add_control(
				'header_menu_notice',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'There are no menus in your site.', 'hello-elementor' ) . '</strong><br>' . sprintf( __( 'Go to <a href="%s" target="_blank">Menus screen</a> to create one.', 'hello-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		} else {
			
			$this->add_control(
				'menu',
				[
					'label' => __( 'Menu', 'hello-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'save_default' => true,
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'hello-elementor' ), admin_url( 'nav-menus.php' ) ),
				]
			);
			
			$this->add_control(
				'header_menu_layout',
				[
					'label' => __( 'Menu Layout', 'hello-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => [
						'horizontal' => __( 'Horizontal', 'hello-elementor' ),
						'dropdown' => __( 'Dropdown', 'hello-elementor' ),
					],
					'frontend_available' => true,
				]
			);

			$breakpoints = Responsive::get_breakpoints();

			$this->add_control(
				'header_menu_dropdown',
				[
					'label' => __( 'Breakpoint', 'hello-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'tablet',
					'options' => [
						/* translators: %d: Breakpoint number. */
						'mobile' => sprintf( __( 'Mobile (< %dpx)', 'hello-elementor' ), $breakpoints['md'] ),
						/* translators: %d: Breakpoint number. */
						'tablet' => sprintf( __( 'Tablet (< %dpx)', 'hello-elementor' ), $breakpoints['lg'] ),
						'none' => __( 'None', 'hello-elementor' ),
					],
					'prefix_class' => 'elementor-nav-menu--dropdown-',
					'condition' => [
						'header_menu_layout!' => 'dropdown',
					],
				]
			);

			$this->add_control(
				'header_menu_color',
				[
					'label' => __( 'Color', 'hello-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition'   => [
			            'footer_copyright_display' => 'yes',
			        ],
					'selectors' => [
						'.site-footer .copyright p' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'header_menu_typography',
					'label' => __( 'Typography', 'hello-elementor' ),
					'condition'   => [
			            'footer_copyright_display' => 'yes',
			        ],
					'selector' => '.site-footer .copyright p',
				]
			);
		}

		$this->end_controls_section();
		

		$this->start_controls_section(
			'header_tagline',
			[
				'tab' => 'settings-layout',
				'label' => __( 'Header Tagline', 'hello-elementor' ),
				'condition'   => [
		            'header_tagline_display' => 'yes',
		        ],
			]
		);

		$this->add_control(
			'tagline_color',
			[
				'label' => __( 'Color', 'hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.site-footer .copyright p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tagline_typography',
				'label' => __( 'Typography', 'hello-elementor' ),
				'selector' => '.site-footer .copyright p',
			]
		);

		$this->end_controls_section();
	}
}
