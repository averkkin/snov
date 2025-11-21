<?php
defined('ABSPATH') || exit;

/**
 * Метабокс настроек комплекта постельного белья
 */
add_action('add_meta_boxes', function() {
    add_meta_box(
        'snov_bedding_set',
        'Комплект постельного белья',
        'snov_render_bedding_set_metabox',
        'product',
        'normal',
        'default'
    );
});

function snov_render_bedding_set_metabox($post) {
    $data = get_post_meta($post->ID, '_snov_bedding_set', true);

    $enabled    = $data['enabled'] ?? '';
    $title      = $data['title'] ?? '';
    $subtitle   = $data['subtitle'] ?? '';
    $components = $data['components'] ?? [];

    wp_nonce_field('snov_bedding_set_nonce', 'snov_bedding_set_nonce_field');
    ?>
    <p>
        <label style="display:flex;gap:8px;align-items:center;">
            <input type="checkbox" name="snov_bedding_set[enabled]" value="1" <?php checked($enabled, '1'); ?>>
            <strong>Включить кастомную вариативность для этого товара</strong>
        </label>
    </p>
    <p>
        <label>
            Заголовок блока<br>
            <input type="text" name="snov_bedding_set[title]" value="<?php echo esc_attr($title); ?>" style="width:100%;">
        </label>
    </p>
    <p>
        <label>
            Подзаголовок / описание блока<br>
            <textarea name="snov_bedding_set[subtitle]" rows="3" style="width:100%;"><?php echo esc_textarea($subtitle); ?></textarea>
        </label>
    </p>

    <div id="snov-bedding-components" data-next-index="<?php echo esc_attr(count($components)); ?>">
        <?php foreach ($components as $index => $component) :
            $component_sizes  = isset($component['sizes']) ? implode("\n", (array) $component['sizes']) : '';
            $component_colors = isset($component['colors']) ? snov_format_bedding_colors_raw($component['colors']) : '';
            ?>
            <div class="snov-bedding-component-row" style="border:1px solid #e0e0e0;padding:16px;margin-bottom:16px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                    <strong>Компонент комплекта</strong>
                    <button type="button" class="button snov-remove-component">Удалить</button>
                </div>
                <p>
                    <label>
                        Название<br>
                        <input type="text" name="snov_bedding_set[components][<?php echo esc_attr($index); ?>][title]" value="<?php echo esc_attr($component['title'] ?? ''); ?>" style="width:100%;">
                    </label>
                </p>
                <p>
                    <label>
                        Дополнительное описание (например, количество или подсказка)<br>
                        <input type="text" name="snov_bedding_set[components][<?php echo esc_attr($index); ?>][subtitle]" value="<?php echo esc_attr($component['subtitle'] ?? ''); ?>" style="width:100%;">
                    </label>
                </p>
                <p>
                    <label>
                        Размеры (каждый с новой строки)<br>
                        <textarea name="snov_bedding_set[components][<?php echo esc_attr($index); ?>][sizes]" rows="3" style="width:100%;"><?php echo esc_textarea($component_sizes); ?></textarea>
                    </label>
                </p>
                <p>
                    <label>
                        Цвета (формат: Название|#HEX, каждый с новой строки)<br>
                        <textarea name="snov_bedding_set[components][<?php echo esc_attr($index); ?>][colors_raw]" rows="4" style="width:100%;"><?php echo esc_textarea($component_colors); ?></textarea>
                    </label>
                </p>
            </div>
        <?php endforeach; ?>
    </div>

    <button id="snov-add-bedding-component" class="button button-primary">+ Добавить компонент</button>

    <script type="text/template" id="snov-bedding-component-template">
        <div class="snov-bedding-component-row" style="border:1px solid #e0e0e0;padding:16px;margin-bottom:16px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                <strong>Компонент комплекта</strong>
                <button type="button" class="button snov-remove-component">Удалить</button>
            </div>
            <p>
                <label>
                    Название<br>
                    <input type="text" name="snov_bedding_set[components][__index__][title]" style="width:100%;">
                </label>
            </p>
            <p>
                <label>
                    Дополнительное описание (например, количество или подсказка)<br>
                    <input type="text" name="snov_bedding_set[components][__index__][subtitle]" style="width:100%;">
                </label>
            </p>
            <p>
                <label>
                    Размеры (каждый с новой строки)<br>
                    <textarea name="snov_bedding_set[components][__index__][sizes]" rows="3" style="width:100%;"></textarea>
                </label>
            </p>
            <p>
                <label>
                    Цвета (формат: Название|#HEX, каждый с новой строки)<br>
                    <textarea name="snov_bedding_set[components][__index__][colors_raw]" rows="4" style="width:100%;"></textarea>
                </label>
            </p>
        </div>
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('snov-bedding-components');
            const addBtn = document.getElementById('snov-add-bedding-component');
            const template = document.getElementById('snov-bedding-component-template');

            if (!wrapper || !addBtn || !template) {
                return;
            }

            let nextIndex = parseInt(wrapper.dataset.nextIndex, 10) || wrapper.querySelectorAll('.snov-bedding-component-row').length;

            addBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const html = template.innerHTML.replace(/__index__/g, nextIndex);
                const div = document.createElement('div');
                div.className = 'snov-bedding-component-row';
                div.innerHTML = html;
                wrapper.appendChild(div);
                nextIndex++;
            });

            wrapper.addEventListener('click', function(e) {
                if (e.target.classList.contains('snov-remove-component')) {
                    e.preventDefault();
                    const row = e.target.closest('.snov-bedding-component-row');
                    if (row) {
                        row.remove();
                    }
                }
            });
        });
    </script>
    <?php
}

