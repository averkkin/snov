export default function sliderAbout() {

    const slider = document.querySelector('.js-about-slider');

    if (!slider) return;

    const paginationEl = slider.querySelector('.swiper-pagination');

    function initSlider(slider) {

        new Swiper(slider, {

            slidesPerView: 3,
            spaceBetween: 0,
            loop: true,
            speed: 500,
            breakpoints: {
                0:   { slidesPerView: 1, spaceBetween: 0, initialSlide: 1},
                768: { slidesPerView: 2, spaceBetween: 0 },
                1200:{ slidesPerView: 3, spaceBetween: 0 }
            },
            pagination: {
                el: paginationEl,
                clickable: true,
            },
        });
    }

    initSlider(slider);

}