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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'news_db' );

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
define( 'AUTH_KEY',         '>L{Xn$ha?L{o%J^`+/w(-6~4:I>ghXd3ynH{s[j]d28D_<VVpwfUx@G#T[R0nn1P' );
define( 'SECURE_AUTH_KEY',  '4k,U{:|Y[5Js!Q{PDExoFRP>!9%(]JmhtxxzDsdI/-wcbmX3^;/|}%}>#n8aqNdr' );
define( 'LOGGED_IN_KEY',    'S0WM*v|AB!b[[waq_$]r EzEXhuyPk-=z{BQ&e$w3dekQ4Q$y=eXh}zOfW>Wq1oE' );
define( 'NONCE_KEY',        '{H{ik`>OO.|zO|c4f}7vbcz7ew$m%~U&(<l_i=;7OyrN|H(DfCSU.p4&|B `>g^F' );
define( 'AUTH_SALT',        'R@%jizo%FDC! Q#qp}:q_Y/DX~*pO[tDf+R%t$@$3:_@6u0pP0_g}.o4 W#5INv.' );
define( 'SECURE_AUTH_SALT', 'c99$oX>-QI^aT{EMgL%g3>z0iglr@(rG1(K}gZ,o:TEi=t/#)-[g>fy~K)+b]U 6' );
define( 'LOGGED_IN_SALT',   ']n9#Cj5K3)Y(5[.PxJ#-%_#7/=O]4VQS0ap7C-Yv2:i~]?tmsL8h)A1=j|Q>C1HQ' );
define( 'NONCE_SALT',       ';Tj7?#g>=g}<}oc6HZ*E*t!oQ0!yf;fci08,T46kma^V)[g4kz8Kt%L3as`)#[KR' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
