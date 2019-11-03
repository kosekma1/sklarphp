<?php

require 'FormHelper.php';

$sweets = array('puff' => 'Sesame Seed Puff',
				'square' => 'Coconut Milk Gelatin Square',
				'cake' => 'Brown Sugar Cake',
				'ricemeat' => 'Sweet Rice and Meat');
				
$main_dishes = array('cuke' => 'Braised Sea Cucumber',
					 'stomach' => "Sauteed Pig's Stomach",
					 'tripe' => 'Sauteed Tripe with Wine Sauce',
					 'taro' => 'Stewed Pork with Taro',
					 'giblets' => 'Baked Giblets with Salt',
					 'abalone' => 'Abalone with Marrow and Duck Feet'
					);
					
//logika hlavní stránky					
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//jestliže validate_form vrátí chyby, předají se funkci show_form
	list($errors, $input) = validate_form();
	if($errors){
		show_form($errors);		
	} else {
		process_form($input);		
	}	
} else {
	show_form();
}

function show_form($errors = array()){
	$defaults = array('delivery' => 'yes',
					  'size' => 'medium');
	
	$form = new FormHelper($defaults);
	
	include 'complete-form.php';
}

function validate_form(){
	$input = array();
	$errors = array();
	
	//název 'name' je povinný
	$input['name'] = trim($_POST['name'] ?? '');
	if(!strlen($input['name'])){
		$errors[] = 'Please enter your name';		
	}
	
	//velikost (size) je povinná
	$input['size'] = $_POST['size'] ?? '';
	if (! in_array($input['size'],['small','medium','large'])) {
		$errors[] = 'Please select a size.';
	}
	
	//Desert (sweet) je povinný
	$input['sweet'] = $_POST['sweet'] ?? '';
	if(! array_key_exists($input['sweet'], $GLOBALS['sweets'])){
		$errors[] = 'Please select a valid sweet item.';
	}
	
	//požadují se přesně dvě jídla
	$input['main_dishes'] = $_POST['main_dishes'] ?? array();
	if(count($input['main_dishes'])!=2){
		$errors[] = 'Please select exactly two main dishes. Not two selected';
	} else {
		//víme že jsou vybraná dvě jídla, tak se přesvědčíme, že jsou obě platná
		if(! (array_key_exists($input['main_dishes'][0], $GLOBALS['main_dishes']) && array_key_exists($input['main_dishes'][1], $GLOBALS['main_dishes']))){
			$errors[] = 'Please select exactly two valid main dishes. Bad selection.';
		}		   
	}
	//pokud je zašktrnuto políčko doručení (delivery) musí element comments (komentář) něco obsahovat
	$input['delivery'] = $_POST['delivery'] ?? 'no';
	$input['comments'] = trim($_POST['comments'] ?? '');
	if(($input['delivery'] == 'yes') && (!strlen($input['comments']))){
		$errors[] = 'Please enter zour address for delivery.';
	}
	
	return array($errors, $input);
	
}

function process_form($input){
	//hledá úplné názvy desertu (sweet) a hlavního chodu (main dishes) v polích $GLOBALS['sweet'] a $GLOBALS['main_dishes']
	$sweet = $GLOBALS['sweets'][$input['sweet']];
	$main_dish_1 = $GLOBALS['main_dishes'][$input['main_dishes'][0]];
	$main_dish_2 = $GLOBALS['main_dishes'][$input['main_dishes'][1]];
	if (isset($input['delivery']) && ($input['delivery'] == 'yes')){
		$delivery = 'do';
	} else {
		$delivery = 'do not';
	}
	//sestaví text objednávkové zprávy
	$message = <<<_ORDER_
Thank you for your order.{$input['name']}.
You requested th {$input['size']} size of $sweet, $main_dish_1, and $main_dish_2.
You $delivery want delivery.
_ORDER_;
    if(strlen(trim($input['comments']))){
		$message = 'Your comments: '.$input['comments'];
	}
	
	//odešle zprávu šéfkuchařovi
	mail('chef@restaurant.example.com','New Order', $message);
	//vytiskne zprávu, ale zakóduje HTML entity a změní znaky pro nový řádek na značky <br />
	print nl2br(htmlentities($message, ENT_HTML5));	

}






















?>