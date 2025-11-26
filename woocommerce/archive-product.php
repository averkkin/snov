<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

?>
<main class="content">


<section class="image-block catalog-hero">
    <h1 class="h2 h2--white h2--large container image-block__h2">
        Каталог
    </h1>
    <img src="<?php echo get_template_directory_uri();?>/assets/images/shop.jpg" class="hidden-mobile" alt="Подушки" width="1512" height="800">
    <img src="<?php echo get_template_directory_uri();?>/assets/images/shop-mobile.jpg" class="visible-mobile" alt="Подушки" width="428" height="570">

</section>

<div class="catalog container">

<?php

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action( 'woocommerce_shop_loop_header' );

?>

<div class="catalog__header">
    <h2 class="h2 catalog__h2">Все товары</h2>
    <nav>
        <ul>
            <li><a href="#podushka">Подушки</a></li>
            <li><a href="#odeyalo">Одеяла</a></li>
            <li><a href="#complect">Комплекты</a></li>
            <li><a href="#navolochka">Наволочки</a></li>
            <li><a href="#pododeyalnik">Пододеяльники</a></li>
            <li><a href="#prostin">Простыни</a></li>
        </ul>
    </nav>
</div>

    <section class="catalog__category" id="podushka">

        <div class="catalog__category-head">
            <h3 class="h3 catalog__h3">Подушки</h3>
            <div class="catalog__type-product">
                <div class="catalog__type-item" data-tab="all-pillows">
                    <span class="dot"></span>
                    <span class="type">Все подушки</span>
                </div>
                <div class="catalog__type-item" data-tab="soft">
                    <span class="dot"></span>
                    <span class="type">Софт</span>
                </div>
                <div class="catalog__type-item" data-tab="balance">
                    <span class="dot"></span>
                    <span class="type">Баланс</span>
                </div>
                <div class="catalog__type-item" data-tab="balance-plus">
                    <span class="dot"></span>
                    <span class="type">Баланс Плюс</span>
                </div>
                <div class="catalog__type-item" data-tab="base">
                    <span class="dot"></span>
                    <span class="type">Бейсик</span>
                </div>
            </div>
        </div>
        <div class="catalog__loop catalog__all-products" data-category="all-pillows">
            <?php render_wc_category_products('soft'); ?>
            <?php render_wc_category_products('balance'); ?>
            <?php render_wc_category_products('balance-plus'); ?>
            <?php render_wc_category_products('base'); ?>
        </div>
        <div class="catalog__loop" data-category="soft">
            <?php render_wc_category_products('soft'); ?>
        </div>
        <div class="catalog__loop" data-category="balance">
            <?php render_wc_category_products('balance'); ?>
        </div>
        <div class="catalog__loop" data-category="balance-plus">
            <?php render_wc_category_products('balance-plus'); ?>
        </div>
        <div class="catalog__loop" data-category="base">
            <?php render_wc_category_products('base'); ?>
        </div>

    </section>

    <section class="catalog__category" id="odeyalo">

        <div class="catalog__category-head">
            <h3 class="h3 catalog__h3">Одеяла</h3>
            <div class="catalog__type-product">
                <div class="catalog__type-item" data-tab="all-blankets">
                    <span class="dot"></span>
                    <span class="type">Все одеяла</span>
                </div>
                <div class="catalog__type-item" data-tab="for-one">
                    <span class="dot"></span>
                    <span class="type">Для одного</span>
                </div>
                <div class="catalog__type-item" data-tab="for-two">
                    <span class="dot"></span>
                    <span class="type">Для двоих</span>
                </div>
                <div class="catalog__type-item" data-tab="down-jacket">
                    <span class="dot"></span>
                    <span class="type">Пуховик</span>
                </div>
            </div>
        </div>

        <div class="catalog__loop catalog__all-products" data-category="all-blankets">
            <?php render_wc_category_products('for-one'); ?>
            <?php render_wc_category_products('for-two'); ?>
            <?php render_wc_category_products('down-jacket'); ?>
        </div>

        <div class="catalog__loop" data-category="for-one">
            <?php render_wc_category_products('for-one'); ?>
        </div>
        <div class="catalog__loop" data-category="for-two">
            <?php render_wc_category_products('for-two'); ?>
        </div>
        <div class="catalog__loop" data-category="down-jacket">
            <?php render_wc_category_products('down-jacket'); ?>
        </div>
    </section>

    <section class="catalog__category" id="complect">
        <div class="catalog__category-head">
            <h3 class="h3 catalog__h3">Комплекты</h3>
            <div class="catalog__type-product">
                <div class="catalog__type-item" data-tab="all-complect">
                    <span class="dot"></span>
                    <span class="type">Все комплекты</span>
                </div>
                <div class="catalog__type-item" data-tab="plain">
                    <span class="dot"></span>
                    <span class="type">Однотонные</span>
                </div>
                <div class="catalog__type-item" data-tab="mix">
                    <span class="dot"></span>
                    <span class="type">Микс</span>
                </div>
            </div>
        </div>
        <div class="catalog__loop catalog__all-products" data-category="all-complect">
            <?php render_wc_category_products('komplekt-postelnogo-belia'); ?>
        </div>
        <div class="catalog__loop" data-category="plain">
            <?php render_wc_category_products('plain'); ?>
        </div>
        <div class="catalog__loop" data-category="mix">
            <?php render_wc_category_products('mix'); ?>
        </div>
    </section>

    <section class="catalog__category" id="navolochka">
        <div class="catalog__category-head">
            <h3 class="h3 catalog__h3">Наволочки</h3>
        </div>
        <?php render_wc_category_products('navolochka'); ?>
    </section>

    <section class="catalog__category" id="pododeyalnik">
        <div class="catalog__category-head">
            <h3 class="h3 catalog__h3">Пододеяльники</h3>
        </div>
        <?php render_wc_category_products('pododeyalnik'); ?>
    </section>

    <section class="catalog__category" id="prostin">
        <div class="catalog__category-head">
            <h3 class="h3 catalog__h3">Простыни</h3>
        </div>
        <?php render_wc_category_products('prostin'); ?>
    </section>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
?>

</div>
</main>

<?php get_footer( 'shop' ); ?>

