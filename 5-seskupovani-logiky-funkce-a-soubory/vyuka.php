<?php

declare(strict_types=1); //vynucení dodržení typu bez pokusu o konverzi na požadovaný typ - musí být na začátku souboru

//5-1 - deklarace funkce
function page_header(){
	print '<html><head><title>Welcome to my site</title></head>';
	print '<body bgcolor="#ffffff">';
}

//5-2 - volání funkce
page_header();
print "Welcome user";
print "</body></html>";

//5-3 - definice funkce předtím nebo potom, co se zavolají
print "<br><br>";
page_header();
$user = "Martin";
print "Welcome, $user";
page_footer();

function page_footer(){
	print "<hr>Thanks for visiting</hr>";
	print "</body></html>";	
}

//5-4 - deklarace funkce s argumentem
function page_header2($color){
	print '<html><head><title>Welcome to my site</title></head>';
	print '<body bgcolor="'.$color.'">';
}

//5-5 - specifikace výchozí hodnoty argumentu. Výchozí hodnoty nemohou být promměné, musejí to být jen literály. 
function page_header3($color='cc3399'){
	print '<html><head><title>Welcome to my site</title></head>';
	print '<body bgcolor="'.$color.'">';
}

//5-6 - Definice funkce přebírající dva argumenty
function page_header4($color, $title){
	print '<html><head><title>'.$title.'</title></head>';
	print '<body bgcolor="'.$color.'">';
}

//5-7 - Volání funkce přebírající dva argumenty
page_header4('66cc66','My homepage');

//5-8 - Několik nepovinných argumentů - nepovinné argumenty musí být uvedeny jako poslední
function page_header5($color, $title, $header='Vítejte'){
	print '<html><head><title>'.$title.'</title></head>';
	print '<body bgcolor="'.$color.'">';
}

function page_header6($color, $title='the page', $header='Vítejte'){
	print '<html><head><title>'.$title.'</title></head>';
	print '<body bgcolor="'.$color.'">';
}

//5-9 - Změna hodnot argumentů 
function countdown($top){
	while($top>0){
	  print "$top<br>";
	  $top--;
	}	
}

$counter = 5;
print "<br>";
countdown($counter);
print "Now counter is $counter";

//5-10 - zachycení návratové hodnoty
$number_to_display = number_format(321442019);
print "<br><br>";
print "The population of the US is about : $number_to_display";

//5-11 - vrácení hodnoty z funkce
function restaurant_check($meal, $tax, $tip){
	$tax_amount = $meal*($tax/100);
	$tip_amount = $meal*($tip/100);
	$total_amount = $meal + $tax_amount + $tip_amount;
	
	return $total_amount;
}

//5-12 - návratová hodnota v příkazu if()
$total = restaurant_check(15.22,8.25,15);

print "<br><br>";
print 'I only have $20 in cash, so...';
if($total>20){
	print "I must pay with my credit card.";
} else {
	print "I can pay with cash";
}

//5-13 - vrácení pole z funkce (více vrácených hodnot)
function restaurant_check2($meal, $tax, $tip){
	$tax_amount = $meal*($tax/100);
	$tip_amount = $meal*($tip/100);
	$total_notip = $meal+$tax_amount;
	$total_tip = $meal+$tax_amount+$tip_amount;	
	
	$amount = array($total_notip, $total_tip);
	
	return $amount;
}

//5-14 - užití pole vráceného z funkce
print "<br><br>";
$totals = restaurant_check2(15.22,8.25,15);

if($totals[0]<20){
  print 'The total without tip is less than $20<br>';	
}
if($totals[1]<20){
  print 'The total tip is less than $20<br>';	
}
	
//5-15 - několik příznaků return ve funkci
function payment_method($cash_on_hand, $amount){
	if($amount > $cash_on_hand){
		return 'credit card';
	} else {
		return 'cash';
	}
}

//5-16 - předání návratové hodnoty do jiné funkce
$total = restaurant_check(15.22,8.25,15);
$method = payment_method(20, $total);
print "<br><br>";
print ' will pay with '. $method;

//5-17 - užití návratových hodnot s if()
print "<br><br>";
if(restaurant_check(15.22,8.25,15) < 20){
	print 'Less than $20, I can pay cash';
} else {
	print 'Too expensive, I need my credit card.';
}

//5-18 - funkce vracející true nebo false
function can_pay_cash($cash_on_hand, $amount){
	if($amount > $cash_on_hand){
		return false;
	} else {
		return true;
	}
}

