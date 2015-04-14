<?php # -*- coding: utf-8 -*-

namespace tf\MetaTaxonomy\Model;

/**
 * Class Taxonomy
 *
 * @package tf\MetaTaxonomy\Model
 */
class Taxonomy {

	/**
	 * @var string
	 */
	private $name;

	/**
	 * Constructor. Init properties.
	 *
	 * @see tf\MetaTaxonomy\Controller\General::initialize()
	 */
	public function __construct() {

		/**
		 * Customize the meta taxonomy's name.
		 *
		 * @param string $name Taxonomy name.
		 */
		$this->name = apply_filters( 'meta_taxonomy_name', 'meta' );
	}

	/**
	 * Return taxonomy name.
	 *
	 * @return string
	 */
	public function get_name() {

		return $this->name;
	}

	/**
	 * Register the taxonomy.
	 *
	 * @wp-hook wp_loaded
	 *
	 * @return void
	 */
	public function register() {

		/**
		 * Customize the meta taxonomy's object type.
		 *
		 * @param string|array $object_type Taxonomy object type.
		 */
		$object_type = apply_filters( 'meta_taxonomy_object_type', 'post' );

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
		 * Customize the meta taxonomy's labels.
		 *
		 * @param array $labels Taxonomy labels.
		 */
		$labels = apply_filters( 'meta_taxonomy_labels', $labels );

		$description = __(
			'This taxonomy provides a high-performance means to query posts in a somewhat meta-based way.',
			'meta-taxonomy'
		);
		/**
		 * Customize the meta taxonomy's description.
		 *
		 * @param string $description Taxonomy description.
		 */
		$description = apply_filters( 'meta_taxonomy_description', $description );

		$capabilities = array(
			'manage_terms' => 'manage_options',
			'edit_terms'   => 'edit_others_posts',
			'delete_terms' => 'delete_others_posts',
			'assign_terms' => 'edit_posts',
		);
		/**
		 * Customize the meta taxonomy's capabilities.
		 *
		 * @param array $capabilities Taxonomy capabilities.
		 */
		$capabilities = apply_filters( 'meta_taxonomy_capabilities', $capabilities );

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
		 * Customize the meta taxonomy's args.
		 *
		 * @param array $args Taxonomy args.
		 */
		$args = apply_filters( 'meta_taxonomy_args', $args );

		register_taxonomy( $this->name, $object_type, $args );
	}

}
