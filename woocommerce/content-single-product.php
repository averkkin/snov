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

    <!-- Галерея -->
    <div class="product-gallery">
        <div class="product-gallery__main">
            <?php echo wp_get_attachment_image( $product->get_image_id(), 'large' ); ?>
        </div>

        <?php if ($images): ?>
            <div class="product-gallery__thumbs swiper product-thumbs-swiper">
                <div class="swiper-wrapper">
                    <?php foreach ( $images as $img_id ): ?>
                        <div class="swiper-slide">
                            <?php echo wp_get_attachment_image( $img_id, 'thumbnail' ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>


    <!-- Правая колонка: информация -->
    <div class="product-info">

        <div class="product-info__category">
            <?php echo wc_get_product_category_list($product->get_id()); ?>
        </div>

        <h1 class="product-info__title"><?php the_title(); ?></h1>

        <div class="product-info__price">
            <?php echo $product->get_price_html(); ?>
        </div>

        <?php if ($short_description): ?>
            <div class="product-info__short">
                <?php echo wp_kses_post($short_description); ?>
            </div>
        <?php endif; ?>

        <!-- Размер -->
        <?php if ($size): ?>
            <div class="product-info__row">
                <span class="label">Размер:</span>
                <span class="value"><?php echo esc_html($size); ?></span>
            </div>
        <?php endif; ?>

        <!-- Цвет — кастом (ссылки на другие товары) -->
        <div class="product-info__colors">
            <span class="label">Цвет:</span>
            <div class="product-info__color-list">
                <?php
                // сюда вставишь свои ссылки на другие товары
                ?>
            </div>
        </div>

        <!-- Описание -->
        <div class="product-info__desc">
            <?php the_content(); ?>
        </div>

        <!-- Состав -->
        <?php if ($sostav): ?>
            <div class="product-info__row">
                <span class="label">Состав:</span>
                <span class="value"><?php echo esc_html($sostav); ?></span>
            </div>
        <?php endif; ?>

        <!-- Материал -->
        <?php if ($material): ?>
            <div class="product-info__row">
                <span class="label">Материал:</span>
                <span class="value"><?php echo esc_html($material); ?></span>
            </div>
        <?php endif; ?>

        <!-- Кнопка "в корзину" -->
        <div class="product-info__cart">
            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>

    </div>

</div>


<!-- Аккордеон -->
<div class="product-accordion">
    <?php do_action('snov_product_accordion'); ?>
</div>
