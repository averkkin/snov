export default function productSizeSelect() {

    const widgets = document.querySelectorAll('.product-size-select');
    if (!widgets.length) return;

    widgets.forEach(widget => {

        const trigger = widget.querySelector('.product-size-select__trigger');
        const valueEl = trigger.querySelector('.value');
        const dropdown = widget.querySelector('.product-size-select__dropdown');
        const nativeSelect = widget.querySelector('.snov-size-native-select');
        const options = widget.querySelectorAll('.product-size-option');

        // Открыть/закрыть dropdown
        trigger.addEventListener('click', () => {
            widget.classList.toggle('is-open');
        });

        // Выбор значения
        options.forEach(option => {
            option.addEventListener('click', () => {

                const val = option.dataset.value;

                // UI
                valueEl.textContent = val;
                options.forEach(o => o.classList.remove('active'));
                option.classList.add('active');
                widget.classList.remove('is-open');

                // WooCommerce + нативное обновление вариации
                jQuery(nativeSelect)
                    .val(val)
                    .trigger('change')
                    .trigger('woocommerce_variation_select_change')
                    .trigger('check_variations');
            });

        });


        // Автовыбор первой опции
        const first = nativeSelect.querySelector('option.attached.enabled');
        if (first && !nativeSelect.value) {
            nativeSelect.value = first.value;
            valueEl.textContent = first.value;

            // отметка в UI
            options[0].classList.add('active');

            jQuery(nativeSelect).trigger('change');
        }

    });


    // WooCommerce events: update price
    const priceEl = document.querySelector('.dynamic-price');

    jQuery('form.variations_form').on('show_variation', function(event, variation) {
        if (priceEl) priceEl.innerHTML = variation.price_html;
    });

    jQuery('form.variations_form').on('hide_variation reset_data', function() {
        if (priceEl) priceEl.innerHTML = priceEl.dataset.defaultPrice;
    });

    jQuery(function($) {

        const priceEl = document.querySelector('.dynamic-price');
        if (!priceEl) return;

        const defaultPrice = priceEl.dataset.defaultPrice;

        // При выборе вариации WooCommerce передаёт price_html
        $('form.variations_form').on('show_variation', function(event, variation) {
            if (variation && variation.price_html) {
                priceEl.innerHTML = variation.price_html;
            }
        });

        // Если вариация сброшена (например, нет комбинации)
        $('form.variations_form').on('reset_data hide_variation', function() {
            priceEl.innerHTML = defaultPrice;
        });

    });


}

