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
		'menu',
		[
			'type' => \Elementor\Controls_Manager::RAW_HTML,
			'raw' => '<strong>' . __( 'There are no menus in your site.', 'hello-elementor' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'hello-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
			'separator' => 'after',
			'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
		]
	);
}

$element->add_control(
	'layout',
	[
		'label' => __( 'Layout', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'default' => 'horizontal',
		'options' => [
			'horizontal' => __( 'Horizontal', 'hello-elementor' ),
			'vertical' => __( 'Vertical', 'hello-elementor' ),
			'dropdown' => __( 'Dropdown', 'hello-elementor' ),
		],
		'frontend_available' => true,
	]
);

$element->add_control(
	'align_items',
	[
		'label' => __( 'Align', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::CHOOSE,
		'options' => [
			'left' => [
				'title' => __( 'Left', 'hello-elementor' ),
				'icon' => 'eicon-h-align-left',
			],
			'center' => [
				'title' => __( 'Center', 'hello-elementor' ),
				'icon' => 'eicon-h-align-center',
			],
			'right' => [
				'title' => __( 'Right', 'hello-elementor' ),
				'icon' => 'eicon-h-align-right',
			],
			'justify' => [
				'title' => __( 'Stretch', 'hello-elementor' ),
				'icon' => 'eicon-h-align-stretch',
			],
		],
		'prefix_class' => 'elementor-nav-menu__align-',
		'condition' => [
			'layout!' => 'dropdown',
		],
	]
);

$element->add_control(
	'pointer',
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
			'layout!' => 'dropdown',
		],
	]
);

