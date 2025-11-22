<?php

defined('ABSPATH') || exit;

add_filter( 'woocommerce_breadcrumb_defaults', function( $defaults ) {

    $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb">';
    $defaults['wrap_after']  = '</nav>';

    // Разделитель — полноценный элемент
    $defaults['delimiter']   = '<span class="crumb-delim">/</span>';

    // Обёртка для каждого элемента
    $defaults['before']      = '<span class="crumb-item">';
    $defaults['after']       = '</span>';

    return $defaults;
});

//add_filter( 'woocommerce_get_breadcrumb', function( $crumbs, $breadcrumb ) {
//
//    if ( is_singular('product') ) {
//
//        foreach ($crumbs as $index => $crumb) {
//            if ($index > 0 && $index < count($crumbs) - 1) {
//                unset($crumbs[$index]);
//            }
//        }
//        $catalog_link = home_url('/shop/');
//
//        $new_crumbs = [];
//
//        foreach ($crumbs as $index => $crumb) {
//            $new_crumbs[] = $crumb;
//
//            if ($index === 0) {
//                $new_crumbs[] = [
//                    'Каталог',
//                    $catalog_link
//                ];
//            }
//        }
//
//        return $new_crumbs;
//    }
//
//    return $crumbs;
//}, 20, 2 );

add_filter( 'woocommerce_get_breadcrumb', function( $crumbs ) {

    if ( is_singular('product') ) {

        $catalog_link = home_url('/shop/');

        $new_crumbs = [];

        $new_crumbs[] = $crumbs[0];

        $new_crumbs[] = [
            'Каталог',
            $catalog_link
        ];

        $new_crumbs[] = end($crumbs);

        return $new_crumbs;
    }

    return $crumbs;
});

