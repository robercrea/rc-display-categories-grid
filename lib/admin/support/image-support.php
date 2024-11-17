<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: image support fot categories
 * since: 1.0
 */

defined('ABSPATH') || exit;


class RC_DCG_Taxonomies_Image_Support {
    private $term_image = 'thumbnail_id';

    function __construct() {
        add_action( 'init', array($this, 'register_thumbnail_id_meta'), 10 );
        
        // {taxonomy}_add_form
        //add_action('category_add_form', array($this,'add_term_image_field'));
        
        // {taxonomy}_edit_form
        add_action('category_edit_form', array($this,'add_thumbnail_id_field'));
        add_action('post_tag_edit_form', array($this,'add_thumbnail_id_field'));
        add_action('product_tag_edit_form', array($this,'add_thumbnail_id_field'));
        
        // edited_{taxonomy} also works
        add_action('edited_terms', array($this,'save_term_image_meta'), 10, 2);
        
        add_action('wp_ajax_rc_term_image', array($this, 'rc_term_image'),);

    }

    function register_thumbnail_id_meta(){
        wp_create_nonce( 'rc_term_image_nonce' );

        // Empty to register on all the taxonomies
        register_term_meta( '', $this->term_image, array(
            'type' => 'attachment',
            'description' => __('Upload an image for this category.', 'rc-display-categories-grid'),
            'single'     => true,
        ) );
    }

    function add_thumbnail_id_field($term){

        $id = $term->term_id;
        $term_image_id = get_term_meta( $id, $this->term_image, true );
        wp_nonce_field( 'rc_term_image', 'rc_term_image_nonce' );
        
        if(intval($term_image_id) > 0){
            $image = wp_get_attachment_image( $term_image_id, 'thumbnail', false, array('id' => 'rc_term_image_preview') );
            echo wp_kses_post($image);
        } else {
            $default_image = RC_DCG_URL . 'images/no-image.png';
            echo '<img id="rc_term_image_preview" class="attachment-thumbnail size-thumbnail" src="' . esc_url($default_image) . '"/><br>';
        }
        echo '</br>';
        ?>

        <input type="hidden" name="thumbnail_id" id="rc_term_image" value="<?php echo esc_attr($term_image_id);?>">
        <input type="button" class="button-primary" value="<?php esc_attr_e('Select Image','rc-display-categories-grid');?>" id="rc_term_image_media_manager"> 
        <?php
    }

    function save_term_image_meta($term_id, $taxonomy){
        if(empty($_POST['rc_term_image_nonce'])) return;
        if(isset($_POST['thumbnail_id']) && wp_verify_nonce( sanitize_html_class( wp_unslash($_POST['rc_term_image_nonce'])), 'rc_term_image' ))
            update_term_meta( $term_id, $this->term_image, sanitize_html_class( wp_unslash($_POST['thumbnail_id'])));
    }

    function rc_term_image(){
        if(!check_ajax_referer('rc-dcg-admin', 'nonce')) return;
        if(isset($_GET['id']) ){
            $image = wp_get_attachment_image( 
                filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT),
                'thumbnail', false, array('id' => 'rc_term_image_preview'));
            $data = array(
                'image' => $image
            );
            wp_send_json_success($data);
        } else {
            wp_send_json_error( ["error" => "Invalid request"] );
        }
    }

}

new RC_DCG_Taxonomies_Image_Support();