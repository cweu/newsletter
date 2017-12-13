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
define('DB_NAME', 'OnWeb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '|O5xMpbb_qs,2&u~xnw1#{q@`*8z7=CJpgN.lqk,*S:V12YLILh+M&-zy[YWvBW_');
define('SECURE_AUTH_KEY',  '1xP<U>vI#qdR+5l=Yifx{&(n^V,Ro>lE|Ug:@mMAPag3?e`FlJmn4^ a|`oWf&0_');
define('LOGGED_IN_KEY',    '43%6f&!w=G/uE#``P~sQU@1%*<j. ID.U2(>o,[p55T(I-#zegQblHOq*Hz0)`^?');
define('NONCE_KEY',        'Tx:uH(Cvu3pg&|_ ^pitI~,h1@%54ll*s0uR@$N33-5D*d[6fP<6g(;*R}@;fc][');
define('AUTH_SALT',        '%f|bsx:gwn.lLq2fs07isPy=&W%)3lu4i}ekU2YO$lE,!&{Y!L&8&iAU1Ip5*XtJ');
define('SECURE_AUTH_SALT', 'BCJQ>{h`y1xnu9dw+g~_sDTyfwFJq2C?KL_qIzS=rp7Lt{`CjNE<O{X;SABn8D*v');
define('LOGGED_IN_SALT',   'CA7O1yhXWhkfA0}$Jj!uiygzR-7foc+%t_HvD0x)gFT5Ia?o-Y2.kT[@PB2N>aCK');
define('NONCE_SALT',       'U}9r5gM{. +kn/|jI+87VP5z =NVj8,~ds8ql~HKdUh9f$]Br#do;8K9>+4:nG4e');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'OnWeb_';

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
