<?php # -*- coding: utf-8 -*-

namespace tf\MetaTaxonomy\Controller;

use tf\MetaTaxonomy\Model;

/**
 * Class General
 *
 * @package tf\MetaTaxonomy\Controller
 */
class General {

	/**
	 * Wire up all general functions.
	 *
	 * @see tf\MetaTaxonomy\Plugin::initialize()
	 *
	 * @return void
	 */
	public function initialize() {

		add_action( 'wp_loaded', array( new Model\Taxonomy(), 'register' ) );
	}

}
