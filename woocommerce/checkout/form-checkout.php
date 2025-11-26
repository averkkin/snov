<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */
if (! defined('ABSPATH')) {
	exit;
}
do_action('woocommerce_before_checkout_form', $checkout);
// If checkout registration is disabled and not logged in, the user cannot checkout.
if (! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
};

get_header();

?>


<style>
	.woocommerce-NoticeGroup-checkout {
		display: none;
	}

	.checkout-inline-error-message {
		color: red;
		font-size: 12px;
	}

	.fonwhite:not(:last-child) {
		margin-bottom: 30px;
	}

	.block-wrap-cont .form-row.place-order {
		display: none;
	}

	.fonwhite {
		background: #fff;
		border-radius: 16px;
		padding: 24px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.07);
	}

	.woocommerce-terms-and-conditions-wrapper {
		font-size: 12px;
		line-height: 124%;
		margin-top: 15px;
	}

	.shop_table.woocommerce-checkout-review-order-table {
		margin-bottom: 20px;
	}

	.shop_table.woocommerce-checkout-review-order-table {
		width: 100%;
		border-collapse: collapse;
		margin-bottom: 30px;
		text-align: left;
		font-size: 15px;
	}

	.woocommerce-checkout .wc_payment_methods {
		display: flex;
		flex-wrap: wrap;
	}

	.shop_table.woocommerce-checkout-review-order-table th {
		font-weight: 400;
	}

	.shop_table.woocommerce-checkout-review-order-table td {
		font-weight: bold;
		padding-right: 0;
	}

	.shop_table.woocommerce-checkout-review-order-table td.product-name {
		padding-right: 10px;
		font-weight: 400;
		max-width: 201px;
	}

	.woocommerce-form-coupon-toggle {
		display: none;
	}

	#order_review2 {
		max-width: 490px;
		flex: 1 1 auto;
		width: 100%;
	}

	#customer_details {
		flex: 1 1 auto;
	}

	.forma-checkout-block {
		display: flex;
		gap: 30px;
		align-items: flex-start;
	}

	.woocommerce-billing-fields h3 {
		margin-bottom: 20px;
		font-size: 20px;
		font-weight: 600;
		line-height: 125%;
	}

	.fonwhite h3 {
		margin-bottom: 20px;
		font-size: 20px;
		font-weight: 600;
		line-height: 125%;
	}

	#order_review_heading {
		margin-bottom: 20px;
		font-size: 20px;
		font-weight: 600;
		line-height: 125%;
	}

	.entry-title {
		margin-bottom: 40px;
		font-weight: 600;
		font-size: 40px;
		line-height: 125%;
		color: #282e2f;
		display: none;
	}

	.form-row {
		display: flex;
		flex-direction: column;
		gap: 10px;
		text-align: left;
		line-height: 145%;
		font-size: 16px;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 61px;
	}

	.select2-container .select2-selection--single {
		height: 61px;
		border-radius: 8px;
	}

	.zakaz-play {
		width: 100%;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow {
		top: 33%;
		right: 15px;
	}

	.form-row label {
		color: #282E2F;
	}

	.form-row input {
		border: 1px solid #909090;
		border-radius: 8px;
		width: 100%;
		display: flex;
		flex: 1 1 auto;
		padding: 20px;
		color: #909090;
	}

	.form-row:not(:last-child) {
		margin-bottom: 25px;
	}

	.menu__icon {
		display: none;
	}

	.checkout_coupon {
		display: none;
	}

	.cart {
		margin-bottom: 70px;
	}

	.payment_box.payment_method_cod {
		font-size: 12px;
		color: grey;
	}

	.select2-container .select2-selection--single .select2-selection__rendered {
		padding-left: 13px;
	}

	.woocommerce-checkout .wc_payment_methods li.active {
		background: #20B7CD;
		color: #fff;
	}

	.woocommerce-checkout .wc_payment_methods li {
		flex: 1 1 calc(50% - 15px);
		overflow: hidden;
	}

	#shipping_method {
		display: grid;
		grid-template-columns: repeat(1, 1fr);
		gap: 13px;
		padding: 0;
		margin: 0;
		list-style: none;
	}

	/* Скрываем сам <li> маркеры и внутренний <input> */
	#shipping_method li {
		margin: 0;
		padding: 0;
	}

	#shipping_method li input[type="radio"] {
		display: none;
	}

	.city-search-sdek {
		font-size: 16px;
		position: relative;
		width: 100%;
		color: #909090;
	}

	.city-search-sdek__label {
		display: flex;
		width: 100%;
		padding: 0 20px;
		justify-content: space-between;
		border: 1px solid #909090;
		border-radius: 8px;
		gap: 10px;
		align-items: center;
		line-height: 1;
	}

	.chois {}

	#city-search-input {
		outline: none;
		margin: 0;
		padding: 20px 0;
		padding-right: 10px;
		width: 100%;
	}

	.city-search-sdek__city {
		width: 100%;
		gap: 10px;
		font-size: 14px;
		padding: 5px;
		cursor: pointer;
		padding-left: 0;
		color: #222;
	}

	.city-search-sdek__arrov {}

	.city-search-sdek__values {
		position: absolute;
		top: 100%;
		background: #fff;
		z-index: 100;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.14);
		left: 0;
		width: 100%;
		height: 250px;
		overflow-y: scroll;
		padding: 20px;
		flex-direction: column;
		gap: 15px;
		display: none;
	}

	#order_review .cart-discount {
		display: none;
	}

	/* Стили для кнопки-лейбла */
	#shipping_method li label {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 18px 13px;
		font-size: 14px;
		border: 1px solid #909090;
		border-radius: 16px;
		position: relative;
		background-color: #fff;
		gap: 5px;
		color: #4E4E4E;
		font-weight: 500;
		cursor: pointer;
		line-height: 1.3;
		transition: background-color .2s, color .2s, box-shadow .2s;
	}

	/* Состояние “выбрано” */
	#shipping_method li input[type="radio"]:checked+label {
		border-color: #20B7CD;
		box-shadow: 0 2px 6px rgba(0, 0, 0, .15);
	}

	#shipping_method li input[type="radio"] {
		position: absolute;
		opacity: 0;
		pointer-events: none;
	}



	/* 4. Радио-стикер в лейбле */
	#shipping_method li label::before {
		content: "";
		flex-shrink: 0;
		width: 20px;
		height: 20px;
		margin-right: 12px;
		border: 2px solid #909090;
		border-radius: 50%;
		box-sizing: border-box;
		transition: background-color .2s, border-color .2s;
	}

	/* 5. Inner dot when checked */
	#shipping_method li input[type="radio"]:checked+label::before {
		border-color: #dfdfdf;
		background: #20B7CD;
	}

	/* 6. Подсветка всего лейбла при checked */
	#shipping_method li input[type="radio"]:checked+label {
		border-color: #20B7CD;

		box-shadow: 0 2px 6px rgba(0, 0, 0, .15);
	}

	/* Отступ снизу у описания (если <span> блока стоит внутри label) */
	#shipping_method li label span.woocommerce-Price-amount {
		margin-left: 5px;
		flex-shrink: 0;
	}

	/* Адаптив: на экранах < 600px — одна колонка */
	@media (max-width: 600px) {
		#shipping_method li label {
			font-size: 12px;
		}

		#shipping_method {
			grid-template-columns: 1fr;
		}
	}

	@media (max-width: 1000px) {
		.title-pages {
			margin-bottom: 30px;
		}

		.select2-container--default .select2-selection--single .select2-selection__rendered {
			line-height: 44px;
		}

		.woocommerce-checkout .wc_payment_methods li {
			flex: 1 1 auto;
		}

		.wc_payment_methods.payment_methods {
			flex-wrap: wrap;
		}

		.select2-container .select2-selection--single {
			height: 44px;
			border-radius: 8px;
		}

		.select2-container--default .select2-selection--single .select2-selection__arrow {
			top: 22%;
			right: 15px;
		}

		.forma-checkout-block {
			flex-direction: column;
		}

		#customer_details {
			width: 100%;
		}

		.fonwhite {
			padding: 15px;
			border-radius: 8px;
		}

		.wc_payment_methods.payment_methods {
			font-size: 14px;
		}

		.form-row input {
			padding: 12px;
			font-size: 14px;
		}
	}
