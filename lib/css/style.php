<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: Get Style
 * since: 1.0
 */

defined('ABSPATH') || exit;



class RC_DCG_Style {
    function get_style(){
        return [
            'cards-columns' => intval( get_option( 'rc_dcg_cards_columns', 4 ) ),
            'cards-gap-v' => sanitize_html_class( get_option( 'rc_dcg_cards_gap-v', '10' ) ),
            'cards-gap-h' => sanitize_html_class( get_option( 'rc_dcg_cards_gap-h', '20' ) ),

            'card-bg-color' => sanitize_hex_color( get_option( 'rc_dcg_card_bg_color', '#f3f3f3' )),
            'card-text-color' => sanitize_hex_color( get_option( 'rc_dcg_card_text_color', '#ffffff' )),
            'card-text-bg-color' => sanitize_hex_color( get_option( 'rc_dcg_card_text_bg_color', '#222222' )),
            'card-hover-text-bg-color' => sanitize_hex_color( get_option( 'rc_dcg_card_hover_text_bg_color', '#183c60' )),

            'card-font-size' => sanitize_html_class( get_option( 'rc_dcg_card_font_size', '15' ) ),
            'card-font-weight' => sanitize_html_class( get_option( 'rc_dcg_card_font_weight', 'bold' ) ),

        ];
    }

    function return_a_color($option, $color){
        $input = sanitize_hex_color( $option );
        if(empty($input)) return $color;
        else return $option;
    }
}