<?php
/**
 * Short Call to Action hook
 *
 * @package kiddiz
 */

if ( ! function_exists( 'kiddiz_add_short_cta_section' ) ) :
    /**
    * Add short_cta section
    *
    *@since Kiddiz 1.0.0
    */
    function kiddiz_add_short_cta_section() {

        // Check if short_cta is enabled on frontpage
        $short_cta_enable = apply_filters( 'kiddiz_section_status', 'enable_short_cta', '' );

        if ( ! $short_cta_enable )
            return false;

        // Get short_cta section details
        $section_details = array();
        $section_details = apply_filters( 'kiddiz_filter_short_cta_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render short_cta section now.
        kiddiz_render_short_cta_section( $section_details );
    }
endif;
add_action( 'kiddiz_primary_content_action', 'kiddiz_add_short_cta_section', 20 );


if ( ! function_exists( 'kiddiz_get_short_cta_section_details' ) ) :
    /**
    * short_cta section details.
    *
    * @since Kiddiz 1.0.0
    * @param array $input short_cta section details.
    */
    function kiddiz_get_short_cta_section_details( $input ) {

        $content = array();
        $page_id = kiddiz_theme_option( 'short_cta_content_page', '' );
        
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
// short_cta section content details.
add_filter( 'kiddiz_filter_short_cta_section_details', 'kiddiz_get_short_cta_section_details' );


if ( ! function_exists( 'kiddiz_render_short_cta_section' ) ) :
  /**
   * Start short_cta section
   *
   * @return string short_cta content
   * @since Kiddiz 1.0.0
   *
   */
   function kiddiz_render_short_cta_section( $content_details = array() ) {
        $read_more = kiddiz_theme_option( 'short_cta_btn_label', esc_html__( 'Learn More', 'kiddiz' ) );

        if ( empty( $content_details ) )
            return;

        foreach ( $content_details as $content ) : ?>
        	<div class="page-section short-cta-section relative">
                <div class="wrapper">
                    <?php if ( ! empty( $content['title'] ) ) : ?>
                        <div class="section-header">
                            <h2 class="section-title"><?php echo esc_html( $content['title'] ); ?></h2>

                            <div class="read-more">
                                <a href="<?php echo esc_url( $content['url'] ); ?>">
                                    <?php echo esc_html( $read_more ); ?>
                                </a>
                            </div>
                        </div><!-- .section-header -->
                    <?php endif; ?>
                </div><!-- .wrapper -->
            </div><!-- #short_cta -->
        <?php endforeach;
    }
endif;