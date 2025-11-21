export default function sliderProducts() {

    const sliders = document.querySelectorAll('.products-swiper');

    if (!sliders.length) return;

    sliders.forEach(slider => {
        new Swiper(slider, {
            slidesPerView: 'auto',
            spaceBetween: 40,
            freeMode: true,
            loop: false,
            speed: 500,
            navigation: {
                nextEl: slider.querySelector('.slider-arrow--next'),
                prevEl: slider.querySelector('.slider-arrow--prev'),
            },
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
                dragSize: 'auto',
            },
            breakpoints: {
                0:   { slidesPerView: 2, spaceBetween: 10 },
                768: { slidesPerView: 2, spaceBetween: 25 },
                1200:{ slidesPerView: 3, spaceBetween: 40 }
            }
        });
    });

}



