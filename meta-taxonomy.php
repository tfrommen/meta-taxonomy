<?php # -*- coding: utf-8 -*-
/**
 * Plugin Name: Meta Taxonomy
 * Plugin URI:  https://github.com/tfrommen/meta-taxonomy
 * Description: Registers a taxonomy that provides a high-performance means to query posts in a somewhat meta-based way.
 * Author:      Thorsten Frommen
 * Author URI:  http://ipm-frommen.de/wordpress
 * Version:     1.0
 * Text Domain: meta-taxonomy
 * Domain Path: /languages
 * License:     GPLv3
 */

namespace tf\MetaTaxonomy;

use tf\Autoloader;

if ( ! function_exists( 'add_action' ) ) {
	return;
}

require_once __DIR__ . '/inc/Autoloader/bootstrap.php';

require_once __DIR__ . '/functions.php';

add_action( 'plugins_loaded', __NAMESPACE__ . '\initialize' );

/**
 * Initialize the plugin.
 *
 * @wp-hook plugins_loaded
 *
 * @return void
 */
function initialize() {

	$autoloader = new Autoloader\Autoloader();
	$autoloader->add_rule( new Autoloader\NamespaceRule( __DIR__ . '/inc', __NAMESPACE__ ) );

	$plugin = new Plugin( __FILE__ );
	$plugin->initialize();
}
