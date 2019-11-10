<?php
//9-11 - zápis dat naformátovaných jako CSV do souboru

try{
	$db = new PDO('sqlite:restaurant.db');
} catch (PDOException $e){
	print "Couldn't connect to database: ".$e->getMessage();
	exit();
}

$fh = fopen('dish-list.csv','wb');
$stmt = $db->query('SELECT dish_name, price, is_spicy FROM dishes');
while($row = $stmt->fetch(PDO::FETCH_NUM)){
  //$info[0] je název jídla, první položka v dish.csv na řádku
  //$info[1] je cena, (druhá položka)
  //$info[2] je ostrost (třetí položka)
  fputcsv($fh, $row);  //fputcsv přidá na konec řádku znak konce řádku (newline)
  print "Dish $row[0] written to the csv file.<br>";
}
fclose($fh);


?>