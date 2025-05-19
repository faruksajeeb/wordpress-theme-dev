<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress-blog' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'yE_2_mIL]EMX12oA&up1hTV>spl($$>DGd?T!0$l013F*-.TMS3EyCwonzRS@#3[' );
define( 'SECURE_AUTH_KEY',  '<,u05MnQK]?pfoH^f#b _l^2PBRfTW O)-`fg*ihh{ae2KHB,V6DIKW0~zVt>@FT' );
define( 'LOGGED_IN_KEY',    'h_9m24xtWww=gGrJX?hHLJ3XqY^01?p[^2T)jmt*UMQ(7_Y,|pD]Jafo?^AH-C0J' );
define( 'NONCE_KEY',        'CnjjBgHiR=qA*,3C^k`~A$vclF(?ST{YCViuae>c`!vuq{+Cr)ERM@]>tZ+Ju+9Z' );
define( 'AUTH_SALT',        '+s2Qf3.l3%~pB5YbcnnH0Qh_j/v(fk+SHo<GS^^>pgwpJqte]0Niu5Z# InY=2[u' );
define( 'SECURE_AUTH_SALT', 'h7Q,t@[bS9s5Qc,r+/$#mGpSq9A<v)8K+C@2Bq627VV3`-26^zRfL)ETJ->z;L:f' );
define( 'LOGGED_IN_SALT',   '@rUq%Kzu6c4D[@/A!5s9qm9Ul`hAdvi,kc$d;__}Euj<{+=V-t[*5fOt3G:J3@rj' );
define( 'NONCE_SALT',       ' :5Sk2E?&{mh8RYB>REX~IU9!j)H6FnJ-`#FvbK]NWRRm4w`noQ:(/$%BWtRN)cT' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'blog_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
