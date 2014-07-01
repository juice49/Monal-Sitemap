<?php namespace Ash\MonalSitemap\Models;




class Collection extends Entity {
	
	
	
	protected $entities = [];
	
	
	
	
	/**
	 * Add either a collection or an entity - OR an array of either - to the collection.
	 *
	 * This is chainable, for example:
	 *
	 * ````
	 * $collection
	 *   ->add($entity)
	 *   ->add($entity)
	 * ````
	 *
	 * You can alternatively provide an array.
	 *
	 * @param {Entity | array} entity - the entity/entities to add
	 * @return {object} collection
	 */
	public function add($entity) {
		
		if($entity instanceof Entity) {
			$this->entities[] = $entity;
		}
		
		if(is_array($entity)) {
			$this->entities = array_merge($this->entities, $entity);
		}

		return $this;
		
	}




}