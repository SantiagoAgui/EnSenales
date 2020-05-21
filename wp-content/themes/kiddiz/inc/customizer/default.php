<?php
/**
 * Default Theme Customizer Values
 *
 * @package kiddiz
 */

function kiddiz_get_default_theme_options() {
	$kiddiz_default_options = array(
		// default options

		/* Homepage Sections */

		// Top Bar
		'enable_topbar'			=> true,
		'show_social_menu'		=> false,
		'show_top_search'		=> true,
		'show_topbar_cart'		=> true,


		// Slider
		'enable_slider'			=> true,
		'slider_entire_site'	=> false,
		'slider_auto_slide'		=> false,
		'slider_arrow'			=> true,
		'slider_btn_label'		=> esc_html__( 'Learn More', 'kiddiz' ),

		// Shor Call to Action
		'enable_short_cta'		=> true,
		'short_cta_btn_label'	=> esc_html__( 'Learn More', 'kiddiz' ),

		// Service
		'enable_service'		=> true,
		'service_title'			=> esc_html__( 'What Kiddiz Offer', 'kiddiz' ),
		'service_readmore'		=> esc_html__( 'Learn More', 'kiddiz' ),
		
		// Introduction
		'enable_introduction'		=> true,
		'introduction_btn_label'	=> esc_html__( 'Explore Us', 'kiddiz' ),

		// Team
		'enable_team'			=> true,
		'team_title'			=> esc_html__( 'Meet Our Staff', 'kiddiz' ),
		'team_auto_slide'		=> false,
		'team_controller'		=> false,

		// Portfolio
		'enable_portfolio'		=> true,
		'portfolio_title'		=> esc_html__( 'Kiddiz prominent Features', 'kiddiz' ),
		'portfolio_btn_label'	=> esc_html__( 'Read More', 'kiddiz' ),
		'portfolio_content_type'	=> 'post',

		// Recent
		'enable_recent'			=> true,
		'recent_title'			=> esc_html__( 'Blog &#38; News', 'kiddiz' ),
		'recent_content_type'	=> 'recent',

		// Call to action
		'enable_cta'			=> true,
		'cta_btn_label'			=> esc_html__( 'Contact Us Now', 'kiddiz' ),
		
		// Footer
		'slide_to_top'			=> true,
		'copyright_text'		=> esc_html__( 'Copyright &copy; 2019 | All Rights Reserved.', 'kiddiz' ),

		/* Theme Options */

		// blog / archive
		'latest_blog_title'		=> esc_html__( 'Blogs', 'kiddiz' ),
		'excerpt_count'			=> 25,
		'pagination_type'		=> 'numeric',
		'sidebar_layout'		=> 'right-sidebar',
		'column_type'			=> 'column-2',
		'show_date'				=> true,
		'show_category'			=> true,
		'show_author'			=> true,
		'show_comment'			=> true,

		// single post
		'sidebar_single_layout'	=> 'right-sidebar',
		'show_single_date'		=> true,
		'show_single_category'	=> true,
		'show_single_tags'		=> true,
		'show_single_author'	=> true,

		// page
		'sidebar_page_layout'	=> 'right-sidebar',

		// global
		'enable_loader'			=> true,
		'enable_breadcrumb'		=> true,
		'enable_sticky_header'	=> false,
		'loader_type'			=> 'spinner-dots',
		'site_layout'			=> 'full',
		'header_typography'		=> 'default',
		'body_typography'		=> 'default',

		// theme color
		'theme_color'			=> 'default',
		'colorscheme'			=> '#1d1d1d',
	);

	$output = apply_filters( 'kiddiz_default_theme_options', $kiddiz_default_options );
	return $output;
}