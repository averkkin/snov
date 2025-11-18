<?php

defined('ABSPATH') || exit;

/**
 * Woocommerce functions
 */

// Declaring Theme Support
// https://developer.woocommerce.com/docs/theming/theme-development/classic-theme-developer-handbook
add_action( 'after_setup_theme', function () {
    add_theme_support('woocommerce');
    add_theme_support('title-tag');
} );

// Remove breadcrumb
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// Disabling WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Добавляем новую вкладку
add_filter('woocommerce_product_data_tabs', function($tabs) {
    $tabs['snov_colors'] = [
        'label'    => 'Цветовые варианты',
        'target'   => 'snov_colors_tab',
        'class'    => ['hide_if_grouped'],
        'priority' => 25,
    ];
    return $tabs;
});

// Панель вкладки
add_action('woocommerce_product_data_panels', function() {
    global $post;
    ?>
    <div id="snov_colors_tab" class="panel woocommerce_options_panel">
        <div class="options_group">

            <?php
            // IDs связанных товаров
            woocommerce_wp_text_input([
                'id'          => '_snov_color_links',
                'label'       => 'Связанные цвета (ID товаров)',
                'placeholder' => '58, 62, 64, 66',
                'desc_tip'    => true,
                'description' => 'Введите ID других товаров, которые являются цветами.',
                'value'       => get_post_meta($post->ID, '_snov_color_links', true),
            ]);

            // HEX
            woocommerce_wp_text_input([
                'id'          => '_snov_color_hex',
                'label'       => 'HEX цвет',
                'placeholder' => '#ece7df',
                'desc_tip'    => true,
                'description' => 'Цвет кружка (например #ece7df)',
                'value'       => get_post_meta($post->ID, '_snov_color_hex', true),
            ]);

            // НОВОЕ ПОЛЕ: Название цвета
            woocommerce_wp_text_input([
                'id'          => '_snov_color_name',
                'label'       => 'Название цвета',
                'placeholder' => 'Например: Белый, Серый, Пудра',
                'desc_tip'    => true,
                'description' => 'Отображаемое имя цвета.',
                'value'       => get_post_meta($post->ID, '_snov_color_name', true),
            ]);
            ?>

        </div>
    </div>
    <?php
});

// Сохранение
add_action('woocommerce_admin_process_product_object', function($product) {

    if (isset($_POST['_snov_color_links'])) {
        $product->update_meta_data('_snov_color_links', sanitize_text_field($_POST['_snov_color_links']));
    }

    if (isset($_POST['_snov_color_hex'])) {
        $product->update_meta_data('_snov_color_hex', sanitize_hex_color($_POST['_snov_color_hex']));
    }

    if (isset($_POST['_snov_color_name'])) {
        $product->update_meta_data('_snov_color_name', sanitize_text_field($_POST['_snov_color_name']));
    }
});






