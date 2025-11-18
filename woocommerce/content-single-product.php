<?php
defined( 'ABSPATH' ) || exit;

global $product;

$images = $product->get_gallery_image_ids();
$sostav   = $product->get_meta('_snov_sostav');
$material = $product->get_meta('_snov_material');
$short_description = apply_filters('woocommerce_short_description', $product->get_short_description());

// Атрибут размера
$size_terms = wc_get_product_terms( $product->get_id(), 'pa_size', ['fields' => 'names'] );
$size = $size_terms ? $size_terms[0] : '';
?>


<div class="product-page container">

    <?php woocommerce_breadcrumb(); ?>

    <div class="product-page__inner">
        <!-- Галерея -->

        <div class="product-gallery">
            <div class="product-gallery__main swiper product-main-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <?php echo wp_get_attachment_image( $product->get_image_id(), 'large' ); ?>
                    </div>

                    <?php foreach ($images as $img_id): ?>
                        <div class="swiper-slide">
                            <?php echo wp_get_attachment_image( $img_id, 'large' ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Пагинация (точки) -->
                <div class="swiper-pagination visible-mobile"></div>
            </div>


            <?php if ($images): ?>
                <div class="product-gallery__thumbs swiper product-thumbs-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $img_id): ?>
                            <div class="swiper-slide">
                                <div class="thumb-box">
                                    <?= wp_get_attachment_image($img_id, 'thumbnail'); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="thumbs-swiper-button-prev"><img src="<?php echo get_template_directory_uri();?>/assets/icons/product-arrow-left.svg" alt=""></div>
                    <div class="thumbs-swiper-button-next"><img src="<?php echo get_template_directory_uri();?>/assets/icons/product-arrow-right.svg" alt=""></div>
                </div>

            <?php endif; ?>
        </div>


        <!-- Правая колонка: информация -->
        <div class="product-info">

            <div class="product-info__header">

                <div class="product-info__category">
                    <?php echo wc_get_product_category_list($product->get_id()); ?>
                </div>

                <div class="product-info__header--inner">

                    <h1 class="product-info__title"><?php the_title(); ?></h1>

                    <div class="product-info__price">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                </div>

                <div class="parameters">
                    <div class="parameters__item">
                        <span>Цена указана за 2 шт.</span>
                    </div>
                </div>

            </div>

            <div class="product-info__main">
                <?php if ($short_description): ?>
                    <div class="product-info__short">
                        <?php echo wp_kses_post($short_description); ?>
                    </div>
                <?php endif; ?>

                <!-- Размер -->
                <?php snov_render_sizes_block(); ?>

                <!-- Цвет (ссылки на другие товары) -->
                <div class="product-info__colors">
                    <span>Цвет:</span>
                    <?php

                    $color_links = $product->get_meta('_snov_color_links');

                    if ($color_links) {

                        $ids = array_map('trim', explode(',', $color_links));

                        echo '<div class="product-color-list">';

                        foreach ($ids as $id) {

                            $color_product = wc_get_product($id);
                            if (!$color_product) continue;

                            $color_name = $color_product->get_name();
                            $color_hex  = get_post_meta($id, '_snov_color_hex', true);

                            if (!$color_hex) {
                                $color_hex = '#ccc'; // fallback
                            }

                            $active = ($id == $product->get_id()) ? ' active' : '';

                            echo '
                <a href="' . get_permalink($id) . '" class="product-color-item' . $active . '">
                    <span class="dot" style="background:' . esc_attr($color_hex) . '"></span>
                    <span class="name">' . esc_html($color_name) . '</span>
                </a>
            ';
                        }

                        echo '</div>';
                    }
                    ?>
                </div>

                <!-- Описание -->
                <div class="product-info__desc">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="product-info__footer">
                <!-- Кнопка "в корзину" -->
                <div class="product-info__cart">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>

                <!-- Аккордеон -->
                <div class="product-accordion">
                    <?php do_action('snov_product_accordion'); ?>
                </div>
            </div>

        </div>
    </div>

</div>
