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
define( 'DB_NAME', 'publicist12' );

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
define( 'AUTH_KEY',         'OiujDd`uv1ahi`HuTdr5?9Lh+6?W)Z|w;gsDU5sZlU~#+BDDJ?d>q6{>fzA[nRd,' );
define( 'SECURE_AUTH_KEY',  'ej4Aw:nXBlIHN*Gz%&2_z!dCeft^5_mamyWRM#@U;Lq`6FEo|Vp3C_j$Aqv]B*E<' );
define( 'LOGGED_IN_KEY',    'VKWA2g$N<k{QSTqAy|nHMf%G&l6r(znq8{Gw7PhhN2C~lr9@9lMeRjl(O;/.4{h=' );
define( 'NONCE_KEY',        '-^l7)d?%-TaJ:D`2Ah6~dkUY2dH:7Ea|{sREp41O6I)yh*T8Wp%XQ>OR6CUb3*Bh' );
define( 'AUTH_SALT',        'Hz%$w8G`J=r=*o5@3HsKpTzSpYDcB%%YO<f5hD^,u5`/s|0zP[#S{c#|;*)%kPJc' );
define( 'SECURE_AUTH_SALT', '@Mq-DKU!8GQ5i-iy!<mSJ*5jn66gX!!qeeyN%@h<y&U-.hUJ[&QtzwFklRtA6+ld' );
define( 'LOGGED_IN_SALT',   'b VWw+k908R,f(0AqVP?tlNg8^9}@L9BUc)~{!i6A*W#;6&x9<FeR/7(-myGl%fX' );
define( 'NONCE_SALT',       'iU.X~-nRw&S7Do&E?)Cvq-%)fZ7mHe hU(ZlGuSeP>-Xmy*ZYY,mb_9}Uju!R$HE' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpb_';

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
