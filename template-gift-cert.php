<?php
/*
Template Name: Подарочный сертификат
*/


get_header();
?>

<main>
    <section class="gift-certificate">

        <div class="gift-certificate__image">
            <img src="<?php echo get_template_directory_uri();?>/assets/images/gift-cert.jpg" alt="Подарочный сертификат СНОВ" width="747" height="717">
        </div>

        <div class="gift-certificate__main-content">
            <div class="gift-certificate__wrapper">
                <h2 class="h2 gift-certificate__h2">Подарочный сертификат СНОВ</h2>
                <p class="p gift-certificate__paragraph">Подарите близкому человеку свободу выбора и приятные эмоции.</p>
                <p class="p gift-certificate__paragraph">После оформления заказа <span class="p--pink p--semibold">мы отправим электронный сертификат на вашу почту,</span> его можно распечатать или переслать как красивый подарок.</p>
                <p class="p gift-certificate__paragraph">Совершить покупку по сертификату можно <span class="p--bold">онлайн
                на сайте snov.group или по предварительной записи
                    на нашем производстве г. Иваново, 11-й проезд, 2, стр. 3</span></p>
                <div class="gift-certificate__bullits">
                    <div class="bullit">
                        <span>Сертификат электронный и неименной;</span>
                    </div>
                    <div class="bullit">
                    <span>
                        Номер сертификата формируется автоматически и уникален
                        для каждого заказа, его возможно использовать один раз,
                        в независимости от размера его номинала;
                    </span>
                    </div>
                    <div class="bullit">
                        <span>Если цена выбранных товаров ниже номинала сертификата, остаток денежными средствами не выплачивается;</span>
                    </div>
                    <div class="bullit">
                        <span>Если цена выбранных товаров выше номинала сертификата, недостающие средства можно доплатить наличными, банковской картой или другим подарочным сертификатом;</span>
                    </div>
                    <div class="bullit">
                        <span>При оформлении заказа укажите свою почту и контактные данные;</span>
                    </div>
                    <div class="bullit">
                        <span>Если письмо не пришло, проверьте папку <span class="p--semibold">«Спам»</span> или свяжитесь с нашей службой поддержки.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
