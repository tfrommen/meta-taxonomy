<?php # -*- coding: utf-8 -*-

namespace tfrommen\MetaTaxonomy;

use tfrommen\Autoloader;

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	return;
}

/** @var \wpdb $wpdb */
global $wpdb;

require_once __DIR__ . '/inc/Autoloader/bootstrap.php';

$autoloader = new Autoloader\Autoloader();
$autoloader->add_rule( new Autoloader\NamespaceRule( __DIR__ . '/inc', __NAMESPACE__ ) );

// Delete plugin terms
$query = "
SELECT term_id
FROM {$wpdb->term_taxonomy}
WHERE taxonomy = %s
LIMIT 500";
$taxonomy = new Models\Taxonomy();
$taxonomy = $taxonomy->get_name();
$query = $wpdb->prepare( $query, $taxonomy );
while ( $term_ids = $wpdb->get_results( $query, ARRAY_N ) ) {
	foreach ( $term_ids as $term_id ) {
		wp_delete_term( $term_id, $taxonomy );
	}
}
