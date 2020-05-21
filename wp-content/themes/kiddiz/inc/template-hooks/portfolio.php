<?php
/**
 * Portfolio hook
 *
 * @package kiddiz
 */

if ( ! function_exists( 'kiddiz_add_portfolio_section' ) ) :
    /**
    * Add portfolio section
    *
    *@since Kiddiz 1.0.0
    */
    function kiddiz_add_portfolio_section() {

        // Check if portfolio is enabled on frontpage
        $portfolio_enable = apply_filters( 'kiddiz_section_status', 'enable_portfolio', '' );

        if ( ! $portfolio_enable )
            return false;

        // Get portfolio section details
        $section_details = array();
        $section_details = apply_filters( 'kiddiz_filter_portfolio_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render portfolio section now.
        kiddiz_render_portfolio_section( $section_details );
    }
endif;
add_action( 'kiddiz_primary_content_action', 'kiddiz_add_portfolio_section', 60 );


if ( ! function_exists( 'kiddiz_get_portfolio_section_details' ) ) :
    /**
    * portfolio section details.
    *
    * @since Kiddiz 1.0.0
    * @param array $input portfolio section details.
    */
    function kiddiz_get_portfolio_section_details( $input ) {

        // Content type.
        $portfolio_content_type  = kiddiz_theme_option( 'portfolio_content_type' );
        $content = array();
        switch ( $portfolio_content_type ) {

            case 'post':
                $post_ids = array();

                for ( $i = 1; $i <= 3; $i++ )  :
                    $post_id = kiddiz_theme_option( 'portfolio_content_post_' . $i );

                    if ( ! empty( $post_id ) ) :
                        $post_ids[] = $post_id;
                    endif;
                endfor;
                
                $args = array(
                    'post_type'         => 'post',
                    'post__in'          => ( array ) $post_ids,
                    'posts_per_page'    => 3,
                    'orderby'           => 'post__in',
                    'ignore_sticky_posts' => true,
                    );                    
            break;

            case 'product':
                if ( ! class_exists( 'WooCommerce' ) ) {
                    return;
                }

                $post_ids = array();

                for ( $i = 1; $i <= 3; $i++ )  :
                    $post_id = kiddiz_theme_option( 'portfolio_content_product_' . $i );

                    if ( ! empty( $post_id ) ) :
                        $post_ids[] = $post_id;
                    endif;
                endfor;
                
                $args = array(
                    'post_type'         => 'product',
                    'post__in'          => ( array ) $post_ids,
                    'posts_per_page'    => 3,
                    'orderby'           => 'post__in',
                    );                    
            break;

            default:
            break;
        }


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            $i = 0;
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = kiddiz_trim_content( 20 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'post-thumbnail' ) : '';

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
// portfolio section content details.
add_filter( 'kiddiz_filter_portfolio_section_details', 'kiddiz_get_portfolio_section_details' );


if ( ! function_exists( 'kiddiz_render_portfolio_section' ) ) :
  /**
   * Start portfolio section
   *
   * @return string portfolio content
   * @since Kiddiz 1.0.0
   *
   */
   function kiddiz_render_portfolio_section( $content_details = array() ) {
        if ( empty( $content_details ) )
            return;

        $portfolio_content_type  = kiddiz_theme_option( 'portfolio_content_type' );
        $title = kiddiz_theme_option( 'portfolio_title', '' );
        $readmore = kiddiz_theme_option( 'portfolio_btn_label', esc_html__( 'Read More', 'kiddiz' ) );

        ?>
    	<div id="portfolio" class="page-section relative">
            <div class="wrapper">
                <?php if ( ! empty( $title ) ) : ?>
                    <div class="section-header align-center">
                        <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <div class="section-content column-3">
                    <?php foreach ( $content_details as $content ) : ?>
                        <article class="hentry">
                            <div class="post-wrapper">
                                <div class="gallery">
                                    <?php if ( ! empty( $content['image'] ) ) : ?>
                                        <div class="featured-image">
                                            <a href="<?php echo esc_url( $content['url'] ); ?>">
                                                <img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
                                            </a>
                                            <?php if ( in_array( $portfolio_content_type, array( 'product', 'product-category' ) ) ) : 
                                                $product = wc_get_product( $content['id'] );

                                                if ( $product->is_on_sale() ) : ?>
                                                    <span class="onsale"><?php esc_html_e( 'Sale!', 'kiddiz' ); ?></span>
                                                <?php endif; 
                                            endif; ?>
                                            <div class="overlay"></div>
                                                
                                            <div class="btn">
                                                <?php if ( in_array( $portfolio_content_type, array( 'product', 'product-category' ) ) ) : ?>
                                                    <a href="?add-to-cart=<?php echo absint( $content['id'] ); ?>" data-quantity="1" class="button more-btn add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo absint( $content['id'] ); ?>" rel="nofollow"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></a>
                                                <?php else : ?>
                                                    <a class="more-btn" href="<?php echo esc_url( $content['url'] ); ?>">
                                                        <span class="screen-reader-text"><?php echo esc_html( $content['title'] ); ?></span>
                                                        <?php echo esc_html( $readmore ); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?> 

                                    <div class="entry-container">
                                        <?php if ( ! empty( $content['title'] ) ) : ?>
                                            <header class="entry-header">
                                                <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                            </header>
                                        <?php endif;

                                         if ( in_array( $portfolio_content_type, array( 'product', 'product-category' ) ) ) : ?>
                                            <span class="price"><?php echo $product->get_price_html(); ?></span>
                                        <?php endif;

                                        if ( ! empty( $content['excerpt'] ) ) : ?>
                                            <div class="entry-content">
                                                <?php echo esc_html( $content['excerpt'] ); ?>
                                            </div><!-- .entry-content -->
                                        <?php endif; ?>
                                    </div>
                                </div><!-- .gallery -->
                            </div><!-- .post-wrapper -->
                        </article>
                    <?php endforeach; ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #gallery -->
    <?php 
    }
endif;