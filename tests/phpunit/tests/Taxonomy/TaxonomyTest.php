<?php # -*- coding: utf-8 -*-

use tfrommen\MetaTaxonomy\Taxonomy\Taxonomy as Testee;
use WP_Mock\Tools\TestCase;

/**
 * Test case for the Taxonomy class.
 */
class TaxonomyTest extends TestCase {

	/**
	 * @covers tfrommen\MetaTaxonomy\Taxonomy\Taxonomy::get_name
	 *
	 * @return void
	 */
	public function test_get_name() {

		$testee = new Testee();

		$this->assertSame( 'meta', $testee->get_name() );
	}

	/**
	 * @covers tfrommen\MetaTaxonomy\Taxonomy\Taxonomy::register
	 *
	 * @return void
	 */
	public function test_register() {

		$testee = new Testee();

		$text_domain = 'meta-taxonomy';

		WP_Mock::wpPassthruFunction(
			'_x',
			array(
				'args' => array(
					Mockery::type( 'string' ),
					Mockery::type( 'string' ),
					$text_domain,
				),
			)
		);

		WP_Mock::wpPassthruFunction(
			'__',
			array(
				'args' => array(
					Mockery::type( 'string' ),
					$text_domain,
				),
			)
		);

		WP_Mock::wpFunction(
			'register_taxonomy',
			array(
				'times' => 1,
				'args'  => array(
					'meta',
					Mockery::type( 'array' ),
					Mockery::type( 'array' ),
				),
			)
		);

		$testee->register();

		$this->assertConditionsMet();
	}

}
