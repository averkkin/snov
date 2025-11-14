<?php
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


/**
 * Добавляем поля Состав и Материал в раздел "Характеристики"
 */
add_action( 'woocommerce_product_data_tabs', function( $tabs ) {
    $tabs['snov_characteristics'] = [
        'label'    => __( 'Характеристики', 'snov' ),
        'target'   => 'snov_characteristics_tab',
        'class'    => [],
        'priority' => 30,
    ];
    return $tabs;
} );

add_action( 'woocommerce_product_data_panels', function() {
    global $post;

    $sostav   = get_post_meta( $post->ID, '_snov_sostav', true );
    $material = get_post_meta( $post->ID, '_snov_material', true );

    echo '<div id="snov_characteristics_tab" class="panel woocommerce_options_panel">';

    woocommerce_wp_text_input([
        'id'          => '_snov_sostav',
        'label'       => 'Состав',
        'value'       => $sostav ?: '',
    ]);

    woocommerce_wp_text_input([
        'id'          => '_snov_material',
        'label'       => 'Материал',
        'value'       => $material ?: '',
    ]);

    echo '</div>';
});

add_action( 'woocommerce_admin_process_product_object', function( $product ) {
    if ( isset($_POST['_snov_sostav']) ) {
        $product->update_meta_data('_snov_sostav', sanitize_text_field($_POST['_snov_sostav']));
    }
    if ( isset($_POST['_snov_material']) ) {
        $product->update_meta_data('_snov_material', sanitize_text_field($_POST['_snov_material']));
    }
});
