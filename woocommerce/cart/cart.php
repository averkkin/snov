<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined('ABSPATH') || exit;

?>
<div class="container page-cart__breadcrumb"><?php woocommerce_breadcrumb(); ?></div>

<main class="container">
    <?php do_action('woocommerce_before_cart'); ?>

    <div class="page-cart">

        <div class="page-cart__header">
            <?php the_title('<h2 class="h2 section-title__h2 section-title--semibold">', '</h2>'); ?>
        </div>


        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">

            <?php do_action('woocommerce_before_cart_table'); ?>

            <div class="cart woocommerce-cart-form__contents page-cart__items">
                <?php do_action('woocommerce_before_cart_contents'); ?>

                <?php
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                    /**
                     * Filter the product name.
                     *
                     * @param string $product_name Name of the product in the cart.
                     * @param array $cart_item The product in the cart.
                     * @param string $cart_item_key Key for the product in the cart.
                     * @since 2.1.0
                     */
                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                        ?>

                        <div class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?> page-cart__item">

                            <div class="product-thumbnail page-cart__item-col page-cart__thumb">
                                <?php
                                /**
                                 * Filter the product thumbnail displayed in the WooCommerce cart.
                                 *
                                 * This filter allows developers to customize the HTML output of the product
                                 * thumbnail. It passes the product image along with cart item data
                                 * for potential modifications before being displayed in the cart.
                                 *
                                 * @param string $thumbnail The HTML for the product image.
                                 * @param array $cart_item The cart item data.
                                 * @param string $cart_item_key Unique key for the cart item.
                                 *
                                 * @since 2.1.0
                                 */
                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                if (!$product_permalink) {
                                    echo $thumbnail; // PHPCS: XSS ok.
                                } else {
                                    printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                }
                                ?>
                            </div>

                            <div class="page-cart__item--inner">

                                <div class="page-cart__item-col page-cart__item-name">
                                    <div class="page-cart__label">Название товара:</div>
                                    <div class="page-cart__value">
                                        <div class="page-cart__category">
                                            <?php echo get_parent_product_category_cart( $product_id ); ?>
                                        </div>
                                        <div class="product-name page-cart__title">
                                            <?php
                                            if (!$product_permalink) {
                                                echo wp_kses_post($product_name . '&nbsp;');
                                            } else {
                                                /**
                                                 * This filter is documented above.
                                                 *
                                                 * @since 2.1.0
                                                 */
                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                            }

                                            do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                            // Meta data.
                                            echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                            // Backorder notification.
                                            if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="page-cart__item-col page-cart__item-quantity">
                                    <div class="page-cart__label">Количество:</div>
                                    <div class="page-cart__value">
                                        <div class="page-cart__quantity qty-wrapper" >
                                            <button type="button" class="qty-minus">-</button>

                                            <?php
                                            if ( $_product->is_sold_individually() ) {
                                                $min_quantity = 1;
                                                $max_quantity = 1;
                                            } else {
                                                $min_quantity = 0;
                                                $max_quantity = $_product->get_max_purchase_quantity();
                                            }

                                            $product_quantity = woocommerce_quantity_input(
                                                    array(
                                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                                            'input_value'  => $cart_item['quantity'],
                                                            'max_value'    => $max_quantity,
                                                            'min_value'    => $min_quantity,
                                                            'product_name' => $product_name,
                                                    ),
                                                    $_product,
                                                    false
                                            );

                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                            ?>

                                            <button type="button" class="qty-plus">+</button>

                                        </div>

                                    </div>
                                </div>

                                <div class="page-cart__item-col page-cart__item-total">
                                    <div class="page-cart__label">Сумма:</div>
                                    <div class="page-cart__value">
                                        <div class="product-price page-cart__title">
                                                <?php
                                                echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.

                                            ?>

                                        </div>
                                    </div>
                                </div>

                                <?php
                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                                '<a role="button" href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><img src="https://snov.group/wp-content/themes/snov-group/assets/icons/delete.svg" alt="Delete" class="page-cart__delete"></a>',
                                                esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                /* translators: %s is the product name */
                                                esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                                                esc_attr($product_id),
                                                esc_attr($_product->get_sku())
                                        ),
                                        $cart_item_key
                                );
                                ?>

                            </div><!-- .page-cart__item-inner -->

                        </div><!-- .page-cart__item -->

                        <?php
                    }
                }
                ?>

                <?php do_action('woocommerce_cart_contents'); ?>

                <div class="page-cart__footer">
                    <div class="page-cart__row">

                        <div class="page-cart__group-fields">
                            <label for="certificate">Введите <span class="color--pink">номер сертификата:</span></label>
                            <div class="page-cart__controls">
                                <input type="text"
                                       id="certificate"
                                       placeholder="Например: 121020">
                                <button type="button" class="btn btn--primary page-cart__group-button">Применить
                                </button>
                            </div>
                        </div><!-- .page-cart__group-fields -->

                        <?php if (wc_coupons_enabled()) { ?>

                            <div class="page-cart__group-fields">
                                <label for="coupon_code">Введите <span class="color--pink">промокод:</span></label>
                                <div class="page-cart__controls">
                                    <input type="text"
                                           id="coupon_code"
                                           name="coupon_code"
                                           class="input-text"
                                           placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>"
                                           value="">
                                    <button type="submit"
                                            class="<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> btn btn--primary page-cart__group-button"
                                            name="apply_coupon"
                                            value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
                                        <?php esc_html_e('Apply coupon', 'woocommerce'); ?>
                                    </button>

                                    <div class="page-cart__notices">
                                        <?php woocommerce_output_all_notices(); ?>
                                    </div>


                                    <?php do_action('woocommerce_cart_coupon'); ?>

                                    <?php do_action('woocommerce_cart_actions'); ?>

                                    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                                </div>
                            </div><!-- .page-cart__group-fields -->

                        <?php } ?>

                        <div class="page-cart__action">
                            <div class="page-cart__summary">Итого:
                                <?php wc_cart_totals_order_total_html(); ?>
                            </div>
                            <a class="checkout-button button alt wc-forward wc-proceed-to-checkout btn btn--primary" href="https://snov.group/checkout/">Перейти к оформлению</a>
                            <button type="submit" class="visually-hidden <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                        </div>

                    </div><!-- .page-cart__row -->
                    <div class="page-cart__row">
                    </div><!-- .page-cart__row -->
                </div>
            </div>


            <?php do_action('woocommerce_after_cart_contents'); ?>
            <?php do_action('woocommerce_after_cart_table'); ?>
        </form>


        <?php do_action('woocommerce_before_cart_collaterals'); ?>

        <div class="cart-collaterals">
            <?php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action('woocommerce_cart_collaterals');
            ?>
        </div>

    </div><!-- .page-cart -->

    <?php do_action('woocommerce_after_cart'); ?>
</main>


<script>
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("qty-plus") || e.target.classList.contains("qty-minus")) {

            const wrapper = e.target.closest(".qty-wrapper");
            const input = wrapper.querySelector(".qty");

            if (!input) return;

            let value = parseInt(input.value);
            const min = parseInt(input.getAttribute("min")) || 1;
            const max = parseInt(input.getAttribute("max")) || 9999;

            if (e.target.classList.contains("qty-plus")) {
                if (value < max) value += 1;
            }

            if (e.target.classList.contains("qty-minus")) {
                if (value > min) value -= 1;
            }

            input.value = value;

            input.dispatchEvent(new Event("change"));

            const updateBtn = document.querySelector('button[name="update_cart"]');
            if (updateBtn) {
                updateBtn.disabled = false;
                updateBtn.click();
            }
        }
    });
</script>
