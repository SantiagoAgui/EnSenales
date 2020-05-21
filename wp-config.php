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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'armero' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'pBg4mh$?{J@ EqLpqC#?#n8>p&{GoeUk,Rd[L89^Q9Vl|4Eb|p)#Lk2VXb]oICcj' );
define( 'SECURE_AUTH_KEY',  'WseUzHUCw8UlTW?6IrtIpq01)Z4$t4LU-*!ryN% C7tUsn(EWV=h>d|:Voe8l7vo' );
define( 'LOGGED_IN_KEY',    ')P-mM]{Ol/}=X^.H:GY&$zYHfJ]j)qZUgdwF]1=X1As9]H^~!YwWq&nGQly&NMWG' );
define( 'NONCE_KEY',        'Luxf2}6Bc<Hm[}*_`4l3U@s. iz{%_>#o~KerL#2IKSGjf1^*AR%e,czTZ^7jh9B' );
define( 'AUTH_SALT',        '1+Cj<|RJ3#g@&-7X5NfhU4df0ezu7D;%UvnNS;?EY|lVNscW&Du|OK?O58{xk+wK' );
define( 'SECURE_AUTH_SALT', '$[jp@(qF>(nF5/+QSMyDbyQwf>vb7F 8 %?iM>FU!#pvl)lw6moFN1<l/|a`9PrE' );
define( 'LOGGED_IN_SALT',   '^%@u%x5N7AUlz=^Icq`LUFG|fA0`NQ65~^23^3Tr;q??Eb~)|JHT}q9Vbo5`&+Ko' );
define( 'NONCE_SALT',       'k~dRoV8I%g-D5tnZwL*n;SinU3|b2ehuCy,NW@~1X4eusRv!II,3SHu?LtKt{*|{' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
