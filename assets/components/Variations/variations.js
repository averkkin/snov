export default function productSizeSelect() {
    const selects = document.querySelectorAll('.product-size-select');

    if (!selects.length) return;

    selects.forEach(select => {
        const trigger = select.querySelector('.product-size-select__trigger');
        const valueEl = trigger.querySelector('.value');
        const dropdown = select.querySelector('.product-size-select__dropdown');
        const options = dropdown.querySelectorAll('.product-size-option');

        // WooCommerce select
        const form = document.querySelector('.variations_form');
        const wcSelect = form ? form.querySelector('select[name*="attribute_"]') : null;

        if (options.length > 0) {
            const first = options[0];
            const firstValue = first.dataset.value;

            // UI
            first.classList.add('active');
            valueEl.textContent = firstValue;

            // WooCommerce
            if (wcSelect) {
                wcSelect.value = firstValue;
                jQuery(wcSelect).trigger('change');
            }
        }

        trigger.addEventListener('click', () => {
            select.classList.toggle('is-open');
        });

        options.forEach(option => {
            option.addEventListener('click', () => {
                const size = option.dataset.value;

                // Обновляем UI
                valueEl.textContent = size;
                options.forEach(o => o.classList.remove('active'));
                option.classList.add('active');

                // Закрываем
                select.classList.remove('is-open');

                // WooCommerce
                if (wcSelect) {
                    wcSelect.value = size;
                    jQuery(wcSelect).trigger('change');
                }
            });
        });

        document.addEventListener('click', e => {
            if (!select.contains(e.target)) {
                select.classList.remove('is-open');
            }
        });
    });
}
