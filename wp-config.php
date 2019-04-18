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
define( 'DB_NAME', 'vost' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'braux' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '2:4e$h(ryr}g@Ip0FKa03#y[LenJC%M4jUW`So%.WH&m/Q}c]&O|hA=59XEb&+U;' );
define( 'SECURE_AUTH_KEY',  '4A0fo&MH)C4H]00cvJrC4xWrgCG*M:[k)jrM0>q9+]w5IhD%ph#An0DK+TC9{X[x' );
define( 'LOGGED_IN_KEY',    'j#*QY#AN[bH/y>X= 4z?=qQaO1KG~ Eu(kR91nNK2/A&xN8K}LAAlPt,AB!,x5/5' );
define( 'NONCE_KEY',        '}0@IKX5f<b.GVJVK/i|Z}FYl7,}c#s@s2s<I2K]{,Y/HS|{c&:6/wG16hYqo^sE[' );
define( 'AUTH_SALT',        'i pb?FBY+.]Q*`h0QI@)Y2)*|2/1lg l}ulx:sd_!_* }2o<by}]ZNS3~+S^z7l7' );
define( 'SECURE_AUTH_SALT', 'f<JBK?pGUALZ+#e/(VWPJ7!Rx-fb#+oG2qs,nc6EC1KDm$7vUYq!R67Z}mbCN=fS' );
define( 'LOGGED_IN_SALT',   'sBZE&rFK|Hq#xw-8V[1yPSES~!n7eEf[l%&4S2%3wR1E;}$O^XLvNx_Q+QJ1t4WB' );
define( 'NONCE_SALT',       'wl]9u{cGZRE]jbJK{;}NWb?NA|nBQh9w!.$s=g&R$leCJrR{iD6*Pl?+vw:0fQcM' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

