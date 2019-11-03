<?php

$db = new PDO('sqlite:dinner.db');
$meals = array('breakfast','lunch','dinner');

if(in_array($_GET['meal'], $meals)){
  $stmt = $db->prepare('SELECT dish, price FROM meals WHERE meal LIKE ?');   // return true or false
  if($stmt) {
	/* 1. option */
	$stmt->execute(array($_GET['meal']));
	/* 2. option
	$stmt->bindParam(1,$_GET['meal'],PDO::PARAM_STR);
    $stmt->execute();
	*/
  } else {
	  print "Something went wrong";
	  exit;
  }    
  
  $rows = $stmt->fetchAll();
  
  if(count($rows)==0){
	  print "No dishes available.";
  } else {
	  print '<table><tr><th>Dish</th><th>Price</th></tr>';
	  foreach($rows as $row){
		  print "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
	  }
	  print('</table');
  }
} else {
	print "Unknown meal";
}

?>