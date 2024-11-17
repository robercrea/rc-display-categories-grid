<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: menu pages footer
 * since: 1.0
 */

defined('ABSPATH') || exit;

?>

</section> <!-- end content -->

<footer>
    <section>
        <img src="<?php echo esc_url(RC_DCG_URL)?>lib/admin/images/robercrea.svg"/>
        <p>
            <?php esc_attr_e('Visit', 'rc-display-categories-grid');?> 
            <a href="https://robercrea.com/" target="_blank">robercrea.com</a> 
            <?php esc_attr_e('to discover more plugins!', 'rc-display-categories-grid');?>
        </p>
        <a class="smallbtn" target="_blank" href="<?php echo esc_html(RC_DCG_URI);?>"><?php esc_attr_e('Report Bug/Leave Comment', 'rc-display-categories-grid');?></a>
    </section>
</footer>
</div><!-- end robercrea-admin -->