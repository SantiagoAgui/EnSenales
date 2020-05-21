<?php
/**
 * Topbar Customizer Options
 *
 * @package kiddiz
 */

// Add topbar section
$wp_customize->add_section( 'kiddiz_topbar_section', array(
	'title'             => esc_html__( 'Top Bar Section','kiddiz' ),
	'description'       => sprintf( '%1$s <a class="menu_locations" href="#"> %2$s </a> %3$s', esc_html__( 'Note: To show social menu.', 'kiddiz' ), esc_html__( 'Click Here', 'kiddiz' ), esc_html__( 'to create menu.', 'kiddiz' ) ),
	'panel'             => 'kiddiz_homepage_sections_panel',
) );

// topbar enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[enable_topbar]', array(
	'default'           => kiddiz_theme_option('enable_topbar'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[enable_topbar]', array(
	'label'             => esc_html__( 'Enable Topbar', 'kiddiz' ),
	'section'           => 'kiddiz_topbar_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// topbar address control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[topbar_address]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[topbar_address]', array(
	'label'             => esc_html__( 'Address', 'kiddiz' ),
	'section'           => 'kiddiz_topbar_section',
	'type'				=> 'text',
) ) );

// topbar phone control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[topbar_phone]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[topbar_phone]', array(
	'label'             => esc_html__( 'Phone No', 'kiddiz' ),
	'section'           => 'kiddiz_topbar_section',
	'type'				=> 'text',
) ) );

// topbar email control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[topbar_email]', array(
	'sanitize_callback' => 'sanitize_email',
) );

$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[topbar_email]', array(
	'label'             => esc_html__( 'Email ID', 'kiddiz' ),
	'section'           => 'kiddiz_topbar_section',
	'type'				=> 'email',
) ) );

// topbar cart setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_topbar_cart]', array(
	'default'           => kiddiz_theme_option('show_topbar_cart'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_topbar_cart]', array(
	'label'             => esc_html__( 'Show WooCommerce Cart', 'kiddiz' ),
	'section'           => 'kiddiz_topbar_section',
	'on_off_label' 		=> kiddiz_show_options(),
	'active_callback'	=> 'kiddiz_woocommerce_enable',
) ) );

// topbar social menu enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_social_menu]', array(
	'default'           => kiddiz_theme_option('show_social_menu'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_social_menu]', array(
	'label'             => esc_html__( 'Show Social Menu', 'kiddiz' ),
	'section'           => 'kiddiz_topbar_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// topbar search enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_top_search]', array(
	'default'           => kiddiz_theme_option('show_top_search'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_top_search]', array(
	'label'             => esc_html__( 'Show Search', 'kiddiz' ),
	'section'           => 'kiddiz_topbar_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );