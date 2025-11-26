<?php

/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */
/*
 * @hooked wc_empty_cart_message - 10
 */
get_header();

do_action('woocommerce_cart_is_empty'); ?>

<section class="favorit cart">
	<div class="container">
		<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php woocommerce_breadcrumb(); ?>
			<div class="wrap">
				<div class="favorit__body">
					<div class="favorit__title title-pages">
						<h1 class="h2">Корзина</h1>
					</div>
					<div class="favorit__content empty-cart-favorit">
						<p>Ваша корзина пуста</p>
						<a href="/shop" class="btn">Перейти в каталог</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
<style>
    /* Убираем стандартные заголовки WooCommerce */
    .entry-title,
    .wc-empty-cart-message {
        display: none;
    }

    /* Контейнер сообщения о пустой корзине */
    .empty-cart-favorit {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 24px;
        font-size: 18px;
        line-height: 130%;
        color: #282E2F;
    }

    .empty-cart-favorit .button:hover {
        background: #1d2223;
    }

    /* Хлебные крошки */
    .breadcrumbs {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
    }

    .breadcrumbs a {
        color: #282E2F;
        text-decoration: none;
    }

    .breadcrumbs span {
        opacity: 0.5;
    }

    /* Страница и контейнеры */
    .favorit.cart {
        padding: 40px 0;
    }

    .favorit__title {
        display: inline-flex;
        justify-content: center;
        width: 100%;
    }

    .favorit__title h1 {
        text-align: center;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 24px;
        margin-top: 60px;
    }

    /* Адаптив */
    @media (max-width: 1000px) {
        .empty-cart-favorit {
            align-items: flex-start;
        }

        .empty-cart-favorit .button {
            width: 100%;
            justify-content: center;
        }

        .favorit__title {
            justify-content: flex-start;
            margin-top: 24px;
        }

        .favorit__title h1 {
            font-size: 26px;
        }
    }
</style>
<?php
// Проверяем, загружен ли WooCommerce
if (class_exists('WooCommerce')) {

	// Получаем товары из корзины
	$cart_items = WC()->cart->get_cart();
	$cart_product_ids = array();

	foreach ($cart_items as $cart_item) {
		$cart_product_ids[] = $cart_item['product_id'];
	}

	// Аргументы для WP_Query
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 4, // Количество продуктов для вывода
		'orderby' => 'date', // Порядок сортировки продуктов
		'order' => 'DESC',
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => 'netkannyi-material',
			),
		),
		'post__not_in' => $cart_product_ids, // Исключаем товары из корзины
	);

	// Создаем новый WP_Query
	$loop = new WP_Query($args);

	// Проверяем, есть ли товары для показа
	if ($loop->have_posts()) : ?>

		<section class="recomend">
			<div class="recomend__container">
				<div class="mob">
					<div class="recomend__title section-title">
						<h2>Рекомендуем посмотреть:</h2>
					</div>
				</div>
				<div class="wrap">
					<div class="recomend__top">
						<div class="section-title">
							<h2>Рекомендуем посмотреть:</h2>
						</div>
						<div class="recomend__navi">
							<button type="button" class="btnprev">
								<svg width="25" height="8" viewBox="0 0 25 8" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0.646446 4.35355C0.451185 4.15829 0.451185 3.84171 0.646446 3.64645L3.82843 0.464466C4.02369 0.269204 4.34027 0.269204 4.53553 0.464466C4.7308 0.659728 4.7308 0.976311 4.53553 1.17157L1.70711 4L4.53553 6.82843C4.7308 7.02369 4.7308 7.34027 4.53553 7.53553C4.34027 7.7308 4.02369 7.7308 3.82843 7.53553L0.646446 4.35355ZM25 4V4.5H1V4V3.5H25V4Z" fill="" />
								</svg>
							</button>
							<button type="button" class="btnnext">
								<svg width="25" height="8" viewBox="0 0 25 8" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M24.3536 4.35355C24.5488 4.15829 24.5488 3.84171 24.3536 3.64645L21.1716 0.464466C20.9763 0.269204 20.6597 0.269204 20.4645 0.464466C20.2692 0.659728 20.2692 0.976311 20.4645 1.17157L23.2929 4L20.4645 6.82843C20.2692 7.02369 20.2692 7.34027 20.4645 7.53553C20.6597 7.7308 20.9763 7.7308 21.1716 7.53553L24.3536 4.35355ZM0 4V4.5H24V4V3.5H0V4Z" fill="" />
								</svg>
							</button>
						</div>
						<div class="pagination2">1/5</div>
					</div>
					<div class="recomend__slider">
						<div class="recomend__swiper">
							<?php while ($loop->have_posts()) {
								$loop->the_post();
								echo '<div class="recomend__slide">';
								wc_get_template_part('woocommerce/custom-product-template'); // Или другой путь к вашему шаблону
								echo '</div>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php endif;

	// Сброс данных поста
	wp_reset_postdata();
}
?>
<?php get_footer();
?>