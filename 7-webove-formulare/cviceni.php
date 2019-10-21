<?php

//1. cvičení
$_POST['noodle'] = 'barbecued pork';
$_POST['sweet'] = array('puff','ricemat',);
$_POST['sweet_q'] = 4;

print "<h1>Cvičení 1</h1>";
print_r($_POST);
print "<br>";

//2. cvičení
function process_form(){
	foreach($_POST as $value){
		if (is_array($value)){
			print_r($value);
		} else {
		   print $value."<br>";	
		}
		
	}
}
print "<h1>Cvičení 2</h1>";
process_form();

//3. Cvičení

function calc(){
	$errors = array();
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		
		$input['operand1'] = filter_input(INPUT_POST,'operand1', FILTER_VALIDATE_FLOAT);
		$input['operand2'] = filter_input(INPUT_POST,'operand2', FILTER_VALIDATE_FLOAT);
		$input['operator'] = $_POST['operator'] ?? '';
		
		if(is_null($input['operand1']) || ($input['operand1']===false)){
			$errors[] = 'You must enter number for operand 1';
		}
		
		if(is_null($input['operand2']) || ($input['operand2']===false)){
			$errors[] = 'You must enter number for operand 2';
		}
		
		if(!in_array($input['operator'], ['+','-','/','*'])){
			$errors[] = 'You have to select right operator';
		}
				
		if($errors){
			print "<ul><li>";
			print implode("</li><li>", $errors);
			print "</li><ul>";			
		} else {			
			if ($input['operator']=='+') { printf("%.2f + %.2f = %.2f" , $input['operand1'], $input['operand2'], ($input['operand1']+$input['operand2'])); }			
			if ($input['operator']=='-') { printf("%.2f - %.2f = %.2f" , $input['operand1'], $input['operand2'], ($input['operand1']-$input['operand2'])); }				
			if ($input['operator']=='*') { printf("%.2f * %.2f = %.2f" , $input['operand1'], $input['operand2'], ($input['operand1']*$input['operand2'])); }			
			if ($input['operator']=='/') { printf("%.2f / %.2f = %.2f" , $input['operand1'], $input['operand2'], ($input['operand1']/$input['operand2'])); }							
		}
		
		
	} else {
		print <<<_HTML_
<form method="POST" action="{$_SERVER['PHP_SELF']}">
<input type="text" size="10" name="operand1">
<select name="operator">
<option>+</option>
<option>-</option>
<option>*</option>
<option>/</option>
<input type="text" size="10" name="operand2">
<input type="submit" name="count" value="Calculate">
</form>		
_HTML_;
	}	
}
print "<h1>Cvičení 3</h1>";
calc();

?>