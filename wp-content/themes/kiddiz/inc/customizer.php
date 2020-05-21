<?php
/**
 * Kiddiz Theme Customizer
 *
 * @package kiddiz
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kiddiz_customize_register( $wp_customize ) {
	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/controls.php';

	// Load callback functions.
	require get_template_directory() . '/inc/customizer/callbacks.php';

	// Load validation functions.
	require get_template_directory() . '/inc/customizer/validate.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'kiddiz_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'kiddiz_customize_partial_blogdescription',
		) );
	}

	// Register custom section types.
	$wp_customize->register_section_type( 'Kiddiz_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Kiddiz_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Kiddiz Pro', 'kiddiz' ),
				'pro_text' => esc_html__( 'Buy Pro', 'kiddiz' ),
				'pro_url'  => 'http://www.sharkthemes.com/downloads/kiddiz-pro/',
				'priority'  => 10,
			)
		)
	);

	// Add panel for common Home Page Settings
	$wp_customize->add_panel( 'kiddiz_homepage_sections_panel' , array(
	    'title'      => esc_html__( 'Homepage Sections','kiddiz' ),
	    'description'=> esc_html__( 'Kiddiz Homepage Sections.', 'kiddiz' ),
	    'priority'   => 100,
	) );

	// topbar settings
	require get_template_directory() . '/inc/customizer/homepage-sections/topbar-customizer.php';

	// slider settings
	require get_template_directory() . '/inc/customizer/homepage-sections/slider-customizer.php';

	// short cta settings
	require get_template_directory() . '/inc/customizer/homepage-sections/short-cta-customizer.php';
	
	// service settings
	require get_template_directory() . '/inc/customizer/homepage-sections/service-customizer.php';

	// introduction settings
	require get_template_directory() . '/inc/customizer/homepage-sections/introduction-customizer.php';

	// team settings
	require get_template_directory() . '/inc/customizer/homepage-sections/team-customizer.php';

	// portfolio settings
	require get_template_directory() . '/inc/customizer/homepage-sections/portfolio-customizer.php';

	// cta settings
	require get_template_directory() . '/inc/customizer/homepage-sections/cta-customizer.php';

	// recent settings
	require get_template_directory() . '/inc/customizer/homepage-sections/recent-customizer.php';

	// Add panel for common Home Page Settings
	$wp_customize->add_panel( 'kiddiz_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','kiddiz' ),
	    'description'=> esc_html__( 'Kiddiz Theme Options.', 'kiddiz' ),
	    'priority'   => 100,
	) );

	// footer settings
	require get_template_directory() . '/inc/customizer/footer-customizer.php';
	
	// blog/archive settings
	require get_template_directory() . '/inc/customizer/blog-customizer.php';

	// single settings
	require get_template_directory() . '/inc/customizer/single-customizer.php';

	// page settings
	require get_template_directory() . '/inc/customizer/single-page-customizer.php';

	// global settings
	require get_template_directory() . '/inc/customizer/global-customizer.php';

}
add_action( 'customize_register', 'kiddiz_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function kiddiz_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function kiddiz_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kiddiz_customize_preview_js() {
	wp_enqueue_script( 'kiddiz-customizer', get_template_directory_uri() . '/assets/js/customizer' . kiddiz_min() . '.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'kiddiz_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function kiddiz_customize_control_js() {
	// Choose from select jquery.
	wp_enqueue_style( 'jquery-chosen', get_template_directory_uri() . '/assets/css/chosen' . kiddiz_min() . '.css' );
	wp_enqueue_script( 'jquery-chosen', get_template_directory_uri() . '/assets/js/chosen' . kiddiz_min() . '.js', array( 'jquery' ), '1.4.2', true );

	// Choose fontawesome select jquery.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome' . kiddiz_min() . '.css' );
	wp_enqueue_style( 'simple-iconpicker', get_template_directory_uri() . '/assets/css/simple-iconpicker' . kiddiz_min() . '.css' );
	wp_enqueue_script( 'jquery-simple-iconpicker', get_template_directory_uri() . '/assets/js/simple-iconpicker' . kiddiz_min() . '.js', array( 'jquery' ), '', true );

	// admin script
	wp_enqueue_style( 'kiddiz-customizer-style', get_template_directory_uri() . '/assets/css/customizer' . kiddiz_min() . '.css' );
	wp_enqueue_script( 'kiddiz-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls' . kiddiz_min() . '.js', array( 'jquery', 'jquery-chosen', 'jquery-simple-iconpicker' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'kiddiz_customize_control_js' );
