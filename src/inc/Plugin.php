<?php # -*- coding: utf-8 -*-

namespace tfrommen\MetaTaxonomy;

/**
 * Main controller.
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
	 * Constructor. Sets up the properties.
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
	 * Initializes the plugin.
	 *
	 * @return void
	 */
	public function initialize() {

		$updater = new Update\Updater( $this->plugin_data[ 'version' ] );
		$updater->update();

		$text_domain = new L10n\TextDomain( $this->plugin_data, $this->file );
		$text_domain->load();

		$taxonomy_controller = new Taxonomy\Controller( new Taxonomy\Taxonomy() );
		$taxonomy_controller->initialize();
	}

}
