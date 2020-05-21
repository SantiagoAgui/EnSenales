<?php
/**
 * Options functions
 *
 * @package kiddiz
 */

if ( ! function_exists( 'kiddiz_show_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function kiddiz_show_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'kiddiz' ),
            'off'       => esc_html__( 'No', 'kiddiz' )
        );
        return apply_filters( 'kiddiz_show_options', $arr );
    }
endif;

if ( ! function_exists( 'kiddiz_page_choices' ) ) :
    /**
     * List of pages for page choices.
     * @return Array Array of page ids and name.
     */
    function kiddiz_page_choices() {
        $pages = get_pages();
        $choices = array();
        $choices[0] = esc_html__( 'None', 'kiddiz' );
        foreach ( $pages as $page ) {
            $choices[ $page->ID ] = $page->post_title;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'kiddiz_post_choices' ) ) :
    /**
     * List of posts for post choices.
     * @return Array Array of post ids and name.
     */
    function kiddiz_post_choices() {
        $posts = get_posts( array( 'numberposts' => -1 ) );
        $choices = array();
        $choices[0] = esc_html__( 'None', 'kiddiz' );
        foreach ( $posts as $post ) {
            $choices[ $post->ID ] = $post->post_title;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'kiddiz_product_choices' ) ) :
    /**
     * List of products for product choices.
     * @return Array Array of product ids and name.
     */
    function kiddiz_product_choices() {
        $posts = get_posts( array( 'post_type' => 'product', 'numberposts' => -1 ) );
        $choices = array();
        $choices[0] = esc_html__( 'None', 'kiddiz' );
        foreach ( $posts as $post ) {
            $choices[ $post->ID ] = $post->post_title;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'kiddiz_category_choices' ) ) :
    /**
     * List of categories for category choices.
     * @return Array Array of category ids and name.
     */
    function kiddiz_category_choices() {
        $args = array(
                'type'          => 'post',
                'child_of'      => 0,
                'parent'        => '',
                'orderby'       => 'name',
                'order'         => 'ASC',
                'hide_empty'    => 0,
                'hierarchical'  => 0,
                'taxonomy'      => 'category',
            );
        $categories = get_categories( $args );
        $choices = array();
        $choices[0] = esc_html__( 'None', 'kiddiz' );
        foreach ( $categories as $category ) {
            $choices[ $category->term_id ] = $category->name;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'kiddiz_product_category_choices' ) ) :
    /**
     * List of product categories for product category choices.
     * @return Array Array of product category ids and name.
     */
    function kiddiz_product_category_choices() {
        $args = array(
                'type'          => 'product',
                'child_of'      => 0,
                'parent'        => '',
                'orderby'       => 'name',
                'order'         => 'ASC',
                'hide_empty'    => 0,
                'hierarchical'  => 0,
                'taxonomy'      => 'product_cat',
            );
        $categories = get_categories( $args );
        $choices = array();
        $choices[0] = esc_html__( 'None', 'kiddiz' );
        foreach ( $categories as $category ) {
            $choices[ $category->term_id ] = $category->name;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'kiddiz_site_layout' ) ) :
    /**
     * site layout
     * @return array site layout
     */
    function kiddiz_site_layout() {
        $kiddiz_site_layout = array(
            'full'    => get_template_directory_uri() . '/assets/uploads/full.png',
            'boxed'   => get_template_directory_uri() . '/assets/uploads/boxed.png',
        );

        $output = apply_filters( 'kiddiz_site_layout', $kiddiz_site_layout );

        return $output;
    }
endif;

if ( ! function_exists( 'kiddiz_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidebar position
     */
    function kiddiz_sidebar_position() {
        $kiddiz_sidebar_position = array(
            'right-sidebar' => get_template_directory_uri() . '/assets/uploads/right.png',
            'no-sidebar'    => get_template_directory_uri() . '/assets/uploads/full.png',
        );

        $output = apply_filters( 'kiddiz_sidebar_position', $kiddiz_sidebar_position );

        return $output;
    }
endif;

if ( ! function_exists( 'kiddiz_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function kiddiz_selected_sidebar() {
        $kiddiz_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'kiddiz' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar', 'kiddiz' ),
        );

        $output = apply_filters( 'kiddiz_selected_sidebar', $kiddiz_selected_sidebar );

        return $output;
    }
endif;

if ( ! function_exists( 'kiddiz_body_courses_choice' ) ) :
    /**
     * body typography options
     * @return array body typography
     */
    function kiddiz_body_courses_choice() {
        $kiddiz_body_courses_choice = array(
            'post'      => esc_html__( 'Post', 'kiddiz' ),
        );

        if ( class_exists( 'WooCommerce' ) ) {
            $kiddiz_body_courses_choice = array_merge( $kiddiz_body_courses_choice, array( 'product' => esc_html__( 'Product', 'kiddiz' ) ) );
        }

        $output = apply_filters( 'kiddiz_body_courses_choice', $kiddiz_body_courses_choice );

        return $output;
    }
endif;