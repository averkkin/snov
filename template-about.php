<?php
/*
Template Name: О нас
*/

get_header();
?>

<main class="content">

    <section class="image-block image-block--large">
        <img src="<?php echo get_template_directory_uri();?>/assets/images/about.jpg" alt="Одеяла" width="1512" height="800">
    </section>

    <section class="about container">

        <h2 class="h2 about__h2">О&nbsp;нас</h2>

        <img src="<?php echo get_template_directory_uri();?>/assets/images/author.jpg" alt="Подушки" class="about__image" width="585" height="717">

        <div class="about__text-group">
            <p class="p about__text ">«Все гениальное, что становится по-настоящему народным, всегда просто. Мы создаем вещи без компромиссов — честно, на совесть, с вниманием к каждой детали и уважением к покупателю.</p>
            <p class="p about__text">Более 30 лет я посвятила текстильному производству, чтобы сегодня представить продукт, в котором соединились опыт, душа и любовь к своему делу.»</p>
            <p class="p about__text about__author">Главный технолог производства Лилия Александровна</p>
        </div>

    </section>

    <section class="three-images">

        <div class="three-images js-about-slider swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/three-image1.jpg" alt="Подушки" width="505" height="717">
                </div>
                <div class="swiper-slide">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/three-image2.jpg" alt="Одеяла" width="502" height="717">
                </div>
                <div class="swiper-slide">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/three-image3.jpg" alt="Подушки" width="505" height="717">
                </div>
            </div>

            <div class="swiper-pagination swiper-pagination-hero"></div>

        </div>

    </section>

</main>

<?php get_footer(); ?>
