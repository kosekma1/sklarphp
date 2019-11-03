<?php

//4-1
$vegetables = array(
				'corn' => 'yellow',
				'beet'=> 'red',
				'carrot' => 'orange'				
				);
$dinner = array(
				0 => 'Sweet Corn and Asparagus',
				1 => 'Lemon Chicken',
				2 => 'Braised Bamboo Fungus'				
				);
$computers = array(
				'trs-80' => 'Radio Shack',
				2600 => 'Atari',
				'adam' => 'Coleco'				
				);

print_r($vegetables);
print_r($dinner);
print_r($computers);
print("<br><br>");

//4-2 - zkrácený zápis
$vegetables = [ 'corn' => 'yellow',
				'beet'=> 'red',
				'carrot' => 'orange'				
			  ];
$dinner = [  0 => 'Sweet Corn and Asparagus',
		   	 1 => 'Lemon Chicken',
		   	 2 => 'Braised Bamboo Fungus'					
		  ];			  
$computers = [	'trs-80' => 'Radio Shack',
			 	2600 => 'Atari',
				'adam' => 'Coleco'				
			 ];

print_r($vegetables);
print_r($dinner);
print_r($computers);
print("<br><br>");
	
//4-3 - přidávání prvků po jednom
$vegetables['corn']= 'yellow';
$vegetables['beet']= 'red';
$vegetables['carrot']= 'orange';

$dinner[0]= 'Sweet Corn and Asparagus';
$dinner[1]= 'Lemon Chicken';
$dinner[2]= 'Braised Bamboo Fungus';

$computers['trs-80']= 'Radio Shack';
$computers[2600]= 'Atari';
$computers['adam']= 'Coleco';

print_r($vegetables);
print_r($dinner);
print_r($computers);
print("<br><br>");

//4-5 - vytvoření číselného pole
$dinner = array(
				'Sweet Corn and Asparagus',
				'Lemon Chicken',
				'Braised Bamboo Fungus'				
				);
print "I want $dinner[0] and $dinner[1]";
print("<br><br>");

//4-6 - přidávání prvků s []
$lunch[] = 'Dried Mushroomns in Brown Sauce'; //$lunch[0]
$lunch[] = 'Pineapple and Zou Fungus'; //$lunch[1]

$dinner = array(
				'Sweet Corn and Asparagus',
				'Lemon Chicken',
				'Braised Bamboo Fungus'				
				);
$dinner[] = 'Flank Skin with Spiced Flavor'; //$dinner[3]

//4-7 - zjištění velikosti pole
$dinner = array(
				'Sweet Corn and Asparagus',
				'Lemon Chicken',
				'Braised Bamboo Fungus'				
				);
$dishes = count($dinner);
print "There are $dishes things for dinner";
print("<br><br>");

//4-8 - smyčka foreach
$meal = array(
				'breakfast' => 'Walnut Bun',
				'snack'=> 'Cashew Nuts and White Mushrooms',
				'dinner' => 'Eggplant with Chili Sauce'				
				);
print "<table border='1'>\n";
foreach($meal as $key => $value){
	print "<tr><td>$key</td><td>$value</td></tr>\n";
}
print "</table>\n";
print("<br><br>");

//4-9 - pravidelné střídání řádků tabulky
$row_style = array('even','odd');
$style_index = 0;
$meal = array(
				'breakfast' => 'Walnut Bun',
				'snack'=> 'Cashew Nuts and White Mushrooms',
				'dinner' => 'Eggplant with Chili Sauce'				
				);
print "<style type='text/css'>.odd {background-color: gray;} .even {background-color: green }</style>";
print "<table border='1'>\n";
foreach($meal as $key => $value){
	print "<tr class='$row_style[$style_index]'><td>$key</td><td>$value</td></tr>\n";
	$style_index = 1 - $style_index; //přepíná mezi 1 a 0
}
print "</table>\n";
print("<br><br>");

//4-10 - modifikování prviků pole s foreach
$meals = array(
				'Walnut Bun' => 1,
				'Cashew Nuts and White Mushrooms' => 4.95,
				'Eggplant with Chili Sauce'	=> 6.50
				);
foreach($meals as $dish=>$price){
	printf("The currenct price of %s is \$%.2f<br>", $dish, $price);
}							
foreach($meals as $dish=>$price){
	//$price = $price * 2 nefungje
	$meals[$dish] = $meals[$dish] * 2;
}
print "<br>";
foreach($meals as $dish=>$price){
	printf("The new price of %s is \$%.2f<br>", $dish, $price);
}

