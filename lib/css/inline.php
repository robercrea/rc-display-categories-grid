<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: Inline Style
 * since: 1.0
 */

defined('ABSPATH') || exit;


require_once 'style.php';

class RC_DCG_Inline extends RC_DCG_Style{
    function __construct(){
        add_action('wp_enqueue_scripts', [$this, 'add']);
    }

    function add(){
        wp_enqueue_style('rc_dcg_style', plugins_url('front.css', __FILE__), [], RC_DCG_VERSION);
        $css= $this->get_variables();
        wp_add_inline_style( 'rc_dcg_style', $css );
    }

    function get_variables(){

        $style = $this->get_style();
        
        return sprintf('
        :root{
        --rc-dcg-cards-columns: %s;
        --rc-dcg-cards-gap-v: %spx;
        --rc-dcg-cards-gap-h: %spx;
    
        --rc-dcg-card-bg-color: %s;
        --rc-dcg-card-text-color: %s;
        --rc-dcg-card-text-bg-color: %s;
    
        --rc-dcg-card-hover-text-bg-color: %s;
    
        --rc-dcg-card-font-size: %spx;
        }
        ',
        esc_attr($style['cards-columns']),
        esc_attr($style['cards-gap-v']),
        esc_attr($style['cards-gap-h']),
        
        esc_attr($style['card-bg-color']),
        esc_attr($style['card-text-color']),
        esc_attr($style['card-text-bg-color']),

        esc_attr($style['card-hover-text-bg-color']),

        esc_attr($style['card-font-size']),

    );
    }
}

new RC_DCG_Inline();