<?php # -*- coding: utf-8 -*-

namespace tfrommen\Tests\MetaTaxonomy\Taxonomy;

use Mockery;
use tfrommen\MetaTaxonomy\Taxonomy\Controller as Testee;
use tfrommen\MetaTaxonomy\Taxonomy\Taxonomy;
use WP_Mock;
use WP_Mock\Tools\TestCase;

/**
 * Test case for the taxonomy controller.
 */
class ControllerTest extends TestCase {

	/**
	 * @covers tfrommen\MetaTaxonomy\Taxonomy\Controller::initialize
	 *
	 * @return void
	 */
	public function test_initialize() {

		/** @var Taxonomy $taxonomy */
		$taxonomy = Mockery::mock( 'tfrommen\MetaTaxonomy\Taxonomy\Taxonomy' );

		$testee = new Testee( $taxonomy );

		WP_Mock::expectActionAdded( 'wp_loaded', array( $taxonomy, 'register' ) );

		$testee->initialize();

		$this->assertHooksAdded();
	}

}
