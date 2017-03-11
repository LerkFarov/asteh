<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/m/mali13mx/asteh.su/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'asteh');

/** Имя пользователя MySQL */
define('DB_USER', 'roketD');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'X4jaTHJgHBnz1WMk');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'l+@Mocnt,85Ac?kydIJ;Ph`,yG!~$ &kp!U/qDGE=.@6|reg;^1}||L;%ns^~|]i');
define('SECURE_AUTH_KEY',  'aMg1?kOwNk -OX-&+:`c36Y[Z,}|g_O:J|7[4&E*G!wx>0tQz!uYag x>5~-iS-S');
define('LOGGED_IN_KEY',    'l%g3d6QRiJBHbTy]Ph%Dp-3Wpb|Q@_o+i=66nZQlTNe.q[@<*l!}Z>1%XsPIK!3a');
define('NONCE_KEY',        'f)CZ0NyF|$)I}4%)A=~zM9-qA*]#Hq6eR9&[n.u(U0H;M3SI;$3x&o|)%8tGA?o~');
define('AUTH_SALT',        'dFwB;2|[4H0PX`HmnZ/+agLwxY-ufO/9F+@L2+uzLu@eg-/2)t68rHV?oAej1|1m');
define('SECURE_AUTH_SALT', 'UZTEb1;/M?hh.I5~G@(2-+6xH:vZ*`+n(M6s;xu9<^qD]MoDa&M 5Ih27hAX`SoJ');
define('LOGGED_IN_SALT',   '%0KpE(i~.Gy}_yIndzaR#L4r]lt,Ah-Yc#$ O(vL]_U{.}q%D==GG1Z#C=7)g^WV');
define('NONCE_SALT',       'c&t?NC$BP !lSSG6R+cj99O.zqiNaBJK$Yu6WL?psw!I?7`*|M&TP|oVJ1Jy~V=m');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
