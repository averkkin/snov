export default function beddingComponents() {
    const sections = document.querySelectorAll('.bedding-builder');
    if (!sections.length) {
        return;
    }

    sections.forEach(section => {
        const components = section.querySelectorAll('.bedding-component');

        components.forEach(component => {
            const sizeButtons = component.querySelectorAll('.bedding-component__size-option');
            const sizeInput = component.querySelector('.js-bedding-component-size');
            const sizeValue = component.querySelector('.bedding-component__size-value');

            sizeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const value = button.dataset.size || '';

                    sizeButtons.forEach(btn => btn.classList.remove('is-active'));
                    button.classList.add('is-active');

                    if (sizeInput) {
                        sizeInput.value = value;
                    }
                    if (sizeValue) {
                        sizeValue.textContent = value;
                    }
                });
            });

            const colorButtons = component.querySelectorAll('.bedding-component__color-option');
            const colorInput = component.querySelector('.js-bedding-component-color');
            const colorValue = component.querySelector('.bedding-component__color-value');

            colorButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const value = button.dataset.color || '';

                    colorButtons.forEach(btn => btn.classList.remove('is-active'));
                    button.classList.add('is-active');

                    if (colorInput) {
                        colorInput.value = value;
                    }
                    if (colorValue) {
                        colorValue.textContent = value;
                    }
                });
            });
        });
    });
}