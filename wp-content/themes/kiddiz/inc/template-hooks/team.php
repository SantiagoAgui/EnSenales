<?php
/**
 * Team hook
 *
 * @package kiddiz
 */

if ( ! function_exists( 'kiddiz_add_team_section' ) ) :
    /**
    * Add team section
    *
    *@since Kiddiz 1.0.0
    */
    function kiddiz_add_team_section() {

        // Check if team is enabled on frontpage
        $team_enable = apply_filters( 'kiddiz_section_status', 'enable_team', '' );

        if ( ! $team_enable )
            return false;

        // Get team section details
        $section_details = array();
        $section_details = apply_filters( 'kiddiz_filter_team_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render team section now.
        kiddiz_render_team_section( $section_details );
    }
endif;
add_action( 'kiddiz_primary_content_action', 'kiddiz_add_team_section', 60 );


if ( ! function_exists( 'kiddiz_get_team_section_details' ) ) :
    /**
    * team section details.
    *
    * @since Kiddiz 1.0.0
    * @param array $input team section details.
    */
    function kiddiz_get_team_section_details( $input ) {

        $content = array();
        $page_ids = array();
        $position = array();

        for ( $i = 1; $i <= 5; $i++ )  :
            $page_id = kiddiz_theme_option( 'team_content_page_' . $i );

            if ( ! empty( $page_id ) ) :
                $page_ids[] = $page_id;
                $position[] = kiddiz_theme_option( 'team_position_' . $i );
            endif;

        endfor;
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          =>  ( array ) $page_ids,
            'posts_per_page'    => 5,
            'orderby'           => 'post__in',
            );                    


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            $i = 0;
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['position']  = ! empty( $position[ $i ] ) ? $position[ $i ] : '';
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : '';

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
// team section content details.
add_filter( 'kiddiz_filter_team_section_details', 'kiddiz_get_team_section_details' );


if ( ! function_exists( 'kiddiz_render_team_section' ) ) :
    /**
    * Start team section
    *
    * @return string team content
    * @since Kiddiz 1.0.0
    *
    */
    function kiddiz_render_team_section( $content_details = array() ) {
        if ( empty( $content_details ) )
            return;

        $title = kiddiz_theme_option( 'team_title', '' );
        $image = kiddiz_theme_option( 'team_image', '' );
        $team_auto_slide = kiddiz_theme_option( 'team_auto_slide' );
        $team_controller = kiddiz_theme_option( 'team_controller' );

        ?>
    	<div class="page-section team-section relative" <?php if ( ! empty( $image ) ) { echo 'style="background-image: url( ' . esc_url( $image ) . ' )"'; } ?> >
            <div class="overlay"></div>
            <div class="wrapper">
                <?php if ( ! empty( $title ) ) : ?>
                    <div class="section-header align-center">
                        <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <div class="section-content">
                    <div class="section-content team-slider" data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "infinite": true, "speed": 1200, "dots": false, "arrows": <?php echo $team_controller ? 'true' : 'false'; ?>, "autoplay": <?php echo $team_auto_slide ? 'true' : 'false'; ?>, "fade": false, "draggable": true }'>
                        <?php foreach ( $content_details as $content ) : ?>
                            <article class="hentry <?php echo ! empty( $content['image'] ) ? '' : 'no-featured-image'; ?>">
                                <div class="post-wrapper">
                                    <header class="entry-header">
                                        <?php if ( ! empty( $content['title'] ) ) : ?>
                                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                        <?php endif;

                                        if ( ! empty( $content['position'] ) ) : ?>
                                            <h6 class="position"><?php echo esc_html( $content['position'] ); ?></h6>
                                        <?php endif; ?>
                                    </header>

                                    <?php if ( ! empty( $content['image'] ) ) : ?>
                                        <div class="team-image">
                                            <a href="<?php echo esc_url( $content['url'] ); ?>">
                                                <img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ) ?>">
                                            </a>
                                        </div><!-- .team-image -->
                                    <?php endif; ?>
                                </div><!-- .post-wrapper -->
                            </article>
                        <?php endforeach; ?>
                    </div><!-- .team-slider -->
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #team-posts -->
    <?php 
    }
endif;