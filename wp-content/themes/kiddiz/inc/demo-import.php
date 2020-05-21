<?php
/**
 * demo import
 *
 * @package kiddiz
 */

/**
 * Imports predefine demos.
 * @return [type] [description]
 */
function kiddiz_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for Kiddiz Theme.', 'kiddiz' ),
    esc_url( 'https://sharkthemes.com/downloads/kiddiz' ), esc_html__( 'Click here', 'kiddiz' ) );

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'kiddiz_intro_text' );