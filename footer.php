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
            <div class="logo footer__logo logo--footer">
                <a href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri();?>/assets/icons/logo.svg" alt="Логотип СНОВ"></a>
                <button type="button" class="footer__cart visible-mobile">Корзина (<span>0</span>)</button>
            </div>
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
                        <li><a href="/shop">Каталог</a></li>
                        <li><a href="/about">О нас</a></li>
                        <li><a href="/contact">Контакты</a></li>
                        <li><a href="/b2b">B2B</a></li>
                    </ul>
                </nav>
                <nav>
                    <ul>
                        <li><a href="/gift-certificate">Сертификат</a></li>
                        <li><a href="">Личный кабинет</a></li>
                        <li class="hidden-mobile"><a href="/cart/" class="footer__cart">Корзина (<span id="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>)</a></li>
                    </ul>
                </nav>
                <a href="#header" class="visible-mobile"><div class="arrow-up"><img src="<?php echo get_template_directory_uri();?>/assets/icons/arrow-up.svg" alt="Наверх"></div></a>
            </div>
            <div class="contact">

                    <span class="contact__name">Телефон:</span>
                    <a class="footer__contact-value contact__value" href="tel:+7 (495) 525-40-10">+7 (495) 525-40-10</a>

                    <span class="contact__name">Почта:</span>
                    <a class="contact__value" href="mailto:info@snov.group">info@snov.group</a>

                    <span class="contact__name">Адрес:</span>
                    <span class="contact__value">г. Иваново ул. 11-я Завокзальная, д.40 </span>
            </div>
            <a href="#header" class="hidden-mobile"><div class="arrow-up"><img src="<?php echo get_template_directory_uri();?>/assets/icons/arrow-up.svg" alt="Наверх"></div></a>
        </div>

    </div>

    <div class="footer__wrapper">

        <div class="footer__left-content">
            <div class="footer__site-info copyright">
                <span class="">©2025</span>
            </div>
        </div>

        <div class="footer__privacy">
            <a href="/privacy" class="link link--blue">Пользовательское соглашение</a>
            <a href="/policy" class="link link--blue">Политика в отношении обработки персональных данных</a>
        </div>

    </div>



</footer><!-- .site-info -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
