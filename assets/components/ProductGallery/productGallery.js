export default function productGallery() {

    const main = new Swiper('.product-main-swiper', {
        slidesPerView: 1,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        on: {
            slideChange(swiper) {
                updateActiveThumb(swiper.realIndex);
            }
        }
    });

    const thumbs = new Swiper('.product-thumbs-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 12,
    });

    // Клик по миниатюре → переключаем главный
    document.querySelectorAll('.product-gallery__thumbs .swiper-slide').forEach((slide, index) => {
        slide.addEventListener('click', () => {
            main.slideTo(index);
            updateActiveThumb(index);
        });
    });

    // Подсветка активной миниатюры
    function updateActiveThumb(index) {
        const slides = document.querySelectorAll('.product-gallery__thumbs .swiper-slide');

        slides.forEach(slide => slide.classList.remove('swiper-slide-active-custom'));
        if (slides[index]) {
            slides[index].classList.add('swiper-slide-active-custom');
        }
    }

    // активируем первый слайд
    updateActiveThumb(0);
}
