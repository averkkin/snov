<?php

// Remove breadcrumb
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action( 'woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

add_filter('woocommerce_get_image_size_thumbnail', function($size) {
    return [
        'width'  => 600,
        'height' => 0,
        'crop'   => 0,
    ];
});

add_filter( 'woocommerce_get_breadcrumb', function( $crumbs, $breadcrumb ) {

    if ( is_singular('product') ) {

        foreach ($crumbs as $index => $crumb) {
            if ($index > 0 && $index < count($crumbs) - 1) {
                unset($crumbs[$index]);
            }
        }
        $catalog_link = home_url('/shop/');

        $new_crumbs = [];

        foreach ($crumbs as $index => $crumb) {
            $new_crumbs[] = $crumb;

            if ($index === 0) {
                $new_crumbs[] = [
                    'Каталог',
                    $catalog_link
                ];
            }
        }

        return $new_crumbs;
    }

    return $crumbs;
}, 20, 2 );




