<?php
/*
Template Name: Главная
*/
?>
<html>
	<head>
		<title>Aquastar - Доставка воды</title>
		<link href="<?php echo get_template_directory_uri(); ?>/assets/css/app.css" rel="stylesheet">
		<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/calendar/css/calendar.css" rel="stylesheet">
		<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
		<?php wp_head(); ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src='<?=get_template_directory_uri()?>/assets/js/main.js'></script>
	</head>
	<body>
		<main>
			<div class="main-screen">
				<div class="logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt=""></div>
				<div class="center-wrap">
					<h1>Доставка воды</h1>
					<p class="main-sub-title">Качество. Скорость. Пунктуальность.</p>
					<span class="button--main" id="start-order">ЗАКАЗАТЬ ВОДУ</span>
					<a href="tel:0676428120" class="main-phone">067 642 81 20</a>
				</div>
			</div>
			<div class="popup-wrap">
			<div class="popup popup1">
				<div class="popup-close"></div>
				<h2>Выберите направление для заказа</h2>
				<div class="direction-list">
					<div class="direction-item">
						<div class="direction-item__popup">
							<strong>Химический состав воды, мг/л:</strong>
							<span>Калий</span>  <p>2–20</p> 
							<span>Фтор</span><p>0,6–1,2</p>
							<span>Кальций</span><p>25–80</p>
							<span>Йод</span><p>0,06</p>
							<span>Магний</span><p>5–50</p>
							<span>HCO3</span><p>30–400</p>
							<span>Общая минерализация</span><p>200–500 мг./л</p>
							<span>Общая жесткость</span><p>1,5–7 мг-экв./л</p>
						</div>
						<div class="direction-item__info"></div>
						<div class="direction-item__img">
							<div><img src="<?php echo get_field('img_aqua_star'); ?>" alt=""></div>
						</div>
						<span class="direction-item__button">Аквастар</span>
					</div>
					<div class="direction-item">
						<div class="direction-item__popup">
							<strong>Химический состав воды, мг/л:</strong>
							<span>Калий</span>  <p>2–20</p> 
							<span>Фтор</span><p>0,6–1,2</p>
							<span>Кальций</span><p>25–80</p>
							<span>Йод</span><p>0,06</p>
							<span>Магний</span><p>5–50</p>
							<span>HCO3</span><p>30–400</p>
							<span>Общая минерализация</span><p>200–500 мг./л</p>
							<span>Общая жесткость</span><p>1,5–7 мг-экв./л</p>
						</div>
						<div class="direction-item__info"></div>
						<div class="direction-item__img">
							<div><img src="<?php echo get_field('img_blago'); ?>" alt=""></div>
						</div>
						<span class="direction-item__button">Благодатна</span>
					</div>
					<div class="direction-item">
						<div class="direction-item__popup">
							<strong>Химический состав воды, мг/л:</strong>
							<span>Калий</span>  <p>2–20</p> 
							<span>Фтор</span><p>0,6–1,2</p>
							<span>Кальций</span><p>25–80</p>
							<span>Йод</span><p>0,06</p>
							<span>Магний</span><p>5–50</p>
							<span>HCO3</span><p>30–400</p>
							<span>Общая минерализация</span><p>200–500 мг./л</p>
							<span>Общая жесткость</span><p>1,5–7 мг-экв./л</p>
						</div>
						<div class="direction-item__info"></div>
						<div class="direction-item__img">
							<div><img src="<?php echo get_field('img_shop'); ?>" alt=""></div>
						</div>
						<span class="direction-item__button">Магазин</span>
					</div>
				</div>
			</div>
			</div>

			<div class="popup-wrap">
				<div class="popup popup2">
					<div class="popup-close"></div>
					<div class="form-list">
						<div class="form-item">
							<p class="form-item__title">Куда</p>
							<div class="form-item__wrap">
								<form action="" id="contact_form">
									<div class="form-item__field-wrap">
										<label>ФИО</label>
										<input type="text" name="fio" data-wm-text="10" value='Информация' placeholder="Информация" id="">
									</div>
									<div class="form-item__field-wrap">
										<label>НОМЕР ТЕЛЕФОНА</label>
										<input type="text" name="phone" data-wm-type="phone" id="" value='090970448' placeholder="090970448">
									</div>
									<div class="form-item__field-wrap">
										<label>АДРЕС</label>
										<input type="text" name="adress" data-wm-text="10" value='Информация' placeholder="Информация" id="">
									</div>
									<div class="form-item__field-wrap">
										<label>Email</label>
										<input type="text" name="mail" data-wm-type="mail" id="" value='Информация' placeholder="Информация">
									</div>
									<input type="submit" data-wm-order='save' value="СОХРАНИТЬ">	
								</form>
							</div>
						</div>
						<div class="form-item">
							<p class="form-item__title">Когда</p>
							<div class="form-item__wrap">
								<div class="when-wrap">
									<p class="when-wrap__title">ВРЕМЯ ДОСТАВКИ</p>
									<div class="when-select-wrap">
										<p class="when-select__item when-select__item--active">08:00-09:00</p>
										<div>
											<p class="when-select__item">09:00-10:00</p>
											<p class="when-select__item">10:00-11:00</p>
											<p class="when-select__item">11:00-12:00</p>
											<p class="when-select__item">12:00-13:00</p>
											<p class="when-select__item">13:00-14:00</p>
											<p class="when-select__item">14:00-15:00</p>
											<p class="when-select__item">15:00-16:00</p>
											<p class="when-select__item">16:00-17:00</p>
											<p class="when-select__item">17:00-18:00</p>
											<p class="when-select__item">18:00-19:00</p>
										</div>
									</div>
								</div>
								<div class="calendar-wrap">
									<div id="calendar"></div>
								</div>
							</div>
						</div>
						<div class="form-item">
							<p class="form-item__title">Сколько</p>
							<div class="form-item__wrap">
								<label for="" class="form-item__packet">
									<div></div>
									<p><?php echo get_field('start_desc'); ?><span><?php echo get_field('price_start'); ?></span></p>
								</label>
								<div class="card-wrap">
									<div class="card-wrap__left">
									 	<div><img id="current-order-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/direction1.png" alt=""></div>
									 </div>
									 <div class="card-wrap__right">
									 	<p class="card-wrap__title">Вода <p data-wm-water-title="true">Аквастар</p></p>
									 	<p class="card-wrap__sub-title"><?php echo get_field('single_desc'); ?><br><span data-wm-s2-prices></span></p>
									 	<div class="card-wrap__quantity">
									 		<p>Количество</p>
									 		<div>
									 			<div data-calc-attr="minus">-</div>
									 			<span data-calc-attr="count">1</span>
									 			<div data-calc-attr="add">+</div>
									 		</div>
									 	</div>
									 </div>
									 <p class="card-wrap__total">Общая сумма:<span></span> грн</p> 
								</div>
							</div>
						</div>
					</div>
					<div class="form-list__button-wrap">
						<span class="button" data-wm-go="step-3">ЗАКАЗАТЬ</span>
					</div>
				</div>
			</div>
			<div class="popup-wrap">
				<div class="popup popup3">
					<div class="popup-close"></div>
					<h2>Ваш заказ</h2>
					<div class="offer-wrap">
						<div class="offer-header">
							<div class="offer-header__item">Изображение</div>
							<div class="offer-header__item">Наименование</div>
							<div class="offer-header__item">Цена за единицу</div>
							<div class="offer-header__item">Кол-во</div>
							<div class="offer-header__item">Сумма</div>
						</div>

						<div class="offer-item wm-hid" data-wm-name="аквастар">
							<div class="offer-item__column">
								<div class="offer-item__img">
									<div><img src="<?php echo get_field('img_aqua_star'); ?>" alt=""></div>
								</div>
							</div>
							<div class="offer-item__column">
								<div>
									<h3>Вода “AQUASTAR”</h3>
									<p>Дата доставки: <p data-delivery-date></p></p>
								</div>
							</div>
							<div class="offer-item__column">
								<p><p data-price-single></p><span> грн</span></p>
								<p class="wm-hid" data-complect-first></p>
							</div>
							<div class="offer-item__column">
								<span data-itm-count></span>
							</div>
							<div class="offer-item__column">
								<p><p data-price-total></p><span> грн</span></p>
							</div>
						</div>

						<div class="offer-item wm-hid" data-wm-name="благодатна">
							<div class="offer-item__column">
								<div class="offer-item__img">
									<div><img src="<?php echo get_field('img_blago'); ?>" alt=""></div>
								</div>
							</div>
							<div class="offer-item__column">
								<div>
									<h3>Вода “БЛАГОДАТНАЯ”</h3>
									<p>Дата доставки: <p data-delivery-date></p></p>
								</div>
							</div>
							<div class="offer-item__column">
								<p><p data-price-single></p><span> грн</span></p>
								<p class="wm-hid" data-complect-first></p>
							</div>
							<div class="offer-item__column">
								<span data-itm-count></span>
							</div>
							<div class="offer-item__column">
								<p><p data-price-total></p><span> грн</span></p>
							</div>
						</div>

						<div class="offer-item wm-hid" data-wm-name="магазин">
							<div class="offer-item__column">
								<div class="offer-item__img">
									<div><img src="<?php echo get_field('img_shop'); ?>" alt=""></div>
								</div>
							</div>
							<div class="offer-item__column">
								<div>
									<h3>Вода “МАГАЗИН”</h3>
									<p>Дата доставки: <p data-delivery-date></p></p>
								</div>
							</div>
							<div class="offer-item__column">
								<p><p data-price-single></p><span> грн</span></p>
								<p class="wm-hid" data-complect-first></p>
							</div>
							<div class="offer-item__column">
								<span data-itm-count></span>
							</div>
							<div class="offer-item__column">
								<p><p data-price-total></p><span> грн</span></p>
							</div>
						</div>

						<div class="offer-bottom">
							<p><span>Адрес доставки: </span><span id="adress-rezult"></span></p>
							<div>
								<span>Итого: <p id="order-total"></p> грн</span>
								<p>Всего к оплате: <p id="order-total2"></p> грн</p>
							</div>
						</div>
					</div>
					<div class="popup-main-button">
						<span class="button" data-confirm-order="btn-3">Подтвердить</span>
					</div>
				</div>
			</div>
		</main>
	<script>
		let price_start = <?php echo get_field('price_start_system'); ?>;
		let ajaxUrl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
		let images = {
			'аквастар': '<?php echo get_field('img_aqua_star'); ?>',
			'благодатна': '<?php echo get_field('img_blago'); ?>',
			'магазин': '<?php echo get_field('img_shop'); ?>'
		};

		let priceListSystem = {
			'аквастар': <?php echo get_field('price_single_system_aq_star'); ?>,
			'благодатна': <?php echo get_field('price_single_system_blago'); ?>,
			'магазин': <?php echo get_field('price_single_system_shop'); ?>
		};

		let priceListClient = {
			'аквастар': '<?php echo get_field('price_single_aq_star'); ?>',
			'благодатна': '<?php echo get_field('price_single_blago'); ?>',
			'магазин': '<?php echo get_field('price_single_shop'); ?>'
		};

	</script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/app.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/wm_main.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/libs/calendar/js/calendar.js"></script>
</body>
</html>