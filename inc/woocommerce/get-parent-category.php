<?php
function get_parent_product_category( $product_id ) {
    $terms = get_the_terms( $product_id, 'product_cat' );

    if ( empty($terms) || is_wp_error($terms) ) {
        return false;
    }

    $term = $terms[0];

    if ( $term->parent !== 0 ) {
        $parent = get_term( $term->parent, 'product_cat' );
        return $parent->name;
    }

    return $term->name;
}