function snov_format_bedding_colors_raw($colors) {
    if (!is_array($colors)) {
        return '';
    }

    $lines = [];
    foreach ($colors as $color) {
        $label = $color['label'] ?? '';
        $hex   = $color['hex'] ?? '';
        if (!$label) {
            continue;
        }
        $lines[] = trim($label . ($hex ? '|' . $hex : ''));
    }

    return implode("\n", $lines);
}

add_action('save_post_product', function($post_id) {
    if (!isset($_POST['snov_bedding_set_nonce_field']) ||
        !wp_verify_nonce($_POST['snov_bedding_set_nonce_field'], 'snov_bedding_set_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (!isset($_POST['snov_bedding_set'])) {
        delete_post_meta($post_id, '_snov_bedding_set');
        return;
    }

    $input = wp_unslash($_POST['snov_bedding_set']);

    $enabled  = isset($input['enabled']) && $input['enabled'] === '1' ? '1' : '';
    $title    = isset($input['title']) ? sanitize_text_field($input['title']) : '';
    $subtitle = isset($input['subtitle']) ? sanitize_textarea_field($input['subtitle']) : '';

    $components = [];
    if (!empty($input['components']) && is_array($input['components'])) {
        foreach ($input['components'] as $component) {
            $component_title = isset($component['title']) ? sanitize_text_field($component['title']) : '';
            $component_subtitle = isset($component['subtitle']) ? sanitize_text_field($component['subtitle']) : '';
            $sizes_input = isset($component['sizes']) ? $component['sizes'] : '';
            $colors_input = isset($component['colors_raw']) ? $component['colors_raw'] : '';

            if (!$component_title && !$sizes_input && !$colors_input) {
                continue;
            }

            $components[] = [
                'title'    => $component_title,
                'subtitle' => $component_subtitle,
                'sizes'    => snov_parse_bedding_lines($sizes_input),
                'colors'   => snov_parse_bedding_colors($colors_input),
            ];
        }
    }

    if (!$enabled || empty($components)) {
        delete_post_meta($post_id, '_snov_bedding_set');
        return;
    }

    $data = [
        'enabled'   => $enabled,
        'title'     => $title,
        'subtitle'  => $subtitle,
        'components'=> array_values($components),
    ];

    update_post_meta($post_id, '_snov_bedding_set', $data);
});

function snov_parse_bedding_lines($text) {
    if (!$text) {
        return [];
    }

    $lines = preg_split('/\r\n|\r|\n/', $text);
    $result = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') {
            continue;
        }
        $result[] = sanitize_text_field($line);
    }
    return $result;
}

function snov_parse_bedding_colors($text) {
    if (!$text) {
        return [];
    }

    $lines = preg_split('/\r\n|\r|\n/', $text);
    $result = [];

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') {
            continue;
        }

        $parts = array_map('trim', explode('|', $line));
        $label = sanitize_text_field($parts[0] ?? '');
        if (!$label) {
            continue;
        }

        $hex = $parts[1] ?? '';
        $hex = sanitize_hex_color($hex);
        if (!$hex) {
            $hex = '#d9d9d9';
        }

        $result[] = [
            'label' => $label,
            'hex'   => $hex,
        ];
    }

    return $result;
}

