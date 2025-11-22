<?php
/**
 * Cart Page - кастомный шаблон под новый дизайн
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
?>

<form class="woocommerce-cart-form cart-page" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php do_action( 'woocommerce_before_cart_table' ); ?>

    <div class="cart-page__head-row">
        <div class="cart-page__head-col cart-page__head-col--product">
            <?php esc_html_e( 'Product name', 'woocommerce' ); ?>
        </div>
        <div class="cart-page__head-col cart-page__head-col--qty">
            <?php esc_html_e( 'Quantity', 'woocommerce' ); ?>
        </div>
        <div class="cart-page__head-col cart-page__head-col--total">
            <?php esc_html_e( 'Total', 'woocommerce' ); ?>
        </div>
    </div>

    <div class="cart-page__items">
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters(
                    'woocommerce_cart_item_permalink',
                    $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '',
                    $cart_item,
                    $cart_item_key
                );
                ?>

                <div class="cart-item woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                    <!-- Удалить товар -->
                    <div class="cart-item__remove">
                        <?php
                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                                '<a role="button" href="%s" class="cart-item__remove-link remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                            ),
                            $cart_item_key
                        );
                        ?>
                    </div>

                    <!-- Картинка товара -->
                    <div class="cart-item__thumb">
                        <?php
                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                        if ( ! $product_permalink ) {
                            echo $thumbnail; // PHPCS: XSS ok.
                        } else {
                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                        }
                        ?>
                    </div>

                    <!-- Информация о товаре: название, атрибуты, доп. мета -->
                    <div class="cart-item__info" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                        <div class="cart-item__name">
                            <?php
                            if ( ! $product_permalink ) {
                                echo wp_kses_post( $product_name . '&nbsp;' );
                            } else {
                                echo wp_kses_post(
                                    apply_filters(
                                        'woocommerce_cart_item_name',
                                        sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ),
                                        $cart_item,
                                        $cart_item_key
                                    )
                                );
                            }
                            ?>
                        </div>

                        <div class="cart-item__meta">
                            <?php
                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                            // Мета-данные вариаций.
                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                            // Сообщение о предзаказе.
                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                echo wp_kses_post(
                                    apply_filters(
                                        'woocommerce_cart_item_backorder_notification',
                                        '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>',
                                        $product_id
                                    )
                                );
                            }
                            ?>
                        </div>

                        <!-- Цена за штуку (если нужна подпись) -->
                        <div class="cart-item__price-single">
                            <?php
                            echo apply_filters(
                                'woocommerce_cart_item_price',
                                WC()->cart->get_product_price( $_product ),
                                $cart_item,
                                $cart_item_key
                            ); // PHPCS: XSS ok.
                            ?>
                        </div>
                    </div>

                    <!-- Количество -->
                    <div class="cart-item__qty" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
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
                    </div>

                    <!-- Сумма по позиции -->
                    <div class="cart-item__subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                        <?php
                        echo apply_filters(
                            'woocommerce_cart_item_subtotal',
                            WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ),
                            $cart_item,
                            $cart_item_key
                        ); // PHPCS: XSS ok.
                        ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>

        <?php do_action( 'woocommerce_cart_contents' ); ?>
        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
    </div>

    <!-- Низ страницы корзины: примечание + купоны/сертификаты + итоги -->
    <div class="cart-page__bottom">
        <div class="cart-page__left">
            <!-- Примечание к заказу (чисто визуально, свою логику можно навесить позже) -->
            <div class="cart-note">
                <label class="cart-note__label" for="cart_note">
                    <?php esc_html_e( 'Add a note to your order', 'woocommerce' ); ?>
                </label>
                <textarea
                    class="cart-note__textarea"
                    id="cart_note"
                    name="cart_note"
                    rows="4"
                    placeholder="<?php esc_attr_e( 'How can we help you?', 'woocommerce' ); ?>"
                ></textarea>
            </div>
        </div>

        <div class="cart-page__right">
            <?php if ( wc_coupons_enabled() ) : ?>
                <div class="cart-discounts">
                    <!-- Блок промокода -->
                    <div class="cart-discounts__item cart-discounts__item--coupon">
                        <label class="cart-discounts__label" for="coupon_code">
                            <?php esc_html_e( 'Enter promo code', 'woocommerce' ); ?>
                        </label>

                        <div class="cart-discounts__row">
                            <input
                                type="text"
                                name="coupon_code"
                                class="input-text cart-discounts__input"
                                id="coupon_code"
                                value=""
                                placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>"
                            />
                            <button
                                type="submit"
                                class="btn cart-discounts__button <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
                                name="apply_coupon"
                                value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"
                            >
                                <?php esc_html_e( 'Apply', 'woocommerce' ); ?>
                            </button>
                        </div>

                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
                    </div>

                    <?php
                    /**
                     * Здесь можно вывести блок "сертификата" под твой плагин.
                     * Например, через отдельный хук:
                     *
                     * do_action( 'snov_cart_gift_certificate' );
                     */
                    ?>
                </div>
            <?php endif; ?>

            <div class="cart-page__totals">
                <?php
                /**
                 * Итоги корзины (Итого, доставка, налоги + кнопка "Перейти к оформлению")
                 *
                 * @hooked woocommerce_cart_totals - 10
                 * @hooked woocommerce_cross_sell_display
                 */
                do_action( 'woocommerce_cart_collaterals' );
                ?>
            </div>
        </div>
    </div>

    <div class="cart-page__actions">
        <button
            type="submit"
            class="btn btn--white cart-page__update-button <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
            name="update_cart"
            value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"
        >
            <?php esc_html_e( 'Update cart', 'woocommerce' ); ?>
        </button>

        <?php do_action( 'woocommerce_cart_actions' ); ?>

        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
    </div>

    <?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_after_cart' ); ?>
