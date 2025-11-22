export default function productSizeSelect() {
    const widgets = document.querySelectorAll('.product-size-select');
    if (!widgets.length) return;

    widgets.forEach(widget => {
        const trigger = widget.querySelector('.product-size-select__trigger');
        const valueEl = trigger.querySelector('.value');
        const dropdown = widget.querySelector('.product-size-select__dropdown');
        const nativeSelect = widget.querySelector('.snov-size-native-select');
        const options = widget.querySelectorAll('.product-size-option');

        // Открыть/закрыть
        trigger.addEventListener('click', () => {
            widget.classList.toggle('is-open');
        });

        // Выбор значения
        options.forEach(option => {
            option.addEventListener('click', () => {
                const val = option.dataset.value;

                valueEl.textContent = option.textContent.trim();
                options.forEach(o => o.classList.remove('active'));
                option.classList.add('active');
                widget.classList.remove('is-open');

                // Прокидываем в скрытый select
                nativeSelect.value = val;

                // Дальше — стандартный WooCommerce-поток
                const $select = jQuery(nativeSelect);
                $select.trigger('change');
            });
        });

        // Авто-выбор первой опции (если хочешь)
        const first = nativeSelect.querySelector('option.attached.enabled');
        if (first && !nativeSelect.value) {
            nativeSelect.value = first.value;
            valueEl.textContent = first.textContent.trim();
            options[0]?.classList.add('active');
            jQuery(nativeSelect).trigger('change');
        }
    });

    // Обновление цены по show_variation / reset_data
    jQuery(function($) {
        const $form = $('form.variations_form');
        const priceEl = document.querySelector('.dynamic-price');
        if (!$form.length || !priceEl) return;

        const defaultPrice = priceEl.dataset.defaultPrice || priceEl.innerHTML;

        $form.on('show_variation', function(event, variation) {
            if (variation && variation.price_html) {
                priceEl.innerHTML = variation.price_html;
            }
        });

        $form.on('reset_data hide_variation', function() {
            priceEl.innerHTML = defaultPrice;
        });
    });
}
