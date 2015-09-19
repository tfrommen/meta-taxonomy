<?php # -*- coding: utf-8 -*-

use tfrommen\MetaTaxonomy\Controllers\Taxonomy as Testee;
use WP_Mock\Tools\TestCase;

class TaxonomyControllerTest extends TestCase {

	/**
	 * @covers tfrommen\MetaTaxonomy\Controllers\Taxonomy::initialize
	 *
	 * @return void
	 */
	public function test_initialize() {

		/** @var tfrommen\MetaTaxonomy\Models\Taxonomy $model */
		$model = Mockery::mock( 'tfrommen\MetaTaxonomy\Models\Taxonomy' );

		$testee = new Testee( $model );

		WP_Mock::expectActionAdded( 'wp_loaded', array( $model, 'register' ) );

		$testee->initialize();

		$this->assertHooksAdded();
	}

}
