<?php


//connecting to MySQL database
//$db = new PDO('mysql:host=db.example.com;dbname=restaurant','penguin','top^hat');

//8-2 - Catching connection errors - connecting to SQlite database
try{
  $db = new PDO('sqlite:restaurant.db');
} catch(PDOException $e){
	print "Couldn't connect to the database: ";
}

//8-4 connecting to SQlite database and executing SQL command create table
function createTableDishes(){
	try{
	  $db = new PDO('sqlite:restaurant.db');
	  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //nastavení úrovně kontroly chyb
	  $q = $db->exec("CREATE TABLE dishes (
						dish_id INTEGER PRIMARY KEY,
						dish_name VARCHAR(255),
						price DECIMAL(4,2),
						is_spicy INT
					  )");	
	  print "Table dishes was created. Status = ". $q;				  
	} catch(PDOException $e){
		print "Couldn't create table: ". $e->getMessage();
	}
}
createTableDishes();

//8-5 - removing a table - inreversible operation
function deleteTableDishes(){
	try{
	  $db = new PDO('sqlite:restaurant.db');
	  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //nastavení úrovně kontroly chyb
	  $q = $db->exec("DROP TABLE dishes");				   
	  print "<br>Table dishes was dropped. Status = ".$q;
	} catch(PDOException $e){
		print "Couldn't create table: ". $e->getMessage();
	}
}
deleteTableDishes();

//8-6 - vkládání dat s exec()
print "<br>";
createTableDishes();
print "<br>";

try {
	$db = new PDO('sqlite:restaurant.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$affectedRows = $db->exec("INSERT INTO dishes (dish_name, price, is_spicy) VALUES ('Sesame Seed Puff', 2.50, 0)");
	print "Affceted rows: ".$affectedRows."<br>";
} catch (PDOException $e){
	print "<br>Couldn't insert a row: ". $e->getMessage();
}

//8-7 - kontrola chyb z exec()
try {
	$db = new PDO('sqlite:restaurant.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$affectedRows = $db->exec("INSERT INTO dishes (dish_size, dish_name, price, is_spicy) VALUES ('Sesame Seed Puff', 2.50, 0)"); //neexistujici sloupec
	print "Affceted rows: ".$affectedRows."<br>";
} catch (PDOException $e){
	print "<br>Couldn't insert a row: ". $e->getMessage();
}

//8-8 - práce v tichém chybovém módu (bez ERRMODE_)
try {
	$db = new PDO('sqlite:restaurant.db');
} catch (PDOException $e){
	print "Couldn't connect".$e->getMessage();
}

$result = $db->exec("INSERT INTO dishes (dish_size, dish_name, price, is_spicy) VALUES ('Sesame Seed Puff', 2.50, 0)"); //neexistujici sloupec
if(false===$result){
	$error = $db->errorInfo();
	print "Couldn't insert!<br>";
	print "SQL Error={$error[0]}, DB Error={$error[1]}, Message={$error[2]}<br>";
}

//8-9 - práce v upozorňujícím chybovém módu (ERRMODE_WARNING)
try {
	$db = new PDO('sqlite:restaurant.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e){
	print "Couldn't connect".$e->getMessage();
}

$result = $db->exec("INSERT INTO dishes (dish_size, dish_name, price, is_spicy) VALUES ('Sesame Seed Puff', 2.50, 0)"); //neexistujici sloupec
if(false===$result){
	$error = $db->errorInfo();
	print "Couldn't insert!<br>";
	print "SQL Error={$error[0]}, DB Error={$error[1]}, Message={$error[2]}<br>";
}

//8-15 - změna dat UPDATE s exec()

try {
	$db = new PDO('sqlite:restaurant.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//nejdříve tam řádky vložím
	$affectedRows = $db->exec("INSERT INTO dishes (dish_name, price, is_spicy) VALUES ('Eggplant with Chili Sauce', 10, 0)");
	$affectedRows = $db->exec("INSERT INTO dishes (dish_name, price, is_spicy) VALUES ('Lobster with Chili Sauce', 20, 0)");
	
	$db->exec("UPDATE dishes SET is_spicy=1 WHERE dish_name='Eggplant with Chili Sauce' ");
	$db->exec("UPDATE dishes SET price=price*2 WHERE dish_name='Lobster with Chili Sauce' ");
	print "Affceted rows: ".$affectedRows."<br>";
} catch (PDOException $e){
	print "<br>Couldn't update a row: ". $e->getMessage();
}

//8-16 - odstraňování dat s exec()
try {
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$make_things_cheaper = true;
	if($make_things_cheaper){
		// odstraní drahá jídla
		$count = $db->exec("DELETE FROM dishes WHERE price>19.95");	
		print "<br>Expensive dishes deleted. Affected rows: ".$count;
	} else {
		//nebo odstraní všechna jídla
		$db->exec("DELETE from dishes");
		print "All data deleted.";
	}
} catch (PDOException $e){
	print "Couldn't delete rows ".$e->getMessage();
}

//8-17 - zjištění, kolik řádků ovlivnil příkaz UPDATE nebo DELETE
try {
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$count = $db->exec("UPDATE dishes SET price = price + 2 WHERE price > 3");	
	print '<br>Change the price of '.$count.' rows';	
} catch (PDOException $e){
	print "Couldn't delete rows ".$e->getMessage();
}

?>