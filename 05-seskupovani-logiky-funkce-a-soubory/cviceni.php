<?php

// 1. cvičení
function image_html($url, $alt=null,$height=null, $width=null){
	
	$path = '<img src="'.$url.'"';
	
	if(isset($alt)){
		$path .= ' alt="'.$alt.'"';
	}
	if(isset($height)){
		$path .= ' height="'.$height.'"';
	}
	if(isset($width)){
		$path .= ' width="'.$width.'"';
	}
	
	$path .=  '/>';
	
	return $path;
}

print "<html><body>"; //začátek HTML stránky

print image_html('car-transparent.png');
print "<br>";
print image_html('car-transparent.png','muj obrazek auta');
print "<br>";
print image_html('car-transparent.png','muj obrazek auta', 40,);
print "<br>";
print image_html('car-transparent.png','muj obrazek auta', 50,50);
print "<br>";

// 2. cvičení
$addr_images = "/images/";
function image_html2($file_name, $alt='',$height='', $width=''){
	if(isset($GLOBALS['addr_images'])){
	  $path = '.'.$GLOBALS['addr_images'].$file_name;	
	}		
	
	if(isset($alt)){
		$path .= ' alt="'.$alt.'"';
	}
	if(isset($height)){
		$path .= ' height="'.$height.'"';
	}
	if(isset($width)){
		$path .= ' width="'.$width.'"';
	}
	
	return '<img src="'.$path.'" alt="'.$alt.'" height="'.$height.'" width="'.$width.'" />';
}

print image_html2('car-transparent.png');



// 3. cvičení
require 'cviceni-soubor-images.php';
print "<br>";
print image_html3('car-transparent.png');
print "<br>";
print image_html3('car-transparent.png','nazev',200,100);
print "<br>";
print image_html3('car-transparent.png');

// 4. cvičení
function restaurant_check($meal, $tax, $tip){
	$tax_amount = $meal*($tax/100);
	$tip_amount = $meal*($tip/100);
	return $meal + $tax_amount + $tip_amount;
}

$cash_on_hand = 31;
$meal = 25;
$tax = 10;
$tip = 10;

print "<br>";
while(($cost = restaurant_check($meal, $tax, $tip)) < $cash_on_hand){
	$tip++;
	print "I can afford a tip of $tip% ($cost)<br>";
}

// 4. cvičení
function hex_color($red, $green, $blue){
	$red = dechex($red);
	$green = dechex($green);
	$blue = dechex($blue);
	if (strlen($red)<2){
		$red = '0'.$red;
	}
	if (strlen($green)<2){
		$green  = '0'.$green;
	}
	if (strlen($blue)<2){
		$blue = '0'.$blue;
	}
	return "#".$red.$green.$blue;
}

print hex_color(255,0,255);

print "</body></html>"; //konec HTML stránky
?>