<?php
/*
Template Name: B2B
*/

get_header();
?>

<main class="content">
    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            B2B
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/b2b.jpg" alt="Подушки" width="1512" height="800">
    </section>
    <section class="advantages container">
        <div class="advantages__item"><img src="<?php echo get_template_directory_uri();?>/assets/images/advantages1.jpg" width="464" height="510" alt="Подушки" class="advantages__image"><span class="advantages__subtitle advantages__subtitle--s">Мы <span class="p--pink">берем в работу самые сложные заказы</span>от&nbsp;отелей и&nbsp;баз отдыха</span></div>
        <div class="advantages__item"><img src="<?php echo get_template_directory_uri();?>/assets/images/advantages2.jpg" width="464" height="510" alt="Одеяло" class="advantages__image"><span class="advantages__subtitle advantages__subtitle--s">Создаем <span class="p--pink">комфорт, продуманный до&nbsp;самых&nbsp;мелочей</span></span></div>
        <div class="advantages__item"><img src="<?php echo get_template_directory_uri();?>/assets/images/advantages3.jpg" width="464" height="510" alt="ПодушкаФ" class="advantages__image"><span class="advantages__subtitle  advantages__subtitle--m"><span class="p--pink">Помогаем составить меню подушек,</span> способное удовлетворить даже самых требовательных гостей</span></div>
    </section>
    <section class="callback container">
        <h2 class="h2 callback__h2">Заполните заявку на&nbsp;сотрудничество</h2>
        <div class="callback__grid">

            <form action="#" method="post"  class="form callback__form">

                <div class="form__groups">
                    <div class="form__group">
                        <label for="name"></label>
                        <input type="text" id="name" name="name" placeholder="Введите ваше имя" required>
                    </div>

                    <div class="form__group">
                        <label for="email"></label>
                        <input type="email" id="email" name="email" placeholder="Введите ваш номер телефона" required>
                    </div>

                    <div class="form__group">
                        <label for="phone"></label>
                        <input type="tel" id="phone" name="phone" placeholder="Введите ваш E-mail" required>
                    </div>
                </div>

                <div class="form__submit">

                    <button type="submit" class="btn form__btn">Отправить заявку</button>

                    <div class="form__checkbox">
                        <input type="checkbox" id="agreement" name="agreement" required>
                        <label for="agreement">Даю согласие на обработку моих <a href="#" class="link link--medium link--pink form__link">Персональных данных.</a></label>
                    </div>

                </div>


            </form>

            <img src="<?php echo get_template_directory_uri();?>/assets/images/b2b-bed.jpg" alt="Кровать" width="827" height="380" class="callback__image">

        </div>
    </section>
</main>

<?php get_footer(); ?>
