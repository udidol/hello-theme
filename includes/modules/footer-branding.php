<?php /**
 *
 * Elementor Hello Theme Footer Branding Settings
 *
*/

$element->start_controls_section(
	'footer_logo_section',
	[
		'tab' => 'settings-layout',
		'label' => __( 'Footer Branding', 'hello-elementor' ),
		'conditions' => [
	        'relation' => 'or',
			'terms' => [
				[
					'name' => 'footer_logo_display',
					'operator' => '=',
					'value' => 'yes',
				],
				[
					'name' => 'footer_tagline_display',
					'operator' => '=',
					'value' => 'yes',
				],
			],
	    ]
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