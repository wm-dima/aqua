<?php

$month_names = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];


function init(){
	global $wpdb;

	$wpdb->query('
		CREATE TABLE IF NOT EXISTS `' . $wpdb->dbname . '`.`' . $wpdb->prefix . 'wm_client_order` ( 
			`id` INT NOT NULL AUTO_INCREMENT , 
			`hash` CHAR(255) NULL UNIQUE , 
			`data` VARCHAR(1000) NOT NULL , 
			PRIMARY KEY (`id`) 
		) ENGINE = InnoDB;'
	);
	$wpdb->query('
		CREATE TABLE IF NOT EXISTS `' . $wpdb->dbname . '`.`' . $wpdb->prefix . 'client_json_order` (
			 `id` INT NOT NULL AUTO_INCREMENT , 
			 `json_order` TEXT(1024) NOT NULL , 
			 PRIMARY KEY (`id`)
		 ) ENGINE = InnoDB;'
	);
	$wpdb->query('
	CREATE TABLE IF NOT EXISTS `' . $wpdb->dbname . '`.`' . $wpdb->prefix . 'wm_client_order` ( 
		`id` INT NOT NULL AUTO_INCREMENT , 
		`hash` CHAR(255) NULL UNIQUE , 
		`data` VARCHAR(1000) NOT NULL , 
		PRIMARY KEY (`id`) 
	) ENGINE = InnoDB;'
	);
}

function order_process(){
	global $month_names;

	$res = str_replace('"', '', $_POST['data'] );
	$res = str_replace('\\', '"', $res );
	$data = json_decode( $res, true );
	$inserted_id = insert_order_to_db($data);
	$month = array_search($data['secondStep']['month'], $month_names) + 1 < 10 ? 
		 		'0' . ( array_search($data['secondStep']['month'], $month_names) + 1 ):
		 		array_search($data['secondStep']['month'], $month_names) + 1;

	$order = '';
	$order .= 'Заказчик: <br>';
	$order .= '      ФИО - ' . $data['secondStep']['fio'] . '<br>';
	$order .= '      Адрес - ' . $data['secondStep']['adress'] . '<br>';
	$order .= '      Телефон - ' . $data['secondStep']['phone'] . '<br>';
	$order .= '      Email - ' . $data['secondStep']['mail'] . '<br>';
	$order .= '      Время и дата: ' .  $data['secondStep']['time'] . '|' .
					 	$month
					 	. '.' .
					 	$data['secondStep']['day']
					 	. '.' .
					 	date('Y') .
					 	'<br>';
	$order .= '<br>Заказ: <br>';



	$exit = true;
	foreach ($data['firstStep'] as $key => $value) {
		if ($value['count'] != null) {
			$key == 'аквастар' ? $key = 'АКВА СТАР': '';
			$key = mb_strtoupper ($key);

			$exit = false;
			$order .= '      вода "'. mb_strtoupper ($key) . '" (' . $value['count'] . ' шт)';
			if ( $value['firstTimeComplect'] ) {
				$order .= ' + комплект на первый раз (1 бутыль воды бесплатно)';
			}
			$order .= '.';
		}
	}

	$order .= '<br> ID заказа: ' . $inserted_id;

	if ($data['secondStep']['payCart'] == true) {
		$order .= '<br> Оплата картой ';
	} else {
		$order .= '<br> Оплата наличными ';
	}

	$order .= '<br> К оплате - ' . get_price($data) . ' грн.';

	if ( $exit ) die;
	init();

    /* Отправляем нам письмо */
    $emailTo = [get_field( 'receive_post_mail', 7 ), $data['secondStep']['mail']];
    $subject = 'Заказ на воду!';
    $headers = "Content-type: text/html; charset=\"utf-8\"";
    $mailBody = $order;

    $send = wp_mail($emailTo, $subject, $mailBody, $headers);

    $liq_btn = create_liq_rtn($inserted_id);

	$response = [
		'success' => true,
		'liqbtn' => $liq_btn
	];

	echo json_encode($response);
	die;
}
add_action( 'wp_ajax_nopriv_send_order', 'order_process' );
add_action( 'wp_ajax_send_order', 'order_process' );

function insert_order_to_db($data){
	global $wpdb;

	$wpdb->query(
		$wpdb->prepare(
			"INSERT INTO " . $wpdb->prefix . "wm_client_order ( data ) VALUES ( %s )",
			json_encode( $data['secondStep'], JSON_UNESCAPED_UNICODE )
	    )
	);

	$inserted_id = $wpdb->insert_id;

	save_to_cookie();

	return $inserted_id;
}

