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
define('DB_NAME', 'usainv');

/** MySQL database username */
define('DB_USER', 'usainvestmentpro');

/** MySQL database password */
define('DB_PASSWORD', 'GE$ag4sA$Wgaw4g');

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
define('AUTH_KEY',         'IQp%zY:;&j_wkd U]VzBNiNzI!zRx_j6(%:+b]6g%~OK{lp2=1FcbC:K^%]LjGeW');
define('SECURE_AUTH_KEY',  'I_fr^epSbrwU:=,>jc.]Y~ Wl@7%$<v;K6t:~S>]!sveckt/T 2[Ri$#KLW;bDaz');
define('LOGGED_IN_KEY',    '+*S}HF=>Y. w2&jD}+C&c_7-(G62H2G%nqO[lCguJKdKr#HiDqjG *XCmVGLd9do');
define('NONCE_KEY',        'p-IXG@Yae!+WbzWSc9k,m^yJD7t[F()@X|qU4:w&GVT(~q5dEcz%R9f|B)B~]@iS');
define('AUTH_SALT',        '{oO0jV[&0Pzc4_&M,K*6xN,v;,3M_qZhco8DD]QWV^^:n ]uvb@Y9ec?JNAt+nV#');
define('SECURE_AUTH_SALT', 's9 Bj%ks_{LO,apcaw^ek<6e5WVhast0$T|UK-&%asocDbgaVBVUX7+ey@$N~#v`');
define('LOGGED_IN_SALT',   '3l.,%gAPj)K4{?!B3{>#(0|a?ugA,9=DRDLZ$wxw<ko`P,Rak-tC9&!HEIw?mh}n');
define('NONCE_SALT',       'r)}4izA|c#S *`C&~YcJCS|Cj%$+b=[pC+=uaK>zH(Z`Vr& )^TT dQLRm~<AP4u');

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
define('WP_DEBUG', true);

define('FS_METHOD', 'direct');
define('WP_DEBUG', false);
define('WP_HOME','https://israelamerica.co.il/' );
define('WP_SITEURL','https://israelamerica.co.il/' );
define('CURRENT_WEBSITE_DIR', '/var/www/israelamerica.co.il');
define('CURRENT_WEBSITE_HOST', 'israelamerica.co.il');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
