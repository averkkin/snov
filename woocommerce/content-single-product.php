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

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<main class="content">
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class('product-page container', $product); ?>>

        <?php woocommerce_breadcrumb(); ?>

        <div class="product-page__inner">
            <div class="product-page__left-col">
                <?php
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action('woocommerce_before_single_product_summary');
                ?>
                <div class="product-gallery">
                    <div class="product-gallery__main swiper product-main-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <?php
                                $images = $product->get_gallery_image_ids();
                                echo wp_get_attachment_image($product->get_image_id(), 'large');
                                ?>
                            </div>

                            <?php foreach ($images as $img_id): ?>
                                <div class="swiper-slide">
                                    <?php echo wp_get_attachment_image($img_id, 'large'); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination visible-mobile"></div>
                    </div>
                    <?php if ($images): ?>
                        <div class="product-gallery__thumbs swiper product-thumbs-swiper">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="thumb-box">
                                        <?php echo wp_get_attachment_image($product->get_image_id(), 'medium_large'); ?>
                                    </div>
                                </div>

                                <?php foreach ($images as $img_id): ?>
                                    <div class="swiper-slide">
                                        <div class="thumb-box">
                                            <?= wp_get_attachment_image($img_id, 'medium_large'); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>

                            <div class="thumbs-swiper-button-prev">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/product-arrow-left.svg"
                                     alt="">
                            </div>
                            <div class="thumbs-swiper-button-next">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/product-arrow-right.svg"
                                     alt="">
                            </div>
                        </div>
                    <?php endif; ?>
                </div><!-- .product-gallery -->
            </div><!-- .product-page__left-col -->
            <div class="product-info">
                <div class="product-info__header">
                    <?php snov_render_product_parameters(); ?>

                    <div class="product-info__category">
                        <?php
                        echo get_parent_product_category(get_the_ID());
                        ?>
                        <?php
                        $product_id = wc_get_product();
                        echo $product_id->get_meta('_custom-color_field', true);
                        ?>
                    </div>
                    <div class="product-info__header--inner">
                        <?php the_title('<h1 class="product_title entry-title product-info__title">', '</h1>'); ?>
                        <div class="product-info__price"
                             data-default-price="<?php echo esc_attr($product->get_price_html()); ?>">
                            <div class="price-new">
                                <?php
                                do_action('custom_price_hook');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-info__main">
                    <?php $short_description = apply_filters('woocommerce_short_description', $product->get_short_description()); ?>
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

                                // Название
                                $color_custom_name = get_post_meta($id, '_snov_color_name', true);
                                $color_name = $color_custom_name ?: $color_product->get_name();

                                // Цвета
                                $hex1 = get_post_meta($id, '_snov_color_hex', true);
                                $hex2 = get_post_meta($id, '_snov_color_hex2', true);

                                if (!$hex1) $hex1 = '#ccc';

                                if ($hex1 && $hex2) {
                                    // Микс
                                    $class = 'mix';
                                    $style = 'background: linear-gradient(90deg, ' . $hex1 . ' 50%, ' . $hex2 . ' 50%);';
                                } else {
                                    // Одиночный цвет
                                    $class = '';
                                    $style = 'background:' . $hex1 . ';';
                                }

                                // Активный
                                $active = ($id == $product->get_id()) ? ' active' : '';

                                echo '
                                <a href="' . get_permalink($id) . '" class="product-color-item' . $active . '">
                                    <span class="dot ' . $class . '" style="' . $style . '"></span>
                                    <span class="name">' . esc_html($color_name) . '</span>
                                </a>';
                            }

                            echo '</div>';
                        }
                        ?>
                    </div>
                    <?php
                    /**
                     * Hook: woocommerce_single_product_summary.
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_rating - 10
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     * @hooked WC_Structured_Data::generate_product_data() - 60
                     */
                    do_action('woocommerce_single_product_summary');
                    ?>
                    <div class="product-info__cart">
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>
                    <?php
                    /**
                     * Hook: woocommerce_after_single_product_summary.
                     *
                     * @hooked woocommerce_output_product_data_tabs - 10
                     * @hooked woocommerce_upsell_display - 15
                     * @hooked woocommerce_output_related_products - 20
                     */
                    do_action('woocommerce_after_single_product_summary');
                    ?>
                </div>
                <div class="product-info__footer">
                    <!-- Аккордеон -->
                    <div class="product-accordion">
                        <?php do_action('snov_product_accordion'); ?>
                    </div>
                </div>
            </div><!-- .product-info -->
        </div><!-- .product-page__inner -->
    </div><!-- .product-page .container -->

    <section class="slider-large">

        <div class="section-title container">
            <h2 class="h2 section-title__h2 section-title--semibold">Вам могут понравиться</h2>
        </div>

        <?php render_category_slider('', 'hits-sales'); ?>

    </section><!-- .slider-large -->

</main>
<script type="text/javascript">

    jQuery(function ($) {

        const headerPrice = $('.product-info__price');
        const variationForm = $('form.variations_form');

        variationForm.on('found_variation', function (event, variation) {
            if (variation && variation.price_html) {
                headerPrice.html(variation.price_html);
            }
        });

        variationForm.on('hide_variation', function () {

            const fallbackVariationPrice = $('.single_variation_wrap .woocommerce-variation-price .price').html();

            if (fallbackVariationPrice) {
                headerPrice.html(fallbackVariationPrice);
            } else {

                const originalPrice = headerPrice.data('default-price');

                if (originalPrice) {
                    headerPrice.html(originalPrice);
                }
            }
        });

    });

</script>
<?php do_action('woocommerce_after_single_product'); ?>

<style>
    .woocommerce-notices-wrapper {
        display: none;
    }
</style>
