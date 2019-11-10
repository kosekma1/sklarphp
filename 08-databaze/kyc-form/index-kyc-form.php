<?php

require "FormHelper.php";
require "data-arrays.php";

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
	include 'kyc-form.php';	
}

function validate_form(){
	$input = array();
	$errors = array();
	
	print "<h1>POST DATA</h1>";
	print "<pre>";
	print_r($_POST);	
	print "</pre>";
	
	/*$input['dish_name'] = trim($_POST['dish_name'] ?? '');
	if(!strlen($input['dish_name'])){
		$errors = 'Please enter the name of the dish';
	}
	
	*/	
	$input['reason'] = $_POST['reason'] ?? '';	
	if($input['reason']){
		foreach($input['reason'] as $origin){
			if(!in_array($origin, $GLOBALS['reason'])){
				$errors[] = "Enter valid reason";
			}
		}
	} else {
		$errors[] = "Select at least one reason.";
	}
	
	$input['employment'] = $_POST['employment'] ?? '';	
	if($input['employment']){	
	  if(!array_key_exists($input['employment'], $GLOBALS['employment'])){
	    $errors[] = "Enter valid employment";
	  }
	} else {
		$errors[] = "Select employment.";
	}
	
	$input['money_origin'] = $_POST['money_origin'] ?? '';	
	if($input['money_origin']){	
	  if(!array_key_exists($input['money_origin'], $GLOBALS['money_origin'])){
	    $errors[] = "Enter valid money origin";
	  }
	} else {
		$errors[] = "Select money origin.";
	}
	
	$input['aml_volume'] = $_POST['aml_volume'] ?? '';			
	if($input['aml_volume']){	
	  if(!array_key_exists($input['aml_volume'], $GLOBALS['aml_volume'])){
	    $errors[] = "Select valid aml volume";
	  }
	} else {
		$errors[] = "Select aml volume.";
	}
	
	$input['aml_owner'] = $_POST['aml_owner'] ?? '';
	if($input['aml_owner']){
		if($input['aml_owner'] != 'real_owner'){
			$errors[] = "Check valid checkbox for real onwer.";
		}
	} else {
		$errors[] = "Check real onwer.";
	}
	
	$input['country'] = $_POST['country'] ?? '';
	if($input['country']){	
	  if(!array_key_exists($input['country'], $GLOBALS['countries'])){
	    $errors[] = "Select valid country";
	  }
	} else {
		$errors[] = "Select country.";
	}
	
	$input['dic'] = trim($_POST['dic'] ?? '');
	if(!$input['dic']){
		$errors[] = "Enter dic.";
	}
	
	return array($errors, $input);
}

function process_form($input){
	
	global $db;
	
	print "<h1>CHECKED INPUT</h1>";
	print "<pre>";
	print_r($input);
	print "</pre>";
	
	/* if($input['is_spicy'] == 'yes'){
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
    */	
}


?>