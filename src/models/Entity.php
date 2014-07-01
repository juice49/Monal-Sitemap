<?php namespace Ash\MonalSitemap\Models;




use URL;




class Entity {
	
	
	
	
	public $uri;
	public $name;
	public $lastmod;
	public $changefreq;
	public $priority;
	
	
	
	
	/**
	 * Array of properties that can be applied to a <url>
	 */
	private $xmlTags = [ 'lastmod', 'changefreq', 'priority' ];
	
	
	
	
	/**
	 * Generates entity XML
	 *
	 * @return {string} - XML string representing entity
	 */
	public function xml() {
		
		$xml = '<url>';
			
		if(!isset($this->entities)) {
			
			$xml .= '<loc>' . URL::to($this->uri) . '</loc>';
			
			foreach($this->xmlTags as $tag) {
				if($this->$tag) {
					$xml .= '<' . $tag . '>' . $this->$tag . '</' . $tag . '>';
				}
			}
			
		} else {
			
			foreach($this->entities as $entity) {
				$xml .= $entity->xml();
			}
			
		}
	
		$xml .= '</url>';
		
		return $xml;
		
	}




	/**
	* Generates entity HTML
	*
	* @param {bool} outer - Used internally for HTML nesting
	* @return {string} - HTML string representing entity
	*/
	public function html($outer = false) {

		if(!isset($this->entities)) {
			return '<li><a href="' . URL::to($this->uri) . '">' . $this->name . '</a></li>';
		}

		$html = '';
		
		if($outer) {
			$html .= '<ul>';
		} else {
			$html .= '<li><a href="' . URL::to($this->uri) . '">' . $this->name . '</a><ul>';
		}

		foreach($this->entities as $entity) {
			$html .= $entity->html();
		}

		if($outer) {
			$html .= '</ul>';
		} else {
			$html .= '</ul></li>';
		}

		return $html;

	}
	
	
	
	
	public function valid() {
		return true;
	}




}