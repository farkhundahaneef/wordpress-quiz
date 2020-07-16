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
define( 'DB_NAME', 'wordpress-quiz' );

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
define( 'AUTH_KEY',         '6BUS@16W5{p=yw2:8Q>d8/rR+I,(T/AuLBDJQtm,`Z75IA.kexvmg=FK*?{+#vj:' );
define( 'SECURE_AUTH_KEY',  ':R-BqQKU?jh1b_@wh3lA?ALh3=d`cs??HATj}~00*mkb6@@}`]t4(SgzXspLP+jf' );
define( 'LOGGED_IN_KEY',    'F+n)pE7`2_>{0,V4k ve>J+dKI:>[6VJr`_023IbCD_fDsKjro.M^RF7t+`ssZ1g' );
define( 'NONCE_KEY',        ']QlNZ/^u2^$&gA4!].9QO!Or_?rbhUD}KX`fK tUxs>tPI ,5baa17Fw<H6f,[c`' );
define( 'AUTH_SALT',        'gE{=;N8>X0R9<w>I*x<P50v/pGd~6+$`P-v/7JG;(flsBs)Gc%3`vf@g,C<FZXA*' );
define( 'SECURE_AUTH_SALT', 'c%=9j&$>oC)Dy7c919<Z+Q}7Jft2GeaL@F}>VY5v+^7)Mqq5|:_}z~hu<gc4nk#t' );
define( 'LOGGED_IN_SALT',   '3^NdK>y5p/d`8X)+[kS-CFtSip?y=~v:kzj*/4VRi4c^`%f]TLk/RD`~WNRN/h@v' );
define( 'NONCE_SALT',       '( O:wm&iPg;m)?yrg#|r3^i9p2<>-!;]+44.<M)4DGk/`6Y{Z@&Srk3zXrJ>}eR1' );

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
