export default function sliderProducts() {

    const sliders = document.querySelectorAll('.products-swiper');

    if (!sliders.length) return;

    sliders.forEach(slider => {
        new Swiper(slider, {
            slidesPerView: 3,
            spaceBetween: 40,
            loop: true,
            speed: 500,
            navigation: {
                nextEl: slider.querySelector('.slider-arrow--next'),
                prevEl: slider.querySelector('.slider-arrow--prev'),
            },
            breakpoints: {
                0:   { slidesPerView: 2, spaceBetween: 10 },
                768: { slidesPerView: 2, spaceBetween: 25 },
                1200:{ slidesPerView: 3, spaceBetween: 40 }
            }
        });
    });

}



