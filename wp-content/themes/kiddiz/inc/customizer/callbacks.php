<?php
/**
 * Callbacks functions
 *
 * @package kiddiz
 */

if ( ! function_exists( 'kiddiz_woocommerce_enable' ) ) :
	/**
	 * Check if woocommerce enabled
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function kiddiz_woocommerce_enable( $control ) {
		return class_exists( 'WooCommerce' );
	}
endif;

if ( ! function_exists( 'kiddiz_portfolio_content_post_enable' ) ) :
	/**
	 * Check if portfolio content type is post.
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function kiddiz_portfolio_content_post_enable( $control ) {
		return 'post' == $control->manager->get_setting( 'kiddiz_theme_options[portfolio_content_type]' )->value();
	}
endif;

if ( ! function_exists( 'kiddiz_portfolio_content_product_enable' ) ) :
	/**
	 * Check if portfolio content type is product.
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function kiddiz_portfolio_content_product_enable( $control ) {
		return 'product' == $control->manager->get_setting( 'kiddiz_theme_options[portfolio_content_type]' )->value();
	}
endif;

if ( ! function_exists( 'kiddiz_recent_content_category_enable' ) ) :
	/**
	 * Check if recent content type is category.
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function kiddiz_recent_content_category_enable( $control ) {
		return 'category' == $control->manager->get_setting( 'kiddiz_theme_options[recent_content_type]' )->value();
	}
endif;
