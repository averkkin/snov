<?php

add_action( 'woocommerce_product_options_attributes', 'art_woo_add_category_color' );
function art_woo_add_category_color() {
    global $product, $post;
    echo '<div class="options_group" style="padding: 9px 12px!important;">';
        woocommerce_wp_text_input( array(
            'id'                => '_custom-color_field',
            'label'             => __( 'Цвет товара', 'woocommerce' ),
            'placeholder'       => 'Белая',
            'desc_tip'          => 'true',
            'description'       => __( 'Цвет товара для отображения после названия категории. Цвет нужно писать в соответствии с мужским или женским родом слова. Например "Белая"(Подушка)', 'woocommerce' ),
        ) );
    echo '</div>';
}