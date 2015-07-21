# Meta Taxonomy

Have you ever wanted to query posts based on the condition that a specific meta is set or equal to a given value, but then you heard/learnt how inefficient a (complex) meta query actually is?

This is exactly when _Meta Taxonomy_ kicks in.

**Disclaimer**: This plugin is not intended to replace the post meta API in general. There are (a lot of) cases where using a post meta makes much more sense than using a term, or where using a term is simply impossible.

## Installation

1. [Download ZIP](https://github.com/tfrommen/meta-taxonomy/archive/master.zip).
1. Upload contents to the `/wp-content/plugins` directory on your web server.
1. Activate the plugin through the _Plugins_ menu in WordPress.
1. Be impressed by how fast your _meta tax_ queries can get, compared to ordinary meta queries.

## Usage

To be honest, this plugin is no big deal. It just provides you with a one-click solution for using high-performance taxonomy-based meta-like queries. Once the plugin is activated, you can assign terms of the new meta taxonomy to your posts, and then query the posts in a highly efficnet way (compared to complex meta queries).

### Filters

In order to customize certain aspects of the plugin, it provides you with several filters. For each of these, a short description as well as a code example on how to alter the default behavior is given below. Just put the according code snippet in your theme's `functions.php` file or your _customization_ plugin, or to some other appropriate place.

#### `meta_taxonomy_args`

If you want to alter a specific taxonomy argument but you can't find a fitting filter, there's `meta_taxonomy_args`, which provides you with the complete args array.

```php
/**
 * Filter the meta taxonomy's args.
 *
 * @param array $args Taxonomy args.
 */
add_filter( 'meta_taxonomy_args', function( $args ) {

	// Turn the whole taxonomy UI invisible
	$args[ 'show_ui' ] = FALSE;
	
	return $args;
} );
```

#### `meta_taxonomy_capabilities`

This filter provides you with the the capabilities required for the four taxonomy-specific actions `manage_terms`, `edit_terms`, `delete_terms` and `assign_terms`.

```php
/**
 * Filter the meta taxonomy's capabilities.
 *
 * @param array $capabilities Taxonomy capabilities.
 */
add_filter( 'meta_taxonomy_capabilities', function( $capabilities ) {

	// Let meta taxonomy terms be deleted by admins only
	$capabilities[ 'delete_terms' ] = 'manage_options';
	
	return $capabilities;
} );
```

#### `meta_taxonomy_description`

If you want to alter the taxonomy description, feel free to do it via this filter.

```php
/**
 * Filter the meta taxonomy's description.
 *
 * @param string $description Taxonomy description.
 */
add_filter( 'meta_taxonomy_description', function() {

	// Kill the description
	return '';
} );
```

#### `meta_taxonomy_labels`

In case you don't like the labels, easily adapt them to your liking.

```php
/**
 * Filter the meta taxonomy's labels.
 *
 * @param array $labels Taxonomy labels.
 */
add_filter( 'meta_taxonomy_labels', function( $labels ) {
	
	// A little more horror, please...
	$labels[ 'not_found' ] = 'ZOMG, no metas found!!1!!1!!oneone!!!1!eleven!1!';
	
	return $labels;
} );
```

#### `meta_taxonomy_name`

Yes, you can also alter the taxonomy name (slug).

```php
/**
 * Filter the meta taxonomy's name.
 *
 * @param string $name Taxonomy name.
 */
add_filter( 'meta_taxonomy_name', function() {
	
	// A little more horro, please...
	return 'meta_terms';
} );
```

#### `meta_taxonomy_object_type`

By default, the meta taxonomy is registered for default posts (i.e., post type `post`) only. If you would like add other custom post types, do this by using this filter. You can either return a single post type slug, or an array of them.

```php
/**
 * Filter the meta taxonomy's object type.
 *
 * @param string|array $object_type Taxonomy object type.
 */
add_filter( 'meta_taxonomy_object_type', function( $object_type ) {
	
	// Add the taxonomy for pages and a CPT, too
	return array_unique( array_merge( (array) $object_type, array(
			'page',
			'my_cpt',
	) ) );
} );
```

### Functions

In order to make use of a specific functionality, there may be a function already. To prevent any incompatibility, all global plugin functions are pluggable. In the rare case where you already have a function within the global namespace with a plugin function's name, you would have to set up such a function by yourself. In principle, this is just a copy of what you can find in the `functions.php` file **of this plugin**.

#### `has_meta_term`

If you want to check wether a specific post has a specific meta term, you can do this by means of the plugin's `has_meta_term` function.

```php
if ( has_meta_term( get_the_ID(), 'popular' ) ) {
	// Do something
}
```

## Contribution

If you have a feature request, or if you have developed the feature already, please feel free to use the Issues and/or Pull Requests section.

Of course, you can also provide me with translations if you would like to use the plugin in another not yet included language.

## Changelog

[Changelog](CHANGELOG.md)
