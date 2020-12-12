<?php /**
 *
 * Elementor Hello Theme Header Menu Settings
 *
*/

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Responsive\Responsive;

$element->start_controls_section(
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

if ( ! empty( $menus ) ) {
	$element->add_control(
		'menu',
		[
			'label' => __( 'Menu', 'hello-elementor' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => $menus,
			'default' => array_keys( $menus )[0],
			'save_default' => true,
			'separator' => 'after',
			'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'hello-elementor' ), admin_url( 'nav-menus.php' ) ),
		]
	);
} else {
	$element->add_control(
		'header_menu',
		[
			'type' => \Elementor\Controls_Manager::RAW_HTML,
			'raw' => '<strong>' . __( 'There are no menus in your site.', 'hello-elementor' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'hello-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
			'separator' => 'after',
			'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
		]
	);
}

$element->add_control(
	'header_menu_layout',
	[
		'label' => __( 'Layout', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'default' => 'horizontal',
		'options' => [
			'horizontal' => __( 'Horizontal', 'hello-elementor' ),
			'dropdown' => __( 'Dropdown', 'hello-elementor' ),
		],
		'frontend_available' => true,
	]
);

$element->add_control(
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

$element->add_group_control(
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

$element->add_control(
	'header_menu_pointer',
	[
		'label' => __( 'Pointer', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'default' => 'underline',
		'options' => [
			'none' => __( 'None', 'hello-elementor' ),
			'underline' => __( 'Underline', 'hello-elementor' ),
			'overline' => __( 'Overline', 'hello-elementor' ),
			'double-line' => __( 'Double Line', 'hello-elementor' ),
			'framed' => __( 'Framed', 'hello-elementor' ),
			'background' => __( 'Background', 'hello-elementor' ),
			'text' => __( 'Text', 'hello-elementor' ),
		],
		'style_transfer' => true,
		'condition' => [
			'header_menu_layout!' => 'dropdown',
		],
	]
);

$element->add_control(
	'header_menu_indicator',
	[
		'label' => __( 'Submenu Indicator', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'default' => 'classic',
		'options' => [
			'none' => __( 'None', 'hello-elementor' ),
			'classic' => __( 'Classic', 'hello-elementor' ),
			'chevron' => __( 'Chevron', 'hello-elementor' ),
			'angle' => __( 'Angle', 'hello-elementor' ),
			'plus' => __( 'Plus', 'hello-elementor' ),
		],
		'prefix_class' => 'elementor-nav-menu--indicator-',
	]
);

$element->add_control(
	'header_menu_mobile_dropdown_heading',
	[
		'label' => __( 'Mobile Dropdown', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::HEADING,
		'separator' => 'before',
		'condition' => [
			'header_menu_layout!' => 'dropdown',
		],
	]
);

$breakpoints = Responsive::get_breakpoints();

$element->add_control(
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

$element->add_control(
	'header_menu_toggle',
	[
		'label' => __( 'Toggle Button', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'default' => 'burger',
		'options' => [
			'' => __( 'None', 'hello-elementor' ),
			'burger' => __( 'Hamburger', 'hello-elementor' ),
		],
		'prefix_class' => 'elementor-nav-menu--toggle elementor-nav-menu--',
		'render_type' => 'template',
		'frontend_available' => true,
		'condition' => [
			'header_menu_layout' => 'dropdown',
		],
	]
);


$element->end_controls_tab();

$element->add_control(
	'header_menu_mobile_submenu_heading',
	[
		'label' => __( 'Sub-Menu Settings', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::HEADING,
		'separator' => 'before',
		'condition' => [
			'header_menu_layout!' => 'dropdown',
		],
	]
);


$element->add_control(
	'dropdown_description',
	[
		'raw' => __( 'On desktop, this will affect the submenu. On mobile, this will affect the entire menu.', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::RAW_HTML,
		'content_classes' => 'elementor-descriptor',
	]
);

$element->start_controls_tabs( 'tabs_dropdown_item_style' );

$element->start_controls_tab(
	'tab_dropdown_item_normal',
	[
		'label' => __( 'Normal', 'hello-elementor' ),
	]
);

$element->add_control(
	'color_dropdown_item',
	[
		'label' => __( 'Text Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'default' => '',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--dropdown a, {{WRAPPER}} .elementor-menu-toggle' => 'color: {{VALUE}}',
		],
	]
);

$element->add_control(
	'background_color_dropdown_item',
	[
		'label' => __( 'Background Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'default' => '',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--dropdown' => 'background-color: {{VALUE}}',
		],
		'separator' => 'none',
	]
);

$element->end_controls_tab();

$element->start_controls_tab(
	'tab_dropdown_item_hover',
	[
		'label' => __( 'Hover', 'hello-elementor' ),
	]
);

$element->add_control(
	'color_dropdown_item_hover',
	[
		'label' => __( 'Text Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'default' => '',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--dropdown a:hover,
			{{WRAPPER}} .elementor-nav-menu--dropdown a.elementor-item-active,
			{{WRAPPER}} .elementor-nav-menu--dropdown a.highlighted,
			{{WRAPPER}} .elementor-menu-toggle:hover' => 'color: {{VALUE}}',
		],
	]
);

$element->add_control(
	'background_color_dropdown_item_hover',
	[
		'label' => __( 'Background Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'default' => '',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--dropdown a:hover,
			{{WRAPPER}} .elementor-nav-menu--dropdown a.elementor-item-active,
			{{WRAPPER}} .elementor-nav-menu--dropdown a.highlighted' => 'background-color: {{VALUE}}',
		],
		'separator' => 'none',
	]
);

$element->end_controls_tab();

$element->start_controls_tab(
	'tab_dropdown_item_active',
	[
		'label' => __( 'Active', 'hello-elementor' ),
	]
);

$element->add_control(
	'color_dropdown_item_active',
	[
		'label' => __( 'Text Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'default' => '',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--dropdown a.elementor-item-active' => 'color: {{VALUE}}',
		],
	]
);

$element->add_control(
	'background_color_dropdown_item_active',
	[
		'label' => __( 'Background Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'default' => '',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--dropdown a.elementor-item-active' => 'background-color: {{VALUE}}',
		],
		'separator' => 'none',
	]
);

$element->end_controls_tab();

$element->end_controls_tabs();

$element->add_group_control(
	\Elementor\Group_Control_Typography::get_type(),
	[
		'name' => 'dropdown_typography',
		'global' => [
			'default' => Global_Typography::TYPOGRAPHY_ACCENT,
		],
		'exclude' => [ 'line_height' ],
		'selector' => '{{WRAPPER}} .elementor-nav-menu--dropdown .elementor-item, {{WRAPPER}} .elementor-nav-menu--dropdown  .elementor-sub-item',
		'separator' => 'before',
	]
);

$element->add_group_control(
	Group_Control_Border::get_type(),
	[
		'name' => 'dropdown_border',
		'selector' => '{{WRAPPER}} .elementor-nav-menu--dropdown',
		'separator' => 'before',
	]
);

$element->add_responsive_control(
	'dropdown_border_radius',
	[
		'label' => __( 'Border Radius', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', '%' ],
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			'{{WRAPPER}} .elementor-nav-menu--dropdown li:first-child a' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',
			'{{WRAPPER}} .elementor-nav-menu--dropdown li:last-child a' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
		],
	]
);

$element->add_group_control(
	Group_Control_Box_Shadow::get_type(),
	[
		'name' => 'dropdown_box_shadow',
		'exclude' => [
			'box_shadow_position',
		],
		'selector' => '{{WRAPPER}} .elementor-nav-menu--main .elementor-nav-menu--dropdown, {{WRAPPER}} .elementor-nav-menu__container.elementor-nav-menu--dropdown',
	]
);

$element->end_controls_section();

$element->start_controls_section( 'style_toggle',
	[
		'label' => __( 'Toggle Button', 'hello-elementor' ),
		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		'condition' => [
			'header_menu_toggle!' => '',
			'header_menu_mobile_dropdown!' => 'none',
		],
	]
);

$element->start_controls_tabs( 'tabs_toggle_style' );

$element->start_controls_tab(
	'tab_toggle_style_normal',
	[
		'label' => __( 'Normal', 'hello-elementor' ),
	]
);

$element->add_control(
	'toggle_color',
	[
		'label' => __( 'Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} div.elementor-menu-toggle' => 'color: {{VALUE}}', // Harder selector to override text color control
		],
	]
);

$element->add_control(
	'toggle_background_color',
	[
		'label' => __( 'Background Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} .elementor-menu-toggle' => 'background-color: {{VALUE}}',
		],
	]
);

$element->end_controls_tab();

$element->start_controls_tab(
	'tab_toggle_style_hover',
	[
		'label' => __( 'Hover', 'hello-elementor' ),
	]
);

$element->add_control(
	'toggle_color_hover',
	[
		'label' => __( 'Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} div.elementor-menu-toggle:hover' => 'color: {{VALUE}}', // Harder selector to override text color control
		],
	]
);

$element->add_control(
	'toggle_background_color_hover',
	[
		'label' => __( 'Background Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'selectors' => [
			'{{WRAPPER}} .elementor-menu-toggle:hover' => 'background-color: {{VALUE}}',
		],
	]
);

$element->end_controls_tab();

$element->end_controls_tabs();

$element->add_responsive_control(
	'toggle_size',
	[
		'label' => __( 'Size', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'min' => 15,
			],
		],
		'selectors' => [
			'{{WRAPPER}} .elementor-menu-toggle' => 'font-size: {{SIZE}}{{UNIT}}',
		],
		'separator' => 'before',
	]
);

$element->add_responsive_control(
	'toggle_border_width',
	[
		'label' => __( 'Border Width', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'max' => 10,
			],
		],
		'selectors' => [
			'{{WRAPPER}} .elementor-menu-toggle' => 'border-width: {{SIZE}}{{UNIT}}',
		],
	]
);

$element->add_responsive_control(
	'toggle_border_radius',
	[
		'label' => __( 'Border Radius', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'size_units' => [ 'px', '%' ],
		'selectors' => [
			'{{WRAPPER}} .elementor-menu-toggle' => 'border-radius: {{SIZE}}{{UNIT}}',
		],
	]
);

$element->end_controls_section();