</style>
<section class="cart">
	<div class="cart__container">

		<form name="checkout" method="post" class="checkout woocommerce-checkout forma-checkout-block" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__('Checkout', 'woocommerce'); ?>">

			<?php if ($checkout->get_checkout_fields()) : ?>

				<div class="col2-set" id="customer_details">
					<div class="block-wrap fonwhite">
						<div class="block-wrap-heading">
							<h3>1. Город доставки</h3>
						</div>
						<div class="block-wrap-cont">
							<!-- HTML -->
							<div class="city-search-sdek">
								<div class="city-search-sdek__label">
									<input
										type="text"
										id="city-search-input"
										placeholder="Начните ввод города для поиска…"
										autocomplete="off">
									<div class="city-search-sdek__arrov">
										<img src="<?php echo get_template_directory_uri();?>/assets/icons/arrow-dd.svg" alt="Выбор города">
									</div>
								</div>
								<div class="city-search-sdek__values">
									<!-- Сюда JS подгрузит div.city-search-sdek__city -->
								</div>
							</div>
							<script>
								document.addEventListener('DOMContentLoaded', function() {
									const popularCities = [
										'Москва',
										'Санкт-Петербург',
										'Казань',
										'Екатеринбург',
										'Новосибирск',
										'Нижний Новгород',
										'Челябинск',
										'Самара',
										'Ростов-на-Дону',
										'Омск',
										'Уфа',
										'Красноярск',
										'Пермь',
										'Волгоград',
										'Воронеж',
										'Саратов',
										'Тюмень',
										'Тула',
										'Ижевск',
										'Барнаул',
										'Ульяновск',
										'Иркутск',
										'Владивосток',
										'Ярославль',
										'Красногорск',
										'Махачкала',
										'Путилково',
										'Тольятти',
										'Томск',
										'Кемерово',
										'Новокузнецк',
                                        'Брянск',
                                        'Киров',
										'Астрахань'
									];

									const input = document.getElementById('city-search-input');
									const valuesWrapper = document.querySelector('.city-search-sdek__values');

									let debounceTimer = null;

									function normalize(str) {
										return str.toLowerCase().replace(/ё/g, 'е');
									}

									function findBestCityMatch(inputValue) {
										const val = normalize(inputValue.trim());
										if (val.length < 2) return null;

										for (const city of popularCities) {
											if (normalize(city).includes(val)) {
												return city;
											}
										}
										return null;
									}

									input.addEventListener('input', () => {
										const val = input.value.trim().toLowerCase();
										if (debounceTimer) clearTimeout(debounceTimer);

										if (val.length < 2) {
											valuesWrapper.innerHTML = '';
											valuesWrapper.style.display = 'none';
											return;
										}

										debounceTimer = setTimeout(() => {
											const inputVal = input.value.trim();

											// Проверка на совпадение с популярным городом
											let matchedCity = popularCities.find(city => normalize(city).includes(normalize(inputVal)));

											// Если нашли — используем его, иначе оригинальный ввод
											const queryCity = matchedCity ?? inputVal;

											fetch(`/wp-admin/admin-ajax.php?action=get_cdek_cities&cityName=${encodeURIComponent(queryCity)}&limit=100`)
												.then(res => res.json())
												.then(data => {
													valuesWrapper.innerHTML = '';

													if (!data.success || !Array.isArray(data.data) || data.data.length === 0) {
														const msg = document.createElement('div');
														msg.className = 'city-search-sdek__not-found';
														msg.textContent = 'Город или регион не найден';
														msg.style.color = 'red';
														valuesWrapper.appendChild(msg);
														valuesWrapper.style.display = 'block';
														return;
													}

													const filtered = data.data
														.map(city => {
															const name = city.city || '';
															const region = city.region || '';
															const subRegion = city.sub_region || '';
															const label = name + (region ? `, ${region}` : '') + (subRegion ? `, ${subRegion}` : '');

															if (!name) return null;

															const matchIndex = label.toLowerCase().indexOf(inputVal.toLowerCase());
															return {
																...city,
																matchIndex,
																label,
																sortPriority: matchIndex === 0 ? 0 : (matchIndex > 0 ? 1 : 2),
															};
														})
														.filter(Boolean)
														.sort((a, b) => a.sortPriority - b.sortPriority);

													if (filtered.length === 0) {
														const msg = document.createElement('div');
														msg.className = 'city-search-sdek__not-found';
														msg.textContent = 'Город или регион не найден';
														msg.style.color = 'red';
														valuesWrapper.appendChild(msg);
														valuesWrapper.style.display = 'block';
														return;
													}

													filtered.forEach((city, idx) => {
														const d = document.createElement('div');
														d.className = 'city-search-sdek__city';

														const regex = new RegExp(`(${inputVal})`, 'i');
														const highlighted = city.label.replace(regex, '<b>$1</b>');
														d.innerHTML = highlighted;

														d.dataset.cityId = city.code ?? idx;
														d.dataset.cityName = city.city ?? '';
														d.dataset.region = city.region ?? '';
														d.dataset.regionCode = city.region_code ?? '';
														d.dataset.subRegion = city.sub_region ?? '';
														d.dataset.latitude = city.latitude ?? '';
														d.dataset.longitude = city.longitude ?? '';

														valuesWrapper.appendChild(d);
													});

													valuesWrapper.style.display = filtered.length ? 'block' : 'none';
												});
										}, 300);

									});

									// Показ при фокусе
									input.addEventListener('focus', () => {
										if (valuesWrapper.children.length > 0) {
											valuesWrapper.style.display = 'block';
										}
									});

									// Скрытие при клике вне
									document.addEventListener('click', (e) => {
										if (!e.target.closest('.city-search-sdek')) {
											valuesWrapper.style.display = 'none';
										}
									});

									// Обработка выбора города
									valuesWrapper.addEventListener('click', (e) => {
										const cityEl = e.target.closest('.city-search-sdek__city');
										if (cityEl) {
											input.value = cityEl.dataset.cityName;
											valuesWrapper.style.display = 'none';
											document.querySelector('#billing_city').value = cityEl.dataset.cityName;
											// тут можешь добавить дополнительную логику при выборе
											let billingCityInput1 = document.querySelector('#billing_city');

											const billingCityInput = document.querySelector('#billing_city');
											if (billingCityInput) {
												billingCityInput.value = cityEl.dataset.cityName;

												// Имитируем ввод вручную
												billingCityInput.dispatchEvent(new Event('input', {
													bubbles: true
												}));
												billingCityInput.dispatchEvent(new Event('change', {
													bubbles: true
												}));
												setTimeout(() => {
													let cityLabel = document.querySelector('label[for="billing_city"]');
													if (cityLabel && cityLabel.textContent.includes('Населённый пункт')) {
														cityLabel.innerHTML = 'Город <span class="required" aria-hidden="true">*</span>';
													}
												}, 400);

												// Дополнительно — WooCommerce использует этот триггер
												jQuery(document.body).trigger('updated_checkout');
											}

										}
									});

								});
							</script>
						</div>
					</div>
					<div class="block-wrap fonwhite">
						<div class="block-wrap-heading">
							<h3>2. Способ оплаты</h3>
						</div>
						<div class="block-wrap-cont"><?php woocommerce_checkout_payment(); ?></div>
					</div>
					<div class="block-wrap fonwhite">
						<div class="block-wrap-heading">
							<h3>3. Способ доставки</h3>
						</div>
						<div class="block-wrap-cont shipping-only-clone dostavka-search">
							<div id="order_review" class="woocommerce-checkout-review-order">
								<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
								<?php do_action('woocommerce_checkout_before_order_review'); ?>
								<h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>
								<?php do_action('woocommerce_checkout_order_review'); ?>
							</div>
						</div>
					</div>
					<div class="block-wrap fonwhite">
						<?php do_action('woocommerce_checkout_before_customer_details'); ?>
						<div class="col-1">
							<?php do_action('woocommerce_checkout_billing'); ?>
						</div>
						<div class="col-3">
							<?php do_action('woocommerce_checkout_after_order_review'); ?>
						</div>
						<div class="col-2">
							<?php do_action('woocommerce_checkout_shipping'); ?>
						</div>
						<?php do_action('woocommerce_checkout_after_customer_details'); ?>
					</div>


				</div>
				<style>
					.custom-cdek-label {
						flex: 1 1 auto;
					}

					#billing_address_2_field {
						display: none !important;
					}

					.shop_table.woocommerce-checkout-review-order-table {
						margin-bottom: 0;
					}

					/* Скрываем заголовок */
					.shipping-only-clone #order_review_heading {
						display: none !important;
					}

					/* Скрываем всю таблицу */
					.shipping-only-clone .cart-subtotal {
						display: none !important;
					}

					.shipping-only-clone thead {
						display: none !important;
					}

					.shipping-only-clone tbody {
						display: none !important;
					}

					/* Оставляем только блок доставки */
					.shipping-only-clone .order-total {
						display: none !important;
					}

					#shipping_method li:not(:last-child) {
						margin-bottom: 10px;
					}

					#billing_country_field {
						display: none !important;
					}

					.shipping-only-clone .woocommerce-shipping-totals td,
					.shipping-only-clone .woocommerce-shipping-totals th {
						display: table-cell !important;
					}

					/* Отображаем сам список методов доставки */
					.shipping-only-clone #shipping_method {
						display: block !important;
					}

					/* Убираем заголовок в колонке (пустой th) */
					.shipping-only-clone .woocommerce-shipping-totals th {
						display: none !important;
					}

					#order_review_in table {
						width: 100%;
						border-collapse: separate;
						/* Чтобы отступы работали */
						border-spacing: 0 10px;
						/* Отступы между строками по вертикали */
						font-size: 14px;
						color: #222;
					}

					#order_review_in table {
						width: 100%;
						table-layout: fixed;
						border-collapse: separate;
						border-spacing: 0 8px;
						/* только вертикальный отступ между строками */
						font-size: 14px;
						color: #222;
					}

					/* Заголовки и ячейки: 50% на каждую колонку */
					#order_review_in table th,
					#order_review_in table td {
						width: 50%;
						text-align: left;
						vertical-align: top;
						padding: 4px 0;
						/* компактно, но читаемо */
						white-space: normal;
						word-wrap: break-word;
						box-sizing: border-box;
					}

					/* Последний столбец (суммы) — выравниваем по правому краю */
					#order_review_in table th:last-child,
					#order_review_in table td:last-child {
						text-align: right;
					}

					/* Финальный блок итогов — чуть жирнее и крупнее */
					#order_review_in table tfoot tr th,
					#order_review_in table tfoot tr td {
						font-weight: 600;
					}

					/* Итоговая сумма — выделяем сильнее */
					#order_review_in table tfoot tr:last-child td {
						font-weight: 700;
						font-size: 15px;
					}

					/* Удаляем все границы */
					#order_review_in table,
					#order_review_in table * {
						border: none !important;
						background: none;
					}

					/* Адаптивность: на маленьких экранах — оборачиваем строки */
					@media (max-width: 480px) {

						#order_review_in table th,
						#order_review_in table td {
							font-size: 13px;
							padding: 4px 6px;
						}
					}
				</style>
			<?php endif; ?>
			<div id="order_review2">
				<div class="box fonwhite">
					<div class="csd" id="order_review_in"></div>
				</div>
				<button class="button zakaz-play" type="btn">Оформить заказ</button>
			</div>
		</form>

		<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
	</div>
