<?php /**
 *
 * Elementor Hello Theme Footer Copyright Settings
 *
*/

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