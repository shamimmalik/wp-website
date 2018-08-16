<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'honeymoons_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'j}<Hr[?eZ.*$C +uQ9IC[zTQO9Ddy*e(!F9L-)x76@g83$xyxZ]~$?[c|4K}igc7');
define('SECURE_AUTH_KEY',  'z@G]DO/AStH[V?Tag;VAPIwa9[chC-3r4QppF&2WW8T>{w?`%ew8;m0AaO{ XjWP');
define('LOGGED_IN_KEY',    '-ikGr8,GY;c,>FLC(=[_V+np!pE~9X`BeU9lo2W(!Fqn(cC,eJ&<2{C[ZdGBb}8Y');
define('NONCE_KEY',        'Xi6R#VWu/P_gz;Z_@hDX46@4$i)k1dD54h<ZOYjjma%Ha`|5bzn]VI^,ZGiW/C!W');
define('AUTH_SALT',        '2eLXXa}.2L(0lO ^g{>RRXb/XG=<oz|PrqJSEpdOEA83f$in.Vs9rmUwks$fN=B8');
define('SECURE_AUTH_SALT', 'fUUcX}7eKIC<m{_X(!hW71:q$1442~m%CNW~`vzR@[o_p>Pm_&a_&;&!a.$~@uC3');
define('LOGGED_IN_SALT',   '[9YbwjyAut{/#5-%5f8.ric|PNPdes4`xD4/w38YSP.=U;i`lAa$=,%n|$+jdE55');
define('NONCE_SALT',       '.LjK`3d=$i)KR/G]X$(t4!qRl:[g|V79bPd@=nxwl]i}TI9nsgK>_y9WzQgg#Q2P');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
