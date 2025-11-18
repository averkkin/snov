<?php
defined('ABSPATH') || exit;

/**
 * Добавляем новую вкладку в карточку товара
 */
add_filter('woocommerce_product_data_tabs', function($tabs) {

    $tabs['snov_details'] = [
        'label'    => 'Детали',
        'target'   => 'snov_details_tab',
        'class'    => ['show_if_simple', 'show_if_variable'],
        'priority' => 21
    ];

    $tabs['snov_care'] = [
        'label'    => 'Правила ухода',
        'target'   => 'snov_care_tab',
        'class'    => ['show_if_simple', 'show_if_variable'],
        'priority' => 22
    ];

    $tabs['snov_delivery'] = [
        'label'    => 'Доставка и возврат',
        'target'   => 'snov_delivery_tab',
        'class'    => ['show_if_simple', 'show_if_variable'],
        'priority' => 23
    ];

    return $tabs;
});


/**
 * Контейнеры вкладок
 */
add_action('woocommerce_product_data_panels', function() {
    global $post;

    // 1. Детали
    ?>
    <div id="snov_details_tab" class="panel woocommerce_options_panel hidden">
        <?php
        wp_editor(
            get_post_meta($post->ID, '_snov_product_details', true),
            'snov_product_details_editor',
            [
                'textarea_name' => '_snov_product_details',
                'textarea_rows' => 10,
                'teeny'         => false,
                'media_buttons' => true,
            ]
        );
        ?>
    </div>

    <?php
    // 2. Правила ухода
    ?>
    <div id="snov_care_tab" class="panel woocommerce_options_panel hidden">
        <?php
        wp_editor(
            get_post_meta($post->ID, '_snov_product_care', true),
            'snov_product_care_editor',
            [
                'textarea_name' => '_snov_product_care',
                'textarea_rows' => 10,
                'teeny'         => false,
                'media_buttons' => true,
            ]
        );
        ?>
    </div>

    <?php
    // 3. Доставка и возврат
    ?>
    <div id="snov_delivery_tab" class="panel woocommerce_options_panel hidden">
        <?php
        wp_editor(
            get_post_meta($post->ID, '_snov_product_delivery', true),
            'snov_product_delivery_editor',
            [
                'textarea_name' => '_snov_product_delivery',
                'textarea_rows' => 10,
                'teeny'         => false,
                'media_buttons' => true,
            ]
        );
        ?>
    </div>
    <?php
});


/**
 * Сохранение данных
 */
add_action('woocommerce_admin_process_product_object', function($product) {
    $fields = [
        '_snov_product_details',
        '_snov_product_care',
        '_snov_product_delivery',
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $product->update_meta_data($field, wp_kses_post($_POST[$field]));
        }
    }
});
