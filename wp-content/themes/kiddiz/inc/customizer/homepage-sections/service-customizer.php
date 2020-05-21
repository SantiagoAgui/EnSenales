<?php
/**
 * Service Customizer Options
 *
 * @package kiddiz
 */

// Add service section
$wp_customize->add_section( 'kiddiz_service_section', array(
	'title'             => esc_html__( 'Service Section','kiddiz' ),
	'description'       => esc_html__( 'Service Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_homepage_sections_panel',
) );

// service menu enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[enable_service]', array(
	'default'           => kiddiz_theme_option('enable_service'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[enable_service]', array(
	'label'             => esc_html__( 'Enable Service', 'kiddiz' ),
	'section'           => 'kiddiz_service_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// service title chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[service_title]', array(
	'default'          	=> kiddiz_theme_option('service_title'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kiddiz_theme_options[service_title]', array(
	'label'             => esc_html__( 'Title', 'kiddiz' ),
	'section'           => 'kiddiz_service_section',
	'type'				=> 'text',
) );

// service label chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[service_readmore]', array(
	'default'          	=> kiddiz_theme_option('service_readmore'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kiddiz_theme_options[service_readmore]', array(
	'label'             => esc_html__( 'Readmore Label', 'kiddiz' ),
	'section'           => 'kiddiz_service_section',
	'type'				=> 'text',
) );

for ( $i = 1; $i <= 4; $i++ ) :

	// service menu enable setting and control.
	$wp_customize->add_setting( 'kiddiz_theme_options[service_icon_' . $i . ']', array(
		// 'default'           => kiddiz_theme_option('service_icon_' . $i . ''),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Kiddiz_Icon_Picker_Control( $wp_customize, 'kiddiz_theme_options[service_icon_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Icon %d', 'kiddiz' ), $i ),
		'section'           => 'kiddiz_service_section',
		'type' 				=> 'icon_picker',
	) ) );

	// service pages drop down chooser control and setting
	$wp_customize->add_setting( 'kiddiz_theme_options[service_content_page_' . $i . ']', array(
		'sanitize_callback' => 'kiddiz_sanitize_page_post',
	) );

	$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[service_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'kiddiz' ), $i ),
		'section'           => 'kiddiz_service_section',
		'choices'			=> kiddiz_page_choices(),
	) ) );

	// service hr control and setting
	$wp_customize->add_setting( 'kiddiz_theme_options[service_custom_hr_' . $i . ']', array(
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( new Kiddiz_Horizontal_Line( $wp_customize, 'kiddiz_theme_options[service_custom_hr_' . $i . ']', array(
		'section'           => 'kiddiz_service_section',
	) ) );

endfor;
