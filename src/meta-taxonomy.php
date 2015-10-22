<?php # -*- coding: utf-8 -*-
/**
 * Plugin Name: Meta Taxonomy
 * Plugin URI:  https://github.com/tfrommen/meta-taxonomy
 * Description: This plugin registers a taxonomy that provides a high-performance means to query posts in a somewhat meta-based way.
 * Author:      Thorsten Frommen
 * Author URI:  http://tfrommen.de
 * Version:     1.3.0
 * Text Domain: meta-taxonomy
 * Domain Path: /languages
 * License:     GPLv3
 */

namespace tfrommen\MetaTaxonomy;

if ( ! function_exists( 'add_action' ) ) {
	return;
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\initialize' );

/**
 * Initializes the plugin.
 *
 * @wp-hook plugins_loaded
 *
 * @return void
 */
function initialize() {

	if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		require_once __DIR__ . '/vendor/autoload.php';
	}

	$plugin = new Plugin( __FILE__ );
	$plugin->initialize();
}

if ( file_exists( __DIR__ . '/functions.php' ) ) {
	include_once __DIR__ . '/functions.php';
}
