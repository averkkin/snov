<?php
defined( 'ABSPATH' ) || exit;

//remove_action('woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 10);


function snov_render_wc_variation_selects() {
    global $product;

    if (!$product->is_type('variable')) return;

    $attributes = $product->get_variation_attributes();

    foreach ($attributes as $attribute_name => $options) {

        $clean_label = wc_attribute_label( $attribute_name );
        $attribute_id = sanitize_title($attribute_name);
        ?>

        <div class="product-size-select" data-attribute="<?php echo esc_attr($attribute_name); ?>">

            <label><?php echo esc_html($clean_label); ?>:</label>

            <!-- Триггер (красивый элемент) -->
            <button type="button" class="product-size-select__trigger">
                <span class="value">Выбрать опцию</span>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-dd.svg" class="arrow" alt="">
            </button>

            <!-- Dropdown -->
            <div class="product-size-select__dropdown">
                <?php foreach ($options as $option): ?>
                    <button
                        type="button"
                        class="product-size-option"
                        data-value="<?php echo esc_attr($option); ?>">
                        <?php echo esc_html($option); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Нативный WooCommerce select (скрытый) -->
            <select
                name="attribute_<?php echo esc_attr($attribute_name); ?>"
                data-attribute_name="attribute_<?php echo esc_attr($attribute_name); ?>"
                class="snov-size-native-select"
                style="display:none;">
                <option value="">Выбрать опцию</option>

                <?php foreach ($options as $option): ?>
                    <option value="<?php echo esc_attr($option); ?>" class="attached enabled">
                        <?php echo esc_html($option); ?>
                    </option>
                <?php endforeach; ?>

            </select>

        </div>

        <?php
    }
}




