<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: register admin menu
 * since: 1.0
 */

defined('ABSPATH') || exit;


class RC_DCG_Menus {

    private $slug = "rc-dcg-menu";
    
    function __construct(){
        if(is_admin())
            add_action('admin_menu', [$this, 'register_menu']);
    }

    function register_menu(){

        // Add Parent Menu
        add_menu_page(
            __('Display Categories Grid', 'rc-display-categories-grid'), 
            __('Categories Grid', 'rc-display-categories-grid'), 
            'manage_options', 
            $this->slug, 
            [$this, 'config_page'], 
            'dashicons-screenoptions', 
            100
        );

        // Add config submenu
        add_submenu_page(
            $this->slug,
            __('Display Categories Grid', 'rc-display-categories-grid'),
            __('Hide Categories', 'rc-display-categories-grid'),
            'manage_options',
            $this->slug,
            [$this, 'config_page']
        );

        // Add style submenu
        add_submenu_page(
            $this->slug,
            __('Style Editor', 'rc-display-categories-grid'),
            __('Edit Styles', 'rc-display-categories-grid'),
            'manage_options',
            $this->slug . '-styles',
            [$this, 'style_editor']
        );

    }

    function config_page(){
        require_once plugin_dir_path(__FILE__) . 'pages/config-page.php';
    }

    function style_editor(){
        require_once plugin_dir_path(__FILE__) . 'pages/style-editor.php';
    }

}

new RC_DCG_Menus();