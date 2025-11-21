
export default function smoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');

    if (!links.length) return;

    links.forEach(link => {
        link.addEventListener('click', (e) => {
            const targetSelector = link.getAttribute('href');
            const target = document.querySelector(targetSelector);

            // Пропускаем если якорь "#" или элемент не найден
            if (!target || targetSelector === '#') return;

            e.preventDefault();

            const offsetTop = target.getBoundingClientRect().top + window.pageYOffset;

            window.scrollTo({
                top: offsetTop,
                behavior: "smooth"
            });
        });
    });
}
