<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: admin
 * since: 1.0
 */

defined('ABSPATH') || exit;


// Load menu files
require_once plugin_dir_path(__FILE__) . 'menu/register.php';
require_once plugin_dir_path(__FILE__) . 'menu/sections.php';
require_once plugin_dir_path(__FILE__) . 'menu/fields.php';

// Add Image support
require_once plugin_dir_path(__FILE__) . 'support/image-support.php';

class RC_DCG_Admin {
    function __construct(){
        if(is_admin())
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    // Enqueue admin css and js
    function enqueue_scripts(){

        // Load Select2
        wp_enqueue_style('select2-css', RC_DCG_URL . '/lib/admin/css/select2.min.css', array(), RC_DCG_VERSION);
        wp_enqueue_script('select2-js', RC_DCG_URL . '/lib/admin/js/select2.min.js', array('jquery'), RC_DCG_VERSION, true);

        // Load Color Picker
        wp_enqueue_style( 'wp-color-picker' );

        // Load admin js
        wp_enqueue_media();
        wp_enqueue_script('rc-dcg-admin-js', plugins_url('/js/admin.js', __FILE__), array('jquery', 'wp-color-picker'), RC_DCG_VERSION, true);
        wp_localize_script('rc-dcg-admin-js', 'rc_dcg_admin', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('rc-dcg-admin')));
        // Load admin css
        $admin_css = plugins_url('/css/admin.css', __FILE__);    
        wp_enqueue_style('rc-dcg-style', $admin_css, array(), RC_DCG_VERSION);

    }
}

new RC_DCG_Admin();