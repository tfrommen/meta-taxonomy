<?php # -*- coding: utf-8 -*-

use tfrommen\MetaTaxonomy\Taxonomy\Controller as Testee;
use WP_Mock\Tools\TestCase;

class ControllerTest extends TestCase {

	/**
	 * @covers tfrommen\MetaTaxonomy\Taxonomy\Controller::initialize
	 *
	 * @return void
	 */
	public function test_initialize() {

		/** @var tfrommen\MetaTaxonomy\Taxonomy\Taxonomy $taxonomy */
		$taxonomy = Mockery::mock( 'tfrommen\MetaTaxonomy\Taxonomy\Taxonomy' );

		$testee = new Testee( $taxonomy );

		WP_Mock::expectActionAdded( 'wp_loaded', array( $taxonomy, 'register' ) );

		$testee->initialize();

		$this->assertHooksAdded();
	}

}
