<?php /**
 *
 * Elementor Hello Theme Footer Settings
 *
*/

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