<?php
//9-13 - odeslání CSV souboru prohlížeči

try{
	$db = new PDO('sqlite:restaurant.db');
} catch (PDOException $e){
	print "Couldn't connect to database: ".$e->getMessage();
	exit();
}

//sdělí webovému klientoiv, že prichází CSV soubor s názvem "dishes.csv"
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="dishes.csv"');

//otevře handle souboru do výstupního proudu - php"//output je speciální vestavěný souborový handle, který odesílá data na stejné místo, kam je posílá print
$fh = fopen('php://output','wb');

$stmt = $db->query('SELECT dish_name, price, is_spicy FROM dishes');
while($row = $stmt->fetch(PDO::FETCH_NUM)){
  //$info[0] je název jídla, první položka v dish.csv na řádku
  //$info[1] je cena, (druhá položka)
  //$info[2] je ostrost (třetí položka)
  fputcsv($fh, $row);  //fputcsv přidá na konec řádku znak konce řádku (newline)  
}
fclose($fh);


?>