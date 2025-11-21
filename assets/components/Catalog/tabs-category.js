// tabsCategory.js
export default function tabsCategory() {
    const categories = document.querySelectorAll('.catalog__category');

    if (!categories.length) return;

    categories.forEach(category => {
        const tabs = category.querySelectorAll('.catalog__type-item');
        const contents = category.querySelectorAll('.catalog__loop');

        if (!tabs.length || !contents.length) return;

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.dataset.tab;

                // 1. Удаляем активный класс у табов текущего блока
                tabs.forEach(t => t.classList.remove('is-active'));

                // 2. Назначаем активный класс
                tab.classList.add('is-active');

                // 3. Скрываем контент ТОЛЬКО внутри этого блока
                contents.forEach(block => {
                    block.style.display = 'none';
                });

                // 4. Показываем нужный
                const activeBlock = category.querySelector(
                    `.catalog__loop[data-category="${target}"]`
                );

                if (activeBlock) {
                    activeBlock.style.display = 'block';
                }
            });
        });

        // Активируем первый таб автоматически
        if (tabs[0]) {
            tabs[0].click();
        }
    });
}
