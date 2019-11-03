<?php
//7-6 zpracování formuláře funkcemi a 7-7 validace dat
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//jestliže validate_form vrátí chyby, předají se funkci show_form
	if($form_errors = validate_form()){
		show_form($form_errors);		
	} else {
		process_form();		
	}	
} else {
	show_form();
}

function process_form(){
	print "Hello, ".$_POST['my_name'];
}

function show_form($errors = null){
	//pokud došlo k chybám
	if($errors){ //prázdné pole se vyhodnotí na false
		print 'Please correct these errors: <ul><li>';
		print implode('</li><li>', $errors);
		print '</li></ul>';
	}	
	print<<<_HTML_
<form method="post" action="$_SERVER[PHP_SELF]">		
Your name: <input type="text" name="my_name"><br>
<input type="submit" value="Say Hello">
</form>
_HTML_;
	
}

function validate_form(){
	
	//začne s prázdným polem chybových zpráv
	$errors = array();
	
	if(strlen($_POST['my_name']) < 3){
		$errors[] = 'Your name must be at least 3 letters long.';		
	} 
	
	//vrátí (možná prázdné) pole chybových zpráv
	return $errors;
}

?>