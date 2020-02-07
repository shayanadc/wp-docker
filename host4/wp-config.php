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
define('DB_NAME', 'wp_host4');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', '123');

/** MySQL hostname */
define('DB_HOST', 'db');

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
define('AUTH_KEY',         'HoaQF6Eh3y?YramG_Ng(vwYKWhs:<<y3[7rr?De}s,u5X2kj_,7%Z/IxbVO3ds.>');
define('SECURE_AUTH_KEY',  '}N&wYX%.J%!_PN8w,L!{I5JP6+v{1%zjTBl<wj.q~XgAJwGrO*@VF7[54l_u{`;4');
define('LOGGED_IN_KEY',    'jLJnbbso6M?7/kEgo<`5,;DV=LWZ<s7sl^Fi52/NV8Rhh4d92c.{LwoK5[>bc]Ox');
define('NONCE_KEY',        '|FDx<JPG/yEp>P^`iTm*J#VAi}-8_5y=?~G0)@blCB)hl7EcrCJy}3,uB{G^##]!');
define('AUTH_SALT',        'L}?@FLZw&IXF]qY-+x],]LoXO`@k%O+dxCKCZN@znt7%6u@7QlbpaPQGd*mt|;={');
define('SECURE_AUTH_SALT', 'WE>GWM;B(c[&pyy.Kzl~=$vgw|zrl|K1QkW$+A/e(JzNDD([iOD[U3c7HDgCP|t2');
define('LOGGED_IN_SALT',   '(>DBjPsQTh4^Ila4bmD3#@C @Ono>&XW{T@1,~gx7Y3=Z|X*;S{D5 |dOd.[/^j:');
define('NONCE_SALT',       '_d~27DFM,1!8<,Dq#j `|[%sV{-R.GlHQ}G@IR6]aj&Fq=eW@fC*GsN/=*0b$ si');

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
