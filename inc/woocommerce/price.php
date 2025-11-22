<?php
defined('ABSPATH') || exit;

// Убираем десятичные значения
//add_filter('woocommerce_price_trim_zeros', '__return_true');



// Убираем диапазон цен

//add_filter('woocommerce_variable_sale_price_html', 'custom_variable_min_price', 10, 2);
//add_filter('woocommerce_variable_price_html', 'custom_variable_min_price', 10, 2);

add_filter( 'woocommerce_variable_price_html', 'custom_variation_price', 20, 2 );

function custom_variation_price( $price, $product ) {

    // страховка
    if ( ! $product->is_type( 'variable' ) ) {
        return $price;
    }

    $min_regular_price = $product->get_variation_regular_price( 'min', true );
    $min_sale_price    = $product->get_variation_sale_price( 'min', true );
    $max_regular_price = $product->get_variation_regular_price( 'max', true );
    $max_sale_price    = $product->get_variation_sale_price( 'max', true );

    // только если цены отличаются
    if ( ! ( $min_regular_price === $max_regular_price && $min_sale_price === $max_sale_price ) ) {

        if ( $min_sale_price < $min_regular_price ) {

            $price = sprintf(
                '<del>%1$s</del> <ins>%2$s</ins>',
                wc_price( $min_regular_price ),
                wc_price( $min_sale_price )
            );

        } else {

            $price = sprintf(
                '%1$s',
                wc_price( $min_regular_price )
            );

        }
    }

    return $price;
}