</section>
<script>
	document.querySelector('.zakaz-play').addEventListener("click", function(e) {
		document.querySelector('#place_order').click()
		console.log('Click!');
	});
</script>
<script>
	jQuery(function($) {
		function cloneOrderReviewWithoutShipping() {
			const $src = $('#order_review');
			const $dest = $('#order_review_in');

			if ($src.length && $dest.length) {
				const $clone = $src.clone();

				// Удаляем блок доставки (способы) из клона
				$clone.find('tr.woocommerce-shipping-totals.shipping').remove();

				// Отключаем все input, select, textarea
				$clone.find('input, select, textarea').prop('disabled', true);

				// Убираем все классы и id у клона
				$clone.find('*').removeAttr('class id');
				$clone.removeAttr('class id');

				// Вставляем содержимое клона в контейнер
				$dest.html($clone.html());

				// Получаем выбранный способ доставки из оригинального блока
				const $shippingMethods = $src.find('tr.woocommerce-shipping-totals.shipping');
				if ($shippingMethods.length) {
					// Найдем выбранный инпут радио
					const $checkedInput = $shippingMethods.find('input.shipping_method:checked');

					if ($checkedInput.length) {
						// Берём label для выбранного input
						const $label = $shippingMethods.find(`label[for="${$checkedInput.attr('id')}"]`);

						if ($label.length) {
							// Внутри label ищем сумму (в теге <span class="woocommerce-Price-amount amount">)
							const $amountSpan = $label.find('.woocommerce-Price-amount.amount');
							let shippingAmountHTML = '';

							if ($amountSpan.length) {
								shippingAmountHTML = $amountSpan.html(); // сумма с форматированием (число + ₽)
							} else {
								// Если вдруг нет суммы, можно взять весь html label без input
								shippingAmountHTML = $label.html();
							}

							// Можно взять текст метода доставки (до суммы)
							// Например "CDEK: Магистральный экспресс склад-дверь (4 дней):"
							const labelText = $label.clone() // клонируем
								.children() // удаляем детей (в том числе span суммы)
								.remove()
								.end()
								.text()
								.trim();

							// Добавляем строку доставки в tfoot клона
							const $tfoot = $dest.find('table tfoot');
							if ($tfoot.length) {
								const shippingTr = `<tr><th>Доставка: ${labelText}</th><td>${shippingAmountHTML}</td></tr>`;
								$tfoot.find('tr').last().before(shippingTr);
							}
						}
					}
				}
			}
		}

		let syncTimeout;
		setTimeout(cloneOrderReviewWithoutShipping, 550);

		$(document.body).on('updated_checkout', function() {
			clearTimeout(syncTimeout);
			syncTimeout = setTimeout(cloneOrderReviewWithoutShipping, 550);
		});
	});



	document.addEventListener('DOMContentLoaded', function() {
		setTimeout(() => {
			let cityLabel = document.querySelector('label[for="billing_city"]');
			if (cityLabel && cityLabel.textContent.includes('Населённый пункт')) {
				cityLabel.innerHTML = 'Город <span class="required" aria-hidden="true">*</span>';
			}
		}, 500);
		// Найдём все элементы списка shipping methods
		var methods = document.querySelectorAll('#shipping_method li');

		methods.forEach(function(li) {
			var input = li.querySelector('input.shipping_method');
			var label = li.querySelector('label');

			if (!input || !label) return;

			// Идентифицируем самовывоз по value или по тексту
			if (input.value.startsWith('local_pickup') || /Самовывоз/.test(label.textContent)) {
				// Проверяем, чтобы спана с ценой ещё не было
				if (!label.querySelector('.custom-shipping-price')) {
					// Создаём span с ценой
					var span = document.createElement('span');
					span.className = 'woocommerce-Price-amount amount custom-shipping-price';
					span.innerHTML = '<bdi>0&nbsp;<span class="woocommerce-Price-currencySymbol">₽</span></bdi>';

					// Добавляем span внутрь label после текста
					label.appendChild(span);
				}
			}
		});
		const cityLabel = document.querySelector('label[for="billing_city"]');
		if (cityLabel && cityLabel.textContent.includes('Населённый пункт')) {
			cityLabel.innerHTML = 'Город <span class="required" aria-hidden="true">*</span>';
		}
	});
</script>

<?php
get_footer();