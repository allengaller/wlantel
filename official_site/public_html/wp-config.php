<?php
/** WordPress数据库的名称 */
define('DB_NAME', 'wlantel');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'QPWOei1029');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

define('AUTH_KEY',         '-53 -G0EGLB4+ w(9*R(<.G2%^w$pOQyIPqN0%]g>FHE-:n:ylkA&7Cq+GtX-BWx');
define('SECURE_AUTH_KEY',  'TI,U2bMGl4Lr>?>Lq(x_BZ?3R?%s [sFe[l=U*@_<>>Ncspe j0=uL#tc#vd6WN.');
define('LOGGED_IN_KEY',    'atAX%PN+7}oN!j<*e<O9ItoJv,Z#!{7B- <=lck.UA:PEG3.^,<s[)edYvM2j;r*');
define('NONCE_KEY',        'p#H/!8J4WCbT1LWP{]BS !$QXSA#~M-I6U;[yPT:ch-3g~Ys$n I(jvoLg&M:5-/');
define('AUTH_SALT',        '4,$HfDmyn+dD tsRd0X;8y6@G$b:@07[t>T[|.Vk)x4v8q -#p:s0[vYVvEK}R%J');
define('SECURE_AUTH_SALT', '?fTEh+DA9Xm_GSPpb#sp5*P;lfXq-J2a|`jm-6<#oYf3MiWD-sjAo9-&|:rL;U)-');
define('LOGGED_IN_SALT',   'caqJ7SUh6LihU;_6,.|hE90m#Qe5&]bBkwZ~mvz$ZP*6n%jPq&AZc3 &@<SCWW?+');
define('NONCE_SALT',       '`*6jm*XXMKy^<t,g+fpckSA[jDG3#?L!!.:|-B4Td+|]78K_M9k z76#c@(_,hIB');

$table_prefix  = 'wp_';

define('WPLANG', 'zh_CN');

define('WP_DEBUG', false);

if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');

