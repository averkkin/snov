<?php

// Получение кол-ва товаров для корзины и обновление количества товаров в шапке
function woocommerce_cart_count_fragments($fragments) {
    $fragments['#cart_count'] = '<span id="cart_count">'.WC()->cart->get_cart_contents_count().'</span>';
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_cart_count_fragments', 10, 1 );


