<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package snov.group
 */

?>
<span class="hr container"></span>
<footer class="footer container">

    <div class="footer__wrapper">

        <div class="footer__left-content">
            <div class="logo footer__logo"><img src="<?php echo get_template_directory_uri();?>/assets/icons/logo.svg" alt="Логотип СНОВ"></div>
            <div class="footer__site-info">
                <span>Все права защищены.</span>
                <span>ИП Новожилов Николай Аркадьевич</span>
                <span>ОГРНИП: 325370000002082</span>
                <span>ИНН: 370242815213</span>
            </div>
        </div>

        <div class="footer__right-content">
            <div class="footer__menu">
                <nav>
                    <ul>
                        <li><a href="">Каталог</a></li>
                        <li><a href="">О нас</a></li>
                        <li><a href="">Контакты</a></li>
                        <li><a href="">B2B</a></li>
                    </ul>
                </nav>
                <nav>
                    <ul>
                        <li><a href="">Сертификат</a></li>
                        <li><a href="">Личный кабинет</a></li>
                        <li><a href="">Корзина (0)</a></li>
                    </ul>
                </nav>
            </div>
            <div class="contact">

                    <span class="contact__name">Телефон:</span>
                    <a class="footer__contact-value contact__value">+7 (495) 525-40-10</a>

                    <span class="contact__name">Почта:</span>
                    <a class="contact__value">info@snov.group</a>

                    <span class="contact__name">Адрес:</span>
                    <span class="contact__value">г. Иваново ул. 11-я Завокзальная, д.40 </span>
            </div>
            <div class="arrow-up"><img src="<?php echo get_template_directory_uri();?>/assets/icons/arrow-up.svg" alt="Наверх"></div>
        </div>

    </div>

    <div class="footer__wrapper">

        <div class="footer__left-content">
            <div class="footer__site-info copyright">
                <span class="">©2025</span>
            </div>
        </div>

        <div class="footer__privacy">
            <a href="" class="link link--blue">Пользовательское соглашение</a>
            <a href="" class="link link--blue">Политика в отношении обработки персональных данных</a>
        </div>

    </div>



</footer><!-- .site-info -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
