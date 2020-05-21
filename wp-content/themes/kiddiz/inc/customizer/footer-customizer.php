<?php
/**
 * Footer Customizer Options
 *
 * @package kiddiz
 */

// Add footer section
$wp_customize->add_section( 'kiddiz_footer_section', array(
	'title'             => esc_html__( 'Footer Section','kiddiz' ),
	'description'       => esc_html__( 'Footer Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_theme_options_panel',
) );

// slide to top enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[slide_to_top]', array(
	'default'           => kiddiz_theme_option('slide_to_top'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[slide_to_top]', array(
	'label'             => esc_html__( 'Show Slide to Top', 'kiddiz' ),
	'section'           => 'kiddiz_footer_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// copyright text
$wp_customize->add_setting( 'kiddiz_theme_options[copyright_text]',
	array(
		'default'       		=> kiddiz_theme_option('copyright_text'),
		'sanitize_callback'		=> 'kiddiz_santize_allow_tags',
	)
);
$wp_customize->add_control( 'kiddiz_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'kiddiz' ),
		'section'    			=> 'kiddiz_footer_section',
		'type'		 			=> 'textarea',
    )
);

