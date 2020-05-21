<?php
/**
 * Team Customizer Options
 *
 * @package kiddiz
 */

// Add team section
$wp_customize->add_section( 'kiddiz_team_section', array(
	'title'             => esc_html__( 'Team Section','kiddiz' ),
	'description'       => esc_html__( 'Team Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_homepage_sections_panel',
) );

// team menu enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[enable_team]', array(
	'default'           => kiddiz_theme_option('enable_team'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[enable_team]', array(
	'label'             => esc_html__( 'Enable Team', 'kiddiz' ),
	'section'           => 'kiddiz_team_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// team controller enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[team_controller]', array(
	'default'           => kiddiz_theme_option('team_controller'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[team_controller]', array(
	'label'             => esc_html__( 'Show Arrow Controller', 'kiddiz' ),
	'section'           => 'kiddiz_team_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// team auto slide enable setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[team_auto_slide]', array(
	'default'           => kiddiz_theme_option('team_auto_slide'),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[team_auto_slide]', array(
	'label'             => esc_html__( 'Enable Auto Slide', 'kiddiz' ),
	'section'           => 'kiddiz_team_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// team label chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[team_title]', array(
	'default'          	=> kiddiz_theme_option('team_title'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kiddiz_theme_options[team_title]', array(
	'label'             => esc_html__( 'Title', 'kiddiz' ),
	'section'           => 'kiddiz_team_section',
	'type'				=> 'text',
) );

// team additional image setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[team_image]', array(
	'sanitize_callback' => 'kiddiz_sanitize_image',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kiddiz_theme_options[team_image]',
		array(
		'label'       		=> esc_html__( 'Select Background Image', 'kiddiz' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'kiddiz' ), 1920, 1080 ),
		'section'     		=> 'kiddiz_team_section',
) ) );

for ( $i = 1; $i <= 5; $i++ ) :

	// team pages drop down chooser control and setting
	$wp_customize->add_setting( 'kiddiz_theme_options[team_content_page_' . $i . ']', array(
		'sanitize_callback' => 'kiddiz_sanitize_page_post',
	) );

	$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[team_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'kiddiz' ), $i ),
		'section'           => 'kiddiz_team_section',
		'choices'			=> kiddiz_page_choices(),
	) ) );

	// team label chooser control and setting
	$wp_customize->add_setting( 'kiddiz_theme_options[team_position_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'kiddiz_theme_options[team_position_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Position %d', 'kiddiz' ), $i ),
		'section'           => 'kiddiz_team_section',
		'type'				=> 'text',
	) );

	// team hr control and setting
	$wp_customize->add_setting( 'kiddiz_theme_options[team_custom_hr_' . $i . ']', array(
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( new Kiddiz_Horizontal_Line( $wp_customize, 'kiddiz_theme_options[team_custom_hr_' . $i . ']', array(
		'section'           => 'kiddiz_team_section',
	) ) );

endfor;
