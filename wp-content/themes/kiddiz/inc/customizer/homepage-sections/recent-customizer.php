<?php
/**
 * Recent Customizer Options
 *
 * @package kiddiz
 */

// Add recent section
$wp_customize->add_section( 'kiddiz_recent_section', array(
	'title'             => esc_html__( 'Recent Section','kiddiz' ),
	'description'       => esc_html__( 'Recent Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_homepage_sections_panel',
) );

// recent enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[enable_recent]', array(
	'default'           => kiddiz_theme_option('enable_recent'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[enable_recent]', array(
	'label'             => esc_html__( 'Enable Recent', 'kiddiz' ),
	'section'           => 'kiddiz_recent_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// recent title chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[recent_title]', array(
	'default'          	=> kiddiz_theme_option('recent_title'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kiddiz_theme_options[recent_title]', array(
	'label'             => esc_html__( 'Title', 'kiddiz' ),
	'section'           => 'kiddiz_recent_section',
	'type'				=> 'text',
) );

// recent content type control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[recent_content_type]', array(
	'default'          	=> kiddiz_theme_option('recent_content_type'),
	'sanitize_callback' => 'kiddiz_sanitize_select',
) );

$wp_customize->add_control( 'kiddiz_theme_options[recent_content_type]', array(
	'label'             => esc_html__( 'Content Type', 'kiddiz' ),
	'section'           => 'kiddiz_recent_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'recent' 	=> esc_html__( 'Recent', 'kiddiz' ),
		'category' 	=> esc_html__( 'Category', 'kiddiz' ),
	),
) );

// recent pages drop down chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[recent_content_category]', array(
	'sanitize_callback' => 'kiddiz_sanitize_category',
) );

$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[recent_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'kiddiz' ),
	'section'           => 'kiddiz_recent_section',
	'choices'			=> kiddiz_category_choices(),
	'active_callback'	=> 'kiddiz_recent_content_category_enable',
) ) );
