<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'youngershen_com');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '7#Db|5s,J|_.qfC 8ruy&]_SS,ZO)l+LVS=%k9>.,Ae/=,C# U:z@+jurFhuUmh-');
define('SECURE_AUTH_KEY',  ']ozv1{5*7}^^sZxf$2O5E))Cxvmc|ZW-{-l!7S%v+2JQZ_+qrD]!!L/Y//ezM5g6');
define('LOGGED_IN_KEY',    '1+tee-_w]631u|d3Aq,@S%=p8WEP@J=RyNH*uYKs)Dd9HJ.<Ms.]Va.lMF{?8Up<');
define('NONCE_KEY',        '++7knoBc2s}/W[9JcgxBA[&MLeSUgz#-HuAU~[lQgHYGYm1oBOY)BIV>jSWulhzi');
define('AUTH_SALT',        's3~zxaVuCD<OKYXtV$*(Ui`D`GN-k&v_)hw.+KeFMih_gw+M*c[4U|RfLM Sf>#?');
define('SECURE_AUTH_SALT', 'hc%L*c6C<-iQgtt =8y-/Ij$iIEjW+sC8@U0%[zh.r?,^A:2lM^xksr}0CXg*]((');
define('LOGGED_IN_SALT',   'ygezy)`|&E|~MGlfB+>--C_Vq|t5oU7B4Dl`FOfKegdmu|q,-md+n!u-9+j/+>#n');
define('NONCE_SALT',       '/3FR3F-{z18M|1/5X[<+B(,U>[3@{Yw$RG/FmM-V<*>W%B`6/|+6=Vw&1w9E+0Q-');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
