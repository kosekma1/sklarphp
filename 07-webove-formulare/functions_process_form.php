<?php
//7-6 zpracování formuláře funkcemi a 7-7 validace dat
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(validate_form()){
		process_form();
	} else {
		show_form();
	}	
} else {
	show_form();
}

function process_form(){
	print "Hello, ".$_POST['my_name'];
}

function show_form(){
	print<<<_HTML_
<form method="post" action="$_SERVER[PHP_SELF]">		
Your name: <input type="text" name="my_name"><br>
<input type="submit" value="Say Hello">
</form>
_HTML_;
	
}

function validate_form(){
	if(strlen($_POST['my_name']) < 3){
		return false;
	} else {
		return true;
	}
}

?>