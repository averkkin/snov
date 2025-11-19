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

                        <!-- Сначала миниатюра главной картинки -->
                        <div class="swiper-slide">
                            <div class="thumb-box">
                                <?php echo wp_get_attachment_image( $product->get_image_id(), 'thumbnail' ); ?>
                            </div>
                        </div>

                        <!-- Затем миниатюры из галереи -->
                        <?php foreach ($images as $img_id): ?>
                            <div class="swiper-slide">
                                <div class="thumb-box">
                                    <?= wp_get_attachment_image($img_id, 'thumbnail'); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <div class="thumbs-swiper-button-prev">
                        <img src="<?php echo get_template_directory_uri();?>/assets/icons/product-arrow-left.svg" alt="">
                    </div>
                    <div class="thumbs-swiper-button-next">
                        <img src="<?php echo get_template_directory_uri();?>/assets/icons/product-arrow-right.svg" alt="">
                    </div>
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

                    <?php
                    // Получаем цены вручную
                    if ($product->is_type('variable')) {

                        // Минимальные цены вариаций
                        $prices = $product->get_variation_prices(true);

                        $min_regular = !empty($prices['regular_price']) ? min($prices['regular_price']) : 0;
                        $min_sale    = !empty($prices['sale_price']) ? min(array_filter($prices['sale_price'])) : 0;

                        if ($min_sale && $min_sale < $min_regular) {
                            // Есть скидка
                            $percent = round((($min_regular - $min_sale) / $min_regular) * 100);

                            $default_price_html =
                                    '<ins>' . wc_price($min_sale) . '</ins> ' .
                                    '<del>' . wc_price($min_regular) . '</del> ' .
                                    '<span class="price-discount">-' . $percent . '%</span>';

                        } else {
                            // Без скидки
                            $default_price_html = '<ins>' . wc_price($min_regular) . '</ins>';
                        }

                    } else {

                        // Простой товар
                        $regular = (float)$product->get_regular_price();
                        $sale    = (float)$product->get_sale_price();

                        if ($sale && $sale < $regular) {
                            $percent = round((($regular - $sale) / $regular) * 100);

                            $default_price_html =
                                    '<ins>' . wc_price($sale) . '</ins> ' .
                                    '<del>' . wc_price($regular) . '</del> ' .
                                    '<span class="price-discount">-' . $percent . '%</span>';

                        } else {
                            $default_price_html = '<ins>' . wc_price($regular) . '</ins>';
                        }
                    }

                    ?>

                    <div class="product-info__price">
                        <span class="dynamic-price"
                              data-default-price="<?php echo esc_attr( $product->get_price_html() ); ?>">
                            <?php echo $product->get_price_html(); ?>
                        </span>
                    </div>


                </div>

                <?php
                $enabled = get_post_meta($product->get_id(), '_snov_parameters_enabled', true);
                $items   = get_post_meta($product->get_id(), '_snov_parameters_items', true);

                if ($enabled && is_array($items) && !empty($items)) :
                    ?>
                    <div class="parameters">
                        <?php foreach ($items as $item): ?>
                            <div class="parameters__item">
                                <span><?php echo esc_html($item); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>

            <div class="product-info__main">
                <?php if ($short_description): ?>
                    <div class="product-info__short">
                        <?php echo wp_kses_post($short_description); ?>
                    </div>
                <?php endif; ?>

                <!--Атрибуты-->
                <?php snov_render_wc_variation_selects(); ?>

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

                            $color_custom_name = get_post_meta($id, '_snov_color_name', true);
                            $color_name = $color_custom_name ? $color_custom_name : $color_product->get_name();
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
