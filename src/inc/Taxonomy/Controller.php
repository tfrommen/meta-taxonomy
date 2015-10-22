<?php # -*- coding: utf-8 -*-

namespace tfrommen\MetaTaxonomy\Taxonomy;

/**
 * Taxonomy controller.
 *
 * @package tfrommen\MetaTaxonomy\Taxonomy
 */
class Controller {

	/**
	 * @var Taxonomy
	 */
	private $taxonomy;

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @param Taxonomy $taxonomy Taxonomy model.
	 */
	public function __construct( Taxonomy $taxonomy ) {

		$this->taxonomy = $taxonomy;
	}

	/**
	 * Wires up all functions.
	 *
	 * @return void
	 */
	public function initialize() {

		add_action( 'wp_loaded', array( $this->taxonomy, 'register' ) );
	}

}
