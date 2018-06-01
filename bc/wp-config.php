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
define('DB_NAME', 'sushiexperience');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         't35|8U4-sk--5vC]OzC?%SP+(1E-1#KXe,V+WItmjnmFs,Y 7iNHuk|HNW>][OY-');
define('SECURE_AUTH_KEY',  '-8UA4a*4N.h$v[:EG(Er=MA7@|zEG$.O9Eif1~$Vdb3nu`vrv-U?@L!p|TcO]Bgc');
define('LOGGED_IN_KEY',    '=rysP#,n@d>Tdp-:tN9U?0r@Tm^dV7ctGX<<0<8-TXxeGe$kzYn*xhR(rz~@^04{');
define('NONCE_KEY',        'c?r%O)&11FLu#=kqo@hlUsp|}7Vq7;h<$fzk1Bl{HUGXyTth<N?YV90!J^LyH~IN');
define('AUTH_SALT',        '.}`DCj-[QCcnt/`K)e*iO%.[w/Idtv-Pj<$t5d.X@u+e-*Rl+&uxjU:m,~|r:orl');
define('SECURE_AUTH_SALT', 'hPWWw+LJk|}<P{/Skpj9bDEbH>!3h!;Puahu>[!>]@I8].eP>;MFe5/AZ0x+Ks|_');
define('LOGGED_IN_SALT',   '5@lap6utds[2tD&>}zOF[ylmh:7t(Ffh}#e|VdpIybFppIIv^Pk|ZH<fv=<6*Deb');
define('NONCE_SALT',       '@]/6H`D|-rjd<+rCOuV4H)NQgV5@cg^PSSb++978~/H9r}*j:Oas_h7~`-|r->cw');

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
