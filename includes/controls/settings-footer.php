<?php

namespace Elementor\Core\Kits\Documents\Tabs;

use Elementor\Plugin;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Responsive\Responsive;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Hello_Settings_Footer extends Tab_Base {

	public function get_id() {
		return 'hello-settings-footer';
	}

	public function get_title() {
		return __( 'Footer', 'hello-elementor' );
	}

	public function get_icon() {
		return 'eicon-footer';
	}

	protected function register_tab_controls() {

		$this->start_controls_section(
			'hello_footer_section',
			[
				'tab' => 'hello-settings-footer',
				'label' => __( 'Footer', 'hello-elementor' ),
			]
		);

		$this->add_control(
			'hello_footer_logo_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Site Logo', 'hello-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'hello_footer_title_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Site Name', 'hello-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'hello_footer_tagline_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Tagline', 'hello-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'hello_footer_menu_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Menu', 'hello-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'hello_footer_copyright_display',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __( 'Copyright', 'hello-elementor' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'hello_footer_layout',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __( 'Layout', 'hello-elementor' ),
				'options' => [
					'default' => __( 'Default', 'hello-elementor' ),
					'inverted' => __( 'Invert', 'hello-elementor' ),
					'stacked' => __( 'Centered', 'hello-elementor' ),
				],
				'prefix_class' => 'footer-',
				'selector' => '.site-footer',
				'default' => 'default',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'hello_footer_background',
				'label' => __( 'Background', 'hello-elementor' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '.site-footer',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_footer_logo_section',
			[
				'tab' => 'hello-settings-footer',
				'label' => __( 'Logo', 'hello-elementor' ),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'hello_footer_logo_display',
							'operator' => '=',
							'value' => 'yes',
						],
						[
							'name' => 'hello_footer_tagline_display',
							'operator' => '=',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'hello_footer_logo_width',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => __( 'Logo Width', 'hello-elementor' ),
				'condition'   => [
					'hello_footer_logo_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'hello_footer_logo_color',
			[
				'label' => __( 'Title Color', 'hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'dynamic' => [],
				'condition'   => [
					'hello_footer_logo_display' => 'yes',
				],
				'selectors' => [
					'.site-footer h4.site-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'hello_footer_title_typography',
				'label' => __( 'Title Typography', 'hello-elementor' ),
				'condition'   => [
					'hello_footer_logo_display' => 'yes',
				],
				'selector' => '.site-footer h4.site-title',

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_footer_tagline',
			[
				'tab' => 'hello-settings-footer',
				'label' => __( 'Tagline', 'hello-elementor' ),
				'condition'   => [
					'hello_footer_tagline_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'hello_footer_tagline_color',
			[
				'label' => __( 'Tagline Color', 'hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'dynamic' => [],
				'condition'   => [
					'hello_footer_tagline_display' => 'yes',
				],
				'selectors' => [
					'.site-footer .site-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'hello_footer_tagline_typography',
				'label' => __( 'Tagline Typography', 'hello-elementor' ),
				'condition'   => [
					'hello_footer_tagline_display' => 'yes',
				],
				'selector' => '.site-footer .site-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_footer_menu',
			[
				'tab' => 'hello-settings-footer',
				'label' => __( 'Menu', 'hello-elementor' ),
				'condition'   => [
					'hello_footer_menu_display' => 'yes',
				],
			]
		);

		$available_menus = wp_get_nav_menus();

		foreach ( $available_menus as $available_menu ) {
			$menus[ $available_menu->slug ] = $available_menu->name;
		}

		if ( empty( $menus ) ) {
			$this->add_control(
				'hello_footer_menu_notice',
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
				'hello_footer_menu_layout',
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
				'hello_footer_menu_dropdown',
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
						'hello_footer_menu_layout!' => 'dropdown',
					],
				]
			);

			$this->add_control(
				'hello_footer_menu_color',
				[
					'label' => __( 'Color', 'hello-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition'   => [
						'hello_footer_copyright_display' => 'yes',
					],
					'selectors' => [
						'.site-footer .copyright p' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'hello_footer_menu_typography',
					'label' => __( 'Typography', 'hello-elementor' ),
					'condition'   => [
						'hello_footer_copyright_display' => 'yes',
					],
					'selector' => '.site-footer .copyright p',
				]
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_footer_copyright_section',
			[
				'tab' => 'hello-settings-footer',
				'label' => __( 'Copyright', 'hello-elementor' ),
				'condition'   => [
					'hello_footer_copyright_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'hello_footer_copyright_text',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'All rights reserved',
			]
		);

		$this->add_control(
			'hello_footer_copyright_color',
			[
				'label' => __( 'Copyright Color', 'hello-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition'   => [
					'hello_footer_copyright_display' => 'yes',
				],
				'selectors' => [
					'.site-footer .copyright p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'hello_footer_copyright_typography',
				'label' => __( 'Copyright Typography', 'hello-elementor' ),
				'condition'   => [
					'hello_footer_copyright_display' => 'yes',
				],
				'selector' => '.site-footer .copyright p',
			]
		);

		$this->end_controls_section();
	}
}

add_action( 'elementor/kit/register_tabs', function( \Elementor\Core\Kits\Documents\Kit $kit ) {
	$kit->register_tab( 'hello-settings-footer', Hello_Settings_Footer::class );
} );
