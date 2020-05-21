<?php
/**
 * Portfolio Customizer Options
 *
 * @package kiddiz
 */

// Add portfolio section
$wp_customize->add_section( 'kiddiz_portfolio_section', array(
	'title'             => esc_html__( 'Portfolio Section','kiddiz' ),
	'description'       => esc_html__( 'Portfolio Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_homepage_sections_panel',
) );

// portfolio menu enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[enable_portfolio]', array(
	'default'           => kiddiz_theme_option('enable_portfolio'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[enable_portfolio]', array(
	'label'             => esc_html__( 'Enable Portfolio', 'kiddiz' ),
	'section'           => 'kiddiz_portfolio_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// portfolio label chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[portfolio_title]', array(
	'default'          	=> kiddiz_theme_option('portfolio_title'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kiddiz_theme_options[portfolio_title]', array(
	'label'             => esc_html__( 'Title', 'kiddiz' ),
	'section'           => 'kiddiz_portfolio_section',
	'type'				=> 'text',
) );

// portfolio button label chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[portfolio_btn_label]', array(
	'default'          	=> kiddiz_theme_option('portfolio_btn_label'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kiddiz_theme_options[portfolio_btn_label]', array(
	'label'             => esc_html__( 'Button Label', 'kiddiz' ),
	'section'           => 'kiddiz_portfolio_section',
	'type'				=> 'text',
) );

// portfolio content type control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[portfolio_content_type]', array(
	'default'          	=> kiddiz_theme_option('portfolio_content_type'),
	'sanitize_callback' => 'kiddiz_sanitize_select',
) );

$wp_customize->add_control( 'kiddiz_theme_options[portfolio_content_type]', array(
	'label'             => esc_html__( 'Content Type', 'kiddiz' ),
	'section'           => 'kiddiz_portfolio_section',
	'type'				=> 'select',
	'choices'			=> kiddiz_body_courses_choice(), // uses courses choice
) );

for ( $i = 1; $i <= 3; $i++ ) :

	// portfolio posts drop down chooser control and setting
	$wp_customize->add_setting( 'kiddiz_theme_options[portfolio_content_post_' . $i . ']', array(
		'sanitize_callback' => 'kiddiz_sanitize_page_post',
	) );

	$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[portfolio_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'kiddiz' ), $i ),
		'section'           => 'kiddiz_portfolio_section',
		'choices'			=> kiddiz_post_choices(),
		'active_callback'	=> 'kiddiz_portfolio_content_post_enable',
	) ) );

	// portfolio products drop down chooser control and setting
	$wp_customize->add_setting( 'kiddiz_theme_options[portfolio_content_product_' . $i . ']', array(
		'sanitize_callback' => 'kiddiz_sanitize_page_post',
	) );

	$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[portfolio_content_product_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Product %d', 'kiddiz' ), $i ),
		'section'           => 'kiddiz_portfolio_section',
		'choices'			=> kiddiz_product_choices(),
		'active_callback'	=> 'kiddiz_portfolio_content_product_enable',
	) ) );

endfor;
