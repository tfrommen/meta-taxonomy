<?php # -*- coding: utf-8 -*-

use tf\MetaTaxonomy\Models\Taxonomy as Testee;
use WP_Mock\Tools\TestCase;

class TaxonomyModelTest extends TestCase {

	public function test_register() {

		$testee = new Testee();

		WP_Mock::wpPassthruFunction(
			'_x',
			array(
				'args' => array(
					WP_Mock\Functions::type( 'string' ),
					WP_Mock\Functions::type( 'string' ),
					'meta-taxonomy',
				),
			)
		);

		WP_Mock::wpPassthruFunction(
			'__',
			array(
				'args' => array(
					WP_Mock\Functions::type( 'string' ),
					'meta-taxonomy',
				),
			)
		);

		WP_Mock::wpFunction(
			'register_taxonomy',
			array(
				'times' => 1,
				'args'  => array(
					'meta',
					WP_Mock\Functions::type( 'string' ),
					WP_Mock\Functions::type( 'array' ),
				),
			)
		);
		$testee->register();

		$this->assertConditionsMet();
	}

}
