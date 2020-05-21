<?php
/**
 * Introduction Customizer Options
 *
 * @package kiddiz
 */

// Add introduction section
$wp_customize->add_section( 'kiddiz_introduction_section', array(
	'title'             => esc_html__( 'Introduction Section','kiddiz' ),
	'description'       => esc_html__( 'Introduction Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_homepage_sections_panel',
) );

// introduction menu enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[enable_introduction]', array(
	'default'           => kiddiz_theme_option('enable_introduction'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[enable_introduction]', array(
	'label'             => esc_html__( 'Enable Introduction', 'kiddiz' ),
	'section'           => 'kiddiz_introduction_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// introduction pages drop down chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[introduction_content_page]', array(
	'sanitize_callback' => 'kiddiz_sanitize_page_post',
) );

$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[introduction_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'kiddiz' ),
	'section'           => 'kiddiz_introduction_section',
	'choices'			=> kiddiz_page_choices(),
) ) );

// introduction btn label chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[introduction_btn_label]', array(
	'default'          	=> kiddiz_theme_option('introduction_btn_label'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kiddiz_theme_options[introduction_btn_label]', array(
	'label'             => esc_html__( 'Button Label', 'kiddiz' ),
	'section'           => 'kiddiz_introduction_section',
	'type'				=> 'text',
) );
