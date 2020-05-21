<?php
/**
 * Global Customizer Options
 *
 * @package kiddiz
 */

// Add Global section
$wp_customize->add_section( 'kiddiz_global_section', array(
	'title'             => esc_html__( 'Global Setting','kiddiz' ),
	'description'       => esc_html__( 'Global Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_theme_options_panel',
) );

// header sticky setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[enable_sticky_header]', array(
	'default'           => kiddiz_theme_option( 'enable_sticky_header' ),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[enable_sticky_header]', array(
	'label'             => esc_html__( 'Make Header Sticky', 'kiddiz' ),
	'section'           => 'kiddiz_global_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// breadcrumb setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[enable_breadcrumb]', array(
	'default'           => kiddiz_theme_option( 'enable_breadcrumb' ),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[enable_breadcrumb]', array(
	'label'             => esc_html__( 'Enable Breadcrumb', 'kiddiz' ),
	'section'           => 'kiddiz_global_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// site layout setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[site_layout]', array(
	'sanitize_callback'   => 'kiddiz_sanitize_select',
	'default'             => kiddiz_theme_option('site_layout'),
) );

$wp_customize->add_control(  new Kiddiz_Radio_Image_Control ( $wp_customize, 'kiddiz_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'kiddiz' ),
	'section'             => 'kiddiz_global_section',
	'choices'			  => kiddiz_site_layout(),
) ) );
