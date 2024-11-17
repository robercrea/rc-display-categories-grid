<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: Blocks
 * since: 1.0
 */

defined('ABSPATH') || exit;


require_once plugin_dir_path(__FILE__) . 'build/callbacks.php';

class RC_DCG_Blocks extends RC_DCG_Blocks_Callbacks{

    function __construct(){

        if(!function_exists('register_block_type')) return; // Gutenberg not active

        add_action( 'enqueue_block_editor_assets', [$this, 'register_admin_style']);
        add_action( 'block_categories_all', array($this, 'register_category'), 10, 2 );
        add_action('init', array($this, 'register'));
    }

    function register_admin_style(){
        wp_register_style( 'rc-dcg-blocks', RC_DCG_URL . '/lib/css/back.css', [], RC_DCG_VERSION);
        wp_enqueue_style( 'rc-dcg-blocks' );
    }

    // Register blocks category
    function register_category($categories) {
        return array_merge(
            $categories,
            [
                [
                    'slug' => 'rc-dcg-blocks',
                    'title' => __('DCG Blocks', 'rc-display-categories-grid')
                ]
            ]
        );
    }

    // Register block
    function register(){

        // Front css
        wp_enqueue_style( 
            'rc-dcg-blocks-front',
            RC_DCG_URL . '/lib/css/front.css',
            [],
            RC_DCG_VERSION,
            'all'
        );

        register_block_type_from_metadata( __DIR__ . '/build/categories', ['render_callback' => [$this, 'categories']]);

    }

}

new RC_DCG_Blocks();