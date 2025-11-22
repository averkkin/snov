<?php

function art_woo_custom_fields_save( $post_id ) {
    $woocommerce_text_field = $_POST['_custom-color_field'];
    if ( ! empty( $woocommerce_text_field ) ) {
        update_post_meta( $post_id, '_custom-color_field', esc_attr( $woocommerce_text_field ) );
    }
}

add_action( 'woocommerce_process_product_meta', 'art_woo_custom_fields_save', 10 );