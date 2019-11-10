<?php

//9-4 pristup k souboru po radcich
print "<h1>Načtení celého souboru do pole po řádcích</h1>";
print "<ul>";
foreach(file('people.txt') as $line){ //funkce file vrací pole radku ze souboru - nacte cely soubor
	$line = trim($line); //odstrani mezery na zacatku a na konci vcetne '\n'
	$info = explode('|',$line); //rozdeli radek do pole podle oddelovace '|'
	print '<li><a href="mailto:'.$info[0].'">'.$info[1]."</a></li>\n";
}
print "</ul>";

//9-6 cteni souboru radek po radku
print "<h1>Čtení souboru po řádcích</h1>";
print "<ul>";
$fh = fopen('people.txt', 'rb'); //cteni souboru od zacatku
while(!feof($fh) && ($line = fgets($fh))){ //cte soubor radek po radku - vhodne pro velke soubory, ktere by se nemuseli vejit do pameti
	$line = trim($line); //odstrani mezery na zacatku a na konci vcetne '\n'
	$info = explode('|',$line); //rozdeli radek do pole podle oddelovace '|'
	print '<li><a href="mailto:'.$info[0].'">'.$info[1]."</a></li>\n";
}
print "</ul>";

?>