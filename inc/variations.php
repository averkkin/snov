<?php
defined( 'ABSPATH' ) || exit;

function snov_get_product_sizes( $product ) {

    if ( ! $product->is_type('variable') ) {
        return [];
    }

    $variations = $product->get_available_variations();
    $sizes = [];

    foreach ( $variations as $variation ) {

        foreach ( $variation['attributes'] as $key => $value ) {

            // Ловим ВСЕ атрибуты вариаций
            if (strpos($key, 'attribute_') === 0 && !empty($value)) {
                $sizes[] = $value;
            }
        }
    }

    return array_unique($sizes);
}



/**
 * Вывод кастомного выбора размера
 */
function snov_render_sizes_block() {
    global $product;

    if ( ! $product->is_type('variable') ) return;

    $sizes = snov_get_product_sizes( $product );

    if (empty($sizes)) return;

    ?>

    <div class="product-size-select" data-attribute="pa_size">

        <button type="button" class="product-size-select__trigger">
            <span class="label">Размер:</span>
            <span class="value"></span>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-dd.svg" class="arrow">
        </button>

        <div class="product-size-select__dropdown">
            <?php foreach ($sizes as $size): ?>
                <button
                        type="button"
                        class="product-size-option"
                        data-value="<?php echo esc_attr($size); ?>">
                    <?php echo esc_html($size); ?>
                </button>
            <?php endforeach; ?>
        </div>

    </div>


    <?php
}
