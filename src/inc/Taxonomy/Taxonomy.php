<?php # -*- coding: utf-8 -*-

namespace tfrommen\MetaTaxonomy\Taxonomy;

/**
 * Taxonomy model.
 *
 * @package tfrommen\MetaTaxonomy\Taxonomy
 */
class Taxonomy {

	/**
	 * @var string
	 */
	private $name;

	/**
	 * Constructor. Sets up the properties.
	 */
	public function __construct() {

		/**
		 * Filters the taxonomy name.
		 *
		 * @param string $name Taxonomy name.
		 */
		$this->name = (string) apply_filters( 'meta_taxonomy_name', 'meta' );
	}

	/**
	 * Returns the taxonomy name.
	 *
	 * @return string
	 */
	public function get_name() {

		return $this->name;
	}

	/**
	 * Registers the taxonomy.
	 *
	 * @wp-hook wp_loaded
	 *
	 * @return void
	 */
	public function register() {

		/**
		 * Filters the taxonomy object types.
		 *
		 * @param string[] $object_types Array of names of object types for the taxonomy.
		 */
		$object_types = (array) apply_filters( 'meta_taxonomy_object_types', array( 'post' ) );

		$labels = array(
			'name'                       => _x( 'Metas', 'Taxonomy general name', 'meta-taxonomy' ),
			'singular_name'              => _x( 'Meta', 'Taxonomy singular name', 'meta-taxonomy' ),
			'menu_name'                  => _x( 'Metas', 'Taxonomy menu name', 'meta-taxonomy' ),
			'all_items'                  => __( 'All Metas', 'meta-taxonomy' ),
			'edit_item'                  => __( 'Edit Meta', 'meta-taxonomy' ),
			'view_item'                  => __( 'View Meta', 'meta-taxonomy' ),
			'update_item'                => __( 'Update Meta', 'meta-taxonomy' ),
			'add_new_item'               => __( 'Add New Meta', 'meta-taxonomy' ),
			'new_item_name'              => __( 'New Meta Name', 'meta-taxonomy' ),
			'parent_item'                => __( 'Parent Meta', 'meta-taxonomy' ),
			'parent_item_colon'          => __( 'Parent Meta:', 'meta-taxonomy' ),
			'search_items'               => __( 'Search Metas', 'meta-taxonomy' ),
			'popular_items'              => __( 'Popular Metas', 'meta-taxonomy' ),
			'separate_items_with_commas' => __( 'Separate metas with commas', 'meta-taxonomy' ),
			'add_or_remove_items'        => __( 'Add or remove metas', 'meta-taxonomy' ),
			'choose_from_most_used'      => __( 'Choose from the most used metas', 'meta-taxonomy' ),
			'not_found'                  => __( 'No metas found.', 'meta-taxonomy' ),
		);
		/**
		 * Filters the taxonomy labels.
		 *
		 * @param string[] $labels Taxonomy labels.
		 */
		$labels = (array) apply_filters( 'meta_taxonomy_labels', $labels );

		$description = __(
			'This taxonomy provides a high-performance means to query posts in a somewhat meta-based way.',
			'meta-taxonomy'
		);
		/**
		 * Filters the taxonomy description.
		 *
		 * @param string $description Taxonomy description.
		 */
		$description = (string) apply_filters( 'meta_taxonomy_description', $description );

		$capabilities = array(
			'manage_terms' => 'manage_options',
			'edit_terms'   => 'edit_others_posts',
			'delete_terms' => 'delete_others_posts',
			'assign_terms' => 'edit_posts',
		);
		/**
		 * Filters the taxonomy capabilities.
		 *
		 * @param string[] $capabilities Taxonomy capabilities.
		 */
		$capabilities = (array) apply_filters( 'meta_taxonomy_capabilities', $capabilities );

		$args = array(
			'labels'             => $labels,
			'description'        => $description,
			'public'             => FALSE,
			'hierarchical'       => FALSE,
			'show_ui'            => TRUE,
			'show_in_menu'       => FALSE,
			'show_in_nav_menus'  => FALSE,
			'show_tagcloud'      => FALSE,
			'show_in_quick_edit' => FALSE,
			'capabilities'       => $capabilities,
			'rewrite'            => FALSE,
		);
		/**
		 * Filters the taxonomy args.
		 *
		 * @param array|string $args Taxonomy args.
		 */
		$args = apply_filters( 'meta_taxonomy_args', $args );

		register_taxonomy( $this->name, $object_types, $args );
	}

}
