<?php
/**
 * Single Post Customizer Options
 *
 * @package kiddiz
 */

// Add excerpt section
$wp_customize->add_section( 'kiddiz_single_section', array(
	'title'             => esc_html__( 'Single Post Setting','kiddiz' ),
	'description'       => esc_html__( 'Single Post Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[sidebar_single_layout]', array(
	'sanitize_callback'   => 'kiddiz_sanitize_select',
	'default'             => kiddiz_theme_option('sidebar_single_layout'),
) );

$wp_customize->add_control(  new Kiddiz_Radio_Image_Control ( $wp_customize, 'kiddiz_theme_options[sidebar_single_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'kiddiz' ),
	'section'             => 'kiddiz_single_section',
	'choices'			  => kiddiz_sidebar_position(),
) ) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_single_date]', array(
	'default'           => kiddiz_theme_option( 'show_single_date' ),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_single_date]', array(
	'label'             => esc_html__( 'Show Date', 'kiddiz' ),
	'section'           => 'kiddiz_single_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_single_category]', array(
	'default'           => kiddiz_theme_option( 'show_single_category' ),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_single_category]', array(
	'label'             => esc_html__( 'Show Category', 'kiddiz' ),
	'section'           => 'kiddiz_single_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_single_tags]', array(
	'default'           => kiddiz_theme_option( 'show_single_tags' ),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_single_tags]', array(
	'label'             => esc_html__( 'Show Tags', 'kiddiz' ),
	'section'           => 'kiddiz_single_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_single_author]', array(
	'default'           => kiddiz_theme_option( 'show_single_author' ),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_single_author]', array(
	'label'             => esc_html__( 'Show Author', 'kiddiz' ),
	'section'           => 'kiddiz_single_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );
