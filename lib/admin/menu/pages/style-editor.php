<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: style page
 * since: 1.0
 */

defined('ABSPATH') || exit;


include_once 'inc/header.php';
?>
    <form action="options.php" method="post">
        <?php
            settings_fields('rc_dcg_style_fields');
            do_settings_sections('rc_dcg_style_fields');
            submit_button();
        ?>
    </form>

<?php include_once 'inc/footer.php';?>