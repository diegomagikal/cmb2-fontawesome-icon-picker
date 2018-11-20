<?php
/*
Plugin Name: CMB2 Field Type: FontAwesome Picker
Plugin URI: https://github.com/diegomagikal/cmb2-fontawesome-picker
Description: Font-Awesome Icon picker field type for CMB2
Version: 1.1.0
Author: Khorshed Alam / Changes by Diego Luiz
Author URI: http://khorshedalam.com
License: GPLv2+
*/

/**
 * Class KS_FontAwesome_IconPicker
 */
class KS_FontAwesome_IconPicker {

    /**
     * Current version number
     */
    const VERSION = '1.1.0';

    /**
     * Initialize the plugin by hooking into CMB2
     */
    public function __construct() {
        add_action( 'cmb2_render_fontawesome_icon', array( $this, 'render' ), 10, 5 );
        add_action( 'cmb2_sanitize_fontawesome_icon', array( $this, 'sanitize' ), 10, 2 );
    }

    /**
     * Add a CMB custom field to allow for the selection FontAwesome Icon
     */
    public function render( $field, $escaped_value, $object_id, $object_type, $field_type ) {
        $this->setup_admin_scripts();

    	echo $field_type->input( array( 'type' => 'text', 'class' => 'fontawesome-icon-select regular-text' ) );
    }

    /**
     * Sanitize icon class name
     */
   public function sanitize( $sanitized_val, $val ) {
        //sanitize disabled due to multiple icon prefix (fas, fab, fa, etc)
        return $sanitized_val;
    }

    /**
     * Enqueue admin scripts for our font-awesome picker field type
     */
    protected function setup_admin_scripts() {
        $dir = trailingslashit( dirname( __FILE__ ) );

        if ( 'WIN' === strtoupper( substr( PHP_OS, 0, 3 ) ) ) {
            // Windows
            $content_dir = str_replace( '/', DIRECTORY_SEPARATOR, WP_CONTENT_DIR );
            $content_url = str_replace( $content_dir, WP_CONTENT_URL, $dir );
            $url = str_replace( DIRECTORY_SEPARATOR, '/', $content_url );
        }
        else {
            $url = str_replace(
                array( WP_CONTENT_DIR, WP_PLUGIN_DIR ),
                array( WP_CONTENT_URL, WP_PLUGIN_URL ),
                $dir
            );
        }

        $url = set_url_scheme( $url );

        $requirements = array(
            'jquery',
        );

    	wp_enqueue_script( 'cmb2-fontawesome-picker', $url . 'node_modules/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js', array('jquery'), self::VERSION, true );
        wp_enqueue_script( 'cmb2-fontawesome-picker-init', $url . 'assets/js/fontawesome-picker-init.js', array('cmb2-fontawesome-picker'), self::VERSION, true );
    	
        wp_enqueue_style( 'cmb2-fontawesome-css', $url . 'node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css', array(), self::VERSION );
        wp_enqueue_style( 'cmb2-fontawesome-css-all', $url . 'node_modules/@fortawesome/fontawesome-free/css/all.min.css', array(), self::VERSION );
        wp_enqueue_style( 'bootstrap-popovers', $url . 'assets/css/bootstrap-popovers.css', array('cmb2-fontawesome-css'), self::VERSION );
       
        wp_enqueue_style( 'cmb2-fontawesome-picker', $url . 'node_modules/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css', array('bootstrap-popovers'), self::VERSION );
        wp_enqueue_style( 'cmb2-fontawesome-picker-fixes', $url . 'assets/css/cmb2-fixes.css', array('cmb2-fontawesome-picker'), self::VERSION );
    }


    /**
     * load the css int the frontend (needs call)
     * Ex: (new KS_FontAwesome_IconPicker())->scripts_frontend(); 
     */
    public function scripts_frontend() {
        $dir = trailingslashit( dirname( __FILE__ ) );

        if ( 'WIN' === strtoupper( substr( PHP_OS, 0, 3 ) ) ) {
            // Windows
            $content_dir = str_replace( '/', DIRECTORY_SEPARATOR, WP_CONTENT_DIR );
            $content_url = str_replace( $content_dir, WP_CONTENT_URL, $dir );
            $url = str_replace( DIRECTORY_SEPARATOR, '/', $content_url );
        }
        else {
            $url = str_replace(
                array( WP_CONTENT_DIR, WP_PLUGIN_DIR ),
                array( WP_CONTENT_URL, WP_PLUGIN_URL ),
                $dir
            );
        }

        $url = set_url_scheme( $url );

       
        
        wp_enqueue_style( 'cmb2-fontawesome-css', $url . 'node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css', array(), self::VERSION );
        wp_enqueue_style( 'cmb2-fontawesome-css-all', $url . 'node_modules/@fortawesome/fontawesome-free/css/all.min.css', array(), self::VERSION );
    }
}
new KS_FontAwesome_IconPicker();
