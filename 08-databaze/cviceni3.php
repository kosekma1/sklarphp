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
	
	$input['dish_id'] = filter_input(INPUT_POST,'dish_id', FILTER_VALIDATE_INT);
	
	if ($input['dish_id'] === null || $input['dish_id'] === false){
		$errors[] = 'Please select a dish';
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
	
	global $db;
	
	$stmt = $db->query('SELECT dish_id, dish_name FROM dishes ORDER BY dish_name');	
	$dish_names = array();
	$dishes = $stmt->fetchAll();		
	foreach($dishes as $dish){			
		$dish_names[$dish->dish_id] = $dish->dish_name; //key value slouží pro správné přiřazení hodnoty do value a pak do názvu <option value='key'>name</option>
	}	
	print $form->select($dish_names,['name' => 'dish_id']);
	print $form->input('submit',['name' => 'send', 'value' => 'Get Dish info']);	
	print "</form>";
	//formulář END
}

function process_form($input){
	
	global $db;
			
	$stmt = $db->prepare('SELECT dish_id, dish_name, price, is_spicy FROM dishes WHERE dish_id = ?');	
	$stmt->execute(array($input['dish_id']));
	
	$dish = $stmt->fetch();
	
	if ($dish === false){
		print 'No dish matched.';
	} else {	
		print '<table border="1">';
		print '<tr><th>Dish ID</th><th>Dish Name</th><th>Price</th><th>Spicy?</th></tr>';
		
		if($dish->is_spicy == 1){
			$spicy = 'yes';
		} else {
			$spicy = 'no';
		}
		printf('<tr><td>%d</td><td>%s</td><td>%.02f</td><td>%s</td></tr>', $dish->dish_id, htmlentities($dish->dish_name), $dish->price, $spicy);		
		print '</table>';	
	}	
}

?>

