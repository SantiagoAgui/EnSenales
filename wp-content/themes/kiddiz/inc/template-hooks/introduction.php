<?php
/**
 * Introduction hook
 *
 * @package kiddiz
 */

if ( ! function_exists( 'kiddiz_add_introduction_section' ) ) :
    /**
    * Add introduction section
    *
    *@since Kiddiz 1.0.0
    */
    function kiddiz_add_introduction_section() {

        // Check if introduction is enabled on frontpage
        $introduction_enable = apply_filters( 'kiddiz_section_status', 'enable_introduction', '' );

        if ( ! $introduction_enable )
            return false;

        // Get introduction section details
        $section_details = array();
        $section_details = apply_filters( 'kiddiz_filter_introduction_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render introduction section now.
        kiddiz_render_introduction_section( $section_details );
    }
endif;
add_action( 'kiddiz_primary_content_action', 'kiddiz_add_introduction_section', 40 );


if ( ! function_exists( 'kiddiz_get_introduction_section_details' ) ) :
    /**
    * introduction section details.
    *
    * @since Kiddiz 1.0.0
    * @param array $input introduction section details.
    */
    function kiddiz_get_introduction_section_details( $input ) {

        $content = array();
        $page_id = kiddiz_theme_option( 'introduction_content_page', '' );
        
        $args = array(
            'post_type' => 'page',
            'page_id' => absint( $page_id ),
            'posts_per_page' => 1,
            );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = kiddiz_trim_content( 40 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) )
            $input = $content;
       
        return $input;
    }
endif;
// introduction section content details.
add_filter( 'kiddiz_filter_introduction_section_details', 'kiddiz_get_introduction_section_details' );


if ( ! function_exists( 'kiddiz_render_introduction_section' ) ) :
  /**
   * Start introduction section
   *
   * @return string introduction content
   * @since Kiddiz 1.0.0
   *
   */
   function kiddiz_render_introduction_section( $content_details = array() ) {
        $read_more = kiddiz_theme_option( 'introduction_btn_label', esc_html__( 'Explore Us', 'kiddiz' ) );

        if ( empty( $content_details ) )
            return;

        ?>
    	<div id="introduction" class="page-section relative left-align">
            <div class="wrapper">
                <?php foreach ( $content_details as $content ) : ?>
                    <article class="hentry">
                        <div class="post-wrapper">
                            <div class="entry-container">
                                <?php if ( ! empty( $content['title'] ) ) : ?>
                                    <header class="entry-header">
                                        <h2 class="entry-title">
                                            <a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a>
                                        </h2>
                                    </header>
                                <?php endif; 

                                if ( ! empty( $content['excerpt'] ) ) : ?>
                                    <div class="entry-content">
                                        <?php echo wp_kses_post( $content['excerpt'] ); ?>
                                    </div><!-- .entry-content -->
                                <?php endif; ?>
                                <a class="more-btn" href="<?php echo esc_url( $content['url'] ); ?>">
                                    <span class="screen-reader-text"><?php echo esc_html( $content['title'] ); ?></span>
                                    <?php echo esc_html( $read_more ); ?>
                                </a>
                            </div><!-- .entry-container -->
                            <?php if ( ! empty( $content['image'] ) ) : ?>
                                <div class="featured-image">
                                    <a href="<?php echo esc_url( $content['url'] ) ?>"><img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>"></a>
                                </div><!-- .featured-image -->
                            <?php endif; ?>
                        </div><!-- .post-wrapper -->
                    </article>
                <?php endforeach; ?>
            </div><!-- .wrapper -->
        </div><!-- #introduction -->
    <?php 
    }
endif;