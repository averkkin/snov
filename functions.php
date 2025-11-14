<?php
if ( ! defined( '_S_VERSION' ) ) {
    define( '_S_VERSION', '1.0.0' );
}

function snov_group_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus([
        'menu-1' => __( 'Primary Menu', 'snov-group' ),
    ]);
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);
    add_theme_support('custom-logo', [
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ]);
}
add_action('after_setup_theme', 'snov_group_setup');

function snov_group_scripts() {
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/styles/style.css', [], _S_VERSION);
}
add_action('wp_enqueue_scripts', 'snov_group_scripts');

// include WooCommerce
require_once get_template_directory() . '/inc/woocommerce.php';

// include custom scripts
require_once get_template_directory() . '/inc/scripts.php';
