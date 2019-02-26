<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'aqua_star' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'h3EJ)dzBTpgh1Ag-t5w2VZPH;A-4PbR|HpMMm~&u?<f)#Uz4lr[@7w;OQ$;{y)Tb' );
define( 'SECURE_AUTH_KEY',  'R{,Fd!KU~f75I-BjQNU[}l`_/Ff`LSq1W2lba5x?O0N*|#6D,2`W:{pKgSAubrjX' );
define( 'LOGGED_IN_KEY',    'X2,o;|e]XY ^e+7xX)XzK[JG4QpR}uW/oYY|;m$]f9b9M4gfr+wMFB,o2XR0 [T6' );
define( 'NONCE_KEY',        '<o5]qO!^L(FQ,$6&<`&C}&S|Ami;Xv|*Koy|t^6qDA&+4(#fms!yL)/o6Xy+^6]6' );
define( 'AUTH_SALT',        '2${xE_Qm^aW[Q5(~-gP @FKQPl`V^c6;-rZf0qbazm(7Gi3d/`Xr:1E}eCeWVn,Y' );
define( 'SECURE_AUTH_SALT', 'Cg(E7Uh=`2?m{CY<?/VkP!~OEuo7JU[oMPWvs:79jHtF}!*}l&vG q3>IE<Fo9^i' );
define( 'LOGGED_IN_SALT',   'mGX1ZHZcf8Uo7QOKtAp.]._9ID!-,_nHy^$s23;kh[Z2W5u$Bh%simW=bIcI>:%Z' );
define( 'NONCE_SALT',       'nuA5eU$4?u=|qYl`f;,:L*N.&@|{of%dZ*bw[E5J_MA$*xL/?aK87,{bL/Qtw]Hg' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
