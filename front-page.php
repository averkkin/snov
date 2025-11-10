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

<main>

    <section class="hero">
        <div class="hero__images">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/img1.jpg" alt="Подушки" width="505" height="717">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/img2.jpg" alt="Одеяла" width="502" height="717">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/img3.jpg" alt="Подушки" width="505" height="717">
        </div>
        <button class="btn btn--white hero__btn" type="button" aria-label="Перейти в каталог">Перейти в каталог</button>
    </section>

    <section class="snov container">
        <img src="<?php echo get_template_directory_uri();?>/assets/images/snov.png" alt="Логотип СНОВ" class="snov__img" aria-label="Логотип СНОВ" width="1432" height="307">
        <p class="snov__text">Объединяем тех, кто любит поспать хорошо</p>
    </section>

    <section class="slider-large container">

        <div class="section-title">
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
        <div class="slider"></div>
    </section>

    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            Подушки
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/img4.jpg" alt="Подушки" width="1512" height="800">
    </section>

    <section class="slider-large container">

        <div class="slider"></div>

    </section>

</main><!-- #main -->


<?php
get_footer();
