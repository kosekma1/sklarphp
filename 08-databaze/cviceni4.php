<?php

require 'FormHelper.php';

//připojení k databázi
try {
	$db = new PDO('sqlite:restaurant_cviceni.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);			
	
} catch (PDOException $e){
	print "Couldn't connect to database".$e->getMessage();
}

//vytvoření tabulky customers
try {
	//pokud tabulka neexistuje tak ji vytvoří
	$result = $db->exec('CREATE TABLE IF NOT EXISTS customers  (
	           customer_id INT,
			   customer_name VARCHAR(255),
			   telephone VARCHAR(255),
			   dish_id INT
	          )');    
} catch (PDOException $e){
	print "Couln't create table ".$e->getMessages();
}

$dish_names = array();

try {	
	$stmt = $db->query('SELECT dish_id, dish_name FROM dishes ORDER BY dish_name');	
	$dish_names = array();
	$dishes = $stmt->fetchAll();		
	foreach($dishes as $dish){			
		$dish_names[$dish->dish_id] = $dish->dish_name; //key value slouží pro správné přiřazení hodnoty do value a pak do názvu <option value='key'>name</option>
	}
} catch (PDOException $e){
	print "Couln't select dishes ".$e->getMessages();
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
	
	$input['customer_name'] = trim($_POST['customer_name'] ?? '');
	
	if(strlen($input['customer_name'])==0){
		$errors[] = 'Enter your name';
	}
	
	$input['telephone'] = trim($_POST['telephone'] ?? '');
	
	if(strlen($input['telephone']) < 9){
		$errors[] = 'Enter valid telephone number';
	}
	
	$input['dish_id'] = filter_input(INPUT_POST,'dish_id', FILTER_VALIDATE_INT);
	
	if ($input['dish_id'] === null || $input['dish_id'] === false || !array_key_exists($input['dish_id'], $GLOBALS['dish_names'])){
		$errors[] = 'Please select a valid dish';
	}	
	
	return array($errors, $input);
}

function show_form($errors=array()){
				
	$defaults = array('customer_name' => 'Karel Novak', 'telephone' => '+420123456789');
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
		
	print '<table>';
	print '<tr><td>'.$form->input('text',['name' => 'customer_name'])."</td></tr>";		
	print '<tr><td>'.$form->input('text',['name' => 'telephone'])."</td></tr>";		
	print '<tr><td>'.$form->select($GLOBALS['dish_names'],['name' => 'dish_id'])."</td></tr>";		
	print '<tr><td>'.$form->input('submit',['name' => 'send', 'value' => 'Save customer'])."</td></tr>";			
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
	
		//zjistím jestli už zákazník neexistuje dle jména
		$customer_name = $db->quote($input['customer_name']);
		$customer_name = strtr($customer_name,['_' => '\_', '%' => '\%']);		
		
		$stmt = $db->query("SELECT customer_id FROM customers WHERE customer_name LIKE $customer_name");			
		$current_customer = $stmt->fetch();
						
		if($current_customer){
			print "Customer with the same name already exists";
		} else {		
			$stmt = $db->query('SELECT customer_id FROM customers ORDER BY customer_id DESC LIMIT 1');	
			$customer = $stmt->fetch();			
			
			if($customer){
				//pokud existuje zakaznik s nejvyssím ID zvýším o jednu jeho současné ID
				$customer_id = $customer->customer_id + 1;			
			} else { 
				$customer_id = 1; //zatím žádný záznam neexistuje
			}		 
			//a vložím do tabulky
			$stmt = $db->prepare('INSERT INTO customers (customer_id, customer_name, telephone, dish_id) VALUES (?,?,?,?)');
			$stmt->execute(array($customer_id, $input['customer_name'], $input['telephone'], $input['dish_id']));
			
			print 'Customer '.$customer_id." ".$input['customer_name']." with telephone ".$input['telephone']." and dish_id ".$input['dish_id']." saved.";
		}
	}	
}

?>

