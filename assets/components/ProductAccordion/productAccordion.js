export default function productAccordion() {
    const accordions = document.querySelectorAll('.product-accordion');

    if (!accordions.length) return;

    accordions.forEach((accordion) => {
        const items = accordion.querySelectorAll('.product-accordion__item');

        items.forEach((item) => {
            const header = item.querySelector('.product-accordion__header');
            const body   = item.querySelector('.product-accordion__body');

            // начальное состояние
            if (item.classList.contains('is-open')) {
                body.style.maxHeight = body.scrollHeight + 'px';
            } else {
                body.style.maxHeight = 0;
            }

            header.addEventListener('click', () => {
                const isOpen = item.classList.contains('is-open');

                // вариант: можно оставить возможность открывать несколько
                item.classList.toggle('is-open', !isOpen);
                body.style.maxHeight = !isOpen ? body.scrollHeight + 'px' : 0;
            });
        });
    });
}
