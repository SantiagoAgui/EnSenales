<?php
/**
 * Slider Customizer Options
 *
 * @package kiddiz
 */

// Add slider section
$wp_customize->add_section( 'kiddiz_slider_section', array(
	'title'             => esc_html__( 'Slider Section','kiddiz' ),
	'description'       => esc_html__( 'Slider Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_homepage_sections_panel',
) );

// slider menu enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[enable_slider]', array(
	'default'           => kiddiz_theme_option('enable_slider'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[enable_slider]', array(
	'label'             => esc_html__( 'Enable Slider', 'kiddiz' ),
	'section'           => 'kiddiz_slider_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// slider arrow control enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[slider_arrow]', array(
	'default'           => kiddiz_theme_option('slider_arrow'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[slider_arrow]', array(
	'label'             => esc_html__( 'Show Arrow Controller', 'kiddiz' ),
	'section'           => 'kiddiz_slider_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// slider auto slide control enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[slider_auto_slide]', array(
	'default'           => kiddiz_theme_option('slider_auto_slide'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[slider_auto_slide]', array(
	'label'             => esc_html__( 'Enable Auto Slide', 'kiddiz' ),
	'section'           => 'kiddiz_slider_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// slider btn label chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[slider_btn_label]', array(
	'default'          	=> kiddiz_theme_option('slider_btn_label'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kiddiz_theme_options[slider_btn_label]', array(
	'label'             => esc_html__( 'Button Label', 'kiddiz' ),
	'section'           => 'kiddiz_slider_section',
	'type'				=> 'text',
) );

for ( $i = 1; $i <= 5; $i++ ) :

	// slider pages drop down chooser control and setting
	$wp_customize->add_setting( 'kiddiz_theme_options[slider_content_page_' . $i . ']', array(
		'sanitize_callback' => 'kiddiz_sanitize_page_post',
	) );

	$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[slider_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'kiddiz' ), $i ),
		'section'           => 'kiddiz_slider_section',
		'choices'			=> kiddiz_page_choices(),
	) ) );

endfor;
