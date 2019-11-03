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

//8-21 - zjištění, kolik řádků ovlivnil příkaz UPDATE nebo DELETE
try {
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$count = $db->exec('UPDATE dishes SET price = price + 2 WHERE price > 3');	
	print '<br>Change the price of '.$count.' rows';	
} catch (PDOException $e){
	print "Couldn't update rows ".$e->getMessage();
}

// 8-26 - bezpečné vložení dat do formuláře
$_POST['dish_name'] = 'Svickova';
try {
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('INSERT INTO dishes (dish_name) VALUES (?)');	
	$count = $stmt->execute(array($_POST['dish_name']));	
	print '<br>Updated rows '.$count.' rows';	
} catch (PDOException $e){
	print "Couldn't insert rows ".$e->getMessage();
}

// 8-27 - několik zástupných otazníků
$_POST['new_dish_name'] = 'pohanka se zeleniou';
$_POST['new_price'] = '20';
$_POST['is_spicy'] = '1';
try {
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('INSERT INTO dishes (dish_name, price, is_spicy) VALUES (?,?,?)');
	$count = $stmt->execute(array($_POST['new_dish_name'], $_POST['new_price'], $_POST['is_spicy']));
	print '<br>Updated rows '.$count.' rows';	
} catch (PDOException $e){
	print "Couldn't insert rows ".$e->getMessage();
}

//8-30 - získávání řádku s query() a fetch()

try {
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$q = $db->query('SELECT dish_name, price FROM dishes');
	print "<br><br>8-30<br>";
	while($row = $q->fetch()){
		print "$row[dish_name], $row[price] \n<br>";
	}
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}
//8-31 - získání všech řádků bez smyčky
try {
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$q = $db->query('SELECT dish_name, price FROM dishes');
	print "<br><br>8-31<br>";
	$rows = $q->fetchAll();
	print_r($rows);
	foreach($rows as $dish){
		print "$dish[dish_name], $dish[price] \n<br>";
	}	
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}

//8-31b - počet řádků v tabulce
try {
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$q = $db->query('SELECT COUNT(*) AS count FROM dishes');
	print "<br><br>8-31b<br>";
	$row = $q->fetch(); //víme, že vrátí jen jeden řádek
	print "Number of returned rows $row[count]";	
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}

//SQL SELECT
/*
    SELECT dish_name, price FROM dishes; //vrátí jen vybrané sloupce
	SELECT * FROM dishes; //vrátí všechny sloupce
	
	//vybere jen ty řádky, které odpovídají daným kritériím
	SELECT dish_name, price FROM dishes WHERE price > 5.00;
    SELECT price FROM dishes WHERE dish_name = 'Walnut Bun':
	SELECT dish_name FROM dishes WHERE price > 5.00 AND price <= 10.00;
	SELECT dish_name FROM dishes WHERE (price > 5.00 AND price <= 10.00) OR dish_name = 'Walnut Bun';
*/

//8-37 - získání řádku s připnutým fetch()
try {
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$cheapest_dish_info = $db->query('SELECT dish_name, price FROM dishes ORDER BY price LIMIT 1')->fetch();
	print "<br><br>8-37<br>";	
	print "$cheapest_dish_info[0], $cheapest_dish_info[1]";	
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}

/*
   SELECT dish_name FROM dishes ORDER BY price; //seřadí jidla od nejlevnějšího po nejdražší - výchozí řazení = od nejnižšího po nejvyšší
   SELECT dish_name FROM dishes ORDER BY price DESC; //seřadí jidla od nejdražšího po nejlevnější
   
   Řadit lze i podle několika sloupců. Pokud budou mít dva řádky stejnou hodnotu v prvním sloupci ORDER BY, seřadí se polde druhého sloupce.
   SELECT dish_name FROM dishes ORDER BY price DESC, dish_name;
   
   Omezení počtu řádků vrácených dotazem SELECT
   ============================================
   SELECT * FROM dishes ORDER BY price LIMIT 1; //jiné databáze mohou mít jiný příkaz než LIMIT; vrátí nejlevnější jídlo
   SELECT dish_name, price FROM dishes ORDER BY price LIMIT 10; //vrátí 10 nejlevnějších jídel seřazených podle ceny
   
   bez příkazu ORDER vrátí prostě prvních X řádků bez seřazení  
   
*/

//8-43 - různé styly dodávání řádků metodou fetch()
try {
	print "<br><br>8-43 - indexy<br>";	
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//když máme jen číslené indexy, snadno se hodnoty spojují dohromady
	$q = $db->query('SELECT dish_name, price FROM dishes');
	while ($row = $q->fetch(PDO::FETCH_NUM)){ //bude vracet řádky jen jako pole s indexy
		print implode(', ',$row)."<br>";
	}	
	
	//když dostaneme objekt, můžeme se na hodnoty obracet jako na vlastnosti objektu
	print "<br><br>8-43 - objekty<br>";	
	$q = $db->query('SELECT dish_name, price FROM dishes');
	while ($row = $q->fetch(PDO::FETCH_OBJ)){ //bude vracet řádky jen jako pole s indexy
		print "{$row->dish_name} has price {$row->price}<br>";
	}
	
	
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}

