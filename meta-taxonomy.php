<?php # -*- coding: utf-8 -*-
/**
 * Plugin Name: Meta Taxonomy
 * Plugin URI:  https://github.com/tfrommen/meta-taxonomy
 * Description: This plugin registers a taxonomy that provides a high-performance means to query posts in a somewhat meta-based way.
 * Author:      Thorsten Frommen
 * Author URI:  http://tfrommen.de
 * Version:     1.3.0
 * Text Domain: meta-taxonomy
 * Domain Path: /src/languages
 * License:     GPLv3
 */

defined( 'ABSPATH' ) or die();

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

require_once __DIR__ . '/src/' . basename( __FILE__ );
