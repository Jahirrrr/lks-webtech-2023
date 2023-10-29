<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '10_cms_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'u5}bQ|P,Uq~T+0 =96x?a`C_xIV)1FG`T+Dt8KUmW5k  ,EiZJ^+v2&aNGQ%Rdjc' );
define( 'SECURE_AUTH_KEY',  'ZW0~Ck[c)]Mblw.2aQrt=KKx&._%!u@: }-|Fs:yG//0E:H,1Vgf5_/O*`HZ2pn8' );
define( 'LOGGED_IN_KEY',    '[~CG9Lw%@>C}8g1ZX9RAOR/)wZw&b;e.*s8=fXbR@sd&{c+8_am2Uzq{f}!)4y^P' );
define( 'NONCE_KEY',        'B(:(hjf19z5luW=AW(a6#(}E#65uyEcs!zFFrUZcSZ8*B,:FgWF4Tl:kWl7^?r w' );
define( 'AUTH_SALT',        '4Ecpq5n!z!GxTA} mILi]WY<osYc-lL&T6e:7}L]ZwbFLtIqBp<TK/`e5P}xXXGX' );
define( 'SECURE_AUTH_SALT', 'MXcz|G2n;d  <7v}ups1]cAmt)$iTM<0JWJ:HeqVuw3(#TC$t2G_08vc>##z2ag`' );
define( 'LOGGED_IN_SALT',   '8W0_D<A 0Ql}@^m.wTC@R$y6<6X2q5)C7K]0>hP]r)B~!1b55^ldF6HF:K@;gjd+' );
define( 'NONCE_SALT',       'sstxu g;9Ivc>5]Y`OnPSAXl3~y@s+=4*@j?aZ|v3)1(j~pEOoJe_7xlL<d7crN]' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
