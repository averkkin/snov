<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package snov.group
 */

get_header();

?>

<main class="content">

    <section class="hero">

        <div class="hero__images hero-desktop">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/img1.jpg" alt="Подушки" width="505" height="717">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/img2.jpg" alt="Одеяла" width="502" height="717">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/img3.jpg" alt="Подушки" width="505" height="717">
        </div>

        <div class="hero__images js-hero-slider swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/img1.jpg" alt="Подушки" width="505" height="717">
                </div>
                <div class="swiper-slide">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/img2.jpg" alt="Одеяла" width="502" height="717">
                </div>
                <div class="swiper-slide">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/img3.jpg" alt="Подушки" width="505" height="717">
                </div>
            </div>

            <div class="swiper-pagination swiper-pagination-hero"></div>
        </div>

        <a href="/shop"><button class="btn btn--white hero__btn" type="button" aria-label="Перейти в каталог">Перейти в каталог</button></a>
    </section>

    <section class="snov container">
        <img src="<?php echo get_template_directory_uri();?>/assets/images/snov.png" alt="Логотип СНОВ" class="snov__img" aria-label="Логотип СНОВ" width="1432" height="307">
        <p class="snov__text">Объединяем тех, кто любит поспать хорошо</p>
    </section>

    <section class="slider-large">

        <div class="section-title container">
            <h2 class="h2 section-title__h2">Хиты продаж</h2>
            <div class="section-title__quote">
                <p>
                    Чем более странным нам
                    кажется сон, тем более
                    глубокий смысл он несет
                </p>
                <span>Зигмунд Фрейд</span>
            </div>

        </div>

        <?php render_category_slider('', 'hits-sales');?>
    </section>

    <!--Подушки-->
    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            Подушки
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/img4.jpg" alt="Подушки" width="1512" height="800">
    </section>

    <?php render_category_slider('Подушки', 'podushka');?>

    <!--Одеяла-->
    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            Одеяла
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/blankets.jpg" alt="Одеяла" width="1512" height="800">
    </section>

    <?php render_category_slider('Одеяла', 'odeyalo');?>

    <!--Комплекты постельного белья-->
<!--    <section class="image-block">-->
<!--        <h2 class="h2 h2--white h2--large container image-block__h2">-->
<!--            Комплекты постельного белья-->
<!--        </h2>-->
<!--        <img src="--><?php //echo get_template_directory_uri();?><!--/assets/images/Bedding%20sets.jpg" alt="Комплекты постельного белья" width="1512" height="800">-->
<!--    </section>-->

<!--    --><?php //render_category_slider('Комплекты постельного белья', 'komplekt-postelnogo-belia');?>

    <!--Наволочки-->
    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            Наволочки
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/Pillowcases.jpg" alt="Наволочки" width="1512" height="800">
    </section>

    <?php render_category_slider('Наволочки', 'navolochka');?>

    <!--Пододеяльники-->
    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            Пододеяльники
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/Duvet%20covers.jpg" alt="Подушки" width="1512" height="800">
    </section>

    <?php render_category_slider('Пододеяльники', 'pododeyalnik');?>

    <!--Простыни-->
    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            Простыни
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/Sheets.jpg" alt="Подушки" width="1512" height="800">
    </section>

    <?php render_category_slider('Простыня', 'prostin');?>

</main><!-- #main -->

<?php
get_footer();
