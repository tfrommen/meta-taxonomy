<?php # -*- coding: utf-8 -*-

namespace tf\MetaTaxonomy;

use tf\MetaTaxonomy\Controller;
use tf\MetaTaxonomy\Model;

/**
 * Class Plugin
 *
 * @package tf\MetaTaxonomy
 */
class Plugin {

	/**
	 * @var string
	 */
	private $file;

	/**
	 * Constructor. Init properties.
	 *
	 * @see init()
	 *
	 * @param string $file Main plugin file.
	 */
	public function __construct( $file ) {

		$this->file = $file;
	}

	/**
	 * Initialize the controller.
	 *
	 * @see initialize()
	 *
	 * @return void
	 */
	public function initialize() {

		$text_domain = new Model\TextDomain( $this->file );
		$text_domain->load();

		$general_controller = new Controller\General();
		$general_controller->initialize();
	}

}
