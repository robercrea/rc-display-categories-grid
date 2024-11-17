<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: admin sections
 * since: 1.0
 */

defined('ABSPATH') || exit;


class RC_DCG_Sections {

    function __construct(){
        if(is_admin()){
            add_action('admin_init', [$this, 'setup_sections']);
        }
    }

    function setup_sections(){

        // Categories configuration section
        add_settings_section(
            'rc_dcg_config_section', 
            __('Categories and Tags You Want to Hide', 'rc-display-categories-grid'), 
            false, 
            'rc_dcg_config_fields'
        );

        // Style configuration section
        add_settings_section(
            'rc_dcg_style_section',
            __('Edit Style', 'rc-display-categories-grid'),
            false,
            'rc_dcg_style_fields'
        );
    }
}

new RC_DCG_Sections();