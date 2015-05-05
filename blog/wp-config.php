<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'business_blog');

/** MySQL database username */
define('DB_USER', 'business_u');

/** MySQL database password */
define('DB_PASSWORD', 'Reload2015');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         ':+HEk,S`%91>zgPmRethGkXK0x{5}uM>4Q<rn-@t-YBI$:J 9(LjY9M9-;^a;rUC');
define('SECURE_AUTH_KEY',  'uh<@s#0J%=O9{- CnJY([]-4ZJ3kC*.u+Ajkrk7+*U_1Y@`$Zv-n+ZFNvlgdI(X:');
define('LOGGED_IN_KEY',    'd5LCw(p(A|q`Fe`Ip zKp2X+#92r{8*sc<E4q6C!2HVf`X0|AljLtoE9G9M0Q+{-');
define('NONCE_KEY',        ' Z@OLq-KE}I{AW<i<*v#CyJC/KVgw;ZZ?bbOVPe$CWB|UT4C5F6(4RKQ$ qibPw=');
define('AUTH_SALT',        '5p5$7H$Saw0}wf.Q&+WFZsRf]yfDBl%!JRkdl6FDZ,V&UX%L`*cU1&<6N_dsjz^G');
define('SECURE_AUTH_SALT', 'B)y4}=Del3kFG(t+ut2.=e+Bhz|80{Hf`7k+/am9xH-K+<L5M%ut/={TM+1!SbQ!');
define('LOGGED_IN_SALT',   'g*n-je,H@;c9+f1>&)irR~8(#B=14.r+CBww.?-Hg4qT|+w,=</ao4M!~ )e;5f?');
define('NONCE_SALT',       '1VAz5h#r&$u%B<f,x;zCRu`p|4Uj2{Q]<D=unlA]9SnMpb2p:A%:!GT<,JN,7d;|');

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
