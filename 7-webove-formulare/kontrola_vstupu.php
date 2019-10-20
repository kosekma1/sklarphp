<?php

//7-9 - povinný element
$_POST['email'] = null;
if(strlen($_POST['email']==0)){
	$errors[] = 'You must enter an email address';
}

//7-10 - filtrování celočíselného vstupu
$ok = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
if(is_null($ok) || ($ok===false)){
	$errors[] = 'Please enter a valid age.';
}

//7-10 - filtrování vstupu v pohzblivé čárce
$ok = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
if(is_null($ok) || ($ok===false)){
	$errors[] = 'Please enter a valid price.';
}

//7-12 - kombinace trim() a strlen()
$_POST['name']= null;
if(strlen(trim($_POST['name'])) == 0){
	$errors[] = 'Your name is required.';
}

//7-13 - vybudování pole modifikovaných vstupních hodnot

function validate_form(){
	$errors = array();
	$input = array();

	$input['age'] = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
	if(is_null($input['age']) || ($input['age']===false)){
		$errors[] = 'Please enter a valid age.';
	}
	
	$input['price'] = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
	if(is_null($input['price']) || ($input['price']===false)){
		$errors[] = 'Please enter a valid price.';
	}
	
	$input['name'] = trim($_POST['name']) ?? '';
	if(strlen($input['name']) == 0){
		$errors[] = 'Your name is required.';
	}

	return array($errors, $input);
}

//7-14 - zpracování chyb a modifikovaných vstupních dat
//Logika: udělat správnou věc na základě metody požadavku
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//jetliže validate_form() vrátí chyby předají se show_form()
	list($form_errors, $input) = validate_form();
	if($form_errors){
		show_form($form_errors);
	} else {
		process_form($input);
	}
} else {
	show_form();
}

function show_form(){
	print('Just show form function');
}

//7-15 - kontrola, zdali číslo spadá do vymezeného rozsahu
$input['age'] = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, array('options' => array('min_range' => 18, 'max_range' => 65)));
if(is_null($input['age'] || ($input['age'] === false))){
	$errors[] = 'Please enter a valid age between 18 and 65.';
}

$input['price'] = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT); //pro desetinná čísla nepodporuje testování rozsahu musíme otestovat sami
if(is_null($input['price']) || ($input['price']===false) || ($input['price']<10.0) || ($input['price']>50.0)) {
	$errors[] = 'Please enter a valid price between $10 and $50.';
}

//7-16 - kontrola rozsahu data
// Uděláme jeden objekt DateTime o šest měsíců do minulosti
$range_start = new DateTime('6 months ago');
// Uděláme další objekt DateTime pro právě teď (dnešní datum)
$range_end = new DateTime();

//čtyřciferný rok je v $_POST['year']
//dvouciferný měsíc je v $_POST['month']
//dvouciferný den je v $_POST['day']
$input['year'] = filter_input(INPUT_POST,'year',FILTER_VALIDATE_INT, array('options' => array('min_range' => 1900, 'max_range' => 2100)));
$input['month'] = filter_input(INPUT_POST,'month',FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 12)));
$input['day'] = filter_input(INPUT_POST,'day',FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 31)));

//nesmíme používat === při porovnání na false, protože 0 není platná
//volba pro rok, ani pro měsíc, ani pro den. checkdate() se přesvědčí zda je číslo dne platné pro daný měsíc a rok

$errors = array();

if($input['year'] && $input['month'] && $input['day'] && checkdate($input['month'],$input['day'],$input['year'])){	
	$submitted_date = new DateTime($input['year'].'-'.$input['month'].'-'.$input['day']);
	if(($range_start > $submitted_date) || ($range_end < $submitted_date)){
		$errors[] = 'Please choose a date less than six months old.';
	} 
} else {
	//K tomuhle dojde, když někdo vynechá některý z parametrů formuláře nebo odešle něco  jako February 31 (31. únor)
	$errors[] = 'Please enter a valid date.';	
} 

if ($errors) {
  print_r($errors);	
} else {
	print_r($submitted_date);
}

//7-17 - Kontrola syntaxe e-mailové adresy
$errors = array();
$input['email'] = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
if(!$input['email']){ //lze použít jelikož jakýkoliv prázdný řetězec bude false a i 0(nula) bude false
	$errors[] = 'Please enter a valid email address';
}
if ($errors) {
  print_r($errors);	
} else {
	print "Email address ".$input['email']." is correct.";
}




?>