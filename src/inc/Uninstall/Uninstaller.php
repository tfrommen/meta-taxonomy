<?php # -*- coding: utf-8 -*-

namespace tfrommen\MetaTaxonomy\Uninstall;

use tfrommen\MetaTaxonomy\Taxonomy\Taxonomy;
use tfrommen\MetaTaxonomy\Update\Updater;

/**
 * Handles all uninstall-related stuff.
 *
 * @package tfrommen\MetaTaxonomy\Uninstall
 */
class Uninstaller {

	/**
	 * @var string
	 */
	private $taxonomy;

	/**
	 * @var string
	 */
	private $version_option_name;

	/**
	 * @var \wpdb
	 */
	private $wpdb;

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @param Updater  $updater  Updater.
	 * @param \wpdb    $wpdb     Database object.
	 * @param Taxonomy $taxonomy Taxonomy model.
	 */
	public function __construct( Updater $updater, \wpdb $wpdb, Taxonomy $taxonomy ) {

		$this->version_option_name = $updater->get_option_name();

		$this->wpdb = $wpdb;

		$this->taxonomy = $taxonomy->get_name();
	}

	/**
	 * Uninstalls all plugin data.
	 *
	 * @return void
	 */
	public function uninstall() {

		if ( is_multisite() ) {
			foreach ( $this->wpdb->get_col( "SELECT blog_id FROM {$this->wpdb->blogs}" ) as $blog_id ) {
				switch_to_blog( $blog_id );

				$this->delete_terms();

				delete_option( $this->version_option_name );
			}

			restore_current_blog();
		} else {
			$this->delete_terms();

			delete_option( $this->version_option_name );
		}
	}

	/**
	 * Deletes all plugin terms.
	 *
	 * @return void
	 */
	private function delete_terms() {

		$query = "
SELECT term_id
FROM {$this->wpdb->term_taxonomy}
WHERE taxonomy = %s
LIMIT 500";
		$query = $this->wpdb->prepare( $query, $this->taxonomy );

		while ( $term_ids = $this->wpdb->get_col( $query ) ) {
			foreach ( $term_ids as $term_id ) {
				wp_delete_term( $term_id, $this->taxonomy );
			}
		}
	}

}
