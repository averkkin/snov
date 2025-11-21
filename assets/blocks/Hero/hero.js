export default function sliderHero() {

    const slider = document.querySelector('.js-hero-slider');

    if (!slider) return;

    const paginationEl = slider.querySelector('.swiper-pagination');

    function initSlider(slider) {

        new Swiper(slider, {

            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            speed: 500,
            pagination: {
                el: paginationEl,
                clickable: true,
            },
        });
    }

    initSlider(slider);

}