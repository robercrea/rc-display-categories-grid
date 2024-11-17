<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: register fields
 * since: 1.0
 */

defined('ABSPATH') || exit;


class RC_DCG_Fields {

    function __construct(){
        if(is_admin()){
            add_action('admin_init', [$this, 'setup_fields']);
            $this->register_settings();
        }
    }

    function register_settings(){
        // rc_dcg_config_fields Settings
        register_setting('rc_dcg_config_fields', 'rc_dcg_category_out', [$this, 'sanitize_int_array'] );
        register_setting('rc_dcg_config_fields', 'rc_dcg_post_tag_out', [$this, 'sanitize_int_array'] );
        register_setting('rc_dcg_config_fields', 'rc_dcg_product_cat_out', [$this, 'sanitize_int_array'] );
        register_setting('rc_dcg_config_fields', 'rc_dcg_product_tag_out', [$this, 'sanitize_int_array'] );
     
        // rc_dcg_style_fields Settings
        register_setting('rc_dcg_style_fields', 'rc_dcg_cards_columns', [$this, 'sanitize_columns'] );
        
        register_setting('rc_dcg_style_fields', 'rc_dcg_cards_gap-v', [$this, 'sanitize_range'] );
        register_setting('rc_dcg_style_fields', 'rc_dcg_cards_gap-h', [$this, 'sanitize_range'] );


        register_setting('rc_dcg_style_fields', 'rc_dcg_card_bg_color', 'sanitize_hex_color' );
        register_setting('rc_dcg_style_fields', 'rc_dcg_card_text_color', 'sanitize_hex_color' );
        register_setting('rc_dcg_style_fields', 'rc_dcg_card_text_bg_color', 'sanitize_hex_color' );
        register_setting('rc_dcg_style_fields', 'rc_dcg_card_hover_text_bg_color', 'sanitize_hex_color' );

        register_setting('rc_dcg_style_fields', 'rc_dcg_card_font_size', [$this, 'sanitize_range'] );

    }

    function setup_fields(){
        $this->setup_field_config();

        // Only setup if WooCommerce is installed/activated
        if (class_exists('WooCommerce')) $this->setup_field_woo_config();
        
        $this->setup_field_style();
    }

    function setup_field_config(){
        $field = "rc_dcg_config_fields";
        $section = "rc_dcg_config_section";

        // Post Categories to Hide
        add_settings_field(
            'rc_dcg_category_out',
            esc_attr__('Post Categories to Hide', 'rc-display-categories-grid'),
            [$this, 'categories_select'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_category_out',
                'default' => 3,
                'select' => 'category'
            ]
        );

        // Post Tags to Hide
        add_settings_field(
            'rc_dcg_post_tag_out',
            esc_attr__('Post Tags to Hide', 'rc-display-categories-grid'),
            [$this, 'categories_select'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_post_tag_out',
                'default' => 1,
                'select' => 'post_tag'
            ]
        );
    }

    function setup_field_woo_config(){
        $field = "rc_dcg_config_fields";
        $section = "rc_dcg_config_section";

        // Product Categories to Hide
        add_settings_field(
            'rc_dcg_product_cat_out',
            esc_attr__('Product Categories to Hide', 'rc-display-categories-grid'),
            [$this, 'categories_select'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_product_cat_out',
                'default' => 1,
                'select' => 'product_cat'
            ]
        );

        // Product Tags to Hide
        add_settings_field(
            'rc_dcg_product_tag_out',
            esc_attr__('Product Tags to Hide', 'rc-display-categories-grid'),
            [$this, 'categories_select'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_product_tag_out',
                'default' => 1,
                'select' => 'product_tag'
            ]
        );
    }

    function setup_field_style() {
        $field = "rc_dcg_style_fields";
        $section = "rc_dcg_style_section";

        // Num of columns
        add_settings_field(
            'rc_dcg_cards_columns',
            esc_attr__('Select Layout', 'rc-display-categories-grid'),
            [$this, 'columns_num'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_cards_columns',
                'default' => 4,
            ]
        );

        // Vertical Space
        add_settings_field(
            'rc_dcg_cards_gap-v',
            esc_attr__('Vertical Space', 'rc-display-categories-grid'),
            [$this, 'space_range'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_cards_gap-v',
                'default' => 10,
                'min' => 0,
                'max' => 300,
                'step' => 10
            ]
        );
        
        // Horizontal Space
        add_settings_field(
            'rc_dcg_cards_gap-h',
            esc_attr__('Horizontal Space', 'rc-display-categories-grid'),
            [$this, 'space_range'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_cards_gap-h',
                'default' => 20,
                'min' => 0,
                'max' => 300,
                'step' => 10
            ]
        );
        

        // Card background color
        add_settings_field(
            'rc_dcg_card_bg_color',
            esc_attr__('Card Background Color', 'rc-display-categories-grid'),
            [$this, 'select_color'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_card_bg_color',
                'default' => "#f3f3f3",
            ]
        );

        // Card text color
        add_settings_field(
            'rc_dcg_card_text_color',
            esc_attr__('Card Text Color', 'rc-display-categories-grid'),
            [$this, 'select_color'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_card_text_color',
                'default' => "#ffffff",
            ]
        );

        // Card text bg color
        add_settings_field(
            'rc_dcg_card_text_bg_color',
            esc_attr__('Card Text background Color', 'rc-display-categories-grid'),
            [$this, 'select_color'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_card_text_bg_color',
                'default' => "#222222",
            ]
        );

        // Card text bg hover color
        add_settings_field(
            'rc_dcg_card_hover_text_bg_color',
            esc_attr__('Card Text Background Hover Color', 'rc-display-categories-grid'),
            [$this, 'select_color'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_card_hover_text_bg_color',
                'default' => "#183c60",
            ]
        );
        
        // Font Size
        add_settings_field(
            'rc_dcg_card_font_size',
            esc_attr__('Font Size', 'rc-display-categories-grid'),
            [$this, 'space_range'],
            $field,
            $section,
            [
                'name' => 'rc_dcg_card_font_size',
                'default' => 15,
                'min' => 6,
                'max' => 20,
                'step' => 1
            ]
        );
    }

