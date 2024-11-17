<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: Blocks callbacks
 * since: 1.0
 */

defined('ABSPATH') || exit;


class RC_DCG_Blocks_Callbacks
{
    function categories($atts)
    {
        $option  = sanitize_html_class($atts['option'] ?? 'category');

        return $this->get_content($option);
    }

    private function get_content($option)
    {
        if(($option == "product_cat" || $option == "product_tag") && !class_exists('WooCommerce'))
            return "<p>" . __('WooCommerce is not installed or activated', 'rc-display-categories-grid') ."</p>";

        $product_terms = get_terms(
            array(
                'taxonomy'   => esc_attr( $option),
                'hide_empty' => false,
            )
        );
        
        $remove = get_option('rc_dcg_' . esc_attr($option) . '_out');

        if (!is_array($remove)) $remove = array();

        $categories = '';
        foreach ($product_terms as $p) {
            $id = $p->term_id;
            $name = $p->name;
            $link = get_term_link($id, $option);

            $image = $this->get_image_url($id);

            if (empty($image))
                $image = RC_DCG_URL . '/images/no-image.png';

            if (!in_array($id, $remove)) {
                $categories .= '<a class="rc-dcg-category" href="' . esc_url($link) . '">';
                $categories .= '<img src="' . esc_url($image) . '"/>';
                $categories .=  '<span>' . esc_attr($name) . '</span></a>';
            }
        }

        return "<div class='rc-dcg-categories'>$categories</div>";
    }

    private function get_image_url($id)
    {
        $image_id = get_term_meta($id, 'thumbnail_id', true);
        return wp_get_attachment_image_url($image_id, 'medium');
    }
}
