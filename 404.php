<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package snov.group
 */

get_header();
?>

    <main class="content">

        <section class="custom-error-404">
            <div class="custom-error-404__wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/404.png" alt="Error" width="594"
                     height="273">
                <h1 class="custom-error-404__title">Ошибка</h1>
            </div>
            <p class="custom-error-404__text">Извините, кажется произошла ошибка. Этой страницы не&nbsp;существует.
                Пожалуйста,
                <a href="/" class="link link--pink link--medium">перейдите на&nbsp;главную</a>
                <?php
                    if (wp_get_referer()) {
                        echo 'или&nbsp;вернитесь <a href="' . esc_url( wp_get_referer() ) . '" class="link link--pink link--medium">назад.</a>';
                    }
                ?>
                </p>
        </section><!-- .error-404 -->

        <section class="slider-large">

            <div class="section-title container">
                <h2 class="h2 section-title__h2">Вам может понравиться</h2>
            </div>

            <?php render_category_slider('', 'hits-sales'); ?>

        </section>

    </main><!-- #main -->

<?php
get_footer();