$element->add_control(
	'animation_line',
	[
		'label' => __( 'Animation', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'default' => 'fade',
		'options' => [
			'fade' => 'Fade',
			'slide' => 'Slide',
			'grow' => 'Grow',
			'drop-in' => 'Drop In',
			'drop-out' => 'Drop Out',
			'none' => 'None',
		],
		'condition' => [
			'layout!' => 'dropdown',
			'pointer' => [ 'underline', 'overline', 'double-line' ],
		],
	]
);

$element->add_control(
	'animation_framed',
	[
		'label' => __( 'Animation', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'default' => 'fade',
		'options' => [
			'fade' => 'Fade',
			'grow' => 'Grow',
			'shrink' => 'Shrink',
			'draw' => 'Draw',
			'corners' => 'Corners',
			'none' => 'None',
		],
		'condition' => [
			'layout!' => 'dropdown',
			'pointer' => 'framed',
		],
	]
);

$element->add_control(
	'animation_background',
	[
		'label' => __( 'Animation', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'default' => 'fade',
		'options' => [
			'fade' => 'Fade',
			'grow' => 'Grow',
			'shrink' => 'Shrink',
			'sweep-left' => 'Sweep Left',
			'sweep-right' => 'Sweep Right',
			'sweep-up' => 'Sweep Up',
			'sweep-down' => 'Sweep Down',
			'shutter-in-vertical' => 'Shutter In Vertical',
			'shutter-out-vertical' => 'Shutter Out Vertical',
			'shutter-in-horizontal' => 'Shutter In Horizontal',
			'shutter-out-horizontal' => 'Shutter Out Horizontal',
			'none' => 'None',
		],
		'condition' => [
			'layout!' => 'dropdown',
			'pointer' => 'background',
		],
	]
);

$element->add_control(
	'animation_text',
	[
		'label' => __( 'Animation', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'default' => 'grow',
		'options' => [
			'grow' => 'Grow',
			'shrink' => 'Shrink',
			'sink' => 'Sink',
			'float' => 'Float',
			'skew' => 'Skew',
			'rotate' => 'Rotate',
			'none' => 'None',
		],
		'condition' => [
			'layout!' => 'dropdown',
			'pointer' => 'text',
		],
	]
);

$element->add_control(
	'indicator',
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
	'heading_mobile_dropdown',
	[
		'label' => __( 'Mobile Dropdown', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::HEADING,
		'separator' => 'before',
		'condition' => [
			'layout!' => 'dropdown',
		],
	]
);

$breakpoints = Responsive::get_breakpoints();

$element->add_control(
	'dropdown',
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
			'layout!' => 'dropdown',
		],
	]
);

$element->add_control(
	'full_width',
	[
		'label' => __( 'Full Width', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SWITCHER,
		'description' => __( 'Stretch the dropdown of the menu to full width.', 'hello-elementor' ),
		'prefix_class' => 'elementor-nav-menu--',
		'return_value' => 'stretch',
		'frontend_available' => true,
		'condition' => [
			'dropdown!' => 'none',
		],
	]
);

$element->add_control(
	'text_align',
	[
		'label' => __( 'Align', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'default' => 'aside',
		'options' => [
			'aside' => __( 'Aside', 'hello-elementor' ),
			'center' => __( 'Center', 'hello-elementor' ),
		],
		'prefix_class' => 'elementor-nav-menu__text-align-',
		'condition' => [
			'dropdown!' => 'none',
		],
	]
);

$element->add_control(
	'toggle',
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
			'dropdown!' => 'none',
		],
	]
);

$element->add_control(
	'toggle_align',
	[
		'label' => __( 'Toggle Align', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::CHOOSE,
		'default' => 'center',
		'options' => [
			'left' => [
				'title' => __( 'Left', 'hello-elementor' ),
				'icon' => 'eicon-h-align-left',
			],
			'center' => [
				'title' => __( 'Center', 'hello-elementor' ),
				'icon' => 'eicon-h-align-center',
			],
			'right' => [
				'title' => __( 'Right', 'hello-elementor' ),
				'icon' => 'eicon-h-align-right',
			],
		],
		'selectors_dictionary' => [
			'left' => 'margin-right: auto',
			'center' => 'margin: 0 auto',
			'right' => 'margin-left: auto',
		],
		'selectors' => [
			'{{WRAPPER}} .elementor-menu-toggle' => '{{VALUE}}',
		],
		'condition' => [
			'toggle!' => '',
			'dropdown!' => 'none',
		],
	]
);

$element->end_controls_section();

$element->start_controls_section(
	'section_style_main-menu',
	[
		'label' => __( 'Main Menu', 'hello-elementor' ),
		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		'condition' => [
			'layout!' => 'dropdown',
		],

	]
);

$element->add_group_control(
	\Elementor\Group_Control_Typography::get_type(),
	[
		'name' => 'menu_typography',
		'global' => [
			'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
		],
		'selector' => '{{WRAPPER}} .elementor-nav-menu .elementor-item',
	]
);

$element->start_controls_tabs( 'tabs_menu_item_style' );

$element->start_controls_tab(
	'tab_menu_item_normal',
	[
		'label' => __( 'Normal', 'hello-elementor' ),
	]
);

$element->add_control(
	'color_menu_item',
	[
		'label' => __( 'Text Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'global' => [
			'default' => Global_Colors::COLOR_TEXT,
		],
		'default' => '',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--main .elementor-item' => 'color: {{VALUE}}',
		],
	]
);

$element->end_controls_tab();

$element->start_controls_tab(
	'tab_menu_item_hover',
	[
		'label' => __( 'Hover', 'hello-elementor' ),
	]
);

$element->add_control(
	'color_menu_item_hover',
	[
		'label' => __( 'Text Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'global' => [
			'default' => Global_Colors::COLOR_ACCENT,
		],
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--main .elementor-item:hover,
			{{WRAPPER}} .elementor-nav-menu--main .elementor-item.elementor-item-active,
			{{WRAPPER}} .elementor-nav-menu--main .elementor-item.highlighted,
			{{WRAPPER}} .elementor-nav-menu--main .elementor-item:focus' => 'color: {{VALUE}}',
		],
		'condition' => [
			'pointer!' => 'background',
		],
	]
);

$element->add_control(
	'color_menu_item_hover_pointer_bg',
	[
		'label' => __( 'Text Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'default' => '#fff',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--main .elementor-item:hover,
			{{WRAPPER}} .elementor-nav-menu--main .elementor-item.elementor-item-active,
			{{WRAPPER}} .elementor-nav-menu--main .elementor-item.highlighted,
			{{WRAPPER}} .elementor-nav-menu--main .elementor-item:focus' => 'color: {{VALUE}}',
		],
		'condition' => [
			'pointer' => 'background',
		],
	]
);

$element->add_control(
	'pointer_color_menu_item_hover',
	[
		'label' => __( 'Pointer Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'global' => [
			'default' => Global_Colors::COLOR_ACCENT,
		],
		'default' => '',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--main:not(.e--pointer-framed) .elementor-item:before,
			{{WRAPPER}} .elementor-nav-menu--main:not(.e--pointer-framed) .elementor-item:after' => 'background-color: {{VALUE}}',
			'{{WRAPPER}} .e--pointer-framed .elementor-item:before,
			{{WRAPPER}} .e--pointer-framed .elementor-item:after' => 'border-color: {{VALUE}}',
		],
		'condition' => [
			'pointer!' => [ 'none', 'text' ],
		],
	]
);

$element->end_controls_tab();

$element->start_controls_tab(
	'tab_menu_item_active',
	[
		'label' => __( 'Active', 'hello-elementor' ),
	]
);

$element->add_control(
	'color_menu_item_active',
	[
		'label' => __( 'Text Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'default' => '',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--main .elementor-item.elementor-item-active' => 'color: {{VALUE}}',
		],
	]
);

$element->add_control(
	'pointer_color_menu_item_active',
	[
		'label' => __( 'Pointer Color', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::COLOR,
		'default' => '',
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--main:not(.e--pointer-framed) .elementor-item.elementor-item-active:before,
			{{WRAPPER}} .elementor-nav-menu--main:not(.e--pointer-framed) .elementor-item.elementor-item-active:after' => 'background-color: {{VALUE}}',
			'{{WRAPPER}} .e--pointer-framed .elementor-item.elementor-item-active:before,
			{{WRAPPER}} .e--pointer-framed .elementor-item.elementor-item-active:after' => 'border-color: {{VALUE}}',
		],
		'condition' => [
			'pointer!' => [ 'none', 'text' ],
		],
	]
);

$element->end_controls_tab();

$element->end_controls_tabs();

/* This control is required to handle with complicated conditions */
$element->add_control(
	'hr',
	[
		'type' => \Elementor\Controls_Manager::DIVIDER,
	]
);

$element->add_responsive_control(
	'pointer_width',
	[
		'label' => __( 'Pointer Width', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'max' => 30,
			],
		],
		'selectors' => [
			'{{WRAPPER}} .e--pointer-framed .elementor-item:before' => 'border-width: {{SIZE}}{{UNIT}}',
			'{{WRAPPER}} .e--pointer-framed.e--animation-draw .elementor-item:before' => 'border-width: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
			'{{WRAPPER}} .e--pointer-framed.e--animation-draw .elementor-item:after' => 'border-width: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
			'{{WRAPPER}} .e--pointer-framed.e--animation-corners .elementor-item:before' => 'border-width: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
			'{{WRAPPER}} .e--pointer-framed.e--animation-corners .elementor-item:after' => 'border-width: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
			'{{WRAPPER}} .e--pointer-underline .elementor-item:after,
			 {{WRAPPER}} .e--pointer-overline .elementor-item:before,
			 {{WRAPPER}} .e--pointer-double-line .elementor-item:before,
			 {{WRAPPER}} .e--pointer-double-line .elementor-item:after' => 'height: {{SIZE}}{{UNIT}}',
		],
		'condition' => [
			'pointer' => [ 'underline', 'overline', 'double-line', 'framed' ],
		],
	]
);

