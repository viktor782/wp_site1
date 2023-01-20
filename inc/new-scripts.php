<?php
if (!function_exists('chromium_include_admin_script')) {
    function chromium_include_admin_script()
    {
        global $typenow;

        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return;
        }

        if (get_post_type() != 'product') {
            return;
        }

        if (!in_array($typenow, array('product'))) {
            return;
        }

        wp_register_script('chromium-admin-js', get_template_directory_uri() . '/assets/js/admin-js.js', '', '');
        wp_enqueue_script('chromium-admin-js');
    }

    add_action('admin_enqueue_scripts', 'chromium_include_admin_script');
}