<?php
/**
 * Service hook
 *
 * @package kiddiz
 */

if ( ! function_exists( 'kiddiz_add_service_section' ) ) :
    /**
    * Add service section
    *
    *@since Kiddiz 1.0.0
    */
    function kiddiz_add_service_section() {

        // Check if service is enabled on frontpage
        $service_enable = apply_filters( 'kiddiz_section_status', 'enable_service', '' );

        if ( ! $service_enable )
            return false;

        // Get service section details
        $section_details = array();
        $section_details = apply_filters( 'kiddiz_filter_service_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render service section now.
        kiddiz_render_service_section( $section_details );
    }
endif;
add_action( 'kiddiz_primary_content_action', 'kiddiz_add_service_section', 30 );


if ( ! function_exists( 'kiddiz_get_service_section_details' ) ) :
    /**
    * service section details.
    *
    * @since Kiddiz 1.0.0
    * @param array $input service section details.
    */
    function kiddiz_get_service_section_details( $input ) {

        $content = array();
        $page_ids = array();
        $icons = array();

        for ( $i = 1; $i <= 4; $i++ )  :
            $page_id = kiddiz_theme_option( 'service_content_page_' . $i );

            if ( ! empty( $page_id ) ) :
                $page_ids[] = $page_id;
                $icons[] = kiddiz_theme_option( 'service_icon_' . $i );
            endif;

        endfor;
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          =>  ( array ) $page_ids,
            'posts_per_page'    => 4,
            'orderby'           => 'post__in',
            );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            $i = 0;
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = kiddiz_trim_content( 20 );
                $page_post['icon']      = ! empty( $icons[ $i ] ) ? $icons[ $i ] : 'fa-laptop';

                // Push to the main array.
                array_push( $content, $page_post );
                $i++;
            endwhile;
        endif;
        wp_reset_postdata();
            
        if ( ! empty( $content ) )
            $input = $content;
       
        return $input;
    }
endif;
// service section content details.
add_filter( 'kiddiz_filter_service_section_details', 'kiddiz_get_service_section_details' );


if ( ! function_exists( 'kiddiz_render_service_section' ) ) :
  /**
   * Start service section
   *
   * @return string service content
   * @since Kiddiz 1.0.0
   *
   */
   function kiddiz_render_service_section( $content_details = array() ) {
        if ( empty( $content_details ) )
            return;

        $title = kiddiz_theme_option( 'service_title', '' );
        $readmore = kiddiz_theme_option( 'service_readmore', esc_html__('Learn More', 'kiddiz' ) );

        ?>
    	<div class="our-services page-section relative center-align">
            <div class="wrapper">
                <?php if ( ! empty( $title ) ) : ?>
                    <div class="section-header align-center">
                        <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <div class="section-content column-4">
                    <?php foreach ( $content_details as $content ) : ?>
                        <article class="hentry">
                            <div class="post-wrapper">
                                <?php if ( ! empty( $content['icon'] ) ) : ?>
                                    <div class="service">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>">
                                            <i class="fa <?php echo esc_attr( $content['icon'] ); ?>" ></i>
                                        </a>
                                    </div><!-- .service -->
                                <?php endif; ?>

                                <div class="entry-container">
                                    <?php if ( !empty( $content['title'] ) ) : ?>
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                        </header>
                                    <?php endif;

                                    if ( !empty( $content['excerpt'] ) ) : ?>
                                        <div class="entry-content">
                                            <?php echo wp_kses_post( $content['excerpt'] ); ?>
                                        </div><!-- .entry-content -->
                                    <?php endif; ?>

                                    <a class="more-btn" href="<?php echo esc_url( $content['url'] ); ?>">
                                        <span class="screen-reader-text"><?php echo esc_html( $content['title'] ); ?></span>
                                        <?php echo esc_html( $readmore ); ?>
                                    </a>
                                </div><!-- .entry-container -->

                            </div><!-- .post-wrapper -->
                        </article>
                    <?php endforeach; ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #our-services -->
    <?php 
    }
endif;