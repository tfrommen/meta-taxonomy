<?php # -*- coding: utf-8 -*-

namespace tfrommen\MetaTaxonomy;

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	return;
}

require_once __DIR__ . '/vendor/autoload.php';

/** @var \wpdb $wpdb */
global $wpdb;

$uninstaller = new Uninstall\Uninstaller(
	new Update\Updater(),
	$wpdb,
	new Taxonomy\Taxonomy()
);
$uninstaller->uninstall();
