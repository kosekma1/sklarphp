<?php

//připojení k databázi a vytvoření tabulky a naplnění daty - připrava pro další cvičení
try {
	$db = new PDO('sqlite:restaurant_cviceni.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//nejdříve tabulku odstraníme pokud existuje
	$db->exec('DROP TABLE IF EXISTS dishes');
	
	//vytvoříme tabulku
	$db->exec('CREATE TABLE dishes (
				dish_id INT,
				dish_name VARCHAR(255),
				price DECIMAL(4,2),
				is_spicy INT)');	
	
	//naplníme tabulku daty
	$db->exec("INSERT INTO dishes VALUES (1,'Walnut Bun',1.00,0)");	
	$db->exec("INSERT INTO dishes VALUES (2,'Cashew Nuts and White Mushrooms',4.95,0)");	
	$db->exec("INSERT INTO dishes VALUES (3,'Dried Mulberries',3.00,0)");	
	$db->exec("INSERT INTO dishes VALUES (4,'Eggplant with Chili Sauce',6.50,1)");	
	$db->exec("INSERT INTO dishes VALUES (5,'Red Bean Bun',1.00,0)");	
	$db->exec("INSERT INTO dishes VALUES (6,'General Tso''s',5.5,1)");		
	print "Table dishes created and rows inserted successfully";
} catch (PDOException $e){
	print "Couldn't connect, create or insert to database: ".$e->getMessage();
}

//cvičení 1
print "<h1>Cvičení 1</h1>";
try {
	$db = new PDO('sqlite:restaurant_cviceni.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	
	$stmt = $db->query('SELECT * FROM dishes ORDER BY price');
	
	print '<table>';
	print '<tr><th>Dish Name</th><th>Price</th><th>Spicy?</th></tr>';
	while($dish=$stmt->fetch()){
		
		if($dish->is_spicy == 1){
			$spicy = 'yes';
		} else {
			$spicy = 'no';
		}
		
		printf('<tr><td>%s</td><td>%.02f</td><td>%s</td></tr>', htmlentities($dish->dish_name), $dish->price, $spicy);		
	}
		
} catch (PDOException $e){
	print "Couldn't connect to database: ".$e->getMessages();
}

?>