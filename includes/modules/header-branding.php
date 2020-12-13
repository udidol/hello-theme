<?php /**
 *
 * Elementor Hello Theme Header Branding Settings
 *
*/

$element->start_controls_section(
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