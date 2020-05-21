<?php
/**
 * Page Customizer Options
 *
 * @package kiddiz
 */

// Add excerpt section
$wp_customize->add_section( 'kiddiz_page_section', array(
	'title'             => esc_html__( 'Page Setting','kiddiz' ),
	'description'       => esc_html__( 'Page Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[sidebar_page_layout]', array(
	'sanitize_callback'   => 'kiddiz_sanitize_select',
	'default'             => kiddiz_theme_option('sidebar_page_layout'),
) );

$wp_customize->add_control(  new Kiddiz_Radio_Image_Control ( $wp_customize, 'kiddiz_theme_options[sidebar_page_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'kiddiz' ),
	'section'             => 'kiddiz_page_section',
	'choices'			  => kiddiz_sidebar_position(),
) ) );
