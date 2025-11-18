export default function productGallery() {

    const thumbs = new Swiper('.product-thumbs-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 12,
        navigation: {
            nextEl: '.thumbs-swiper-button-next',
            prevEl: '.thumbs-swiper-button-prev',
        },
        watchSlidesProgress: true,
    });

    const main = new Swiper('.product-main-swiper', {
        slidesPerView: 1,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        thumbs: {
            swiper: thumbs,
        },
    });

}