function snov_get_bedding_set($product_or_id = null) {
    $product = $product_or_id instanceof WC_Product ? $product_or_id : wc_get_product($product_or_id ?: get_the_ID());
    if (!$product) {
        return null;
    }

    $data = get_post_meta($product->get_id(), '_snov_bedding_set', true);

    if (empty($data['enabled']) || empty($data['components']) || !is_array($data['components'])) {
        return null;
    }

    $components = array_values(array_filter($data['components'], function($component) {
        return !empty($component['title']);
    }));

    if (!$components) {
        return null;
    }

    return [
        'title'      => $data['title'] ?? '',
        'subtitle'   => $data['subtitle'] ?? '',
        'components' => $components,
    ];
}

add_action('woocommerce_before_add_to_cart_button', function() {
    global $product;
    if (!$product) {
        return;
    }

    $bedding = snov_get_bedding_set($product);
    if (!$bedding) {
        return;
    }

    get_template_part('template-parts/product/bedding-components', null, ['bedding' => $bedding]);
}, 5);

function snov_sanitize_bedding_request_components($raw) {
    if (!is_array($raw)) {
        return [];
    }

    $result = [];
    foreach ($raw as $component) {
        $result[] = [
            'title' => isset($component['title']) ? sanitize_text_field($component['title']) : '',
            'size'  => isset($component['size']) ? sanitize_text_field($component['size']) : '',
            'color' => isset($component['color']) ? sanitize_text_field($component['color']) : '',
        ];
    }

    return $result;
}

add_filter('woocommerce_add_to_cart_validation', function($passed, $product_id, $quantity) {
    $bedding = snov_get_bedding_set($product_id);
    if (!$bedding) {
        return $passed;
    }

    $submitted = snov_sanitize_bedding_request_components($_POST['snov_bedding_components'] ?? []);

    if (count($submitted) < count($bedding['components'])) {
        wc_add_notice('Пожалуйста, выберите параметры комплекта.', 'error');
        return false;
    }

    foreach ($bedding['components'] as $index => $component) {
        $current = $submitted[$index] ?? [];

        if (!empty($component['sizes']) && empty($current['size'])) {
            wc_add_notice(sprintf('Пожалуйста, выберите размер для «%s».', esc_html($component['title'] ?? '')), 'error');
            return false;
        }
        if (!empty($component['colors']) && empty($current['color'])) {
            wc_add_notice(sprintf('Пожалуйста, выберите цвет для «%s».', esc_html($component['title'] ?? '')), 'error');
            return false;
        }
    }

    return $passed;
}, 10, 3);

add_filter('woocommerce_add_cart_item_data', function($cart_item_data, $product_id, $variation_id) {
    $bedding = snov_get_bedding_set($product_id);
    if (!$bedding) {
        return $cart_item_data;
    }

    $submitted = snov_sanitize_bedding_request_components($_POST['snov_bedding_components'] ?? []);
    if (!$submitted) {
        return $cart_item_data;
    }

    $cart_item_data['snov_bedding_components'] = $submitted;
    return $cart_item_data;
}, 10, 3);

add_filter('woocommerce_get_item_data', function($item_data, $cart_item) {
    if (empty($cart_item['snov_bedding_components'])) {
        return $item_data;
    }

    foreach ($cart_item['snov_bedding_components'] as $component) {
        $details = [];
        if (!empty($component['size'])) {
            $details[] = 'Размер: ' . $component['size'];
        }
        if (!empty($component['color'])) {
            $details[] = 'Цвет: ' . $component['color'];
        }

        $item_data[] = [
            'name'  => $component['title'] ?: 'Компонент',
            'value' => implode(' | ', $details),
        ];
    }

    return $item_data;
}, 10, 2);

add_action('woocommerce_checkout_create_order_line_item', function($item, $cart_item_key, $values, $order) {
    if (empty($values['snov_bedding_components'])) {
        return;
    }

    foreach ($values['snov_bedding_components'] as $component) {
        $parts = [];
        if (!empty($component['size'])) {
            $parts[] = 'Размер: ' . $component['size'];
        }
        if (!empty($component['color'])) {
            $parts[] = 'Цвет: ' . $component['color'];
        }
        $item->add_meta_data($component['title'] ?: 'Компонент', implode(' | ', $parts));
    }
}, 10, 4);