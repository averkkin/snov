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


// Render slider of category
function render_category_slider($title, $slug) {
    $args = [
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'tax_query'      => [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $slug,
            ]
        ]
    ];

    $loop = new WP_Query($args);

    if ($loop->have_posts()) :
        ?>
        <section class="products-slider container">
            <div class="swiper products-swiper">
                <div class="swiper-wrapper">
                    <?php while ($loop->have_posts()) : $loop->the_post();
                        global $product;
                        ?>
                        <div class="swiper-slide">
                            <div class="product-card">

                                <a href="<?php the_permalink(); ?>" class="product-card__image">
                                    <?php if ($product->is_on_sale()) : ?>
                                        <span class="product-card__sale-badge">
                                            -<?php echo round( ( ($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price() ) * 100 ); ?>%
                                        </span>
                                    <?php endif; ?>

                                    <?php echo woocommerce_get_product_thumbnail('large'); ?>
                                </a>

                                <div class="product-card__meta">
                                    <span class="product-card__category">
                                        <?php echo wc_get_product_category_list(get_the_ID()); ?>
                                        <?php
                                        $color = wc_get_product_terms(get_the_ID(), 'pa_color');
                                        if (!empty($color)) : echo esc_html($color[0]->name);
                                        endif;
                                        ?>
                                    </span>

                                    <div class="product-card__info">
                                        <a href="<?php the_permalink(); ?>" class="product-card__title">
                                            <?php the_title(); ?>
                                        </a>
                                        <div class="product-card__price">
                                            <?php if ($product->is_on_sale()) : ?>
                                                <span class="price-new"><?php echo wc_price($product->get_sale_price()); ?></span>
                                                <span class="price-old"><?php echo wc_price($product->get_regular_price()); ?></span>
                                            <?php else : ?>
                                                <span class="price-new"><?php echo wc_price($product->get_regular_price()); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Стрелки -->
                <div class="slider-arrow slider-arrow--prev">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-left.svg" alt="Назад">
                </div>

                <div class="slider-arrow slider-arrow--next">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrow-right.svg" alt="Вперед">
                </div>

            </div>

        </section>
    <?php
    endif;

    wp_reset_postdata();
}

?>

<main class="content">

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

    <!--Подушки-->
    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            Подушки
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/img4.jpg" alt="Подушки" width="1512" height="800">
    </section>

<!--    --><?php //render_category_slider('Подушки', 'podushka');?>

    <!--Одеяла-->
    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            Одеяла
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/blankets.jpg" alt="Одеяла" width="1512" height="800">
    </section>

<!--    --><?php //render_category_slider('Одеяла', 'odeyalo');?>

    <!--Комплекты постельного белья-->
    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            Комплекты постельного белья
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/Bedding%20sets.jpg" alt="Комплекты постельного белья" width="1512" height="800">
    </section>

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

<!--    --><?php //render_category_slider('Пододеяльники', 'pododeyalnik');?>

    <!--Простыни-->
    <section class="image-block">
        <h2 class="h2 h2--white h2--large container image-block__h2">
            Простыни
        </h2>
        <img src="<?php echo get_template_directory_uri();?>/assets/images/Sheets.jpg" alt="Подушки" width="1512" height="800">
    </section>

<!--    --><?php //render_category_slider('Простыни', 'prostin');?>

</main><!-- #main -->

<?php
get_footer();
