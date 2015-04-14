<?php # -*- coding: utf-8 -*-

namespace tf\MetaTaxonomy\Model;

/**
 * Class TextDomain
 *
 * @package tf\MetaTaxonomy\Model
 */
class TextDomain {

	/**
	 * @var string
	 */
	private $path;

	/**
	 * Constructor. Set up properties.
	 *
	 * @see tf\MetaTaxonomy\Plugin::initialize()
	 *
	 * @param string $file Main plugin file.
	 */
	public function __construct( $file ) {

		$this->path = plugin_basename( $file );
		$this->path = dirname( $this->path ) . '/languages';
	}

	/**
	 * Load text domain.
	 *
	 * @see tf\MetaTaxonomy\Controller\Admin::initialize()
	 *
	 * @return void
	 */
	public function load() {

		load_plugin_textdomain( 'meta-taxonomy', FALSE, $this->path );
	}

}
