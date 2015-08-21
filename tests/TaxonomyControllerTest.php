<?php # -*- coding: utf-8 -*-

use tf\MetaTaxonomy\Controllers\Taxonomy as Testee;
use WP_Mock\Tools\TestCase;

class TaxonomyControllerTest extends TestCase {

	public function test_initialize() {

		$model = Mockery::mock( 'tf\MetaTaxonomy\Models\Taxonomy' );

		/** @var tf\MetaTaxonomy\Models\Taxonomy $model */
		$testee = new Testee( $model );

		WP_Mock::expectActionAdded( 'wp_loaded', array( $model, 'register' ) );

		$testee->initialize();

		$this->assertHooksAdded();
	}

}
