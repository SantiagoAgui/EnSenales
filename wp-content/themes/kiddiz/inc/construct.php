<?php
/**
 * Functions which construct the theme by hooking into WordPress
 *
 * @package kiddiz
 */


/*------------------------------------------------
            HEADER HOOK
------------------------------------------------*/

if ( ! function_exists( 'kiddiz_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_doctype() { ?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php }
endif;
add_action( 'kiddiz_doctype_action', 'kiddiz_doctype', 10 );

if ( ! function_exists( 'kiddiz_head' ) ) :
	/**
	 * head Codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_head() { ?>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
				<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
			<?php endif; ?>
			<?php wp_head(); ?>
		</head>
	<?php }
endif;
add_action( 'kiddiz_head_action', 'kiddiz_head', 10 );

if ( ! function_exists( 'kiddiz_body_start' ) ) :
	/**
	 * Body start codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_body_start() { ?>
		<body <?php body_class(); ?>>
		<?php do_action( 'wp_body_open' ); ?>
	<?php }
endif;
add_action( 'kiddiz_body_start_action', 'kiddiz_body_start', 10 );


if ( ! function_exists( 'kiddiz_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_page_start() { ?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'kiddiz' ); ?></a>
	<?php }
endif;
add_action( 'kiddiz_page_start_action', 'kiddiz_page_start', 10 );


if ( ! function_exists( 'kiddiz_cart_link' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function kiddiz_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'kiddiz' ); ?>">
				<?php echo kiddiz_get_svg( array( 'icon' => 'basket' ) ); ?>
				<?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?> 
				<span class="topbar-count">
					<?php echo wp_kses_data( sprintf( _n( ' - %d item', ' - %d items', WC()->cart->get_cart_contents_count(), 'kiddiz' ), WC()->cart->get_cart_contents_count() ) ); ?>
				</span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'kiddiz_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function kiddiz_woocommerce_cart_link_fragment( $fragments ) {

		ob_start();
		kiddiz_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'kiddiz_woocommerce_cart_link_fragment' );


if ( ! function_exists( 'kiddiz_top_bar' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_top_bar() { 
		if ( ! kiddiz_theme_option( 'enable_topbar' ) )
			return;

		$address 	= kiddiz_theme_option( 'topbar_address' );
		$phone 		= kiddiz_theme_option( 'topbar_phone' );
		$email 		= kiddiz_theme_option( 'topbar_email' );
		$topbar_cart = kiddiz_theme_option( 'show_topbar_cart' );
		?>
		<div id="top-menu">
            <?php 
            echo kiddiz_get_svg( array( 'icon' => 'up', 'class' => 'dropdown-icon' ) );
            echo kiddiz_get_svg( array( 'icon' => 'down', 'class' => 'dropdown-icon' ) ); 
            ?>
            
            <div class="wrapper">
                <div class="secondary-menu">
                	<ul class="menu">
                		<?php if ( ! empty( $address ) ) : ?>
	                		<li>
	                			<?php 
                        		echo kiddiz_get_svg( array( 'icon' => 'location-o' ) ); 
		                        echo esc_html( $address ); 
		                        ?>
	                		</li>
	                	<?php endif;
	                	
	                	if ( ! empty( $phone ) ) : ?>
	                		<li><a href="<?php echo esc_url( 'tel:' . $phone ); ?>">
	                			<?php 
                        		echo kiddiz_get_svg( array( 'icon' => 'phone-o' ) ); 
		                        echo esc_html( $phone ); 
		                        ?>
	                		</a></li>
                		<?php endif;
	                	
	                	if ( ! empty( $email ) ) : ?>
	                		<li><a href="<?php echo esc_url( 'mailto:' . sanitize_email( $email ) ); ?>">
	                			<?php 
                        		echo kiddiz_get_svg( array( 'icon' => 'envelope-o' ) ); 
		                        echo esc_html( $email ); 
		                        ?>
	                		</a></li>
	                	<?php endif;

	                	if ( class_exists( 'WooCommerce' ) && $topbar_cart ) : ?>
	                		<li>
	                			<?php kiddiz_cart_link(); ?>
	                		</li>
	                	<?php endif; ?>
                	</ul>
                </div><!-- .secondary-menu -->

	            <?php if ( kiddiz_theme_option( 'show_top_search' ) ) : ?>
		            <div id="top-search" class="social-menu">
	                	<ul>
	                		<li>
	                			<div id="search"><?php get_search_form(); ?></div>
	                			<a href="#" class="search">
	                				<?php echo kiddiz_get_svg( array( 'icon' => 'search' ) ); ?>
	            				</a>
	                		</li>
	                	</ul>
	                </div>
	            <?php endif;

	            if ( kiddiz_theme_option( 'show_social_menu' ) && has_nav_menu( 'social' ) ) : ?>
	                <div class="social-menu">
	                    <?php  
	                	wp_nav_menu( array(
	                		'theme_location'  	=> 'social',
	                		'container' 		=> false,
	                		'menu_class'      	=> 'menu',
	                		'depth'           	=> 1,
	            			'link_before' 		=> '<span class="screen-reader-text">',
							'link_after' 		=> '</span>',
	                	) );
	                	?>
	                </div><!-- .social-menu -->
                <?php endif; ?>
            </div><!-- .wrapper -->
        </div><!-- #top-menu -->
	<?php }
endif;
add_action( 'kiddiz_page_start_action', 'kiddiz_top_bar', 20 );


if ( ! function_exists( 'kiddiz_header_start' ) ) :
	/**
	 * Header starts html codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_header_start() { 
		$sticky_header = kiddiz_theme_option( 'enable_sticky_header' ) ? 'sticky-header' : ''; 
		?>
		<header id="masthead" class="site-header <?php echo esc_attr( $sticky_header ); ?>">
		<div class="wrapper">
	<?php }
endif;
add_action( 'kiddiz_header_start_action', 'kiddiz_header_start', 10 );


if ( ! function_exists( 'kiddiz_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_site_branding() { ?>
		<div class="site-menu">
            <div class="container">
				<div class="site-branding pull-left">
					<?php
					// site logo
					the_custom_logo();
					?>
					<div class="site-details">
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					</div><!-- .site-details -->
				</div><!-- .site-branding -->
	<?php }
endif;
add_action( 'kiddiz_site_branding_action', 'kiddiz_site_branding', 10 );


if ( ! function_exists( 'kiddiz_primary_nav' ) ) :
	/**
	 * Primary nav codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_primary_nav() { ?>
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <span class="screen-reader-text"><?php esc_html_e( 'Menu', 'kiddiz' ); ?></span>
            <svg viewBox="0 0 40 40" class="icon-menu">
                <g>
                    <rect y="7" width="40" height="2"/>
                    <rect y="19" width="40" height="2"/>
                    <rect y="31" width="40" height="2"/>
                </g>
            </svg>
            <?php echo kiddiz_get_svg( array( 'icon' => 'close' ) ); ?>
        </button>
		<nav id="site-navigation" class="main-navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
        			'container' => 'div',
        			'menu_class' => 'menu nav-menu',
        			'menu_id' => 'primary-menu',
        			'fallback_cb' => 'kiddiz_menu_fallback_cb',
				) );
			?>
		</nav><!-- #site-navigation -->
		</div><!-- .container -->
        </div><!-- .site-menu -->
	<?php }
endif;
add_action( 'kiddiz_primary_nav_action', 'kiddiz_primary_nav', 10 );


if ( ! function_exists( 'kiddiz_header_ends' ) ) :
	/**
	 * Header ends codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_header_ends() { ?>
		</div><!-- .wrapper -->
		</header><!-- #masthead -->
	<?php }
endif;
add_action( 'kiddiz_header_ends_action', 'kiddiz_header_ends', 10 );


if ( ! function_exists( 'kiddiz_site_content_start' ) ) :
	/**
	 * Site content start codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_site_content_start() { ?>
		<div id="content" class="site-content">
	<?php }
endif;
add_action( 'kiddiz_site_content_start_action', 'kiddiz_site_content_start', 10 );


/**
 * Display custom header title in frontpage and blog
 */
function kiddiz_custom_header_title() {
	if ( is_home() && is_front_page() ) : 
		$title = kiddiz_theme_option( 'latest_blog_title', 'Blogs' ); ?>
		<h2><?php echo esc_html( $title ); ?></h2>
	<?php elseif ( is_singular() || ( is_home() && ! is_front_page() ) ): ?>
		<h2><?php single_post_title(); ?></h2>
	<?php elseif ( class_exists( 'WooCommerce' ) && is_shop() ) : ?>
    	<h2><?php woocommerce_page_title(); ?></h2>
    <?php elseif ( is_archive() ) : 
		the_archive_title( '<h2>', '</h2>' );
	elseif ( is_search() ) : ?>
		<h2><?php printf( esc_html__( 'Search Results for: %s', 'kiddiz' ), get_search_query() ); ?></h2>
	<?php elseif ( is_404() ) :
		echo '<h2>' . esc_html__( 'Oops! That page can&#39;t be found.', 'kiddiz' ) . '</h2>';
	endif;
}


if ( ! function_exists( 'kiddiz_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_add_breadcrumb() {
		// Bail if Breadcrumb disabled.
		if ( ! kiddiz_theme_option( 'enable_breadcrumb' ) ) {
			return;
		}
		
		// Bail if Home Page.
		if ( ! is_home() && is_front_page() ) {
			return;
		}

		echo '<div id="breadcrumb-list" >';
				/**
				 * kiddiz_breadcrumb hook
				 *
				 * @hooked kiddiz_breadcrumb -  10
				 *
				 */
				do_action( 'kiddiz_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
		return;
	}
endif;


if ( ! function_exists( 'kiddiz_custom_header' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Kiddiz 1.0.0
	 *
	 */
	function kiddiz_custom_header() {
		if ( ! is_home() && is_front_page() ) {
			return;
		}
		
		$image = get_header_image() ? get_header_image() : get_template_directory_uri() . '/assets/uploads/banner.jpg';
		if ( is_singular() ) {
			$image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : $image;
		}
		?>

        <div class="inner-header-image">
    		<div class="featured-image" style="background-image: url( '<?php echo esc_url( $image ); ?>' )">
    			<div class="overlay"></div>
        		<div class="wrapper">
	                <div class="custom-header-content">
	                    <?php 
	                    echo kiddiz_custom_header_title();
	                    kiddiz_add_breadcrumb(); 
	                    ?>
	                </div><!-- .custom-header-content -->
        		</div><!-- .wrapper -->
            </div>
        </div><!-- .custom-header-content-wrapper -->
		<?php
	}
endif;
add_action( 'kiddiz_site_content_start_action', 'kiddiz_custom_header', 20 );


/*------------------------------------------------
            FOOTER HOOK
------------------------------------------------*/

if ( ! function_exists( 'kiddiz_site_content_ends' ) ) :
	/**
	 * Site content ends codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_site_content_ends() { ?>
		</div><!-- #content -->
	<?php }
endif;
add_action( 'kiddiz_site_content_ends_action', 'kiddiz_site_content_ends', 10 );


if ( ! function_exists( 'kiddiz_footer_start' ) ) :
	/**
	 * Footer start codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_footer_start() { ?>
		<footer id="colophon" class="site-footer">
	<?php }
endif;
add_action( 'kiddiz_footer_start_action', 'kiddiz_footer_start', 10 );


if ( ! function_exists( 'kiddiz_site_info' ) ) :
	/**
	 * Site info codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_site_info() { 
		$copyright = kiddiz_theme_option('copyright_text');
		?>
		<div class="site-info">
			<?php echo kiddiz_get_svg( array( 'icon' => 'cloud-border' ) ); ?>
            <div class="wrapper">
            	<?php if ( ! empty( $copyright ) ) : ?>
	                <div class="copyright">
	                	<p>
	                    	<?php 
	                    	echo kiddiz_santize_allow_tags( $copyright ); 
	                    	printf( esc_html__( ' Kiddiz by %1$s Shark Themes %2$s', 'kiddiz' ), '<a href="' . esc_url( 'http://sharkthemes.com/' ) . '" target="_blank">','</a>' ); 
	                    	if ( function_exists( 'the_privacy_policy_link' ) ) {
								the_privacy_policy_link( ' | ' );
							}
	                    	?>
	                    </p>
	                </div><!-- .copyright -->
	            <?php endif; 

	            if ( ! empty( $copyright ) ) : ?>
	                <div class="powered-by">
	                    <?php
							wp_nav_menu( array(
								'theme_location' => 'footer',
			        			'container' => false,
			        			'menu_class' => 'menu nav-menu',
			        			'menu_id' => 'footer-menu',
			        			'fallback_cb' => 'kiddiz_menu_fallback_cb',
							) );
						?>
	                </div><!-- .powered-by -->
	            <?php endif; ?>
            </div><!-- .wrapper -->    
        </div><!-- .site-info -->
	<?php }
endif;
add_action( 'kiddiz_site_info_action', 'kiddiz_site_info', 10 );


if ( ! function_exists( 'kiddiz_footer_ends' ) ) :
	/**
	 * Footer ends codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_footer_ends() { ?>
		</footer><!-- #colophon -->
	<?php }
endif;
add_action( 'kiddiz_footer_ends_action', 'kiddiz_footer_ends', 10 );


if ( ! function_exists( 'kiddiz_slide_to_top' ) ) :
	/**
	 * Footer ends codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_slide_to_top() { ?>
		<div class="backtotop">
            <?php echo kiddiz_get_svg( array( 'icon' => 'up' ) ); ?>
        </div><!-- .backtotop -->
	<?php }
endif;
add_action( 'kiddiz_footer_ends_action', 'kiddiz_slide_to_top', 20 );


if ( ! function_exists( 'kiddiz_page_ends' ) ) :
	/**
	 * Page ends codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_page_ends() { ?>
		</div><!-- #page -->
	<?php }
endif;
add_action( 'kiddiz_page_ends_action', 'kiddiz_page_ends', 10 );


if ( ! function_exists( 'kiddiz_body_html_ends' ) ) :
	/**
	 * Body & Html ends codes
	 *
	 * @since Kiddiz 1.0.0
	 */
	function kiddiz_body_html_ends() { ?>
		</body>
		</html>
	<?php }
endif;
add_action( 'kiddiz_body_html_ends_action', 'kiddiz_body_html_ends', 10 );

