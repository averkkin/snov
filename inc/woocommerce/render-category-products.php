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

    // Создаём временный WP_Query, чтобы не ломать основной цикл страницы
    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {

        // Стандартный старт woocommerce (обёртка UL .products и т.д.)
        woocommerce_product_loop_start();

        // ВЫКЛЮЧАЕМ глобальный цикл и работаем с WP_Query
        while ( $query->have_posts() ) {
            $query->the_post();

            do_action('woocommerce_shop_loop');

            // Стандартный шаблон товара — НЕ кастомный
            wc_get_template_part( 'content', 'product' );
        }

        woocommerce_product_loop_end();
    }

    // Возвращаем глобальные переменные WordPress как были
    wp_reset_postdata();
}
