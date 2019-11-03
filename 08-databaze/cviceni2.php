<?php

require 'FormHelper.php';

try {
	$db = new PDO('sqlite:restaurant_cviceni.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e){
	print "Couldn't connect to database".$e->getMessage();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	list($errors, $input) = validate_form();
	if($errors){
		show_form($errors);
	} else {
		process_form($input);
	}
} else {
	show_form();
}

function validate_form(){
	
	$errors = array();
	$input = array();
	
	$input['price'] = filter_input(INPUT_POST,'price', FILTER_VALIDATE_FLOAT);
	if ($input['price'] === null || $input['price'] === false){
		$errors[] = 'Enter valid minimum price';
	}
	
	if($input['price']<0){
		$errors[] = 'Enter positive value of the price';
	}	
	
	return array($errors, $input);
}

function show_form($errors=array()){
				
	$defaults = array('price' => '5');
	$form = new FormHelper($defaults);

	//formulář START - obvykle bývá v samostatném souboru kvůli modularitě		
	if($errors) {
		print '<ul>';
		foreach($errors as $error){
			print '<li>'.$error.'</li>';
		}
		print '<ul>';
	}
	
	print "<form method='POST' action='{$form->encode($_SERVER['PHP_SELF'])}'>";
	print $form->input('text',['name' => 'price']);
	print $form->input('submit',['name' => 'send', 'value' => 'Send']);	
	print "</form>";
	//formulář END
}

function process_form($input){
	
	global $db;
	$stmt = $db->prepare('SELECT dish_name, price FROM dishes WHERE price <= ?');
	$stmt->execute(array($input['price']));
	
	$dishes = $stmt->fetchAll();
	
	if (count($dishes) == 0){
		print 'No dishes matched';
	} else {	
		print '<table>';
		print '<tr><th>Dish Name</td><th>Price</th></tr>';
		foreach($dishes as $dish){
			printf('<tr><td>%s</td><td>%.02f</td></tr>', $dish->dish_name, $dish->price);
		}
		print '</table>';	
	}	
}

?>

