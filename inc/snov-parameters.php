<?php
defined('ABSPATH') || exit;

/**
 * Добавляем метабокс
 */
add_action('add_meta_boxes', function() {
    add_meta_box(
        'snov_product_parameters',
        'Параметры цены',
        'snov_render_parameters_metabox',
        'product',
        'normal',
        'default'
    );
});

/**
 * Рендер полей
 */
function snov_render_parameters_metabox($post) {
    $enabled = get_post_meta($post->ID, '_snov_parameters_enabled', true);
    $items   = get_post_meta($post->ID, '_snov_parameters_items', true);

    if (!is_array($items)) $items = [];

    wp_nonce_field('snov_parameters_nonce', 'snov_parameters_nonce_field');
    ?>

    <div>
        <label style="display:flex;gap:6px;align-items:center;margin-bottom:15px;">
            <input type="checkbox" name="snov_parameters_enabled" value="1" <?php checked($enabled, '1'); ?>>
            <strong>Включить параметры для этого товара</strong>
        </label>
    </div>

    <div id="snov-parameters-wrapper">

        <?php foreach ($items as $index => $value) : ?>
            <div class="snov-parameter-row" style="margin-bottom:10px; display:flex; gap:10px;">
                <input type="text" name="snov_parameters_items[]" value="<?php echo esc_attr($value); ?>" style="width: 100%;">
                <button class="button remove-row">Удалить</button>
            </div>
        <?php endforeach; ?>

    </div>

    <button id="snov-add-parameter" class="button button-primary">+ Добавить строку</button>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const wrapper = document.getElementById('snov-parameters-wrapper');
            const addBtn  = document.getElementById('snov-add-parameter');

            addBtn.addEventListener('click', function(e){
                e.preventDefault();
                const div = document.createElement('div');
                div.className = 'snov-parameter-row';
                div.style = "margin-bottom:10px; display:flex; gap:10px;";

                div.innerHTML = `
                    <input type="text" name="snov_parameters_items[]" style="width:100%;">
                    <button class="button remove-row">Удалить</button>
                `;

                wrapper.appendChild(div);
            });

            wrapper.addEventListener('click', function(e){
                if (e.target.classList.contains('remove-row')) {
                    e.preventDefault();
                    e.target.parentNode.remove();
                }
            });
        });
    </script>

    <?php
}

/**
 * Сохран
 */
add_action('save_post_product', function($post_id){

    if (!isset($_POST['snov_parameters_nonce_field']) ||
        !wp_verify_nonce($_POST['snov_parameters_nonce_field'], 'snov_parameters_nonce')) {
        return;
    }

    $enabled = isset($_POST['snov_parameters_enabled']) ? '1' : '0';

    update_post_meta($post_id, '_snov_parameters_enabled', $enabled);

    if (isset($_POST['snov_parameters_items']) && is_array($_POST['snov_parameters_items'])) {
        $items = array_map('sanitize_text_field', $_POST['snov_parameters_items']);
        update_post_meta($post_id, '_snov_parameters_items', $items);
    } else {
        delete_post_meta($post_id, '_snov_parameters_items');
    }

});
