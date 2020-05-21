<?php
/**
 * Page/Post Metabox
 *
 * @package kiddiz
 */

/**
 * Class to Renders and save metabox options
 *
 * @since Kiddiz 1.0.0
 */
class Kiddiz_MetaBox {
    private $meta_box;

    private $fields;

    /**
    * Constructor
    *
    * @since Kiddiz 1.0.0
    *
    * @access public
    *
    */
    public function __construct( $meta_box_id, $meta_box_title, $post_type ) {
        
        $this->meta_box = array (
                            'id'        => $meta_box_id,
                            'title'     => $meta_box_title,
                            'post_type' => $post_type,
                            );

        $this->fields = array(
                            'kiddiz-sidebar-position',
                            'kiddiz-selected-sidebar',
                            );


        // Add metaboxes
        add_action( 'add_meta_boxes', array( $this, 'add' ) );
        
        add_action( 'save_post', array( $this, 'save' ) );  
    }

    /**
    * Add Meta Box for multiple post types.
    *
    * @since Kiddiz 1.0.0
    *
    * @access public
    */
    public function add($postType) {
        if( in_array( $postType, $this->meta_box['post_type'] ) ) {
            add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $postType );
        }
    }

    /**
    * Renders metabox
    *
    * @since Kiddiz 1.0.0
    *
    * @access public
    */
    public function show() {
        global $post;

        $layout_options         = kiddiz_sidebar_position();
        $sidebar_options        = kiddiz_selected_sidebar();
        
        
        // Use nonce for verification  
        wp_nonce_field( basename( __FILE__ ), 'kiddiz_custom_meta_box_nonce' );

        // Begin the field table and loop  ?>  
        <div id="kiddiz-ui-tabs" class="ui-tabs">
            <ul class="kiddiz-ui-tabs-nav" id="kiddiz-ui-tabs-nav">
                <li><a href="#frag1"><?php esc_html_e( 'Layout Options', 'kiddiz' ); ?></a></li>
                <li><a href="#frag2"><?php esc_html_e( 'Select Sidebar', 'kiddiz' ); ?></a></li>
            </ul> 

            <div id="frag1">
                <table id="layout-options" class="form-table" width="100%">
                    <tbody>
                        <tr>
                            <?php  
                                $metalayout = get_post_meta( $post->ID, 'kiddiz-sidebar-position', true );
                                if( empty( $metalayout ) ){
                                    $metalayout='';
                                }

                                foreach ( $layout_options as $value => $url ) :
                                    echo '<label>';
                                    echo '<input type="radio" name="kiddiz-sidebar-position" value="' . esc_attr( $value ) . '" ' . checked( $metalayout, $value, false ) . ' />';
                                    echo '<img src="' . esc_url( $url ) . '"/>';
                                    echo '</label>';
                                endforeach;
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="frag2">
                <table id="sidebar-metabox" class="form-table" width="100%">
                    <tbody> 
                        <tr>
                            <?php
                            $metasidebar = get_post_meta( $post->ID, 'kiddiz-selected-sidebar', true );
                            if ( empty( $metasidebar ) ){
                                $metasidebar='sidebar-1';
                            } 
                            foreach ( $sidebar_options as $field => $value ) {  
                            ?>
                                <td style="vertical-align: top;">
                                    <label class="description">
                                        <input type="radio" name="kiddiz-selected-sidebar" value="<?php echo esc_attr( $field ); ?>" <?php checked( $field, $metasidebar ); ?>/>&nbsp;&nbsp;<?php echo esc_html( $value ); ?>
                                    </label>
                                </td>
                                
                            <?php
                            } // end foreach 
                            ?>
                        </tr>
                    </tbody>
                </table>        
            </div>

        </div>
    <?php 
    }

    /**
     * Save custom metabox data
     * 
     * @action save_post
     *
     * @since Kiddiz 1.0.0
     *
     * @access public
     */
    public function save( $post_id ) { 
    
        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'kiddiz_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'kiddiz_nonce' ] ), basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
            return;
        }

        $layout_options         = kiddiz_sidebar_position();
        $sidebar_options        = kiddiz_selected_sidebar();
      
        foreach ( $this->fields as $field ) {      
            // Checks for input and sanitizes/saves if needed
            if( isset( $_POST[ $field ] ) ) {
                $choices = ( 'kiddiz-sidebar-position' == $field ) ? $layout_options : $sidebar_options;
                update_post_meta( $post_id, $field, kiddiz_sanitize_meta_select( wp_unslash( $_POST[ $field ] ), $choices ) );
            }
        } // end foreach      
    }
}
$post_types = array( 'page', 'post' );

$kiddiz_metabox = new Kiddiz_MetaBox( 
                                    'kiddiz-options',     //metabox id
                                    esc_html__( 'Kiddiz Meta Options', 'kiddiz' ), //metabox title
                                    $post_types            //metabox post types
                                    );

/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_enqueue_script, and  wp_enqueue_style
 *
 * @since Kiddiz 1.0.0
 */
function kiddiz_enqueue_metabox_scripts( $hook ) {

    if( $hook == 'post.php' || $hook == 'post-new.php'  ){
        //Scripts
        wp_enqueue_script( 'kiddiz-metabox', get_template_directory_uri() . '/assets/js/metabox' . kiddiz_min() . '.js', array( 'jquery', 'jquery-ui-tabs' ), '2013-10-05' );
        //CSS Styles
        wp_enqueue_style( 'kiddiz-metabox-tabs', get_template_directory_uri() . '/assets/css/metabox' . kiddiz_min() . '.css' );
    }
    return;
}
add_action( 'admin_enqueue_scripts', 'kiddiz_enqueue_metabox_scripts', 20 );
