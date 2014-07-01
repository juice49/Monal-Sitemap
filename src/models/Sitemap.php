<?php namespace Ash\MonalSitemap\Models;




use Config, Cache;




class Sitemap extends Entity {
	
	
	
	
	/**
	 * Register a sitemap collection or entity
	 *
	 * @param {string} URI
	 * @param {callable} register - callback that adds content to sitemap
	 * @param {integer | boolean | string} - override for cache
	 */
	public function register($uri, Callable $register, $cache = true) {

		$duration = 1440;

		if($cache === 'forever' || is_numeric($cache)) {
			// The user provided an override duration for the cache
			$duration = $cache;
		}
		
		if($cache === false || $duration === false) {
			// The user disabled the cache
			$duration = 0;
		}
		
		switch($duration) {
			
			case '0':
				$this->entities[] = $register($uri);
				break;
				
			case 'forever':
				$this->entities[] = Cache::rememberForever('sitemap-' . $uri, function() use($uri, $register) {
					return $register($uri);
				});
				break;
				
			default:
				$this->entities[] = Cache::remember('sitemap-' . $uri, 1, function() use($uri, $register) {
					return $register($uri);
				});
			
		}

	}
	
	
	
	
	/**
	 * Generates sitemap HTML
	 *
	 * @param {bool} outer - Used internally for HTML nesting
	 * @return {string} - HTML string representing sitemap
	 */
	public function html($outer = true) {
		if(isset($this->entities) && count($this->entities) > 0) {
			return parent::html($outer);
		}
	}
	
	
	
	
	/**
	 * Generates sitemap XML
	 *
	 * @return {string} - XML string representing sitemap
	 */
	public function xml() {
		
		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$xml .= parent::xml();
		$xml .= '</urlset>';
		
		return $xml;
		
	}
	



}