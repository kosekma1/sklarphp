<?php

//6-1 - definice třídy
class Entree {
	public $name;
	public $ingredients = array();
	
	public function hasIngredient($ingredient){	
		print $ingredient.">>><br>";
		return in_array($ingredient, $this->ingredients);
	}	
}

//6-2 - vytvoření objektů a práce s nimi
$soup = new Entree;
$soup->name = 'Chicken Soup';
$soup->ingredients = array('chicken','water');

$sandwich = new Entree;
$sandwich->name = 'Chicken Sendwiche';
$sandwich->ingredients = array('chicken','bread');

foreach(['chicken', 'lemon', 'bread','water'] as $ing){
	if($soup->hasIngredient($ing)){
		print "Soup contains $ing.<br>";
	}
	if($sandwich->hasIngredient($ing)){
		print "Sandwich contains $ing.<br>";
	}
}

//6-3 - definice statické metody
class Entree2 {
	public $name;
	public $ingredients = array();
	
	public function hasIngredient($ingredient){		
		return in_array($ingredient, $this->ingredients);
	}	
	
	public static function getSizes(){
		return array('small', 'medium', 'large');
	}
}

$sizes = Entree2::getSizes();
print_r($sizes);

//6-6 - inicializace objektu konstruktorem
class Entree3 {
	public $name;
	public $ingredients = array();
	
	public function __construct($name, $ingredients){
		$this->name = $name;
		$this->ingredients = $ingredients;
		print $this->name." : ".$name;
	}
	
	public function hasIngredient($ingredient){		
		return in_array($ingredient, $this->ingredients);
	}	
	
	public static function getSizes(){
		return array('small', 'medium', 'large');
	}
}

$soup = new Entree3('Chicken soup',array('chicken','water'));
$sandwich = new Entree3('Chicken sandwich',array('chicken','bread'));

print "<br>";
print "name: ".$soup->name;
print "<br>";
print "name: ".$sandwich->name;
print "<br>";
print_r($soup->ingredients);
print("<br>");
print_r($sandwich->ingredients);
print("<br>");

//6-7 - vygenerování výjimky
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


//6-8 - vygenerování výjimky
/*
$drink = new Entree4('Glass of Milk','milk');
if($drink->hasIngredient('milk')){
	print' Yummy!';
}
*/

//6-9 - ošetření výjimky
try {
	$drink = new Entree4('Glass of Milk','milk');
	if($drink->hasIngredient('milk')){
	  print' Yummy!';
	}
} catch (Exception $e){
	print "Couldn't create the drink: ".$e->getMessage();
}

// 6-10 - Třída odvozená ze třídy Entree
class ComboMeal extends Entree4 {
	public function hasIngredient($ingredient){
		foreach($this->ingredients as $entree){
			if($entree->hasIngredient($ingredient)){
				return true;
			}
		}
		return false;
	}
}

// 6-11 - Použití podtřídy
$soup = new Entree4('Chicken Soup', array('chicken','water'));
$sandwich = new Entree4('Chicken Sandwich', array('chicken','bread'));

$combo = new ComboMeal('Soup + Sandwich', array($soup, $sandwich));
print "<br>";
foreach(['chicken','water','bread'] as $ing){	
	if($combo->hasIngredient($ing)){
		print "Something in the combo contains $ing<br>";
	}
}

// 6-12 - Vlastní konstruktor podtřídy
class ComboMeal2 extends Entree4 {
	
	public function __construct($name, $entrees){
		parent::__construct($name, $entrees);
		foreach($entrees as $entree){
			if(!$entree instanceof Entree4){
				throw new Exception('Elements of $entrees must be Entree objects');
			}
		}
	}
	
	public function hasIngredient($ingredient){
		foreach($this->ingredients as $entree){
			if($entree->hasIngredient($ingredient)){
				return true;
			}
		}
		return false;
	}
	
}

$soup = new Entree4('Chicken Soup', array('chicken','water'));
$sandwich = new Entree4('Chicken Sandwich', array('chicken','bread'));

$combo = new ComboMeal2('Soup + Sandwich', array($soup, $sandwich));
print "<br>";
foreach(['chicken','water','bread'] as $ing){	
	if($combo->hasIngredient($ing)){
		print "Something in the combo contains $ing<br>";
	}
}

//6-13 - změna viditelnosti vlastnosti
class Entree5 {
	private $name;
	protected $ingredients = array();
	
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
//6-13b - testování funkčnosti
class ComboMeal3 extends Entree5 {
	
	public function __construct($name, $entrees){
		parent::__construct($name, $entrees);
		foreach($entrees as $entree){
			if(!$entree instanceof Entree5){
				throw new Exception('Elements of $entrees must be Entree objects');
			}
		}
	}
	
	public function hasIngredient($ingredient){
		foreach($this->ingredients as $entree){
			if($entree->hasIngredient($ingredient)){
				return true;
			}
		}
		return false;
	}
	
}

$soup = new Entree5('Chicken Soup', array('chicken','water'));
$sandwich = new Entree5('Chicken Sandwich', array('chicken','bread'));

$combo = new ComboMeal3('Soup + Sandwich', array($soup, $sandwich));
print "<br>";
foreach(['chicken','water','bread'] as $ing){	
	if($combo->hasIngredient($ing)){
		print "Something in the combo contains $ing<br>";
	}
}

?>