<?php
get_header();
?>
    <div class="container page-cart__breadcrumb"><?php woocommerce_breadcrumb(); ?></div>

    <main class="container content">

        <div class="page-cart">

            <div class="page-cart__header">
                <?php the_title('<h2 class="h2 section-title__h2 section-title--semibold">', '</h2>'); ?>
            </div>

            <div class="page-cart__items">
                <div class="page-cart__item">

                    <div class="page-cart__item-col page-cart__thumb">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pillowcase-capuchino.jpg" width="294" height="230">
                    </div>

                    <div class="page-cart__item--inner">

                        <div class="page-cart__item-col page-cart__item-name">
                            <div class="page-cart__label">Название товара:</div>
                            <div class="page-cart__value">
                                <div class="page-cart__category">Простыня</div>
                                <div class="page-cart__title">Капучино</div>
                            </div>
                        </div>

                        <div class="page-cart__item-col page-cart__item-quantity">
                            <div class="page-cart__label">Количество:</div>
                            <div class="page-cart__value">
                                <div class="page-cart__quantity">
                                    1
                                </div>
                            </div>
                        </div>

                        <div class="page-cart__item-col page-cart__item-total">
                            <div class="page-cart__label">Сумма:</div>
                            <div class="page-cart__value">
                                <div class="page-cart__title">2 200 ₽</div>
                            </div>
                        </div>

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/delete.svg" alt="Delete"
                             class="page-cart__delete">

                    </div>

                </div><!-- .page-cart__item -->
            </div> <!-- .page-cart__items -->

            <form class="page-cart__footer">
                <div class="page-cart__row">
                    <div class="page-cart__note">
                        <label for="userMessage">Добавить примечание к заказу:</label>
                        <textarea id="userMessage" placeholder="Чем мы можем вам помочь?" rows="5"></textarea>
                    </div>
                    <div class="page-cart__action">
                        <div class="page-cart__summary">Итого: 299 999 ₽</div>
                        <button type="submit" class="btn btn--primary">Перейти к оформлению</button>
                    </div>
                </div><!-- .page-cart__row -->
                <div class="page-cart__row">

                    <div class="page-cart__group-fields">
                        <label for="certificate">Введите <span class="color--pink">номер сертификата:</span></label>
                        <div class="page-cart__controls">
                            <input type="text"
                                   id="certificate"
                                   placeholder="Например: 121020">
                            <button type="button" class="btn btn--primary page-cart__group-button">Применить</button>
                        </div>
                    </div><!-- .page-cart__group-fields -->

                    <div class="page-cart__group-fields">
                        <label for="promo">Введите <span class="color--pink">промокод:</span></label>
                        <div class="page-cart__controls">
                            <input type="text"
                                   id="promo"
                                   placeholder="CНОВ">
                            <button type="button" class="btn btn--primary page-cart__group-button">Применить</button>
                        </div>
                    </div><!-- .page-cart__group-fields -->

                </div><!-- .page-cart__row -->
            </form>

        </div><!-- .page-cart -->

    </main><!-- .container content -->

<?php
get_footer();
