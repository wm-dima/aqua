<?php

function order_process(){
	$res = str_replace('"', '', $_POST['data'] );
	$res = str_replace('\\', '"', $res );
	$data = json_decode( $res, true );
	$order = '';
	$order .= 'Заказчик: <br>';
	$order .= '&nbsp &nbsp ФИО - ' . $data['secondStep']['fio'] . '<br>';
	$order .= '&nbsp &nbsp Адрес - ' . $data['secondStep']['adress'] . '<br>';
	$order .= '&nbsp &nbsp Телефон - ' . $data['secondStep']['phone'] . '<br>';
	$order .= '&nbsp &nbsp Email - ' . $data['secondStep']['mail'] . '<br>';
	$order .= '<br>Заказ: <br>';

	$exit = true;
	foreach ($data['firstStep'] as $key => $value) {
		if ($value['count'] != null) {
			$exit = false;
			$order .= '&nbsp &nbsp ' . mb_convert_case( $key, MB_CASE_TITLE, "UTF-8" ) . ' ( ';
			if ( $value['firstTimeComplect'] ) {
				$order .= 'комплект на первый раз, ';
			}
			$order .= 'вода "'. $key . '" (' . $value['count'] . ' шт.) )';
		}
	}
	if ( $exit ) {
		die;
	}
	if ( !isset($_COOKIE['water_info'] ) ) {
		global $wpdb;
		$res = $wpdb->query('
			CREATE TABLE IF NOT EXISTS `' . $wpdb->dbname . '`.`' . $wpdb->prefix . 'wm_client_order` ( 
				`id` INT NOT NULL AUTO_INCREMENT , 
				`hash` CHAR(255) NULL UNIQUE , 
				`data` VARCHAR(1000) NOT NULL , 
				PRIMARY KEY (`id`) 
			) ENGINE = InnoDB;'
		);
		$wpdb->query(
			$wpdb->prepare(
				"INSERT INTO " . $wpdb->prefix . "wm_client_order ( data ) VALUES ( %s )",
				json_encode( $data['secondStep'], JSON_UNESCAPED_UNICODE )
		    )
		);
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

    /* Отправляем нам письмо */
    $emailTo = [get_field( 'receive_post_mail', 7 ), $data['secondStep']['mail']];
    $subject = 'Заказ на воду!';
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

add_action( 'wp_ajax_nopriv_send_order', 'order_process' );
add_action( 'wp_ajax_send_order', 'order_process' );

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

function get_liq_btn() {
	global $wpdb;

	$res = $wpdb->query('
		CREATE TABLE IF NOT EXISTS `' . $wpdb->dbname . '`.`' . $wpdb->prefix . 'wm_client_order` ( 
			`id` INT NOT NULL AUTO_INCREMENT , 
			`hash` CHAR(255) NULL UNIQUE , 
			`data` VARCHAR(1000) NOT NULL , 
			PRIMARY KEY (`id`) 
		) ENGINE = InnoDB;'
	);
	$res = $wpdb->query('
		CREATE TABLE IF NOT EXISTS `' . $wpdb->dbname . '`.`' . $wpdb->prefix . 'client_json_order` (
			 `id` INT NOT NULL AUTO_INCREMENT , 
			 `json_order` TEXT(1024) NOT NULL , 
			 PRIMARY KEY (`id`)
		 ) ENGINE = InnoDB;'
	);
	$res = str_replace('"', '', $_POST['data'] );
	$res = str_replace('\\', '"', $res );
	$data = json_decode( $res, true );

	$wpdb->query(
		$wpdb->prepare(
			"INSERT INTO " . $wpdb->prefix . "wm_client_order ( data ) VALUES ( %s )",
			json_encode( $data['secondStep'], JSON_UNESCAPED_UNICODE )
	    )
	);
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

	$fio    = $data['secondStep']['fio'];
	$adress = $data['secondStep']['adress'];
	$phone  = $data['secondStep']['phone'];
	$mail   = $data['secondStep']['mail'];
	$exit = true;
	$first_time = false;
	foreach ($data['firstStep'] as $key => $value) {
		if ($value['count'] != null) {
			$exit = false;
			$order .= '&nbsp &nbsp' . mb_convert_case( $key, MB_CASE_TITLE, "UTF-8" ) . ' ( ';

			$water_type = $key;
			$count = $value['count'];

			if ( $value['firstTimeComplect'] ) {
				$first_time = true;
			}
		}
	}
	if ( $exit ) {
		die;
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

	$price = $count * $the_price;
	if ($first_time) {
		$price += get_field('price_start_system', 7); 
	}

	$wpdb->query(
		$wpdb->prepare(
			"INSERT INTO " . $wpdb->prefix . "client_json_order ( json_order ) VALUES ( %s )",
			json_encode( $_POST['data'], JSON_UNESCAPED_UNICODE )
	    )
	);

	$priv_k = 'BQz0aArqe45bZNMNo5CepMXqYA1KBoD0Ck0ZjZX8';

	$json_string = '{"public_key":"i93907095182","version":"3","action":"pay",' .
					'"amount":"'.$price.'","currency":"UAH",'.
					'"description":"Замовлення - вода \"'.$water_type.'\" у кількості - ' . $count . ' шт';
	if ($first_time) {
		$json_string .= '(+ набір першого разу)';
	}
	$json_string .= '","sandbox":"1",';
	$json_string .= '"result_url":"' . get_page_link(65) . '",';
	$json_string .= '"server_url":"https://web-marketing.su/voocshop/wp-json/payment/v1/pay_responce?id='.$wpdb->insert_id.'"}';

	$data = base64_encode ( $json_string );
	$sign_string = $priv_k . $data . $priv_k;
	$signature = base64_encode( sha1( $sign_string, 1) );

	$response = [
		'success' => true,
		'data' => '<form method="POST" action="https://www.liqpay.ua/api/3/checkout" accept-charset="utf-8"> 
			 <input type="hidden" name="data" value="'.$data.'"/> 
			 <input type="hidden" name="signature" value="'.$signature.'"/> 
			 <input type="image" src="//static.liqpay.ua/buttons/p1ru.radius.png"/> 
			</form>'
	];

	echo json_encode($response);
	die;
}

add_action( 'wp_ajax_nopriv_prepare_liq_btn', 'get_liq_btn' );
add_action( 'wp_ajax_prepare_liq_btn', 'get_liq_btn' );


// Регистрирует маршрут
add_action( 'rest_api_init', function () {
	register_rest_route( 'payment/v1', '/pay_responce', array(
		'methods'  => 'POST',
		'callback' => 'my_rest_api_func2',
	) );
} );

function my_rest_api_func2aaa(){
	echo "string";
	die;
}

function my_rest_api_func2( WP_REST_Request $request ){
	global $wpdb;
	$priv_k = 'BQz0aArqe45bZNMNo5CepMXqYA1KBoD0Ck0ZjZX8';
	
	$sign_string = $priv_k . $_POST['data'] . $priv_k;
	$signature = base64_encode( sha1( $sign_string, 1) );
	
	if ( $_POST['signature'] != $signature ) exit;
	
	$res = $wpdb->get_row(
		$wpdb->prepare(
			"SELECT json_order FROM " . $wpdb->prefix . "client_json_order WHERE id = %s ",
			$request->get_param( 'id' )
	    ),
	    ARRAY_N
	);

	$res = str_replace('"', '', $res );
	$res = str_replace('\\', '"', $res );
	$res = str_replace('"""', '"', $res );
	$data = json_decode( $res[0], true , JSON_FORCE_OBJECT );

	$order = '';
	$order .= 'Заказчик: <br>';
	$order .= '&nbsp &nbsp ФИО - ' . $data['secondStep']['fio'] . '<br>';
	$order .= '&nbsp &nbsp Адрес - ' . $data['secondStep']['adress'] . '<br>';
	$order .= '&nbsp &nbsp Телефон - ' . $data['secondStep']['phone'] . '<br>';
	$order .= '&nbsp &nbsp Email - ' . $data['secondStep']['mail'] . '<br>';
	$order .= '&nbsp &nbsp Время и дата: ' .  $data['secondStep']['time'] . '<br>';
	$order .= '<br>Заказ: <br>';

	// $exit = true;
	foreach ($data['firstStep'] as $key => $value) {
		if ($value['count'] != null) {
			// $exit = false;
			$order .= '&nbsp &nbsp вода "'. $key . '" (' . $value['count'] . ' шт)';
			if ( $value['firstTimeComplect'] ) {
				$order .= ' + комплект на первый раз';
			}
			$order .= '.';
		}
	}
	// if ( $exit ) {
		// die;
	// }


    /* Отправляем нам письмо */
    $emailTo = [get_field( 'receive_post_mail', 7 ), $data['secondStep']['mail']];
    $subject = 'Заказ на воду!';
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