//8-44 - nastavení výchozího stylu dodávání řádků pro vybraný příkaz ->setFetchMode(...)
try {
	print "<br><br>8-44 - nastavení výchozího stylu dodávání řádků pro vybraný příkaz<br>";	
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//když máme jen číslené indexy, snadno se hodnoty spojují dohromady
	$q = $db->query('SELECT dish_name, price FROM dishes');
	$q->setFetchMode(PDO::FETCH_NUM); //nastavení výchozího stylu pro dodávání řádků pro dané připojení
	while($row = $q->fetch()){ //bude vracet řádky jen jako pole s indexy
		print implode(', ',$row)."<br>";
	}			
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}

//8-44a - nastavení výchozího stylu dodávání řádků pro vše přes ->setAttribute(...)
try {
	print "<br><br>8-44a - nastavení výchozího stylu dodávání řádků pro vše<br>";	
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NUM); //nastavení výchozího stylu dodování řádků pro vše
	
	//když máme jen číslené indexy, snadno se hodnoty spojují dohromady
	$q = $db->query('SELECT dish_name, price FROM dishes');
	while ($row = $q->fetch()){ //bude vracet řádky jen jako pole s indexy
		print implode(', ',$row)."<br>";
	}			
	
	print "<br>Dishes with price less then 5:<br>";
	$anotherQuery = $db->query('SELECT dish_name FROM dishes WHERE price < 5');
	$moreDishes = $anotherQuery->fetchAll(); // každé podpole v $moreDishes je tak0 indexované číselně
	foreach($moreDishes as $dish){
		print "$dish[0]<br>";
	}
	
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}

//8-45 - zástupný symbol otazníku v příkazu SELECT
try {
	print "<br><br>8-45 - zástupný symbol otazníku v příkazu SELECT<br>";	
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NUM); //nastavení výchozího stylu dodování řádků pro vše
	$stmt = $db->exec("INSERT INTO dishes (dish_name, price, is_spicy) VALUES('General Tso''s Chicken',33,0)");
	$stmt = $db->prepare("SELECT dish_name, price FROM dishes WHERE dish_name LIKE ?"); //zástupný znak ? - díky němu se předznačí všechny zástupné znaky SLQ jako ' atd.
	$_POST['dish_search'] = "General Tso's Chicken";
	$stmt->execute(array($_POST['dish_search']));
	while($row = $stmt->fetch()){
	  print_r($row);	 
    }
	
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}

/* Zástupné znaky v SQL
   _   zastupuje jeden znak
   %   zastupuje libovolné množství znaků

	SELECT * FROM dishes WHERE dish_name LIKE 'D%'; // vybere řádky jejichž název jídla začíná na D%
	SELECT * FROM dishes WHERE dish_name LIKE 'Fried _od'; // jen ty řádky kde je např. Fried Mod, Fried Cod atd.
	UPDATE dishes SET price=price*2 WHERE dish_name LIKE '%chili%'; // zdojnásobí cenu jídel, které v názvu obsahují chili
	DELETE FROM dishes WHERE dish_name LIKE '%Shrimp'; // vymaže řádky jejichž název končí na Shrimp
	SELECT * FROM dishes WHERE dish_name LIKE '%50\% off%'; jen ty řádky, které obsahují 50% off
	


*/


//8-50 - nepoužívat zástupný znak v příkazu SELECT
try {
	print "<br><br>8-50a - nepoužívat zástupný znak v příkazu SELECT<br>";
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NUM); //nastavení výchozího stylu dodování řádků pro vše	
	
	$_POST['dish_search'] = "General Tso's Chicken";
	$dish = $db->quote($_POST['dish_search']); //zdvojím horní apostrofy
	$dish = strtr($dish, array('_' => '\_', '%' => '\%')); //nahradím znaky _ a % escapovanými hodnotami
	$stmt = $db->query("SELECT dish_name, price FROM dishes WHERE dish_name LIKE $dish");		
	while($row = $stmt->fetch()){
	  print_r($row);	 
    }
	
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}



//8-51 - nekorektní použití zástupných znaků v příkazu UPDATE
try {
	print "<br><br>8-51 - nekorektní použití zástupných znaků v příkazu UPDATE<br>";
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NUM); //nastavení výchozího stylu dodování řádků pro vše	
	
	$_POST['dish_name'] = 'Svickova';
		
	$stmt = $db->query("UPDATE dishes SET price = 1 WHERE dish_name LIKE ?");		
	$stmt->execute(array($_POST['dish_name']));	
	
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}

//8-52 - korektní použití zástupných znaků v příkazu UPDATE
try {
	print "<br><br>8-52 - nekorektní použití zástupných znaků v příkazu UPDATE<br>";
	$db = new PDO('sqlite:restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NUM); //nastavení výchozího stylu dodování řádků pro vše	
	
	$_POST['dish_name'] = '%';
	$db->quote($_POST['dish_name']);
	$dish = strtr($dish, array('_' => '\_', '%' => '\%'));
	$stmt = $db->exec("UPDATE dishes SET price = 1 WHERE dish_name LIKE $dish");				
	
} catch (PDOException $e){
	print "Couldn't get rows ".$e->getMessage();
}

?>