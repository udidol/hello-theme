<?php /**
 *
 * Elementor Hello Theme Header General Settings
 *
*/

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
			'inverted' => 'Invert',
			'stacked' => 'Centered',
		],
		'prefix_class' => 'header-',
		'selector' => '.site-header',
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