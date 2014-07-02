# Monal Sitemap

Sitemap generator for [Monal CMS](https://github.com/arranjacques/monal). Allows the registering of entities on a package by package basis.

By default Monal Sitemap places sitemaps at `sitemap` and `sitemap.xml`. This name can be customised via the `config['filename']` option.

## Installation

1. Fetch the package (add Packagist details here)
2. Add `'Ash\MonalSitemap\MonalSitemapServiceProvider'` to app providers
3. Add `'Sitemap' => 'Ash\MonalSitemap\Facades\Sitemap'` to app aliases

## Registering a sitemap section

Monal Sitemap consists of collections of entities. An entity can be either a single entity (a `SitemapEntity`) or a collection of entities (a `SitemapCollection`).

Entities are registered using the `register` function.

### Sitemap::register( string $name, Callable $register [, $cache ] )

#### $name
The name of the collection / entity. Must be unique.

#### $register
A function that returns either an instance of `SitemapCollection` or `SitemapEntity`.

#### $cache
Override the default cache (1440 minutes). Set to either a custom number of minutes, or `false` to disable caching.

### SitemapEntity and SitemapCollection
`SitemapEntity` and `SitemapCollection` are identical in all regards other than `SitemapCollection`s ability to contain a collection of entities.

#### $entity/$collection->uri - required
Full URI of the entity (excluding domain).

#### $entity/$collection->name - required

#### $entity/$collection->lastmod

#### $entity/$collection->changefreq

#### $entity/$collection->priority

#### $collection->add($collection/$entity)
Add a collection or entity to the collection. Can be chained or given an array, for example:

	$collection
		->add($subCollection)
		->add($subCollection2);
		
	$collection->add([
		$subCollection,
		$subCollection2
	]);

## Example

	// Register a collection named 'products'
	
	Sitemap::register('products', function($uri) {
	
		// The second param of the register function is a callback
	// that should return a collection or an entity
		
		// Create a new collection
		$collection = App::make('SitemapCollection');
		
		// Set the collection URI
		// $uri passed to this callback is the same as the collection name (products)
		$collection->uri = $uri;
		
		$collection->name = 'Products';
	
		// Gather data for a resource	
		foreach(Product::all() as $product) {
			
			// Create a new single entity
			$entity = App::make('SitemapEntity');
			
			// Set entity URI
			$entity->uri = 'products/' . $product->uri;
			
			$entity->name = $product->name;
			
			// Set entity lastmod
			// The default Laravel updated_at timestamp works here
			$entity->lastmod = $product->updated_at;
			
			// Add the single entity to the collection
			$collection->add($entity);
			
		}

		return $collection;
	
	});

## Todo
- Add entity validation - `$entity->valid()` is check upon adding, currently always returns true
- Unit tests
- Add default cache duration as config item
- Improve templating for HTML version
- Implement gzipping of XML version

## Releases

### 0.0.1 - 01/07/14