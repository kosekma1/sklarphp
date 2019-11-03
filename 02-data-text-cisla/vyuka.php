<?php

echo "<h1>Here document</h1>";

print <<<HTMLBLOCK
<html>
<h2>Ahoj</h2>
<ul>
<li>první položka</li>
<li>první položka</li>
<li>první položka</li>
</ul>
</html>
HTMLBLOCK;


//$_POST['zipcode'] = ' 41201 ';
$postzipcode = '41201';
$zipcode = trim($postzipcode); //odstraní počáteční a koncové mezery
$zip_length = strlen($zipcode); //délka textu - počet znaků
if($zip_length!=5){
	print "Please enter a zip code that is 5 characters long.";
} else {
	print "$zipcode<br />";		
}

//stručnější kód
if(strlen((trim($postzipcode))) != 5){
	print "Please enter a zip code that is 5 characters long.";
} else {
	print "$zipcode<br />";			
}

//porovnání řetězců - respektuje velikost písmen
$email = 'president@whitehouse.gov';
if($email == 'president@whitehouse.gov'){
	print "Email je $email<br />";
}

//porovnání řetězců bez ohledu na velikost
$email = 'president@whitehouse.GOV';
if(strcasecmp($email, 'president@whitehouse.gov') == 0){
	print "Email je $email<br />";
}

//formátování řetězců
printf("Desetiné číslo na dvě destinná čísla: %0.2f<br />", 15.234);

//vyplnění data nulami
printf("ZIP is %05d and the date is %02d/%02d/%d<br />", $zipcode, 2, 6, 2007);

//zobrazení znamének
$min = -48;
$max = 40;
printf("The computer can operate between %+d and %+d degrees Celsisus.<br />", $min, $max);

//změna velikosti textu
print strtolower('Beef, CHICKEN, Pork, DuCK<br />');
print strtoupper('Beef, CHICKEN, Pork, DuCK<br />');

//první písmena slov velká
print ucwords(strtolower('JOHN FRANKENHEIMER<br />'));

//zkrácení řetězce pomocí substring
print substr('Muj komentar je zkraceny', 0, 15); //extrahuje 15 znaku od indexu 0
print "<br />";

//extrahování znaků od konce
print "Extrahování znaků od konce. Card XXX";
print substr('6541321456789', -4, 4); //extrahuje 4 znaky od indexu -4
print "<br />";

//nahrazení řetězce
$html = '<span class ="{class}">Fried Bean Curd</span>
         <span class ="{class}">Oil-Soaked Fish</span>';   
$my_class = 'lunch';
print str_replace('{class}', $my_class, $html);


?>