<?php

defined('ABSPATH') || exit;

function theme_enqueue_assets() {

    wp_enqueue_script(
        'main-js',
        get_template_directory_uri() . '/assets/main.js',
        [],
        null,
        true
    );

}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');

function add_module_to_main_js($tag, $handle, $src) {
    if ($handle === 'main-js') {
        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_module_to_main_js', 10, 3);
