<?php
defined( 'ABSPATH' ) || exit;
function render_category_slider( $title, $slug ) {
    $args = [
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'tax_query'      => [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $slug,
            ],
        ],
    ];

    $loop = new WP_Query( $args );

    if ( $loop->have_posts() ) : ?>
        <section class="products-slider container">
            <div class="swiper products-swiper">
                <div class="swiper-wrapper">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <?php
                        $product = wc_get_product( get_the_ID() );
                        if ( ! $product ) {
                            continue;
                        }

                        $regular_price = (float) $product->get_regular_price();
                        $sale_price    = (float) $product->get_sale_price();
                        $on_sale       = $product->is_on_sale() && $regular_price > 0 && $sale_price > 0 && $sale_price < $regular_price;

                        if ( $on_sale ) {
                            $discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                        }
                        ?>
                        <div class="swiper-slide">
                            <div class="product-card">

                                <a href="<?php the_permalink(); ?>" class="product-card__image">
                                    <?php echo $product->get_image( 'large' ); ?>
                                </a>

                                <div class="product-card__meta">

                                    <span class="product-card__category">
                                        <?php echo get_parent_product_category( get_the_ID() ); ?>
                                        <?php
                                            $product_id = wc_get_product();
                                            echo $product_id->get_meta( '_custom-color_field', true );
                                        ?>
                                    </span>

                                    <div class="product-card__info">
                                        <a href="<?php the_permalink(); ?>" class="product-card__title">
                                            <?php the_title(); ?>
                                        </a>

                                        <div class="product-card__price">
                                            <?php if ( $on_sale ) : ?>
                                                <span class="price-new">
                                                    <?php echo wc_price( $sale_price ); ?>
                                                </span>
                                                <span class="price-old">
                                                    <?php echo wc_price( $regular_price ); ?>
                                                </span>
                                            <?php else : ?>
                                                <span class="price-new">
                                                    <?php echo $product->get_price_html(); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="slider-arrow slider-arrow--prev">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/icons/arrow-left.svg' ); ?>" alt="Назад">
                </div>

                <div class="slider-arrow slider-arrow--next">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/icons/arrow-right.svg' ); ?>" alt="Вперёд">
                </div>

                <div class="swiper-scrollbar swiper-scrollbar--products">
                    <div class="swiper-scrollbar-arrow swiper-scrollbar-arrow--prev">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/icons/polygon-left.svg' ); ?>" alt="Назад">
                    </div>
                    <div class="swiper-scrollbar-arrow swiper-scrollbar-arrow--next">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/icons/polygon-right.svg' ); ?>" alt="Вперёд">
                    </div>
                </div>

            </div>
        </section>
    <?php
    endif;

    wp_reset_postdata();
}