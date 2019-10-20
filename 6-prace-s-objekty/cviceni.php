<?php

namespace Ingre;

//1. cvičení
class Ingredient {
	protected $name;
	protected $price;
	
	public function __construct($name, $price){
		$this->name = $name;
		$this->price = $price;
	}
	
	// v rámci 2. cvičení	
	public function IngredientCost($price){
		$this->price = $price;
	}		
	
	public function getName(){
		return $this->name;
	}
	
	public function getPrice(){
		return $this->price;
	}
}

?>