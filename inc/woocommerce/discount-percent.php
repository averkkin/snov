<?php
defined('ABSPATH') || exit;

add_filter('woocommerce_get_price_html', 'snov_add_discount_percent_to_price', 20, 2);
function snov_add_discount_percent_to_price($price_html, $product) {

    $regular = floatval( $product->get_regular_price() );
    $sale = floatval( $product->get_sale_price() );

    // Если обычный продукт со скидкой
    if ($sale && $sale < $regular) {
        $percent = round((($regular - $sale) / $regular) * 100);
        $price_html .= ' <span class="price-discount">-' . $percent . '%</span>';
    }

    return $price_html;
}


add_filter('woocommerce_variable_sale_price_html', 'snov_variable_price_percent', 20, 2);
add_filter('woocommerce_variable_price_html', 'snov_variable_price_percent', 20, 2);

function snov_variable_price_percent($price_html, $product) {

    $prices = $product->get_variation_prices( true );

    if ( empty($prices['regular_price']) || empty($prices['sale_price']) ) {
        return $price_html;
    }

    $min_regular = min($prices['regular_price']);
    $min_sale = min(array_filter($prices['sale_price']));

    if ($min_sale < $min_regular) {
        $percent = round((($min_regular - $min_sale) / $min_regular) * 100);
        $price_html .= ' <span class="price-discount">-' . $percent . '%</span>';
    }

    return $price_html;
}


