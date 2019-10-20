<?php

require('cviceni.php');

class Entree4 {
	public $name;
	public $ingredients = array();
	
	public function __construct($name, $ingredients){
		if(!is_array($ingredients)){
			throw new Exception('$ingredients must be an array');
		}		
		$this->name = $name;
		$this->ingredients = $ingredients;		
	}
	
	public function hasIngredient($ingredient){		
		return in_array($ingredient, $this->ingredients);
	}	
	
	public static function getSizes(){
		return array('small', 'medium', 'large');
	}
}

class Entree extends Entree4 {
	
	public function __construct($name, $ingredients){			    	
		if(!is_array($ingredients)){
			throw new Exception('$ingredients must be an array');
		}		
		foreach($ingredients as $ing){		
			if (!$ing instanceof \Ingre\Ingredient){
			    throw new Exception('Element of $entree must be ingredient object');
		    }			
		}		
		parent::__construct($name, $ingredients); 					
	}
	
	public function getPrice(){
		$totalPrice = 0;
		foreach($this->ingredients as $ing){		
			$totalPrice += $ing->getPrice();
		}
		return $totalPrice;
		
	}
}

$ing = new \Ingre\Ingredient('bread',10);
$ing2 = new \Ingre\Ingredient('soup',3);
$ent = new Entree("my eat", array($ing, $ing2));
print $ent->getPrice();


?>