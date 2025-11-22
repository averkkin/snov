<?php
get_header();
?>
<div class="container page-cart__breadcrumb"><?php woocommerce_breadcrumb(); ?></div>

    <main class="container content">

        <div class="page-cart">

            <div class="page-cart__header">
                <?php the_title( '<h2 class="h2 section-title__h2 section-title--semibold">', '</h2>' ); ?>
            </div>

            <div class="page-cart__items">
                <div class="page-cart__item">

                    <div class="page-cart__item-col">
                        <img src="<?php echo get_template_directory_uri();?>/assets/images/pillowcase-capuchino.jpg" alt="" class="page-cart__thumb" width="294" height="230">
                    </div>

                    <div class="page-cart__item-col">
                        <div class="page-cart__label">Название товара:</div>
                        <div class="page-cart__value">
                            <div class="page-cart__category">Простыня</div>
                            <div class="page-cart__title">Капучино</div>
                        </div>
                    </div>

                    <div class="page-cart__item-col">
                        <div class="page-cart__label">Количество:</div>
                        <div class="page-cart__value">
                            <div class="page-cart__quantity">
                                1
                            </div>
                        </div>
                    </div>

                    <div class="page-cart__item-col">
                        <div class="page-cart__label">Сумма:</div>
                        <div class="page-cart__value">
                            <div class="page-cart__title">2 200 ₽</div>
                        </div>
                    </div>

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/delete.svg" alt="Delete" class="page-cart__delete">

                </div><!-- .page-cart__item -->
            </div> <!-- .page-cart__items -->

            <form class="page-cart__footer">
                <div class="page-cart__row">
                    <div class="page-cart__note">
                        <label for="note">Добавить примечание к заказу:</label>
                        <input type="text" placeholder="Чем мы можем вам помочь?" name="note" aria-label="note" >
                    </div>
                    <div class="page-cart__total">
                        <div class="page-cart__label">Итого</div>
                        <div class="page-cart__summary">299 999 ₽</div>
                    </div>
                    <button type="submit" class="btn btn--primary">Перейти к оформлению</button>
                </div>
                <div class="page-cart__row">

                    <div class="page-cart__group-fields">
                        <label for="certificate">Введите номер сертификата:</label>
                        <div class="page-cart__controls">
                            <input type="text"
                                   id="certificate"
                                   class="form-group__input"
                                   placeholder="Например: 121020">
                            <button type="button" class="btn btn--primary form-group__button">Применить</button>
                        </div>
                    </div><!-- .page-cart__group-fields -->

                    <div class="page-cart__group-fields">
                        <label for="promo">Введите промокод:</label>
                        <div class="page-cart__controls">
                            <input type="text"
                                   id="promo"
                                   class="form-group__input"
                                   placeholder="CНОВ">
                            <button type="button" class="btn btn--primary form-group__button">Применить</button>
                        </div>
                    </div><!-- .page-cart__group-fields -->

                </div><!-- .page-cart__row -->
            </form>

        </div><!-- .page-cart -->

    </main><!-- .container content -->

<?php
get_footer();