//4-11 - smyčka foreach() pro číselná pole
$dinner = array(
				'Sweet Corn and Asparagus',
				'Lemon Chicken',
				'Braised Bamboo Fungus'				
				);
print "<br>";				
foreach ($dinner as $dish){
	print "You can eat: $dish<br>";
}

//4-12 - procházení číselným polem se smyčkou for()
$dinner = array(
				'Sweet Corn and Asparagus',
				'Lemon Chicken',
				'Braised Bamboo Fungus'				
				);				
print "<br>";		
for($i=0, $num_dishes=count($dinner); $i<$num_dishes; $i++){
	print "Dish number $i is $dinner[$i]<br>\n";
}

//4-13 - pravidelné střídání css tříd pro řádky tabulky se smyčkou for()
$row_style = array('even','odd');
$dinner = array(
				'Sweet Corn and Asparagus',
				'Lemon Chicken',
				'Braised Bamboo Fungus'				
				);		
print "<style type='text/css'>.odd {background-color: gray;} .even {background-color: green }</style>";
print "<br>";	
print "<table border='1'>\n";
for($i=0,$num_dishes=count($dinner); $i<$num_dishes; $i++){
	print "<tr class='".$row_style[$i%2]."'><td>Element $i</td><td>$dinner[$i]</td></tr>\n";	
}
print "</table>\n";
print("<br><br>");

//4-13 - pořadí prvků v poli a foreach()
// prvky byly přidané v jinénm pořadí a foreach je zobrazí jinak než čekáme
$letters[0] = 'A';
$letters[1] = 'B';
$letters[3] = 'D';
$letters[2] = 'C';

//nezaručí pořadí vytištěných prvků
foreach($letters as $letter){
	print $letter;
}

print "<br>";	
//zaručí pořadí vytištěných prvků
for($i=0, $num_letters = count($letters); $i < $num_letters; $i++){
	print $letters[$i];
}

//4-15 - kontrola, zdali v poli existuje prvke s konkrétním klíčem - funkce array_key_exists(hodnota, pole)
$meals = array(
				'Walnut Bun' => 1,
				'Cashew Nuts and White Mushrooms' => 4.95,
				'Dried Mulberries' => 3.00,
				'Eggplant with Chili Sauce'	=> 6.50,
				'Shrimp Puffs' => 0 // Krevety v listovém těstě jsou gratis!
				);
$books = array("The Eater's Guide to Chinese Characters", 'How to Cook and Eat in Chinese');
print "<br>";
if(array_key_exists('Shrimp Puffs', $meals)){
	print "Yes, we have Shrimp Puffs<br>";
}

if(array_key_exists('Steak Sandwich', $meals)){
	print "Yes, we have Steak Sandwich<br>";
}

if(array_key_exists(1,$books)){
	print "Element 1 is How to Cook and Eat in Chinese<br>";
}

//4-16 - kontrola, zdali v poli existuje prvek s konkrétní hodnotou
$meals = array(
				'Walnut Bun' => 1,
				'Cashew Nuts and White Mushrooms' => 4.95,
				'Dried Mulberries' => 3.00,
				'Eggplant with Chili Sauce'	=> 6.50,
				'Shrimp Puffs' => 0 // Krevety v listovém těstě jsou gratis!
				);				
$books = array("The Eater's Guide to Chinese Characters", 'How to Cook and Eat in Chinese');
if(in_array(3, $meals)){
	print "There is a $3 item.<br>";
}
if (in_array('How to Cook and Eat in Chinese', $books)){
	print "We have How to Cook and Eat in Chinese<br>";
}
if(in_array("the eater's guide to chinese characters", $books)){ //bude false in_array rozlišuje malá a velká písmena
	print "We have the The Eater's Guide to Chinese Characters<br>";
}

//4-17 - hledání prvku s konkrétní hodnotou
$meals = array(
				'Walnut Bun' => 1,
				'Cashew Nuts and White Mushrooms' => 4.95,
				'Dried Mulberries' => 3.00,
				'Eggplant with Chili Sauce'	=> 6.50,
				'Shrimp Puffs' => 0 // Krevety v listovém těstě jsou gratis!
				);				
$dish = array_search(6.50, $meals); //array_search vrátí klíč prvku
if($dish){
	print "$dish cost \$6.50<br>";
}