$element->add_responsive_control(
	'padding_horizontal_menu_item',
	[
		'label' => __( 'Horizontal Padding', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'max' => 50,
			],
		],
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--main .elementor-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
		],
	]
);

$element->add_responsive_control(
	'padding_vertical_menu_item',
	[
		'label' => __( 'Vertical Padding', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'max' => 50,
			],
		],
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--main .elementor-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
		],
	]
);

$element->add_responsive_control(
	'menu_space_between',
	[
		'label' => __( 'Space Between', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'max' => 100,
			],
		],
		'selectors' => [
			'body:not(.rtl) {{WRAPPER}} .elementor-nav-menu--layout-horizontal .elementor-nav-menu > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
			'body.rtl {{WRAPPER}} .elementor-nav-menu--layout-horizontal .elementor-nav-menu > li:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
			'{{WRAPPER}} .elementor-nav-menu--main:not(.elementor-nav-menu--layout-horizontal) .elementor-nav-menu > li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
		],
	]
);

$element->add_responsive_control(
	'border_radius_menu_item',
	[
		'label' => __( 'Border Radius', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'size_units' => [ 'px', 'em', '%' ],
		'selectors' => [
			'{{WRAPPER}} .elementor-item:before' => 'border-radius: {{SIZE}}{{UNIT}}',
			'{{WRAPPER}} .e--animation-shutter-in-horizontal .elementor-item:before' => 'border-radius: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
			'{{WRAPPER}} .e--animation-shutter-in-horizontal .elementor-item:after' => 'border-radius: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
			'{{WRAPPER}} .e--animation-shutter-in-vertical .elementor-item:before' => 'border-radius: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
			'{{WRAPPER}} .e--animation-shutter-in-vertical .elementor-item:after' => 'border-radius: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
		],
		'condition' => [
			'pointer' => 'background',
		],
	]
);

$element->end_controls_section();

$element->start_controls_section(
	'section_style_dropdown',
	[
		'label' => __( 'Dropdown', 'hello-elementor' ),
		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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

$element->add_responsive_control(
	'padding_horizontal_dropdown_item',
	[
		'label' => __( 'Horizontal Padding', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--dropdown a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
		],
		'separator' => 'before',

	]
);

$element->add_responsive_control(
	'padding_vertical_dropdown_item',
	[
		'label' => __( 'Vertical Padding', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'max' => 50,
			],
		],
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--dropdown a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
		],
	]
);

$element->add_control(
	'heading_dropdown_divider',
	[
		'label' => __( 'Divider', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::HEADING,
		'separator' => 'before',
	]
);

$element->add_group_control(
	Group_Control_Border::get_type(),
	[
		'name' => 'dropdown_divider',
		'selector' => '{{WRAPPER}} .elementor-nav-menu--dropdown li:not(:last-child)',
		'exclude' => [ 'width' ],
	]
);

$element->add_control(
	'dropdown_divider_width',
	[
		'label' => __( 'Border Width', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'max' => 50,
			],
		],
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--dropdown li:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
		],
		'condition' => [
			'dropdown_divider_border!' => '',
		],
	]
);

$element->add_responsive_control(
	'dropdown_top_distance',
	[
		'label' => __( 'Distance', 'hello-elementor' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'min' => -100,
				'max' => 100,
			],
		],
		'selectors' => [
			'{{WRAPPER}} .elementor-nav-menu--main > .elementor-nav-menu > li > .elementor-nav-menu--dropdown, {{WRAPPER}} .elementor-nav-menu__container.elementor-nav-menu--dropdown' => 'margin-top: {{SIZE}}{{UNIT}} !important',
		],
		'separator' => 'before',
	]
);

$element->end_controls_section();

$element->start_controls_section( 'style_toggle',
	[
		'label' => __( 'Toggle Button', 'hello-elementor' ),
		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		'condition' => [
			'toggle!' => '',
			'dropdown!' => 'none',
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