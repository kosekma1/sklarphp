<?php

require "FormHelper.php";

try {
	$db = new PDO("sqlite:restaurant.db");	
} catch (PDOException $e){
	print "Can't connect ".$e->getMesssage();
	exit();
}

//připraví se na databázové výjimky
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Logika hlavní stránky
// - jestliže je formulář odeslaný, validuje se a zpracuje, nebo se zobrazí znovu 
// - jestli není odeslaný, zobrazí se 
if($_SERVER['REQUEST_METHOD']== 'POST'){
	list($errors, $input) = validate_form();
	if($errors){
		show_form($errors);
	} else {
		// odeslaná data jsou platná, takže se zpracují
		process_form($input);
	}
} else {
	// Formulář nebyl odeslán, zobrazí se
	show_form();
}

function show_form($errors = array()){
	$defaults = array('price' => 5.00);
	$form = new FormHelper();
	//Veškeré zobrazení HTML a formuláře je kvůli lepší modularitě v samostatném souboru
	include 'insert-form.php';	
}

function validate_form(){
	$input = array();
	$errors = array();
	
	$input['dish_name'] = trim($_POST['dish_name'] ?? '');
	if(!strlen($input['dish_name'])){
		$errors = 'Please enter the name of the dish';
	}
	
	//cena musí být platné číslo v pohyblivé řádové čárce a větší než 0
	$input['price'] = filter_input(INPUT_POST, 'price',FILTER_VALIDATE_FLOAT);
	if($input['price']<=0){
		$errors[] = 'Please enter a valid price';
	}
	
	//výchozí hodnota pro is_spicy (zda je jídlo ostré) je 'no' (není)
	$input['is_spicy'] = $_POST['is_spicy'] ?? 'no';
	
	return array($errors, $input);
}

function process_form($input){
	
	global $db;
	
	if($input['is_spicy'] == 'yes'){
		$is_spicy = 1;
	} else {
		$is_spicy = 0;
	}
	
	try {
		$stmt = $db->prepare('INSERT INTO dishes (dish_name, price, is_spicy) VALUES (?,?,?)');
		$stmt->execute(array($input['dish_name'], $input['price'], $is_spicy));
		print 'Added '.htmlentities($input['dish_name']. ' to the database.');
	} catch (PDOException $e){
		print "Couldnt't add your dish to the database.";
	}		
}


?>