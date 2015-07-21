<?php # -*- coding: utf-8 -*-

namespace tf\MetaTaxonomy;

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
	 * Constructor. Set up the properties.
	 *
	 * @param string $file Main plugin file.
	 */
	public function __construct( $file ) {

		$this->file = $file;
	}

	/**
	 * Initialize the plugin.
	 *
	 * @return void
	 */
	public function initialize() {

		$text_domain = new Models\TextDomain( $this->file );
		$text_domain->load();

		$taxonomy = new Models\Taxonomy();

		$taxonomy_controller = new Controllers\Taxonomy( $taxonomy );
		$taxonomy_controller->initialize();
	}

}
