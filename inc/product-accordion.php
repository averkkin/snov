<?php


defined('ABSPATH') || exit;

add_action('snov_product_accordion', function() {
    global $product;

    $details  = $product->get_meta('_snov_product_details', true);
    $care     = $product->get_meta('_snov_product_care', true);
    $delivery = $product->get_meta('_snov_product_delivery', true);

    if (!$details && !$care && !$delivery) {
        return;
    }
    ?>
    <section class="product-accordion__inner">

        <?php if ($details): ?>
        <div class="product-accordion__item is-open">
            <button type="button" class="product-accordion__header">
                <span>Детали</span>
                <span class="product-accordion__icon"></span>
            </button>
            <div class="product-accordion__body">
                <?php echo wpautop($details); ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($care): ?>
        <div class="product-accordion__item">
            <button type="button" class="product-accordion__header">
                <span>Правила ухода</span>
                <span class="product-accordion__icon"></span>
            </button>
            <div class="product-accordion__body">
                <?php echo wpautop($care); ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($delivery): ?>
        <div class="product-accordion__item">
            <button type="button" class="product-accordion__header">
                <span>Доставка и возврат</span>
                <span class="product-accordion__icon"></span>
            </button>
            <div class="product-accordion__body">
                <?php echo wpautop($delivery); ?>
            </div>
        </div>
        <?php endif; ?>

    </section>
    <?php
});
