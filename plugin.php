<?php 
/*
Plugin Name: Display Categories and Tags Grid
Plugin URI: https://robercrea.com/plugins-wordpress/display-categories-grid/
Description: Display the categories and tags from posts or products on a grid in your website.
Author: Rober Crea
Author URI: https://robercrea.com/
Version: 1.0
License: GPL2 or later
Text Domain: rc-display-categories-grid
Domain Path: /languages
*/

// If this file is called directly, exit.
defined( 'ABSPATH' ) || exit;

// Set plugin version constant
if(!function_exists('get_plugin_data')){
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
$plugin_data = get_plugin_data(__FILE__, ['Version'=> 'Version']);
if(!defined('RC_DCG_VERSION'))
    define('RC_DCG_VERSION', $plugin_data['Version']);

// Set plugin uri constant
if(!defined('RC_DCG_URI'))
    define('RC_DCG_URI', $plugin_data['PluginURI']);

// Set plugin url constant
if(!defined('RC_DCG_URL'))
    define('RC_DCG_URL', plugin_dir_url(__FILE__));

require_once plugin_dir_path(__FILE__) . 'lib/admin/admin.php';
require_once plugin_dir_path(__FILE__) . 'lib/blocks/blocks.php';
require_once plugin_dir_path(__FILE__) . 'lib/css/inline.php';

class RC_DCG {

    function __construct(){
        add_action('plugins_loaded', [$this, 'load_i18n']);
    }

    // Load internationalization.
    function load_i18n(){
        load_plugin_textdomain('rc-display-categories-grid', false, basename(dirname(__FILE__)).'/languages/');
    }

}

new RC_DCG();