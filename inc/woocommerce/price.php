<?php
defined('ABSPATH') || exit;

// Убираем десятичные значения
add_filter('woocommerce_price_trim_zeros', '__return_true');



// Убираем диапазон цен

add_filter('woocommerce_variable_sale_price_html', 'custom_variable_min_price', 10, 2);
add_filter('woocommerce_variable_price_html', 'custom_variable_min_price', 10, 2);

function custom_variable_min_price($price, $product) {
    // Получаем все цены вариаций
    $prices = $product->get_variation_prices( true );

    if ( empty( $prices['price'] ) ) {
        return $price;
    }

    // Минимальные значения
    $min_regular = ! empty( $prices['regular_price'] ) ? min( $prices['regular_price'] ) : false;
    $min_sale    = ! empty( $prices['sale_price'] ) ? min( array_filter( $prices['sale_price'] ) ) : false;

    // Если есть акционная цена
    if ( $min_sale && $min_sale < $min_regular ) {
        return '<ins>' . wc_price( $min_sale ) . '</ins> <del>' . wc_price( $min_regular ) . '</del>';
    }

    // Если скидок нет — показываем обычную минимальную цену
    return '<ins>' . wc_price( $min_regular ) . '</ins>';
}