    // Select Range
    public function space_range($args) {
        $name = sanitize_html_class( $args['name'] );
        $default = intval( $args['default'] );
        $option = intval( get_option( $name, $default ));
        $min = intval($args['min']);
        $max = intval($args['max']);
        $step = intval($args['step']);
        ?>

        <input 
            type="range"
            class="rc-range"
            name="<?php echo esc_attr( $name ); ?>"
            value="<?php echo intval($option);?>"
            min="<?php echo intval($min);?>"
            max="<?php echo intval($max);?>"
            step="<?php echo intval($step);?>"
        >
        <label class="rc-range-label" id="<?php echo esc_attr( $name );?>_label"><?php echo intval($option);?>px</label>

        <?php
    }

    // Select color
    public function select_color($args) {
        $name = sanitize_html_class( $args['name'] );
        $default = sanitize_hex_color( $args['default'] );
        $color = sanitize_hex_color( get_option($name, $default) );
        ?>
        <input type="text" 
        name="<?php echo esc_attr($name);?>" 
        value="<?php echo esc_attr($color);?>" 
        data-default-color="<?php echo esc_attr($default);?>"
        class="wp-color-picker <?php echo esc_attr( $name );?>"/>
        <?php
    }

    // Num of columns
    public function columns_num($args) {
        $name = sanitize_html_class( $args['name']);
        $default = intval($args['default']);
        $option = intval(get_option($name, $default));
        $imagePath = RC_DCG_URL . 'lib/admin/images/';
        ?>
        <div class="rc-grid-3col">
            <label>
                <span><?php echo esc_attr__("3 columns", 'rc-display-categories-grid');?></span>
                <img class="radio" src="<?php echo esc_url($imagePath);?>columns-03.svg"/>
                <input type="radio" name="<?php echo esc_attr($name);?>" value="3" <?php checked($option, 3);?>>
            </label>
            <label>
                <span><?php echo esc_attr__("4 columns", 'rc-display-categories-grid');?></span>
                <img class="radio" src="<?php echo esc_url($imagePath);?>columns-04.svg"/>
                <input type="radio" name="<?php echo esc_attr($name);?>" value="4" <?php checked($option, 4);?>>
            </label>
            <label>
                <span><?php echo esc_attr__("5 columns", 'rc-display-categories-grid');?></span>
                <img class="radio" src="<?php echo esc_url($imagePath);?>columns-05.svg"/>
                <input type="radio" name="<?php echo esc_attr($name);?>" value="5" <?php checked($option, 5);?>>
            </label>
        </div>

        <?php

    }

    // Select products categories
    public function categories_select($args) {
        $name = sanitize_html_class( $args['name']);
        $select = sanitize_html_class( $args['select']);
        $options = get_option($name);

        // get all woocommerce categories
        $product_terms = get_terms( 
            [
                'taxonomy'   => $select,
                'hide_empty' => false,
            ]
        );
        $content = '<select class="select2" multiple="multiple" name="' . esc_attr($name) . '[]">';
        foreach($product_terms as $term){

            $selected =(is_array($options)) ? selected( true, in_array(intval($term->term_id), $options), false) : false;
            $content .= '<option value="' . intval($term->term_id) . '" ' . $selected . '>' . esc_attr($term->name) . '</option>';
        }
        $content .= "</select>";
        
        $allowed_html = [
            'select' => [
                'multiple' => true,
                'name' => true,
                'class' => true,
            ], 
            'option' => [
                'value' => true,
                'selected' => true,
            ],
            'span' => [
                'class' => true,
            ]
        ];
        echo wp_kses($content, $allowed_html);
    }

    // Select image sizes from wordpress
    function select_image_size($args){
        $name = sanitize_html_class($args['name']);
        $selected = esc_attr(get_option($name, $args['default']));

        $options = get_intermediate_image_sizes();

        echo '<select id="' . esc_attr($name) . '" name="' . esc_attr($name).'">';
        foreach ($options as $opt) {
            echo '<option value="' . esc_attr($opt) . '"' . selected($opt,$selected) . '>';
            echo esc_attr($opt) . '</option>';
        }
        echo '</select>';
    }

    //Sanitize Range
    function range_sanitize($input) {
        $num = intval($input);
        return ($input >= 0 && $input <=300)?$num:0;
    }

    //Sanitize columns
    function sanitize_columns($input) {
        $num = intval($input);
        
        // if $num between 2 and 6 return $num else return 4
        return ($num > 2 && $num < 6)? $num:4;
    }

    // Sanitize int array
    function sanitize_int_array($input) {
        
        //check if $input is an array
        if(!is_array($input)){
            return intval($input);
        }
        // return sanitize each element of the array
        return array_map('intval', $input);
    }

}

new RC_DCG_Fields();