//4-18 - operace s jednotlivými prvky polí
$dishes = array();
$dishes['Beef Chow Foon'] = 12;
$dishes['Beef Chow Foon']++;
$dishes['Roast Duck'] = 3;
$dishes['total'] = $dishes['Beef Chow Foon'] + $dishes['Roast Duck'];

print "<br>";
if($dishes['total'] > 15){
	print "You ate a lot: ";
}
print "<br>";
print 'You ate '.$dishes['Beef Chow Foon'].' dishes of Beef Chow Foon.';

//4-19 - vsouvání hodnot prvků polí řetězců v uvozovkách
$meals = array();
$meals['breakfast'] = 'Walnut Bun';
$meals['lunch'] = 'Eggplant with Chili Sauce';
$amounts = array(3,6);

print "<br>";
print "For breakfast, I'd like $meals[breakfast] and for lunch,\n<br/>";
print "I'd like $meals[lunch]. I want $amounts[0] at breakfast and\n<br/>";
print "$amounts[1] at lunch.";
print "<br>";

//4-20 - vsouvání hodnot prvků polí do řetězců se složenými závorkami
$meals['Walnut Bun'] = "$3.95";
$hosts['www.example.com'] = "website";
print "A Walnut Bun costs {$meals['Walnut Bun']}\n<br>";
print "www.example.com is a {$hosts['www.example.com']}.";

//4-20.5 - odstranění prvku z pole
unset($meals['Walnut Bun']);

//4-21 - přeměna pole na řetězec funkcí implode()
$dimsum = array('Chicken Bun','Stuffed Duck Web', 'Turnip Cake');
$menu = implode(', ', $dimsum);
print "<br>";
print $menu;

$letters = array('A','B','C','D');
print "<br>";
print implode('', $letters);

//4-22 - vytištění řádků HTML tabulky s implode()
$dimsum = array('Chicken Bun','Stuffed Duck Web', 'Turnip Cake');
print "<br>";
print '<table border="1">';
print '<tr><td>'.implode('</td><td>', $dimsum).'</td></tr>';
print '</table>';

//4-23 - přeměna řetězce na pole funkcí explode()
$fish = 'Bass, Carp, Pike, Flounder';
$fish_list = explode(', ', $fish);
print "The second fish is $fish_list[1]";

//4-24 - Seřazení prvků pole s funkcí sort() - měla by se používat jen na číselná pole - resetuje klíče pole poté, co pole seřadí - řadí vzestupně
$dinner = array(
				'Sweet Corn and Asparagus',
				'Lemon Chicken',
				'Braised Bamboo Fungus'				
				);		
$meal = array(
				'breakfast' => 'Walnut Bun',
				'snack'=> 'Cashew Nuts and White Mushrooms',
				'snack' => 'Dried Mulberries',
				'dinner' => 'Eggplant with Chili Sauce'				
			 );
print "<br>";			 
print "<br>";
print "Before Sorting:\n<br>";
foreach($dinner as $key => $value){
	print "\$dinner: $key $value<br>";
}
print "<br>";
foreach($meal as $key => $value){
	print "\$meal: $key $value<br>";
}

sort($dinner);
sort($meal);

print "<br>";			 
print "After Sorting - sort():\n<br>";
foreach($dinner as $key => $value){
	print "\$dinner: $key $value<br>";
}
print "<br>";
foreach($meal as $key => $value){
	print "\$meal: $key $value<br>";
}

//4-25 - Seřazení prvků pole asort() - udržíme s hodnotami jejich klíče i po seřazení - vzestupně
$meal = array(
				'breakfast' => 'Walnut Bun',
				'snack'=> 'Cashew Nuts and White Mushrooms',
				'lunch' => 'Dried Mulberries',
				'dinner' => 'Eggplant with Chili Sauce'				
			 );
			 
print "<br>";
print "Before Sorting:\n<br>";
foreach($meal as $key => $value){
	print "\$meal: $key $value<br>";
}

asort($meal);

print "<br>";
print "After Sorting - asort():\n<br>";
foreach($meal as $key => $value){
	print "\$meal: $key $value<br>";
}

//4-26 - Seřazení prvků pole s ksort() - podle klíčů - vzestupně
$meal = array(
				'breakfast' => 'Walnut Bun',
				'snack'=> 'Cashew Nuts and White Mushrooms',
				'lunch' => 'Dried Mulberries',
				'dinner' => 'Eggplant with Chili Sauce'				
			 );

print "<br>";
print "Before Sorting:\n<br>";
foreach($meal as $key => $value){
	print "\$meal: $key $value<br>";
}

