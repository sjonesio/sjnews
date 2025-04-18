<?php
/**
 * SJ News
 *
 * @package           sjnews
 * @author            sjonesio
 * @copyright         2025 sjones.digital
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       SJ News
 * Plugin URI:        https://sjones.digital
 * Description:       Adds your own news feed to the Dashboard of WP Admin. Great for freelancers and agencies.
 * Version:           1.0.0
 * Author:            sjonesio
 * Author URI:        https://sjones.digital
 * Text Domain:       sjnews
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Set plugin directory path.
if ( ! defined( 'SJNEWS_PLUGIN_DIR' ) ) {
	define( 'SJNEWS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

// Set plugin directory URL.
if ( ! defined( 'SJNEWS_PLUGIN_URL' ) ) {
	define( 'SJNEWS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// Plugin includes.
require SJNEWS_PLUGIN_DIR . 'class-articles.php';
require SJNEWS_PLUGIN_DIR . 'class-dashboard.php';

$sjnews = new SJNEWS\Dashboard();
