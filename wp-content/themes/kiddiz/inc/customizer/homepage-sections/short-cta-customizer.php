<?php
/**
 * Short Call to Action Customizer Options
 *
 * @package kiddiz
 */

// Add short_cta section
$wp_customize->add_section( 'kiddiz_short_cta_section', array(
	'title'             => esc_html__( 'Short Call to Action Section','kiddiz' ),
	'description'       => esc_html__( 'Short Call to Action Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_homepage_sections_panel',
) );

// short_cta menu enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[enable_short_cta]', array(
	'default'           => kiddiz_theme_option('enable_short_cta'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[enable_short_cta]', array(
	'label'             => esc_html__( 'Enable Short Call to Action', 'kiddiz' ),
	'section'           => 'kiddiz_short_cta_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// short_cta pages drop down chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[short_cta_content_page]', array(
	'sanitize_callback' => 'kiddiz_sanitize_page_post',
) );

$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[short_cta_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'kiddiz' ),
	'section'           => 'kiddiz_short_cta_section',
	'choices'			=> kiddiz_page_choices(),
) ) );

// short_cta btn label chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[short_cta_btn_label]', array(
	'default'          	=> kiddiz_theme_option('short_cta_btn_label'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kiddiz_theme_options[short_cta_btn_label]', array(
	'label'             => esc_html__( 'Button Label', 'kiddiz' ),
	'section'           => 'kiddiz_short_cta_section',
	'type'				=> 'text',
) );