ksort($meal);

print "<br>";
print "After Sorting - ksort():\n<br>";
foreach($meal as $key => $value){
	print "\$meal: $key $value<br>";
}

//4-27 Seřazení prvků pole s arsort() - rsort() řadí v sestupném pořadí
$meal = array(
				'breakfast' => 'Walnut Bun',
				'snack'=> 'Cashew Nuts and White Mushrooms',
				'lunch' => 'Dried Mulberries',
				'dinner' => 'Eggplant with Chili Sauce'				
			 );
print "<br>";
print "Before Sorting:\n<br>";
foreach($meal as $key => $value){
	print "\$meal: $key $value<br>";
}

arsort($meal);

print "<br>";
print "After Sorting - arsort():\n<br>";
foreach($meal as $key => $value){
	print "\$meal: $key $value<br>";
}
print "<br>";
print "<br>";

//4-28 - Vytváření vícerozměrných polí s array() a []
$meals = array(
				'breakfast' => ['Walnut Bun', 'Coffee'],
				'lunch'=> ['Cashew Nuts', 'White Mushrooms'],
				'snack' => ['Dried Mulberries','Salted Sesame Crab']
			 );

$lunches = [ ['Chicken', 'Eggplant', 'Rice'],
             ['Beef', 'Scallions', 'Noodles'],
			 ['Eggplant', 'Tofu'] ];

$flavors = array('Japanese' => array('hot' => 'wasabi', 'salty' => 'soy sauce'),
                 'Chinese' => array('hot' => 'mustard','pepper-salty' => 'prickly ash'));

//4-29 - Jak se přistupuje k prvkům vícerozměrných polí
print $meals['lunch'][1]."<br>"; //White Mushrooms
print $meals['snack'][0]."<br>"; //Dride Mulberries
print $lunches[0][0]."<br>"; //Chicken							 
print $lunches[2][1]."<br>"; //Tofu
print $flavors['Japanese']['salty']."<br>"; //soy sauce
print $flavors['Chinese']['hot']."<br>"; //mustard

//4-30 - Manipulace s vícerozměrnými poli
$prices['dinnes']['Sweet Corn and Aspargus'] = 12.50;
$prices['lunch']['Cashwe Nuts and White Mushrooms'] = 4.95;
$prices['dinner']['Braised Bamboo Fungus'] = 8.95;

$prices['dinner']['total'] = $prices['dinnes']['Sweet Corn and Aspargus'] + $prices['dinner']['Braised Bamboo Fungus'];
print $prices['dinner']['total'];

$specials[0][0] = 'Chestnut Bun';
$specials[0][1] = 'Walnut Bun';
$specials[0][2] = 'Peanut Bun';
$specials[1][0] = 'Chestnut salat';
$specials[1][1] = 'Walnut Salad';

//když vynecháte index, přidáváte na konec pole - tohle vytvoří $specials[1][2]
$specials[1][] = 'Peanut Salad';

//4-31 - procházení vícerozměným polem s foreach()
print "<br><br>";
$flavors = array('Japanese' => array('hot' => 'wasabi', 'salty' => 'soy sauce'),
                 'Chinese' => array('hot' => 'mustard','pepper-salty' => 'prickly ash'));
foreach($flavors as $culture => $culture_flavors){
	foreach($culture_flavors as $flavor => $example){
		print "A $culture $flavor is $example.\n<br>";
	}
}

//4-32 - procházení vícerozměným polem s for()
$specials = array( array('Chestnut Bun', 'Walnut Bun', 'Peanut Bun'), array('Cestnut Salad','Walnut salat','Peanut Salad') );
print "<br><br>";
for($i=0, $num_specials = count($specials); $i<$num_specials;$i++){
	for ($m=0, $num_sub = count($specials[$i]); $m<$num_sub; $m++){
		print "Element [$i][$m] is ". $specials[$i][$m]."\n<br>";
	}
}

//4-33 - vsunutí hodnoty prvku vícerozměrného pole
$specials = array( array('Chestnut Bun', 'Walnut Bun', 'Peanut Bun'), array('Cestnut Salad','Walnut salat','Peanut Salad') );
print "<br><br>";
for($i=0, $num_specials = count($specials); $i<$num_specials;$i++){
	for ($m=0, $num_sub = count($specials[$i]); $m<$num_sub; $m++){
		print "Element [$i][$m] is {$specials[$i][$m]}\n<br>"; 
	}
}

?>