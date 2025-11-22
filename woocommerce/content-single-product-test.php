<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$images = $product->get_gallery_image_ids();
$short_description = apply_filters('woocommerce_short_description', $product->get_short_description());


?>

<main class="content">
    <div class="product-page container">

        <?php woocommerce_breadcrumb(); ?>

        <div class="product-page__inner">
            <!-- Галерея -->

            <div class="product-page__left-col">
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
                                        <?php echo wp_get_attachment_image( $product->get_image_id(), 'medium_large' ); ?>
                                    </div>
                                </div>

                                <!-- Затем миниатюры из галереи -->
                                <?php foreach ($images as $img_id): ?>
                                    <div class="swiper-slide">
                                        <div class="thumb-box">
                                            <?= wp_get_attachment_image($img_id, 'medium_large'); ?>
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
            </div>

            <!-- Правая колонка: информация -->
            <div class="product-info">

                <div class="product-info__header">

                    <div class="product-info__category">
                        <?php
                        echo get_parent_product_category( get_the_ID() );
                        ?>
                        <?php
                        $product_id = wc_get_product();
                        echo $product_id->get_meta( '_custom-color_field', true );
                        ?>
                    </div>

                    <div class="product-info__header--inner">

                        <h1 class="product-info__title"><?php the_title(); ?></h1>

                        <div class="product-info__price">
                            <?php echo $product->get_price_html(); ?>
                        </div>

                    </div>

                </div>

                <div class="product-info__main">
                    <?php if ($short_description): ?>
                        <div class="product-info__short">
                            <?php echo wp_kses_post($short_description); ?>
                        </div>
                    <?php endif; ?>

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

                    <div class="product-info__cart">
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>

                </div>
                <div class="product-info__footer">
                    <!-- Аккордеон -->
                    <div class="product-accordion">
                        <?php do_action('snov_product_accordion'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <section class="slider-large">

        <div class="section-title container">
            <h2 class="h2 section-title__h2 section-title--semibold">Вам могут понравиться</h2>
        </div>

        <?php render_category_slider('', 'hits-sales');?>

    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector(".variations_form");
            const variationInput = form.querySelector(".variation_id");

            // Все селекты вариаций, даже если они НЕ внутри формы
            const selects = document.querySelectorAll(".product-info__main select");

            selects.forEach(select => {
                select.addEventListener("change", () => {
                    setTimeout(() => {
                        const variationIdField = document.querySelector(".variation_id");

                        // WooCommerce сам создаёт это поле на странице при выборе
                        const selected = document.querySelector("input.variation_id");

                        if (selected && selected.value) {
                            variationInput.value = selected.value;
                        }
                    }, 10);
                });
            });
        });

    </script>

</main>

<!--function custom_variable_min_price($price, $product) {-->
<!--// Получаем все цены вариаций-->
<!--$prices = $product->get_variation_prices( true );-->
<!---->
<!--if ( empty( $prices['price'] ) ) {-->
<!--return $price;-->
<!--}-->
<!---->
<!--// Минимальные значения-->
<!--$min_regular = ! empty( $prices['regular_price'] ) ? min( $prices['regular_price'] ) : false;-->
<!--$min_sale    = ! empty( $prices['sale_price'] ) ? min( array_filter( $prices['sale_price'] ) ) : false;-->
<!---->
<!--// Если есть акционная цена-->
<!--if ( $min_sale && $min_sale < $min_regular ) {-->
<!--return '<ins>' . wc_price( $min_sale ) . '</ins> <del>' . wc_price( $min_regular ) . '</del>';-->
<!--}-->
<!---->
<!--// Если скидок нет — показываем обычную минимальную цену-->
<!--return '<ins>' . wc_price( $min_regular ) . '</ins>';-->
<!--}-->

<!--function custom_add_to_cart_text() {-->
<!--global $product;-->
<!---->
<!--if ( ! $product instanceof WC_Product ) {-->
<!--return;-->
<!--}-->
<!---->
<!--$price_html = wc_price( $product->get_price() );-->
<!--$price_clean = strip_tags( $price_html );-->
<!--return __( 'Добавить в корзину ' . $price_clean, 'woocommerce' );-->
<!--}-->
<!--add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text' );-->

