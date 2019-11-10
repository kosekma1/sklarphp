<?php

//9-17 - Kontrola chyb z fopen() nebo fclose()
try {
	$db = new PDO('sqlite:restaurant.db');
} catch (PDOException $e){
	print "Couldn't connect to database: ".$e->getMessage();
}

$fh = fopen('./dishes.txt', 'wb');
if(!$fh){
	print "Error opening dishes.txt: $php_errormsg"; //$php_erroormsg je globální proměnná a obsahuje chybovou zprávu
} else {
	$q = $db->query("SELECT dish_name, price, is_spicy FROM dishes");	
}

while($row=$q->fetch()){
	fwrite($fh,"The price of $row[0] is $row[1] \n");
}
print "Dishes was wrote to file.<br>";

if(!fclose($fh)){
	print "Error closing dishes.txt: $php_errormsg";
}

//9-18 - kontrola , zda volání file_get_contents() neskončilo chybou.
$page = file_get_contents('./cteni-a-zapis/page-template.html');
if($page === false){
	print "Coulnd't load template: $php_errormsg";
} else {
	//zpracování šablony
	print "Zpracování šablony";
}

//9-19 - kontrola, zda neskončilo chybou volání fopen(), fgets() nebo flcose()
$fh = fopen('people.txt', 'rb');
if(!$fh){
	print "Error closing dishes.txt: $php_errormsg;";
} else{
	while(!feof($fh)){
		$line = fgets($fh);
		if($line!==false){
			$line = trim($line);
			$info = explode('|', $line);
			print '<li><a href="mailto:'.$info[0].'">'.$info[1]."</li>\n";
		}
	}
}
if(!fclose($fh)){
	print "Error closing people.txt: $php_errormsg";
}

?>