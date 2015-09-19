<?php # -*- coding: utf-8 -*-

namespace tfrommen\MetaTaxonomy\Controllers;

use tfrommen\MetaTaxonomy\Models\Taxonomy as Model;

/**
 * Taxonomy controller.
 *
 * @package tfrommen\MetaTaxonomy\Controllers
 */
class Taxonomy {

	/**
	 * @var Model
	 */
	private $model;

	/**
	 * Constructor. Set up the properties.
	 *
	 * @param Model $model Model.
	 */
	public function __construct( Model $model ) {

		$this->model = $model;
	}

	/**
	 * Wire up all functions.
	 *
	 * @return void
	 */
	public function initialize() {

		add_action( 'wp_loaded', array( $this->model, 'register' ) );
	}

}
