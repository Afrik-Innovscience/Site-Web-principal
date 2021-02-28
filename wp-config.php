<?php

define('FS_METHOD', 'direct');
define('FORCE_SSL_ADMIN', true);

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
define( 'DB_NAME', 'dbs1279154' );

/** MySQL database username */
define( 'DB_USER', 'dbu1026413' );

/** MySQL database password */
define( 'DB_PASSWORD', 'lMuxWzKuMOdOanaXBNoi' );

/** MySQL hostname */
define( 'DB_HOST', 'db5001528384.hosting-data.io' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '@<x{Z@~G@t},Df$b;U7._-k8Cm_3e&{`1M-l5]7,W1a%mVo3v?nSoRig2RY$iNL ' );
define( 'SECURE_AUTH_KEY',   '^d0. kp.Ki!=1$4>/(g-!Dt}+O]G_&:v0@iob!c=%5`Y`$K<;Q-lr)yYPzY/[l|y' );
define( 'LOGGED_IN_KEY',     'L810r/q+V7a<+6RI+{$I_fI:RQD6GXMN7ZO,WoeOIiD;#K7kHWWq!ik&y-56AP~Z' );
define( 'NONCE_KEY',         '+N?qX$ (YMWltW@u$*Ziz7OlUKec,-Gneft1xBI64MaRU~,Sldk0[Y]Zkh66)@;?' );
define( 'AUTH_SALT',         'cK!]8)Ku$51m6(S?OjdJlFO,oftHDPWrKgUyDccUPk8Hmf1a-AQ+x71z64ng6xi=' );
define( 'SECURE_AUTH_SALT',  'L(7EEtfHiyPEHG{i}b6 Jc;&h~t9H@- 2IeRQ3Cn,iT`9=Ap]g!qm5}vVj=-Xno3' );
define( 'LOGGED_IN_SALT',    'K jC)+ksBq)nw0zQ))Hpx)6X/t~n?+{XTpcdhA.~MWrAZXVMw5%83|fk_F`BQlfa' );
define( 'NONCE_SALT',        'KpKZ@N3o=0|.t2|%q09~//V$T/A#6*v$EOP6%^YO.=X/#*PhFb=s,gy>A|g.HVA8' );
define( 'WP_CACHE_KEY_SALT', '%*ALxc[ jMR_wD${um_!s.r7NhTJNfY4O}u%>,[Yh7@:*M:bm2x] j#=ux,F.`s?' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'knNZChpC';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
