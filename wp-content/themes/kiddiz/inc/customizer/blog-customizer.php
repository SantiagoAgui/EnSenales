<?php
/**
 * Blog / Archive / Search Customizer Options
 *
 * @package kiddiz
 */

// Add blog section
$wp_customize->add_section( 'kiddiz_blog_section', array(
	'title'             => esc_html__( 'Blog/Archive Page Setting','kiddiz' ),
	'description'       => esc_html__( 'Blog/Archive/Search Page Setting Options', 'kiddiz' ),
	'panel'             => 'kiddiz_theme_options_panel',
) );

// latest blog title drop down chooser control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[latest_blog_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> kiddiz_theme_option( 'latest_blog_title' ),
) );

$wp_customize->add_control( new Kiddiz_Dropdown_Chosen_Control( $wp_customize, 'kiddiz_theme_options[latest_blog_title]', array(
	'label'             => esc_html__( 'Latest Blog Title', 'kiddiz' ),
	'description'       => esc_html__( 'Note: This title is displayed when your homepage displays option is set to latest posts.', 'kiddiz' ),
	'section'           => 'kiddiz_blog_section',
	'type'				=> 'text',
) ) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[sidebar_layout]', array(
	'sanitize_callback'   => 'kiddiz_sanitize_select',
	'default'             => kiddiz_theme_option( 'sidebar_layout' ),
) );

$wp_customize->add_control(  new Kiddiz_Radio_Image_Control ( $wp_customize, 'kiddiz_theme_options[sidebar_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'kiddiz' ),
	'section'             => 'kiddiz_blog_section',
	'choices'			  => kiddiz_sidebar_position(),
) ) );

// column control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[column_type]', array(
	'default'          	=> kiddiz_theme_option( 'column_type' ),
	'sanitize_callback' => 'kiddiz_sanitize_select',
) );

$wp_customize->add_control( 'kiddiz_theme_options[column_type]', array(
	'label'             => esc_html__( 'Column Layout', 'kiddiz' ),
	'section'           => 'kiddiz_blog_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'column-1' 		=> esc_html__( 'One Column', 'kiddiz' ),
		'column-2' 		=> esc_html__( 'Two Column', 'kiddiz' ),
	),
) );

// excerpt count control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[excerpt_count]', array(
	'default'          	=> kiddiz_theme_option( 'excerpt_count' ),
	'sanitize_callback' => 'kiddiz_sanitize_number_range',
	'validate_callback' => 'kiddiz_validate_excerpt_count',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'kiddiz_theme_options[excerpt_count]', array(
	'label'             => esc_html__( 'Excerpt Length', 'kiddiz' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 50.', 'kiddiz' ),
	'section'           => 'kiddiz_blog_section',
	'type'				=> 'number',
	'input_attrs'		=> array(
		'min'	=> 1,
		'max'	=> 50,
		),
) );

// pagination control and setting
$wp_customize->add_setting( 'kiddiz_theme_options[pagination_type]', array(
	'default'          	=> kiddiz_theme_option( 'pagination_type' ),
	'sanitize_callback' => 'kiddiz_sanitize_select',
) );

$wp_customize->add_control( 'kiddiz_theme_options[pagination_type]', array(
	'label'             => esc_html__( 'Pagination Type', 'kiddiz' ),
	'section'           => 'kiddiz_blog_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'default' 		=> esc_html__( 'Default', 'kiddiz' ),
		'numeric' 		=> esc_html__( 'Numeric', 'kiddiz' ),
	),
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_date]', array(
	'default'           => kiddiz_theme_option( 'show_date' ),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_date]', array(
	'label'             => esc_html__( 'Show Date', 'kiddiz' ),
	'section'           => 'kiddiz_blog_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_category]', array(
	'default'           => kiddiz_theme_option( 'show_category' ),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_category]', array(
	'label'             => esc_html__( 'Show Category', 'kiddiz' ),
	'section'           => 'kiddiz_blog_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_author]', array(
	'default'           => kiddiz_theme_option( 'show_author' ),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_author]', array(
	'label'             => esc_html__( 'Show Author', 'kiddiz' ),
	'section'           => 'kiddiz_blog_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );

// Archive comment meta setting and control.
$wp_customize->add_setting( 'kiddiz_theme_options[show_comment]', array(
	'default'           => kiddiz_theme_option( 'show_comment' ),
	'sanitize_callback' => 'kiddiz_sanitize_switch',
) );

$wp_customize->add_control( new Kiddiz_Switch_Control( $wp_customize, 'kiddiz_theme_options[show_comment]', array(
	'label'             => esc_html__( 'Show Comment', 'kiddiz' ),
	'section'           => 'kiddiz_blog_section',
	'on_off_label' 		=> kiddiz_show_options(),
) ) );