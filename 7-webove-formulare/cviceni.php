<?php

//1. cvičení
$_POST['noodle'] = 'barbecued pork';
$_POST['sweet'] = array('puff','ricemat',);
$_POST['sweet_q'] = 4;
$_POST['submit'] = 'Order';

print "<h1>Cvičení 1</h1>";
print_r($_POST);
print "<br>";

//2. cvičení a 5. cvičení
function process_form(){
	foreach($_POST as $key=>$value){
		if (is_array($value)){
			foreach ($value as $item){
				if(is_array($item)){
					print_r($item);
					print "<br>";
				} else {
					print $item."<br>";
				}			
			}			
	    } else {
			print htmlentities($key)." : ".htmlentities($value)."<br>";
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
		
		if($input['operator'] == '/' && $input['operand2']==0){
			$errors[] = 'Division by 0 is not allowed.';
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