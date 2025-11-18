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
