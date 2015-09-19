<?php # -*- coding: utf-8 -*-

namespace tfrommen\MetaTaxonomy;

/**
 * Class Plugin
 *
 * @package tfrommen\MetaTaxonomy
 */
class Plugin {

	/**
	 * @var string
	 */
	private $file;

	/**
	 * @var string
	 */
	private $plugin_data;

	/**
	 * Constructor. Set up the properties.
	 *
	 * @param string $file Main plugin file.
	 */
	public function __construct( $file ) {

		$this->file = $file;

		$headers = array(
			'version'     => 'Version',
			'text_domain' => 'Text Domain',
			'domain_path' => 'Domain Path',
		);
		$this->plugin_data = get_file_data( $file, $headers );
	}

	/**
	 * Initialize the plugin.
	 *
	 * @return void
	 */
	public function initialize() {

		$update_controller = new Controllers\Update( $this->plugin_data[ 'version' ] );
		$update_controller->update();

		$text_domain = new Models\TextDomain(
			$this->file,
			$this->plugin_data[ 'text_domain' ],
			$this->plugin_data[ 'domain_path' ]
		);
		$text_domain->load();

		$taxonomy = new Models\Taxonomy();

		$taxonomy_controller = new Controllers\Taxonomy( $taxonomy );
		$taxonomy_controller->initialize();
	}

}
