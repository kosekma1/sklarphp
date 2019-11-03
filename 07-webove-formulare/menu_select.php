<?php

//položky pro select. V kódu je použito pole $GLOBALS a proto doporučuji proměnné definovat před použitím $GLOBALS;
$sweets = array('Sesame Seed Puff','Coconut Milk Gelatin Square','Brown Sugar Cake','Sweet Rice and Meat');

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

function generate_options($options){
	$html = '';
	foreach($options as $option){
		$html.= "<option>$option</option>\n";
	}
	return $html;
}

function show_form($errors=null){    			
	if($errors){
		print 'Please correct these errors: <ul><li>';
		print implode('</li><li>', $errors);
		print '</li></ul>';
	}
	$sweets = generate_options($GLOBALS['sweets']);
print<<<_HTML_
<form method="post" action="$_SERVER[PHP_SELF]">
Your order: <select name="order">
$sweets
</select>
<br>
<input type="submit" value="Order">
</form>
_HTML_;
	
}

function validate_form(){
	$input['order'] = $_POST['order'];
	$errors = array();
	
	if(!in_array($input['order'], $GLOBALS['sweets'])){ //kontrolujeme existenci hodnoty v poli
		$errors[] = 'Please choose a valid order';
	}
	
	return array($errors, $input);
}

function process_form($input){
	print "You selected ".$input['order']."<br>";
}

?>