<?php

//9-8 - zapisovani dat do souboru
try {
	$db = new PDO('sqlite:restaurant.db');
} catch (PDOException $e){
	print "Couldn't connect to database: ". $e->getMessage();
}

$fh = fopen('dishes.txt', 'wb'); //zapise na zacatek souboru a kdyz soubor neexistuje, tak ho vytvori

$q = $db->query("SELECT dish_name, price FROM dishes");
while($row=$q->fetch()){
	fwrite($fh,"The price of $row[0] is $row[1] \n");
}

print "Data written to file dishes.txt";

fclose($fh);

?>