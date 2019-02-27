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
			$order .= '&nbsp &nbsp' . mb_convert_case( $key, MB_CASE_TITLE, "UTF-8" ) . ' ( ';
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
    $emailTo = get_field( 'receive_post_mail', 7 );
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