function save_to_cookie(){
	global $wpdb;

	$the_hash = hash( 'haval128,3', 'lient_infp_' . $wpdb->insert_id );
	$wpdb->update( $wpdb->prefix . 'wm_client_order',
		array( 'hash' => $the_hash ),
		array( 'id' => $wpdb->insert_id )
	);
	setcookie( 
		'water_info', 
		$the_hash, 
		time()+60*60*24*380,
		'/'
	);
}

function get_price($data){
	$first_time = false;
	foreach ($data['firstStep'] as $key => $value) {
		if ($value['count'] != null) {
			$order .= '     ' . mb_convert_case( $key, MB_CASE_TITLE, "UTF-8" ) . ' ( ';

			$water_type = $key;
			$count = $value['count'];

			if ( $value['firstTimeComplect'] ) {
				$first_time = true;
			}
		}
	}
	switch ($water_type) {
		case 'аквастар':
			$the_price = get_field('price_single_system_aq_star', 7);
			break;
		case 'благодатна':
			$the_price = get_field('price_single_system_blago', 7);
			break;
		case 'магазин':
			$the_price = get_field('price_single_system_shop', 7);
			break;
	}


	if ($first_time) {
		$price = get_field('price_start_system', 7) * $count; 
	} else {
		$price = $count * $the_price;
	}
	return $price;
}

function create_liq_rtn($inserted_id){

	$res = str_replace('"', '', $_POST['data'] );
	$res = str_replace('\\', '"', $res );
	$data = json_decode( $res, true );

	$price = get_price($data);
	
	foreach ($data['firstStep'] as $key => $value) {
		if ($value['count'] != null) {
			$water_type = $key;
			$count = $value['count'];
			if ( $value['firstTimeComplect'] ) {
				$first_time = true;
			}
		}
	}

	$water_type == 'аквастар' ? $water_type = 'АКВА СТАР': '';
	$water_type = mb_strtoupper ($water_type);

	$priv_k = 'BQz0aArqe45bZNMNo5CepMXqYA1KBoD0Ck0ZjZX8';
	$json_string = '{"public_key":"i93907095182","version":"3","action":"pay",' .
					'"amount":"'.$price.'","currency":"UAH",'.
					'"description":"Замовлення - вода \"'.$water_type.'\" у кількості - ' . $count . ' шт';
	if ($first_time) {
		$json_string .= '(+ набір першого разу)';
	}
	$json_string .= '","sandbox":"1",';
	$json_string .= '"result_url":"' . get_page_link(65) . '",';
	$json_string .= '"server_url":"https://web-marketing.su/voocshop/wp-json/payment/v1/pay_responce?id='.$inserted_id.'"}';

	$data = base64_encode ( $json_string );
	$sign_string = $priv_k . $data . $priv_k;
	$signature = base64_encode( sha1( $sign_string, 1) );

	return '<form method="POST" action="https://www.liqpay.ua/api/3/checkout" accept-charset="utf-8"> 
			 <input type="hidden" name="data" value="'.$data.'"/> 
			 <input type="hidden" name="signature" value="'.$signature.'"/> 
			 <input type="image" src="//static.liqpay.ua/buttons/p1ru.radius.png"/> 
			</form>';
}

function liq_response( WP_REST_Request $request ){
	global $wpdb;
	$priv_k = 'BQz0aArqe45bZNMNo5CepMXqYA1KBoD0Ck0ZjZX8';
	
	$sign_string = $priv_k . $_POST['data'] . $priv_k;
	$signature = base64_encode( sha1( $sign_string, 1) );
	
	if ( $_POST['signature'] != $signature ) exit;
	
	$order = '<br>Заказ: ' . $request->get_param( 'id' ) . ' был оплачен.';

    /* Отправляем нам письмо */
    $emailTo = [get_field( 'receive_post_mail', 7 ), $data['secondStep']['mail']];
    $subject = 'Онлайн оплаза воды.';
    $headers = "Content-type: text/html; charset=\"utf-8\"";
    $mailBody = $order;

    $send = wp_mail($emailTo, $subject, $mailBody, $headers);
    if ( $send ) {
		$response = [
			'success' => true
		];
    }
	echo json_encode($response);
	die;
}

function get_info(){
	global $wpdb;
	$res = $wpdb->get_row(
		$wpdb->prepare(
			"SELECT data FROM " . $wpdb->prefix . "wm_client_order WHERE hash = %s ",
			$_POST['id']
	    ),
	    ARRAY_N
	);
	echo $res[0];
	die;
}
add_action( 'wp_ajax_nopriv_send_id', 'get_info' );
add_action( 'wp_ajax_send_id', 'get_info' );

add_action( 'rest_api_init', function () {
	register_rest_route( 'payment/v1', '/pay_responce', array(
		'methods'  => 'POST',
		'callback' => 'liq_response',
	) );
} );