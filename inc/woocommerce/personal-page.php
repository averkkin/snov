<?php
// Include styles woocommerce only on page.php
add_action( 'wp_enqueue_scripts', function() {

    if ( is_account_page() ) {

        // Основные стили WC
        wp_enqueue_style(
            'woocommerce-general',
            WC()->plugin_url() . '/assets/css/woocommerce.css',
            [],
            WC()->version
        );

        // Макет
        wp_enqueue_style(
            'woocommerce-layout',
            WC()->plugin_url() . '/assets/css/woocommerce-layout.css',
            [],
            WC()->version
        );

        // Мобильные стили
        wp_enqueue_style(
            'woocommerce-smallscreen',
            WC()->plugin_url() . '/assets/css/woocommerce-smallscreen.css',
            [ 'woocommerce-layout' ],
            WC()->version,
            'only screen and (max-width: 767px)'
        );

        // Стили блоков
        wp_enqueue_style(
            'wc-blocks-style',
            WC()->plugin_url() . '/assets/client/styles/frontend.css',
            [],
            WC()->version
        );
    }

}, 20 );

