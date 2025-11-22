<?php

add_filter('woocommerce_order_button_text', 'custom_checkout_button_text');

function custom_checkout_button_text($button_text) {

    $button_text = 'Перейти к оформлению';

    return $button_text;
}