$total = restaurant_check(15.22,8.25,15);
print "<br><br>";
if(can_pay_cash(20, $total)){
	print 'I can pay in cash.';
} else {
	print 'Time for the credit card.';
}

//5-19 - přirazení a funkční volání uvnitř testovacího výrazu
function complete_bill($meal, $tax, $tip, $cash_on_hand){
	$tax_amount = $meal*($tax/100);
	$tip_amount = $meal*($tip/100);
	$total_amount = $meal + $tax_amount + $tip_amount;
	if($total_amount > $cash_on_hand){
		return false; // účet je větší než máme u sebe hotových peněz
	} else {
		return $total_amount; //tuto částku můžeme zaplatit hotově
	}		
}

print "<br><br>";
if($total = complete_bill(15.22,8.25,15,20)){
	print "I'm happy to pay $total";
} else {
	print "I don't have enough money. Shall I was some dishes?";
}

//5-20 - obor proměnné
$dinner = 'Curry Cuttlefish'; //globální proměnná
print "<br><br>";

function vegetarian_dinner(){	
	print "Dinner is $dinner, or "; //proměnná $dinner není nastavená a nemá žádný efekt
	$dinner = 'Sauteed Pea Shoots';
	print $dinner;
	print '<br>';
}

function kosher_dinner(){	
	print "Dinner is $dinner, or "; //proměnná $dinner není nastavená a nemá žádný efekt
	$dinner = 'Kung Pea Shoots';
	print $dinner;
	print '<br>';
}

print "Vegetarian ";
vegetarian_dinner();
print "Kosher ";
kosher_dinner();
print "Regular dinner is $dinner<br>"; //přistupujeme ke globální proměnné

//5-21 - pole $GLOBALS - přístup ke globálním proměnným - $GLOBALS je autoglobální proměnná = je k ní přístup všude automaticky
$dinner = 'Curry Cuttlefish'; //globální proměnná

function macrobiotic_dinner(){
	$dinner = "Some vegetables ";
	print "Dinner is $dinner";
	//Neodolal vábení oceánu
	print " bud I'd rahter have ";
	print $GLOBALS['dinner'];
	print "<br>";
}

macrobiotic_dinner();
print "Regular dinner is: $dinner<br>";

//5-22 - modifikace proměnné pomocí $GLOBALS
$dinner = 'Curry Cuttlefish'; //globální proměnná

function hungry_dinner(){
	$GLOBALS['dinner'] .=  ' and Deep-Fried Taro'; //změna globální proměnné
}

print "Regular dinner is $dinner<br>";
hungry_dinner();
print "Hungry dinner is $dinner<br>";

//5-23 - klíčové slovo global pro přístup ke globální proměnné
$dinner = 'Curry Cuttlefish'; //globální proměnná

function vegetarian_dinner_global(){	
	global $dinner; //přenesení proměnné do lokálního oboru
	print "Dinner was $dinner, but now it's "; 
	$dinner = 'Sauteed Pea Shoots';
	print $dinner;
	print '<br>';
}

print "Regular Dinner is $dinner.<br>";
vegetarian_dinner_global();
print "Regular Dinner is $dinner<br>";

//5-24 - deklarace typu pro argument
function countdown2(int $top){
	while($top>0){
		print $top;
		$top--;
	}
	print "boom!<br>";
}

$counter = 5;
countdown2($counter); //předání proměnné typu int
print "Now, counter is $counter<br>";
//countdown2("grunt"); //předání proměnné jiného typu než int, vyhodí fatal error

//5-25 - deklarace návratového typu
//declare(strict_types=1); //vynucení dodržení typu bez pokusu o konverzi na požadovaný typ - musí být na začátku souboru
function restaurant_check1($meal, $tax, $tip): float{ //návratový typ float - desetinné číslo
	$tax_amount = $meal*($tax/100);
	$tip_amount = $meal*($tip/100);
	$total_amount = $meal + $tax_amount + $tip_amount;
	
	return $total_amount;
}

/* nucené výchozí chování je, že návratové hodnoty se snaží PHP překonvertovat na požadovaný typ, ale pokud chceme vynutit přesné vrácení hodnoty, tak uvádíme
   na začátku souboru declare(strict_type=1);
*/

//5-26 - rozdělení funkcí do různých souborů - restaurant-functions.php

//5-27 - odkaz na samostatný soubor

require 'restaurant-functions.php';
/* účet je $25, plus daň 8.875% tax plus spropitné 20% */
$total_bill = restaurant_check2(25,8.875,20);
/* účet je celkem 30 dolarů */
$cash = 30;
print "I need to pay with ".payment_method1($cash, $total_bill)

?>