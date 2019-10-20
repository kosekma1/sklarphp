<?php

// 1. cvičení
$cities_people = array ( 'NY' => array('New York' => 8175133),
						 'IL' => array('Chicago' => 2695598),
						 'CA' => array('Los Angeles' => 3792621,'San Diego' => 1307402, 'San Jose' => 945942),		
						 'TX' => array('Houston' => 2100263,'San Antonio' => 3792621, 'Dallas' => 1197816),
						 'PA' => array('Philadelphia' => 1526006),
						 'ZA' => array('Phoenix' => 1445632)			 						 						 
						);

$total_population = 0;

print "<table border='1'>";
print "<tr><th>City</th><th>Population</th>";
foreach($cities_people as $country_short => $cities){			
	foreach($cities as $city => $population){
		printf("<tr><td>%s</td><td align='right'>%s</td></tr>", $city, number_format($population,0,'.',' '));
		$total_population += $population;
	}	
}
print "</table>";
print "Total population is ".number_format($total_population,0,'.',' ');

//2. cvičení
$cities = array('New York' => 8175133,
				'Chicago' => 2695598,
				'Los Angeles' => 3792621,'San Diego' => 1307402, 'San Jose' => 945942,		
				'Houston' => 2100263,'San Antonio' => 3792621, 'Dallas' => 1197816,
				'Philadelphia' => 1526006,
				'Phoenix' => 1445632			 						 						 
				);

asort($cities); //seřazení pole hodnot se zachováním klíčů

print "<br><br>";
print "<table border='1'>";
print "<tr><th>Country</th><th>Population</th>";
foreach($cities as $city => $population){
		printf("<tr><td>%s</td><td align='right'>%s</td></tr>", $city, number_format($population,0,'.',' '));	
}
print "</table>";

ksort($cities); //seřazení podle klíčů

print "<br><br>";
print "<table border='1'>";
print "<tr><th>Country</th><th>Population</th>";
foreach($cities as $city => $population){
		printf("<tr><td>%s</td><td align='right'>%s</td></tr>", $city, number_format($population,0,'.',' '));	
}
print "</table>";

//3. cvičení

$cities_people = array ( 'NY' => array('New York' => 8175133),
						 'IL' => array('Chicago' => 2695598),
						 'CA' => array('Los Angeles' => 3792621,'San Diego' => 1307402, 'San Jose' => 945942),		
						 'TX' => array('Houston' => 2100263,'San Antonio' => 3792621, 'Dallas' => 1197816),
						 'PA' => array('Philadelphia' => 1526006),
						 'ZA' => array('Phoenix' => 1445632)			 						 						 
						);

print "<br><br>";
print "<table border='1'>";
print "<tr><th>State</th><th>Population</th>";
foreach($cities_people as $country_short => $cities){
	$population_sum = 0;
    printf("<tr><td>%s</td>", $country_short);	
	foreach($cities as $city => $population){		
		$population_sum += $population;
	}	
	printf("<td>%s</td><tr>", number_format($population_sum,0,'.',' '));		
}
print "</table>";

//4. cvičení
$students = [ 'Greg Smith' => ['grade'=>'A', 'id'=1], 'Adam Novak' => ['grade'=>'B', 'id'=2 ] ];

$items = [ 'oranges' => 10, 'pens' => 20, 'papers' => 100];

$week_food = [ 'Monday' => ['lunch' => [ 'main' => 'dumplings', 'desert' => 'iceream', 'drink' => 'tea', 'price' => 123]],
               'Tuesday' => ['lunch' => [ 'main' => 'dumplings', 'desert' => 'iceream', 'drink' => 'tea', 'price' => 99]]
			 ];
$family_names = ['Martin','Pepa','Pavel','Dusan','Klara'];               
$family = [ "Martin" => ['age' => 40, 'relation' => 'me'],
            "Edita" => ['age' => 78, 'relation' => 'mother'],
			"Josef" => ['age' => 77, 'relation' => 'father']
		   ]



?>