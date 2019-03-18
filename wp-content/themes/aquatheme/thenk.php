<?php
/*
Template Name: Спасибо
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta charset="utf-8">
  		<style>html{margin-top: 0px !important}</style>
	</head>
	<body>
		<main class='main--active'>
			<div class="blur"></div>
			<div class="main-screen">
				<div class="logo"><img src="<?php echo get_field('logo', 7); ?>" alt=""></div>
				<div class="center-wrap">
					<h1>Доставка воды</h1>
					<p class="main-sub-title"><?php echo get_field('text_1', 7) ?></p>
					<span class="button--main" id="start-order"><?php echo get_field('text_2', 7) ?></span>
					<a href="tel:<?php echo str_replace ( ['(', ')', ' ', '-', '+'], '', get_field('the_phone', 7) ); ?>" class="main-phone"><?php echo get_field('the_phone', 7); ?></a>
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
							<div><img src="<?php echo get_field('img_aqua_star', 7); ?>" alt=""></div>
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
							<div><img src="<?php echo get_field('img_blago', 7); ?>" alt=""></div>
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
							<div><img src="<?php echo get_field('img_shop', 7); ?>" alt=""></div>
						</div>
						<span class="direction-item__button">Магазин</span>
					</div>
				</div>

				<div class="swiper-container">
				    <div class="swiper-wrapper">
				    	<div class="swiper-slide">
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
				    				<div><img src="<?php echo get_field('img_aqua_star', 7); ?>" alt=""></div>
				    			</div>
				    			<span class="direction-item__button">Аквастар</span>
				    		</div>
				    	</div>
				    	<div class="swiper-slide">
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
				    				<div><img src="<?php echo get_field('img_blago', 7); ?>" alt=""></div>
				    			</div>
				    			<span class="direction-item__button">Благодатна</span>
				    		</div>
				    	</div>
				    	<div class="swiper-slide">
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
				    				<div><img src="<?php echo get_field('img_shop', 7); ?>" alt=""></div>
				    			</div>
				    			<span class="direction-item__button">Магазин</span>
				    		</div>
				    	</div>
				    </div>
				     <div class="swiper-button-prev"></div>
   					 <div class="swiper-button-next"></div>
				</div>

			</div>
			</div>

			<div class="popup-wrap">
				<div class="popup popup2">
					<div class="popup-close"></div>
					<div class="form-list">
						<div class="form-item wm-min-hid" data-second-step="2">
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
						<div class="form-item wm-min-hid" data-second-step="1">
							<p class="form-item__title">Когда</p>
							<div class="form-item__wrap">
								<div class="when-wrap">
									<p class="when-wrap__title">ВРЕМЯ ДОСТАВКИ</p>
									<div class="when-select-wrap">
										<p class="when-select__item when-select__item--active"><?php echo get_field('default_time', 7); ?></p>
										<div class="wm-select-time">
											<?php 
												$delivery_time = get_field('delivery_time', 7);
												foreach ($delivery_time as $key => $value) :
											?>
												<p class="when-select__item"><?php echo $value['the_time']; ?></p>
											<?php endforeach ?>
										</div>
									</div>
								</div>
								<div class="calendar-wrap">
									<div id="calendar"></div>
								</div>
							</div>
						</div>
						<div class="form-item wm-min-hid" data-second-step="0">
							<p class="form-item__title">Сколько</p>
							<div class="form-item__wrap">
								<label for="" class="form-item__packet before-none">
									<div></div>
									<p><?php echo get_field('start_desc', 7); ?><span><?php echo get_field('price_start', 7); ?></span></p>
								</label>
								<div class="card-wrap">
									<div class="card-wrap__left">
									 	<div><img id="current-order-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/direction1.png" alt=""></div>
									 </div>
									 <div class="card-wrap__right">
									 	<p class="card-wrap__title">Вода <p data-wm-water-title="true">Аквастар</p></p>
									 	<p class="card-wrap__sub-title"><?php echo get_field('single_desc', 7); ?><br><span data-wm-s2-prices></span></p>
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
						<span class="button--back" data-wm-step-back><strong>Вернуться</strong> назад</span>
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
									<div><img src="<?php echo get_field('img_aqua_star', 7); ?>" alt=""></div>
								</div>
							</div>
							<div class="offer-item__column">
								<div>
									<h3>Вода “AQUASTAR”</h3>
									<p>Дата доставки: <p data-delivery-date></p></p>
									<p class="wm-hid" data-complect-first>Бутыль + помпа</p>
								</div>
							</div>
							<div class="offer-item__column">
								<p><p data-price-single></p><span> грн</span></p>
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
									<div><img src="<?php echo get_field('img_blago', 7); ?>" alt=""></div>
								</div>
							</div>
							<div class="offer-item__column">
								<div>
									<h3>Вода “БЛАГОДАТНАЯ”</h3>
									<p>Дата доставки: <p data-delivery-date></p></p>
									<p class="wm-hid" data-complect-first>Бутыль + помпа</p>
								</div>
							</div>
							<div class="offer-item__column">
								<p><p data-price-single></p><span> грн</span></p>
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
									<div><img src="<?php echo get_field('img_shop', 7); ?>" alt=""></div>
								</div>
							</div>
							<div class="offer-item__column">
								<div>
									<h3>Вода “МАГАЗИН”</h3>
									<p>Дата доставки: <p data-delivery-date></p></p>
									<p class="wm-hid" data-complect-first>Бутыль + помпа</p>
								</div>
							</div>
							<div class="offer-item__column">
								<p><p data-price-single></p><span> грн</span></p>
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
								<span>Итого: <span id="order-total"></span> грн</span>
								<p>Всего к оплате: <span id="order-total2"></span> грн</p>
							</div>
						</div>
					</div>
					<div class="popup-main-button">
						<span class="button--back" data-confirm-order-back><strong>Вернуться</strong> назад</span>
						<span class="button" data-confirm-order="btn-3">
							Оплатить
							<div id="pay-btn" class="wm-hid"></div>
						</span>
					</div>
				</div>
			</div>
			<div class="popup-wrap" data-popup-thenk>
				<div class="popup popup4">
					<div class="popup-close"></div>
					<h2>Спасибо за заказ!</h2>
					<span class='button' data-close-thenk>НА ГЛАВНУЮ</a>
				</div>
			</div>
		</main>

	<script>
		document.querySelector('[data-popup-thenk]').classList.add('popup-wrap--active');
		document.querySelector('[data-close-thenk]').addEventListener('click', goMainPahe);
		document.querySelector('.popup4 .popup-close').addEventListener('click', goMainPahe);
		document.addEventListener('click', function(e){
			if (e.target.closest('.popup4') == null) goMainPahe();
		});
		function goMainPahe(){
			window.location.href = '<?php echo get_home_url(); ?>';
		}
	</script>
</body>
</html>