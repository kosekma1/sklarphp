<?php
//9-10 - vkládání dat CSVdo databázeové tabulky

try{
	$db = new PDO('sqlite:restaurant.db');
} catch (PDOException $e){
	print "Couldn't connect to database: ".$e->getMessage();
	exit();
}

$fh = fopen('dishes.csv','rb');
$stmt = $db->prepare('INSERT INTO dishes (dish_name, price, is_spicy) VALUES (?,?,?)');
while(!feof($fh) && ($info=fgetcsv($fh))){
  //$info[0] je název jídla, první položka v dish.csv na řádku
  //$info[1] je cena, (druhá položka)
  //$info[2] je ostrost (třetí položka)
  $stmt->execute($info);	  
  print "Inserted $info[0]\n<br>";
}


?>