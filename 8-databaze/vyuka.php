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
try{
  $db = new PDO('sqlite:restaurant.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //nastavení úrovně kontroly chyb
  $q = $db->exec("CREATE TABLE dishes (
					dish_id INT,
					dish_name VARCHAR(255),
					price DECIMAL(4,2),
					is_spicy INT
				  )");	
  print "Table dishes was created. Status = ". $q;				  
} catch(PDOException $e){
	print "Couldn't create table: ". $e->getMessage();
}

//8-5 - removing a table - inreversible operation
try{
  $db = new PDO('sqlite:restaurant.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //nastavení úrovně kontroly chyb
  $q = $db->exec("DROP TABLE dishes");				   
  print "<br>Table dishes was dropped. Status = ".$q;
} catch(PDOException $e){
	print "Couldn't create table: ". $e->getMessage();
}

print "<br>";
$upass = "Martin1978";
//$encoded_pass = hash('SHA512', $upass);
$encoded_pass = sha1($upass);
echo $encoded_pass;





?>