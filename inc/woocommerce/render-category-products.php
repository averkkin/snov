<?php
function render_wc_category_products( $category_slug ) {

    // Запрашиваем товары конкретной категории
    $args = [
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ],
        ],
    ];

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {

        woocommerce_product_loop_start();

        while ( $query->have_posts() ) {
            $query->the_post();

            do_action('woocommerce_shop_loop');

            wc_get_template_part( 'content', 'product' );
        }

        woocommerce_product_loop_end();
    }

    wp_reset_postdata();
}
