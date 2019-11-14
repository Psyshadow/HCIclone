<?php
/**
 * In dieser Datei werden die Grundeinstellungen für WordPress vorgenommen.
 *
 * Zu diesen Einstellungen gehören: MySQL-Zugangsdaten, Tabellenpräfix,
 * Secret-Keys, Sprache und ABSPATH. Mehr Informationen zur wp-config.php gibt es
 * auf der {@link http://codex.wordpress.org/Editing_wp-config.php wp-config.php editieren}
 * Seite im Codex. Die Informationen für die MySQL-Datenbank bekommst du von deinem Webhoster.
 *
 * Diese Datei wird von der wp-config.php-Erzeugungsroutine verwendet. Sie wird ausgeführt,
 * wenn noch keine wp-config.php (aber eine wp-config-sample.php) vorhanden ist,
 * und die Installationsroutine (/wp-admin/install.php) aufgerufen wird.
 * Man kann aber auch direkt in dieser Datei alle Eingaben vornehmen und sie von
 * wp-config-sample.php in wp-config.php umbenennen und die Installation starten.
 *
 * @package WordPress
 */

/**  MySQL Einstellungen - diese Angaben bekommst du von deinem Webhoster. */
/**  Ersetze database_name_here mit dem Namen der Datenbank, die du verwenden möchtest. */
define( 'DB_NAME', 'hci_2019' );

/** Ersetze username_here mit deinem MySQL-Datenbank-Benutzernamen */
define( 'DB_USER', 'administrator' );

/** Ersetze password_here mit deinem MySQL-Passwort */
define( 'DB_PASSWORD', '123456' );

/** Ersetze localhost mit der MySQL-Serveradresse */
define( 'DB_HOST', 'sfk2019.ch' );

/** Der Datenbankzeichensatz der beim Erstellen der Datenbanktabellen verwendet werden soll */
define( 'DB_CHARSET', 'utf8mb4' );

/** Der collate type sollte nicht geändert werden */
define('DB_COLLATE', '');

/**#@+
 * Sicherheitsschlüssel
 *
 * Ändere jeden KEY in eine beliebige, möglichst einzigartige Phrase.
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * kannst du dir alle KEYS generieren lassen.
 * Bitte trage für jeden KEY eine eigene Phrase ein. Du kannst die Schlüssel jederzeit wieder ändern,
 * alle angemeldeten Benutzer müssen sich danach erneut anmelden.
 *
 * @seit 2.6.0
 */
define( 'AUTH_KEY',         '1qs6&X#n^vkj.ex9yEu)S$<`en4-ht<lBv::p0x I5/D{7#W6|W}Z<2ZnZqL^V%:' );
define( 'SECURE_AUTH_KEY',  'JW#@ll^$NAxWX|4$VX<8]B36%_;$MciS7)JzzEC1|E6WM.Zij`PGa~SJ+QHyf?zD' );
define( 'LOGGED_IN_KEY',    'zm<1L5V{4l2Jd+pw^:Qw-kw eUg*!_zN}xr|aOnmmlk6o@+jYO`_|Y1+@g.6!d_X' );
define( 'NONCE_KEY',        'C 4v?UFo,FN&[?hUu=TvO6+,-WZf|-loB5`*y!BM<@zkfuUQ;tb!;vlxfH5#WyGz' );
define( 'AUTH_SALT',        'SjyL@64j9g[dJ93Kyl3!^[S0GG1e8P}99+/J`|WJh7][AE$KZw {RNOyj BoY($v' );
define( 'SECURE_AUTH_SALT', '1_a+J9mUp*/r[5CvbBo4=f~ilne2v;4nNx[?MI1ubwqavKRM]T>1?G<o(H*Rzfj+' );
define( 'LOGGED_IN_SALT',   '>Je$e*ARCL$e%Bt-.|eGk<sj_}1T8Kn4SR@c@!*AYD)VZc$7k803EN6LY@=pHpDG' );
define( 'NONCE_SALT',       'i66zVKGx1,Xr}z`YwZM;DazkN+h&+8:![y#%4gIIf)f!AEG4d)T/:@+LoLrcwLhU' );

/**#@-*/

/**
 * WordPress Datenbanktabellen-Präfix
 *
 *  Wenn du verschiedene Präfixe benutzt, kannst du innerhalb einer Datenbank
 *  verschiedene WordPress-Installationen betreiben. Nur Zahlen, Buchstaben und Unterstriche bitte!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/** Sets the wordpress upload directory */
define( 'UPLOADS', ''.'images' );

