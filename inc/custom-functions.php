<?php

// Получение кол-ва товаров для корзины и обновление количества товаров в шапке
function woocommerce_cart_count_fragments($fragments) {
    $fragments['#cart_count'] = '<span id="cart_count">'.WC()->cart->get_cart_contents_count().'</span>';
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_cart_count_fragments', 10, 1 );

function get_parent_product_category_cart( $product_id ) {
    $terms = get_the_terms( $product_id, 'product_cat' );
    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        return '';
    }

    // Берём самую "верхнюю" категорию (родительскую)
    $term = $terms[0];

    while ( $term->parent != 0 ) {
        $term = get_term( $term->parent, 'product_cat' );
    }

    return $term->name;
}



