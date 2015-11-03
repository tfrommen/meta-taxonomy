<?php # -*- coding: utf-8 -*-

namespace tfrommen\Tests\MetaTaxonomy\Uninstall;

use Mockery;
use tfrommen\MetaTaxonomy\Taxonomy\Taxonomy;
use tfrommen\MetaTaxonomy\Uninstall\Uninstaller as Testee;
use tfrommen\MetaTaxonomy\Update\Updater;
use WP_Mock;
use WP_Mock\Tools\TestCase;
use wpdb;

/**
 * Test case for the uninstaller.
 */
class UninstallerTest extends TestCase {

	/**
	 * @covers       tfrommen\MetaTaxonomy\Uninstall\Uninstaller::uninstall
	 * @dataProvider provide_uninstall_data
	 *
	 * @param bool  $is_multisite
	 * @param int[] $blog_ids
	 * @param int[] $term_ids
	 *
	 * @return void
	 */
	public function test_uninstall( $is_multisite, $blog_ids, $term_ids ) {

		$version_option_name = 'plugin_version';

		/** @var Updater $updater */
		$updater = Mockery::mock( 'tfrommen\MetaTaxonomy\Update\Updater' )
			->shouldReceive( 'get_option_name' )
			->andReturn( $version_option_name )
			->getMock();

		/** @var wpdb $wpdb */
		$wpdb = Mockery::mock( 'wpdb' );
		$wpdb->term_taxonomy = 'term_taxonomy';

		$taxonomy_name = 'taxonomy_name';

		/** @var Taxonomy $taxonomy */
		$taxonomy = Mockery::mock( 'tfrommen\MetaTaxonomy\Taxonomy\Taxonomy' )
			->shouldReceive( 'get_name' )
			->andReturn( $taxonomy_name )
			->getMock();

		WP_Mock::wpFunction(
			'is_multisite',
			array(
				'return' => $is_multisite,
			)
		);

		$times_delete = 1;

		$return_get_col = array();

		if ( $is_multisite ) {
			$return_get_col[] = $blog_ids;

			$wpdb->blogs = 'blogs';

			$times_delete = count( $blog_ids );

			WP_Mock::wpFunction( 'switch_to_blog' );

			WP_Mock::wpFunction( 'restore_current_blog' );
		}

		$wpdb->shouldReceive( 'prepare' );

		for ( $i = 0; $i < $times_delete; $i++ ) {
			if ( $term_ids ) {
				$return_get_col[] = $term_ids;
			}
			$return_get_col[] = array();
		}

		$wpdb->shouldReceive( 'get_col' )
			->andReturnValues( $return_get_col );

		WP_Mock::wpFunction(
			'wp_delete_term',
			array(
				'args' => array(
					Mockery::type( 'int' ),
					$taxonomy_name,
				),
			)
		);

		WP_Mock::wpFunction(
			'delete_option',
			array(
				'args' => array(
					$version_option_name,
				),
			)
		);

		$testee = new Testee( $updater, $wpdb, $taxonomy );

		$testee->uninstall();

		$this->assertConditionsMet();
	}

	/**
	 * Provider for the test_uninstall() method.
	 *
	 * @return array[]
	 */
	public function provide_uninstall_data() {

		$blog_ids = array(
			4,
			8,
			15,
			16,
			23,
			42,
		);

		$term_ids = array(
			1,
			1,
			2,
			3,
			5,
			8,
			13,
			21,
			34,
			55,
		);

		return array(
			'single_without_terms'    => array(
				'is_multisite' => FALSE,
				'blog_ids'     => $blog_ids,
				'term_ids'     => array(),
			),
			'single_with_terms'       => array(
				'is_multisite' => FALSE,
				'blog_ids'     => $blog_ids,
				'term_ids'     => $term_ids,
			),
			'multisite_without_blogs' => array(
				'is_multisite' => TRUE,
				'blog_ids'     => array(),
				'term_ids'     => array(),
			),
			'multisite_without_terms' => array(
				'is_multisite' => TRUE,
				'blog_ids'     => $blog_ids,
				'term_ids'     => array(),
			),
			'multisite_with_terms'    => array(
				'is_multisite' => TRUE,
				'blog_ids'     => $blog_ids,
				'term_ids'     => $term_ids,
			),
		);
	}

}
