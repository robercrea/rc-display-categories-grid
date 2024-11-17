<?php
/**
 * author: Rober Crea
 * uri: https://robercrea.com
 * desc: config page
 * since: 1.0
 */

defined('ABSPATH') || exit;


include_once 'inc/header.php'; ?>

<div class="notification notification-info">
    <p>
        <?php echo wp_kses(__("You can display the categories or tags using the <strong>GUTENBERG BLOCK</strong>.", 'rc-display-categories-grid'),
        ['strong' => []]);?>
    </p>
</div>

<form action="options.php" method="post">
    <?php
        settings_fields('rc_dcg_config_fields');
        do_settings_sections('rc_dcg_config_fields');
        submit_button();
    ?>
</form>

<?php include_once 'inc/footer.php';?>