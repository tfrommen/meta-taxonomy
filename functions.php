<?php # -*- coding: utf-8 -*-

use tf\MetaTaxonomy\Models\Taxonomy;

if ( ! function_exists( 'has_meta_term' ) ) {

	/**
	 * Check if the post with the given ID has the meta term with the given ID or slug.
	 *
	 * @param int        $post_id Post ID.
	 * @param int|string $term    Term ID or slug.
	 *
	 * @return bool
	 */
	function has_meta_term( $post_id, $term ) {

		$taxonomy = new Taxonomy();
		$taxonomy = $taxonomy->get_name();

		return is_object_in_term( $post_id, $taxonomy, $term );
	}

}
