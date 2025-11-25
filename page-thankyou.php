<?php
/*
Template Name: Thank you
*/

get_header();
?>


    <div class="container page-cart__breadcrumb"><?php woocommerce_breadcrumb(); ?></div>

    <main class="content">
        <div class="thankyou">
            <div class="page-cart__header">
                <h2 class="h2 section-title__h2 section-title--semibold">Спасибо! Ваш заказ оформлен!</h2>
            </div>
            <span class="thankyou__hr"></span>
            <div class="thankyou__content">
                <p>На ваш адрес электронной почты было отправлено письмо со всей необходимой вам информацией! Если письмо так и не поступило, проверьте папку <span class="p--medium">«Спам».</span> </p>
                <a href="/"><button type="button" class="thankyou__btn btn">Вернуться на главную страницу</button></a>
            </div>
        </div><!-- .thankyou -->

        <section class="slider-large">

            <div class="section-title container">
                <h2 class="h2 section-title__h2 section-title--semibold">Вам могут понравиться</h2>
            </div>

            <?php render_category_slider('', 'hits-sales'); ?>

        </section><!-- .slider-large -->

    </main>



<?php
get_footer();